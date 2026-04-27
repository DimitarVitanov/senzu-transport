<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // Site Settings
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'Senzu Transport', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'And Logistics', 'type' => 'text', 'group' => 'general'],
            ['key' => 'phone', 'value' => '0456 155 078', 'type' => 'text', 'group' => 'general'],
            ['key' => 'phone_raw', 'value' => '+61456155078', 'type' => 'text', 'group' => 'general'],
            ['key' => 'email', 'value' => 'senzutransport@gmail.com', 'type' => 'text', 'group' => 'general'],

            // Hero
            ['key' => 'hero_badge', 'value' => "BRISBANE'S TRUSTED DELIVERY SPECIALISTS", 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_title_line1', 'value' => 'DELIVERY,', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_title_line2', 'value' => 'INSTALLATION & MORE —', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_title_accent', 'value' => 'DONE RIGHT', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_title_line3', 'value' => '', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_description', 'value' => "We deliver more than just white goods.\nFrom furniture, drawers and single items to full loads —\nwe handle delivery, installation, store pickups\nand rubbish removal.", 'type' => 'textarea', 'group' => 'hero'],
            ['key' => 'hero_cta_primary', 'value' => 'GET A QUOTE', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_cta_secondary', 'value' => 'BOOK DELIVERY', 'type' => 'text', 'group' => 'hero'],

            // Hero bullet points
            ['key' => 'hero_bullet_1', 'value' => 'White goods delivery & installation', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_bullet_2', 'value' => 'Room of choice + setup', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_bullet_3', 'value' => 'Furniture, drawers & general items', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_bullet_4', 'value' => 'Store pickups & rubbish removal', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_bullet_5', 'value' => 'Single item or full load deliveries', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_bullet_6', 'value' => 'Parcels, boxes & pallet transport', 'type' => 'text', 'group' => 'hero'],

            // Services Section
            ['key' => 'services_badge', 'value' => 'OUR SERVICES', 'type' => 'text', 'group' => 'services'],
            ['key' => 'services_title', 'value' => 'WE DO MORE', 'type' => 'text', 'group' => 'services'],
            ['key' => 'services_subtitle', 'value' => "SO YOU DON'T HAVE TO", 'type' => 'text', 'group' => 'services'],
            ['key' => 'services_description', 'value' => "From single items to full loads - we deliver, install and remove.\nFast, reliable and done right.", 'type' => 'textarea', 'group' => 'services'],

            // Stats
            ['key' => 'stat_1_number', 'value' => '500+', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_1_label', 'value' => 'JOBS COMPLETED', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_1_sub', 'value' => 'Across Brisbane', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_2_number', 'value' => '5.0', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_2_label', 'value' => 'STAR RATING', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_2_sub', 'value' => 'Google Reviews', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_3_label', 'value' => 'FULLY INSURED', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_3_sub', 'value' => 'Goods in Transit & Public Liability', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_4_label', 'value' => 'LOCAL BRISBANE', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_4_sub', 'value' => 'Proudly supporting our community', 'type' => 'text', 'group' => 'stats'],

            // How It Works
            ['key' => 'how_badge', 'value' => 'BUILT FOR THE TOUGH JOBS', 'type' => 'text', 'group' => 'how'],
            ['key' => 'how_title', 'value' => 'WE HANDLE WHAT', 'type' => 'text', 'group' => 'how'],
            ['key' => 'how_title_accent', 'value' => "OTHERS CAN'T", 'type' => 'text', 'group' => 'how'],
            ['key' => 'how_description', 'value' => 'From tight staircases to heavy appliance installs, our trained team and modern equipment get every job done safely and efficiently.', 'type' => 'textarea', 'group' => 'how'],

            // Why Choose Us
            ['key' => 'why_title', 'value' => 'WHY CHOOSE', 'type' => 'text', 'group' => 'why'],
            ['key' => 'why_title_accent', 'value' => 'SENZU TRANSPORT?', 'type' => 'text', 'group' => 'why'],

            // CTA
            ['key' => 'cta_title', 'value' => 'NEED IT DELIVERED TODAY?', 'type' => 'text', 'group' => 'cta'],
            ['key' => 'cta_title_accent', 'value' => 'DONE RIGHT?', 'type' => 'text', 'group' => 'cta'],
            ['key' => 'cta_description', 'value' => 'Same-day availability • Fast response', 'type' => 'text', 'group' => 'cta'],
            ['key' => 'cta_tagline', 'value' => 'We get it done right.', 'type' => 'text', 'group' => 'cta'],

            // About Page
            ['key' => 'about_badge', 'value' => 'ABOUT US', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_title', 'value' => 'SENZU TRANSPORT', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_title_accent', 'value' => '& LOGISTICS', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_subtitle', 'value' => "Brisbane's trusted delivery and installation service built on reliability, precision, and doing the job right the first time.", 'type' => 'textarea', 'group' => 'about'],
            ['key' => 'about_paragraph_1', 'value' => "We don't just move items from A to B — we handle the full process. From single-item deliveries to full loads, our team takes care of transport, room-of-choice placement, installation, and rubbish removal, so you don't have to deal with multiple providers.", 'type' => 'textarea', 'group' => 'about'],
            ['key' => 'about_paragraph_2', 'value' => "With experience across white goods, furniture, store pickups, and general freight, we understand how to handle items safely and professionally. Whether it's a fridge, washing machine, lounge, or pallet delivery, every job is treated with care and attention to detail.", 'type' => 'textarea', 'group' => 'about'],
            ['key' => 'about_values_heading', 'value' => 'We focus on what matters most to our customers:', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_value_1', 'value' => 'Turning up on time', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_value_2', 'value' => 'Handling items properly', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_value_3', 'value' => 'Communicating clearly', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_value_4', 'value' => 'Leaving the space clean and ready to use', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_paragraph_3', 'value' => "As a local Brisbane business, we take pride in providing a service that's fast, reliable, and easy to deal with. No shortcuts, no excuses — just solid work and consistent results.", 'type' => 'textarea', 'group' => 'about'],
            ['key' => 'about_closing', 'value' => 'Senzu Transport and Logistics — we get it done right.', 'type' => 'text', 'group' => 'about'],

            // Contact Page
            ['key' => 'contact_badge', 'value' => 'GET IN TOUCH', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_title', 'value' => 'CONTACT', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_title_accent', 'value' => 'US', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_subtitle', 'value' => 'Have a delivery or installation job? Get in touch for a fast, free quote. We respond quickly.', 'type' => 'textarea', 'group' => 'contact'],
            ['key' => 'contact_form_heading', 'value' => 'Request a Free Quote', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_form_description', 'value' => 'Fill in the details below and we\'ll get back to you ASAP.', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_info_heading', 'value' => 'Other Ways to Reach Us', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_hours', 'value' => 'Mon – Sun: 6:00am – 8:00pm', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_area', 'value' => 'Servicing Brisbane & surrounding areas', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'facebook_url', 'value' => 'https://www.facebook.com/senzutransport', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'instagram_url', 'value' => 'https://www.instagram.com/senzutransport', 'type' => 'text', 'group' => 'contact'],

            // Footer badges
            ['key' => 'footer_badge_1', 'value' => 'LOCAL BRISBANE BUSINESS', 'type' => 'text', 'group' => 'footer'],
            ['key' => 'footer_badge_2', 'value' => 'FULLY INSURED', 'type' => 'text', 'group' => 'footer'],
            ['key' => 'footer_badge_3', 'value' => '5 STAR SERVICE', 'type' => 'text', 'group' => 'footer'],
            ['key' => 'footer_badge_4', 'value' => 'SATISFACTION GUARANTEED', 'type' => 'text', 'group' => 'footer'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // Hero Features (icon row below hero)
        $heroFeatures = [
            ['title' => 'SINGLE ITEM DELIVERIES', 'description' => 'From one item to a full load.', 'icon' => 'cube', 'section' => 'hero_features', 'sort_order' => 1],
            ['title' => 'SAME-DAY & URGENT JOBS', 'description' => 'Fast response when you need it most.', 'icon' => 'clock', 'section' => 'hero_features', 'sort_order' => 2],
            ['title' => 'FULLY INSURED & RELIABLE', 'description' => 'Your items are in safe hands.', 'icon' => 'shield', 'section' => 'hero_features', 'sort_order' => 3],
            ['title' => 'LOCAL BRISBANE BUSINESS', 'description' => 'Proudly serving homes and businesses.', 'icon' => 'map-pin', 'section' => 'hero_features', 'sort_order' => 4],
        ];

        // How It Works Features
        $howFeatures = [
            ['title' => 'TIGHT ACCESS SPECIALISTS', 'description' => 'Stairs, apartments, narrow access — no problem.', 'icon' => 'stairs', 'section' => 'how_it_works', 'sort_order' => 1],
            ['title' => 'EXPERIENCED TEAM', 'description' => 'Skilled, careful and professional in every delivery.', 'icon' => 'users', 'section' => 'how_it_works', 'sort_order' => 2],
            ['title' => 'CARE-FIRST HANDLING', 'description' => 'We treat your items like our own.', 'icon' => 'heart', 'section' => 'how_it_works', 'sort_order' => 3],
        ];

        // Why Choose Us Features
        $whyFeatures = [
            ['title' => 'DIFFICULT DELIVERY SPECIALISTS', 'description' => "We thrive where others say it can't be done.", 'icon' => 'trophy', 'section' => 'why_choose', 'sort_order' => 1],
            ['title' => 'SAME-DAY AVAILABILITY', 'description' => "Need it done today? We've got you.", 'icon' => 'zap', 'section' => 'why_choose', 'sort_order' => 2],
            ['title' => 'FULLY EQUIPPED TEAM', 'description' => 'Trolleys, straps, blankets & more.', 'icon' => 'wrench', 'section' => 'why_choose', 'sort_order' => 3],
            ['title' => 'CARE-FIRST HANDLING', 'description' => 'Your items treated like our own.', 'icon' => 'hand-heart', 'section' => 'why_choose', 'sort_order' => 4],
        ];

        foreach (array_merge($heroFeatures, $howFeatures, $whyFeatures) as $feature) {
            Feature::updateOrCreate(
                ['title' => $feature['title'], 'section' => $feature['section']],
                $feature
            );
        }

        // Services
        $services = [
            [
                'title' => 'FURNITURE, PARCELS & PALLET DELIVERY',
                'description' => 'We deliver everything from single items to full loads — furniture, appliances, parcels and pallets.',
                'icon' => 'truck',
                'bullet_points' => ['Single item deliveries', 'Furniture & general items', 'Parcels, boxes & cartons', 'Pallet transport', 'Full loads & bulk deliveries', 'Careful handling'],
                'sort_order' => 1,
            ],
            [
                'title' => 'DELIVERY & INSTALLATION',
                'description' => "We don't just drop off — we deliver, install and set up your items ready to use.",
                'icon' => 'wrench',
                'bullet_points' => ['Room of choice delivery', 'Connect & test appliances', 'Assembly & installation', 'Careful handling', 'Quality installation', 'One team. Done right.'],
                'sort_order' => 2,
            ],
            [
                'title' => 'FULL SERVICE DELIVERY',
                'description' => 'From store pickup to final setup, we handle everything so you don\'t have to.',
                'icon' => 'building',
                'bullet_points' => ['Store & click-and-collect pickups', 'Room of choice delivery & setup', 'Rubbish & packaging removal', 'Old items taken away', 'Same-day & urgent jobs available', 'One team. Start to finish.'],
                'sort_order' => 3,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['sort_order' => $service['sort_order']], $service);
        }

        // Testimonials
        $testimonials = [
            [
                'name' => 'Sarah Mitchell',
                'location' => 'Brisbane CBD',
                'content' => 'Senzu Transport delivered and installed our new fridge and washing machine. The guys were professional, on time, and even took away all the packaging. Best delivery service in Brisbane!',
                'rating' => 5,
                'sort_order' => 1,
            ],
            [
                'name' => 'James Cooper',
                'location' => 'Paddington',
                'content' => 'Had a heavy dishwasher that needed to go up 3 flights of narrow stairs. Other companies said no. Senzu got it done without a scratch. Absolute legends!',
                'rating' => 5,
                'sort_order' => 2,
            ],
            [
                'name' => 'Lisa Thompson',
                'location' => 'Bulimba',
                'content' => 'Same-day delivery for an urgent job. They were quick, careful, and the price was very fair. Highly recommend Senzu Transport for any delivery needs.',
                'rating' => 5,
                'sort_order' => 3,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(['name' => $testimonial['name']], $testimonial);
        }
    }
}
