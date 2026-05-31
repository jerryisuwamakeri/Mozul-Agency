<?php

namespace App\Services;

use App\Models\PageView;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PageViewTracker
{
    public static function track(Model $viewable, Request $request): void
    {
        $ip      = $request->ip();
        $session = $request->session()->getId();

        // Deduplicate: one view per session per content
        $key = 'view_' . class_basename($viewable) . '_' . $viewable->id . '_' . $session;
        if (Cache::has($key)) return;
        Cache::put($key, true, now()->addHours(1));

        [$country, $code] = static::resolveCountry($ip);

        PageView::create([
            'viewable_type' => get_class($viewable),
            'viewable_id'   => $viewable->id,
            'session_id'    => substr($session, 0, 64),
            'ip_hash'       => hash('sha256', $ip),
            'country'       => $country,
            'country_code'  => $code,
            'referer'       => substr($request->headers->get('referer', ''), 0, 255) ?: null,
            'user_agent'    => substr($request->userAgent() ?? '', 0, 255),
            'created_at'    => now(),
        ]);
    }

    private static function resolveCountry(string $ip): array
    {
        if (in_array($ip, ['127.0.0.1', '::1', '::ffff:127.0.0.1'])) {
            return ['Local', 'LO'];
        }

        return Cache::remember("geoip_{$ip}", now()->addDay(), function () use ($ip) {
            try {
                $res = Http::timeout(2)->get("http://ip-api.com/json/{$ip}?fields=country,countryCode,status");
                if ($res->ok() && $res->json('status') === 'success') {
                    return [$res->json('country'), $res->json('countryCode')];
                }
            } catch (\Throwable $e) {}
            return [null, null];
        });
    }
}
