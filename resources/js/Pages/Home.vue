<template>
    <Head>
        <title>Senzu Transport & Logistics | Brisbane's Trusted Delivery & Installation Specialists</title>
        <meta name="description" content="Senzu Transport — Brisbane's trusted delivery and installation service. White goods delivery, furniture transport, appliance installation, rubbish removal. Same-day availability. Get a free quote today!">
        <meta name="keywords" content="Brisbane delivery, white goods delivery, appliance installation, furniture delivery, pallet transport, Brisbane logistics, same day delivery Brisbane, delivery and installation Brisbane, rubbish removal Brisbane">
        <link rel="canonical" href="https://senzutransport.com.au/">
        <meta property="og:title" content="Senzu Transport & Logistics | Delivery & Installation Done Right">
        <meta property="og:description" content="Brisbane's trusted delivery and installation specialists. White goods, furniture, appliances — delivered, installed, done right. Same-day availability.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://senzutransport.com.au/">
        <meta property="og:image" content="https://senzutransport.com.au/images/hero-truck-2.webp">
        <meta name="twitter:title" content="Senzu Transport & Logistics | Delivery Done Right">
        <meta name="twitter:description" content="Brisbane's trusted delivery and installation specialists. Same-day availability. Get a free quote!">
        <meta name="twitter:image" content="https://senzutransport.com.au/images/hero-truck-2.webp">
    </Head>

    <MainLayout>
        <!-- DARK: Hero with truck background + floating features card -->
        <HeroSection :settings="settings" @open-quote="showQuote = true">
            <template #features>
                <FeaturesRow :features="heroFeatures" />
            </template>
        </HeroSection>

        <!-- Spacer for the floating card that sticks out below the hero -->
        <div class="features-spacer"></div>

        <!-- WHITE: Services cards -->
        <ServicesSection
            :services="services"
            :badge="settings.services_badge"
            :title="settings.services_title"
            :subtitle="settings.services_subtitle"
            :description="settings.services_description"
        />

        <!-- Anchor point for future gallery section -->
        <div id="gallery"></div>

        <!-- Stats + Green CTA combined -->
        <div id="contact"></div>
        <StatsBar :settings="settings" />

        <!-- Dark split section before footer -->
        <HowItWorks
            :features="resolvedHowFeatures"
            :badge="settings.how_badge || 'BUILT FOR THE TOUGH JOBS'"
            :title="settings.how_title || 'WE HANDLE WHAT'"
            :title-accent="settings.how_title_accent || `OTHERS CAN'T`"
            :description="settings.how_description || 'From tight staircases to heavy appliance installs, our trained team and modern equipment get every job done safely and efficiently.'"
        />

        <WhyChooseUs
            :features="resolvedWhyFeatures"
            :title="settings.why_title || 'WHY CHOOSE'"
            :title-accent="settings.why_title_accent || 'SENZU TRANSPORT?'"
        />

        <CtaSection
            :cta-title="settings.cta_title || 'NEED A DELIVERY'"
            :cta-title-accent="settings.cta_title_accent || 'DONE RIGHT?'"
            :cta-description="settings.cta_description || 'Get in touch today for a fast, free quote.'"
            :cta-tagline="settings.cta_tagline || 'We get it done right.'"
            :phone="settings.phone || '0456 155 078'"
            :phone-raw="settings.phone_raw || '+61456155078'"
            @open-quote="showQuote = true"
        />

        <QuoteModal
            :show="showQuote"
            :phone-raw="settings.phone_raw || '+61456155078'"
            :facebook-url="settings.facebook_url || 'https://facebook.com'"
            :instagram-url="settings.instagram_url || 'https://instagram.com'"
            @close="showQuote = false"
        />
    </MainLayout>
</template>

<script setup>
import { computed, ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import HeroSection from '@/Components/HeroSection.vue';
import FeaturesRow from '@/Components/FeaturesRow.vue';
import ServicesSection from '@/Components/ServicesSection.vue';
import StatsBar from '@/Components/StatsBar.vue';
import HowItWorks from '@/Components/HowItWorks.vue';
import WhyChooseUs from '@/Components/WhyChooseUs.vue';
import CtaSection from '@/Components/CtaSection.vue';
import QuoteModal from '@/Components/QuoteModal.vue';

const props = defineProps({
    settings: { type: Object, required: true },
    heroFeatures: { type: Array, required: true },
    services: { type: Array, required: true },
    howFeatures: { type: Array, required: true },
    whyFeatures: { type: Array, required: true },
});

const showQuote = ref(false);

const fallbackHowFeatures = [
    {
        id: 'fallback-how-1',
        title: 'TIGHT ACCESS SPECIALISTS',
        description: 'Stairs, apartments, narrow access - no problem.',
    },
    {
        id: 'fallback-how-2',
        title: 'EXPERIENCED TEAM',
        description: 'Skilled, careful and professional in every delivery.',
    },
    {
        id: 'fallback-how-3',
        title: 'CARE-FIRST HANDLING',
        description: 'We treat your items like our own.',
    },
];

const resolvedHowFeatures = computed(() =>
    Array.isArray(props.howFeatures) && props.howFeatures.length > 0
        ? props.howFeatures
        : fallbackHowFeatures
);

const fallbackWhyFeatures = [
    {
        id: 'fallback-why-1',
        title: 'DIFFICULT DELIVERY SPECIALISTS',
        description: "We thrive where others say it can't be done.",
        icon: 'trophy',
    },
    {
        id: 'fallback-why-2',
        title: 'SAME-DAY AVAILABILITY',
        description: "Need it done today? We've got you.",
        icon: 'zap',
    },
    {
        id: 'fallback-why-3',
        title: 'FULLY EQUIPPED TEAM',
        description: 'Trolleys, straps, blankets & more.',
        icon: 'wrench',
    },
    {
        id: 'fallback-why-4',
        title: 'CARE-FIRST HANDLING',
        description: 'Your items treated like our own.',
        icon: 'hand-heart',
    },
];

const resolvedWhyFeatures = computed(() =>
    Array.isArray(props.whyFeatures) && props.whyFeatures.length > 0
        ? props.whyFeatures
        : fallbackWhyFeatures
);
</script>
