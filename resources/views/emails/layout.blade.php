<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { background: #f4f4f5; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; color: #111; line-height: 1.6; }
  .wrapper { max-width: 560px; margin: 40px auto; padding: 0 16px 40px; }
  .card { background: #fff; border-radius: 16px; border: 1px solid #e4e4e7; overflow: hidden; }
  .header { background: #111; padding: 28px 32px; display: flex; align-items: center; gap: 12px; }
  .header-text { color: #fff; font-size: 15px; font-weight: 700; }
  .header-sub { color: rgba(255,255,255,0.5); font-size: 12px; margin-top: 2px; }
  .body { padding: 32px; }
  .label { font-size: 10px; font-weight: 700; color: #71717a; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 4px; }
  .value { font-size: 15px; color: #111; font-weight: 500; word-break: break-word; }
  .field { margin-bottom: 20px; }
  .message-box { background: #f9f9fb; border: 1px solid #e4e4e7; border-radius: 10px; padding: 16px; margin-top: 4px; font-size: 14px; color: #444; line-height: 1.7; white-space: pre-wrap; word-break: break-word; }
  .divider { height: 1px; background: #f0f0f2; margin: 24px 0; }
  .btn { display: inline-block; background: #111; color: #fff !important; text-decoration: none; font-size: 13px; font-weight: 700; padding: 12px 24px; border-radius: 10px; margin-top: 8px; }
  .btn:hover { background: #333; }
  .footer { padding: 20px 32px; border-top: 1px solid #f0f0f2; display: flex; align-items: center; justify-content: space-between; }
  .footer-text { font-size: 11px; color: #a1a1aa; }
  .badge { display: inline-block; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; padding: 3px 8px; border-radius: 100px; background: #111; color: #fff; }
</style>
</head>
<body>
<div class="wrapper">
  <div class="card">
    <div class="header">
      <div>
        <div class="header-text">Mozul Africa</div>
        <div class="header-sub">Admin Notification</div>
      </div>
    </div>
    <div class="body">
      @yield('content')
    </div>
    <div class="footer">
      <span class="footer-text">© {{ date('Y') }} Mozul Africa · Automated notification</span>
      <span class="badge">Admin</span>
    </div>
  </div>
  <p style="text-align:center;font-size:11px;color:#a1a1aa;margin-top:16px;">You're receiving this because you're an admin at Mozul Africa.</p>
</div>
</body>
</html>
