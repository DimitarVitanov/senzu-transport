<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Seeds the content for the single-page furniture-removals landing.
     *
     * Safe to re-run: settings/features/services/testimonials use position-keyed
     * updateOrCreate, so nothing is duplicated. Contact details (email, socials,
     * site name) use firstOrCreate so any admin edits are preserved. Only the
     * phone is force-updated to the current brand number.
     */
    public function run(): void
    {
        $this->removeLegacySettings();

        // --- Force-set: the current brand phone number ---
        SiteSetting::set('phone', '0424 033 572', 'text', 'general');
        SiteSetting::set('phone_raw', '+61424033572', 'text', 'general');

        // --- Preserve if already set (created with defaults only when missing) ---
        $ensure = [
            ['key' => 'site_name', 'value' => 'Senzu Transport', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'And Logistics', 'type' => 'text', 'group' => 'general'],
            ['key' => 'email', 'value' => 'info@senzutransport.com.au', 'type' => 'text', 'group' => 'general'],
            ['key' => 'notification_email', 'value' => 'senzutransport@gmail.com', 'type' => 'text', 'group' => 'general'],
            ['key' => 'facebook_url', 'value' => 'https://www.facebook.com/senzutransport', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'instagram_url', 'value' => 'https://www.instagram.com/senzutransport', 'type' => 'text', 'group' => 'contact'],
        ];
        foreach ($ensure as $s) {
            SiteSetting::firstOrCreate(['key' => $s['key']], $s);
        }

        // --- Landing content (force-set to the current design) ---
        $content = [
            // Hero
            ['key' => 'hero_title_line1', 'value' => 'FURNITURE', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_title_line2', 'value' => 'REMOVALS', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_title_accent', 'value' => 'BRISBANE', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_subtitle_pre', 'value' => 'SAFE.', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_subtitle_accent', 'value' => 'RELIABLE', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_subtitle_post', 'value' => 'STRESS FREE.', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_description', 'value' => "We handle your furniture with care from start to finish. Whether you're moving a single item, an apartment, or a large family home, our experienced team makes moving easy.", 'type' => 'textarea', 'group' => 'hero'],

            // Services section
            ['key' => 'services_title', 'value' => 'OUR REMOVAL SERVICES', 'type' => 'text', 'group' => 'services'],

            // Process ("Moving Made Easy")
            ['key' => 'process_title', 'value' => 'MOVING MADE EASY', 'type' => 'text', 'group' => 'process'],

            // Service areas + reviews
            ['key' => 'areas_title', 'value' => 'SERVICE AREAS', 'type' => 'text', 'group' => 'areas'],
            ['key' => 'service_areas', 'value' => 'Brisbane, Gold Coast, Logan, Sunshine Coast, Ipswich, Toowoomba', 'type' => 'text', 'group' => 'areas'],
            ['key' => 'reviews_title', 'value' => 'WHAT OUR CUSTOMERS SAY', 'type' => 'text', 'group' => 'areas'],

            // CTA band
            ['key' => 'cta_title_pre', 'value' => 'READY TO', 'type' => 'text', 'group' => 'cta'],
            ['key' => 'cta_title_accent', 'value' => 'MOVE?', 'type' => 'text', 'group' => 'cta'],
            ['key' => 'cta_subtitle', 'value' => 'Get a fast, obligation-free quote today.', 'type' => 'text', 'group' => 'cta'],

            // Footer
            ['key' => 'footer_tagline', 'value' => "Brisbane's trusted furniture removalists. We take the stress out of moving.", 'type' => 'textarea', 'group' => 'footer'],

            // SEO
            ['key' => 'seo_title', 'value' => 'Senzu Transport and Logistics | Professional Furniture Removals Brisbane', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'seo_description', 'value' => 'Professional furniture removalists in Brisbane. House moves, office relocations, packing & unpacking services. Fully insured, reliable movers serving Brisbane, Gold Coast, Sunshine Coast & Queensland.', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'seo_keywords', 'value' => 'furniture removals Brisbane, house movers, office relocations, packing services, removalists Brisbane, Gold Coast movers, Sunshine Coast removals, Queensland removals, furniture delivery, interstate removals', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'seo_og_image', 'value' => 'https://senzutransport.com.au/images/hero-section-1.webp', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'seo_url', 'value' => 'https://senzutransport.com.au', 'type' => 'text', 'group' => 'seo'],
        ];
        foreach ($content as $s) {
            SiteSetting::updateOrCreate(['key' => $s['key']], $s);
        }

        // --- Features Bar (icons row) — section: hero_features ---
        $featuresBar = [
            ['title' => 'FULLY INSURED', 'description' => 'Your peace of mind is our priority.', 'icon' => 'shield'],
            ['title' => 'LOCAL & INTERSTATE', 'description' => 'Moving across town or across the country.', 'icon' => 'truck'],
            ['title' => 'RESIDENTIAL & COMMERCIAL', 'description' => 'Solutions for homes and businesses.', 'icon' => 'house'],
            ['title' => 'EXPERIENCED REMOVALISTS', 'description' => 'Skilled team. Great service every time.', 'icon' => 'people'],
            ['title' => 'MODERN FLEET', 'description' => 'Reliable trucks equipped for safe transport.', 'icon' => 'truck'],
            ['title' => 'TRUSTED BY CUSTOMERS', 'description' => '5-star service you can rely on.', 'icon' => 'star'],
        ];

        // --- "Moving Made Easy" steps — section: how_it_works ---
        $steps = [
            ['title' => 'REQUEST A QUOTE', 'description' => 'Tell us what you need moved.', 'icon' => 'icon-list'],
            ['title' => 'BOOK YOUR MOVE', 'description' => 'Choose a time that suits you.', 'icon' => 'icon-calendar'],
            ['title' => 'WE PACK & TRANSPORT', 'description' => 'Our team handles everything with care.', 'icon' => 'icon-truck-two'],
            ['title' => 'YOU RELAX', 'description' => 'Your items arrive safely at your new home.', 'icon' => 'icon-chair'],
        ];

        // --- CTA feature icons — section: why_choose ---
        $ctaFeatures = [
            ['title' => 'SAFE HANDLING', 'description' => 'Careful with every item.', 'icon' => 'icon-safe-handlling'],
            ['title' => 'ON-TIME SERVICE', 'description' => 'We show up when we say we will.', 'icon' => 'icon-on-time'],
            ['title' => 'FULLY INSURED', 'description' => 'Your move is fully protected.', 'icon' => 'icon-fully-secured'],
            ['title' => 'CAREFUL MOVERS', 'description' => 'Trained, professional team.', 'icon' => 'icon-careful-movers'],
        ];

        $this->seedFeatureSection('hero_features', $featuresBar);
        $this->seedFeatureSection('how_it_works', $steps);
        $this->seedFeatureSection('why_choose', $ctaFeatures);

        // --- Services (6 cards) ---
        $services = [
            ['title' => 'HOUSE MOVES', 'description' => 'Full home relocations throughout Brisbane and South East Queensland.', 'icon' => 'icon-house', 'image' => '/images/service-house-moves.webp'],
            ['title' => 'OFFICE RELOCATIONS', 'description' => 'Fast and professional business relocations.', 'icon' => 'icon-office', 'image' => '/images/service-office.webp'],
            ['title' => 'PACKING SERVICES', 'description' => 'Furniture wrapping, packing supplies and protection.', 'icon' => 'icon-packing', 'image' => '/images/service-packing.webp'],
            ['title' => 'INTERSTATE MOVES', 'description' => 'Queensland, New South Wales and beyond.', 'icon' => 'icon-truck', 'image' => '/images/service-interstate.webp'],
            ['title' => 'PACKAGING REMOVAL', 'description' => 'Removal of moving boxes and packaging waste.', 'icon' => 'icon-recycle', 'image' => '/images/service-packaging.webp'],
            ['title' => 'FURNITURE DELIVERY', 'description' => 'Single furniture items and specialty deliveries.', 'icon' => 'icon-chair', 'image' => '/images/service-furniture.webp'],
        ];
        foreach ($services as $i => $service) {
            Service::updateOrCreate(
                ['sort_order' => $i + 1],
                array_merge($service, ['bullet_points' => [], 'sort_order' => $i + 1, 'is_active' => true])
            );
        }

        // --- Testimonials (3) ---
        $testimonials = [
            ['name' => 'Sarah J.', 'location' => 'Brisbane', 'content' => 'Senzu Transport made our move so easy. The team was on time, careful and very professional.', 'rating' => 5],
            ['name' => 'Michael T.', 'location' => 'Gold Coast', 'content' => 'Excellent service from start to finish. Highly recommend these guys!', 'rating' => 5],
            ['name' => 'Lisa P.', 'location' => 'Logan', 'content' => 'Great communication, fair pricing and nothing was too much trouble. Would use again!', 'rating' => 5],
        ];
        foreach ($testimonials as $i => $testimonial) {
            Testimonial::updateOrCreate(
                ['sort_order' => $i + 1],
                array_merge($testimonial, ['sort_order' => $i + 1, 'is_active' => true])
            );
        }
    }

    /**
     * Remove settings that belonged to the old multi-page site (About/Services/
     * Contact/Gallery pages, stats bar, etc.) which no longer have a home on the
     * single-page landing. Contact details, phone, email and socials are kept.
     */
    private function removeLegacySettings(): void
    {
        $legacyKeys = [
            // old hero
            'hero_badge', 'hero_title_line3', 'hero_cta_primary', 'hero_cta_secondary',
            'hero_bullet_1', 'hero_bullet_2', 'hero_bullet_3', 'hero_bullet_4', 'hero_bullet_5', 'hero_bullet_6',
            // old services header
            'services_badge', 'services_subtitle', 'services_description',
            // stats bar
            'stat_1_number', 'stat_1_label', 'stat_1_sub', 'stat_2_number', 'stat_2_label', 'stat_2_sub',
            'stat_3_label', 'stat_3_sub', 'stat_4_label', 'stat_4_sub',
            // how it works (now driven by Features)
            'how_badge', 'how_title', 'how_title_accent', 'how_description',
            // why choose (now driven by Features)
            'why_title', 'why_title_accent',
            // about page
            'about_badge', 'about_title', 'about_title_accent', 'about_subtitle', 'about_paragraph_1',
            'about_paragraph_2', 'about_values_heading', 'about_value_1', 'about_value_2', 'about_value_3',
            'about_value_4', 'about_paragraph_3', 'about_closing',
            // contact page text (facebook_url / instagram_url are kept)
            'contact_badge', 'contact_title', 'contact_title_accent', 'contact_subtitle', 'contact_form_heading',
            'contact_form_description', 'contact_info_heading', 'contact_hours', 'contact_area',
            // footer badges
            'footer_badge_1', 'footer_badge_2', 'footer_badge_3', 'footer_badge_4',
            // old CTA copy
            'cta_title', 'cta_description', 'cta_tagline',
        ];

        SiteSetting::whereIn('key', $legacyKeys)->delete();
    }

    /**
     * Seed a feature section by position so re-runs never duplicate rows.
     */
    private function seedFeatureSection(string $section, array $items): void
    {
        foreach ($items as $i => $item) {
            Feature::updateOrCreate(
                ['section' => $section, 'sort_order' => $i + 1],
                array_merge($item, ['section' => $section, 'sort_order' => $i + 1, 'is_active' => true])
            );
        }
    }
}
