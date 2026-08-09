<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Server-render SEO meta + structured data into the root template so
        // search engines and AI crawlers (which often don't run JS) get the
        // full picture. All values are admin-editable via the "seo" settings.
        View::composer('app', function ($view) {
            $view->with('seo', $this->seoData());
        });
    }

    private function seoData(): array
    {
        $get = function (string $key, $default = null) {
            try {
                return SiteSetting::get($key, $default);
            } catch (Throwable $e) {
                return $default;
            }
        };

        $title = $get('seo_title', 'Senzu Transport and Logistics | Professional Furniture Removals Brisbane');
        $description = $get('seo_description', 'Professional furniture removalists in Brisbane. House moves, office relocations, packing & unpacking services. Fully insured, reliable movers serving Brisbane, Gold Coast, Sunshine Coast & Queensland.');
        $keywords = $get('seo_keywords', 'furniture removals Brisbane, house movers, office relocations, packing services, removalists Brisbane');
        $url = rtrim($get('seo_url', 'https://senzutransport.com.au'), '/');
        $image = $get('seo_og_image', $url.'/images/hero-section-1.webp');
        $phone = $get('phone_raw', '+61424033572');
        $email = $get('email', 'info@senzutransport.com.au');
        $facebook = $get('facebook_url', 'https://www.facebook.com/senzutransport');
        $instagram = $get('instagram_url', 'https://www.instagram.com/senzutransport');
        $areas = array_values(array_filter(array_map('trim', explode(',', (string) $get('service_areas', 'Brisbane, Gold Coast, Logan, Sunshine Coast, Ipswich, Toowoomba')))));

        $jsonLd = [
            [
                '@context' => 'https://schema.org',
                '@type' => 'MovingCompany',
                'name' => 'Senzu Transport and Logistics',
                'description' => $description,
                'url' => $url,
                'telephone' => $phone,
                'email' => $email,
                'image' => $image,
                'logo' => $url.'/images/logo-light.webp',
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => 'Brisbane',
                    'addressRegion' => 'QLD',
                    'addressCountry' => 'AU',
                ],
                'areaServed' => $areas,
                'priceRange' => '$$',
                'openingHours' => 'Mo-Sa 07:00-19:00',
                'sameAs' => array_values(array_filter([$facebook, $instagram])),
            ],
            [
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => [
                    ['@type' => 'Question', 'name' => 'How do I book a move with Senzu Transport?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Request a free quote online or call us. We provide an obligation-free quote and help you book your move at a time that suits you.']],
                    ['@type' => 'Question', 'name' => 'What areas do you service?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'We service '.implode(', ', $areas).' and surrounding areas in South East Queensland.']],
                    ['@type' => 'Question', 'name' => 'Are you fully insured?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes, Senzu Transport is fully insured for all moves. We handle your items with care and professionalism.']],
                ],
            ],
        ];

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'url' => $url,
            'image' => $image,
            'jsonld' => json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        ];
    }
}
