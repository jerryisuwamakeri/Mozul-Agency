<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name',       'label' => 'Site Name',         'value' => 'Mozul Africa',                  'type' => 'text',    'group' => 'general', 'order' => 1],
            ['key' => 'site_tagline',    'label' => 'Tagline',           'value' => 'Created to Create.',            'type' => 'text',    'group' => 'general', 'order' => 2],
            ['key' => 'site_email',      'label' => 'Contact Email',     'value' => 'hello@mozulafrica.com',         'type' => 'text',    'group' => 'general', 'order' => 3],
            ['key' => 'site_phone',      'label' => 'Phone Number',      'value' => '+234 (0) 813 929 4463',         'type' => 'text',    'group' => 'general', 'order' => 4],
            ['key' => 'site_address',    'label' => 'Address',           'value' => 'Abuja, Nigeria',                'type' => 'text',    'group' => 'general', 'order' => 5],
            // Hero
            ['key' => 'hero_headline',   'label' => 'Hero Headline',     'value' => 'We Build Digital Brands That Grow, Lead, and Last.', 'type' => 'text', 'group' => 'hero', 'order' => 1],
            ['key' => 'hero_subheadline','label' => 'Hero Subheadline',  'value' => 'Mozul Africa is a creative digital marketing agency helping businesses, founders, and executives across Africa build powerful digital identities through strategy, storytelling, content, and growth marketing.', 'type' => 'textarea', 'group' => 'hero', 'order' => 2],
            ['key' => 'hero_cta_primary','label' => 'Primary CTA Text',  'value' => 'Book a Discovery Call',        'type' => 'text',    'group' => 'hero', 'order' => 3],
            ['key' => 'hero_cta_secondary','label'=>'Secondary CTA Text','value' => 'View Our Services',            'type' => 'text',    'group' => 'hero', 'order' => 4],
            // Stats
            ['key' => 'stat_brands',     'label' => 'Brands Served',     'value' => '10+',                          'type' => 'text',    'group' => 'stats', 'order' => 1],
            ['key' => 'stat_engagement', 'label' => 'Engagement Growth', 'value' => '3×',                           'type' => 'text',    'group' => 'stats', 'order' => 2],
            ['key' => 'stat_products',   'label' => 'Knowledge Products','value' => '9',                            'type' => 'text',    'group' => 'stats', 'order' => 3],
            ['key' => 'stat_industries', 'label' => 'Industries Served', 'value' => '5+',                          'type' => 'text',    'group' => 'stats', 'order' => 4],
            // Social
            ['key' => 'social_instagram','label' => 'Instagram URL',     'value' => '',                             'type' => 'text',    'group' => 'social', 'order' => 1],
            ['key' => 'social_twitter',  'label' => 'Twitter / X URL',   'value' => '',                             'type' => 'text',    'group' => 'social', 'order' => 2],
            ['key' => 'social_linkedin', 'label' => 'LinkedIn URL',      'value' => '',                             'type' => 'text',    'group' => 'social', 'order' => 3],
            ['key' => 'social_facebook', 'label' => 'Facebook URL',      'value' => '',                             'type' => 'text',    'group' => 'social', 'order' => 4],
            // SEO
            ['key' => 'meta_description','label' => 'Default Meta Description', 'value' => 'Mozul Africa is a creative digital marketing agency helping businesses across Africa grow their digital brands.', 'type' => 'textarea', 'group' => 'seo', 'order' => 1],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
