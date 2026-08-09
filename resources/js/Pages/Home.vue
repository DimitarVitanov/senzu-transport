<script setup>
import { computed, ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Navbar from '@/Components/landing/Navbar.vue';
import Hero from '@/Components/landing/Hero.vue';
import FeaturesBar from '@/Components/landing/FeaturesBar.vue';
import ServicesSection from '@/Components/landing/ServicesSection.vue';
import AboutSection from '@/Components/landing/AboutSection.vue';
import CTASection from '@/Components/landing/CTASection.vue';
import Footer from '@/Components/landing/Footer.vue';
import QuoteModal from '@/Components/QuoteModal.vue';

const props = defineProps({
    settings: { type: Object, default: () => ({}) },
    services: { type: Array, default: () => [] },
    featuresBar: { type: Array, default: () => [] },
    steps: { type: Array, default: () => [] },
    ctaFeatures: { type: Array, default: () => [] },
    testimonials: { type: Array, default: () => [] },
});

const page = usePage();
const nav = computed(() => page.props.nav || {});

// Settings helper — returns the stored value or a fallback default.
const s = (key, fallback = '') => {
    const v = props.settings?.[key];
    return v === undefined || v === null || v === '' ? fallback : v;
};

const phone = computed(() => nav.value.phone || '0424 033 572');
const phoneRaw = computed(() => nav.value.phone_raw || '+61424033572');
const email = computed(() => nav.value.email || 'info@senzutransport.com.au');
const facebookUrl = computed(() => nav.value.facebook_url || 'https://facebook.com');
const instagramUrl = computed(() => nav.value.instagram_url || 'https://instagram.com');

const serviceAreas = computed(() =>
    s('service_areas', 'Brisbane, Gold Coast, Logan, Sunshine Coast, Ipswich, Toowoomba')
        .split(',')
        .map((a) => a.trim())
        .filter(Boolean)
);

const showQuote = ref(false);
</script>

<template>
    <div class="min-h-screen bg-ink font-sans text-white">
        <Navbar :phone="phone" :phone-raw="phoneRaw" @open-quote="showQuote = true" />

        <Hero
            :phone="phone"
            :phone-raw="phoneRaw"
            :title1="s('hero_title_line1', 'FURNITURE')"
            :title2="s('hero_title_line2', 'REMOVALS')"
            :accent="s('hero_title_accent', 'BRISBANE')"
            :subtitle-pre="s('hero_subtitle_pre', 'SAFE.')"
            :subtitle-accent="s('hero_subtitle_accent', 'RELIABLE')"
            :subtitle-post="s('hero_subtitle_post', 'STRESS FREE.')"
            :description="s('hero_description', `We handle your furniture with care from start to finish. Whether you're moving a single item, an apartment, or a large family home, our experienced team makes moving easy.`)"
            @open-quote="showQuote = true"
        />

        <FeaturesBar :features="featuresBar" />

        <ServicesSection :services="services" :title="s('services_title', 'OUR REMOVAL SERVICES')" />

        <AboutSection
            :steps="steps"
            :testimonials="testimonials"
            :service-areas="serviceAreas"
            :process-title="s('process_title', 'MOVING MADE EASY')"
            :areas-title="s('areas_title', 'SERVICE AREAS')"
            :reviews-title="s('reviews_title', 'WHAT OUR CUSTOMERS SAY')"
        />

        <CTASection
            :phone="phone"
            :phone-raw="phoneRaw"
            :title-pre="s('cta_title_pre', 'READY TO')"
            :title-accent="s('cta_title_accent', 'MOVE?')"
            :subtitle="s('cta_subtitle', 'Get a fast, obligation-free quote today.')"
            :features="ctaFeatures"
            @open-quote="showQuote = true"
        />

        <Footer
            :phone="phone"
            :phone-raw="phoneRaw"
            :email="email"
            :tagline="s('footer_tagline', `Brisbane's trusted furniture removalists. We take the stress out of moving.`)"
            :facebook-url="facebookUrl"
            :instagram-url="instagramUrl"
            @open-quote="showQuote = true"
        />

        <QuoteModal
            :show="showQuote"
            :phone-raw="phoneRaw"
            :facebook-url="facebookUrl"
            :instagram-url="instagramUrl"
            @close="showQuote = false"
        />
    </div>
</template>
