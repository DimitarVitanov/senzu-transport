<template>
    <Head>
        <title>Our Services | Senzu Transport & Logistics Brisbane</title>
        <meta name="description" content="Senzu Transport services — general delivery, white goods delivery & installation, furniture transport, pallet freight, and rubbish removal across Brisbane. Same-day availability.">
        <meta name="keywords" content="delivery services Brisbane, white goods installation Brisbane, furniture delivery Brisbane, pallet delivery, freight transport Brisbane, appliance installation, rubbish removal Brisbane">
        <link rel="canonical" href="https://senzutransport.com.au/services">
        <meta property="og:title" content="Our Services | Senzu Transport & Logistics">
        <meta property="og:description" content="Delivery, installation, and logistics services across Brisbane. White goods, furniture, pallets — same-day availability.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://senzutransport.com.au/services">
        <meta property="og:image" content="https://senzutransport.com.au/images/hero-truck-2.webp">
        <meta name="twitter:title" content="Our Services | Senzu Transport & Logistics">
        <meta name="twitter:description" content="Delivery, installation, and logistics services across Brisbane. Same-day availability.">
        <meta name="twitter:image" content="https://senzutransport.com.au/images/hero-truck-2.webp">
    </Head>

    <MainLayout>
        <!-- Page Header -->
        <section class="page-header">
            <div class="page-header-content">
                <h1 class="page-header-title">Our <em>Services</em></h1>
                <p class="page-header-desc">Everything we offer to get your items delivered and installed, done right.</p>
            </div>
        </section>

        <!-- Services Cards -->
        <ServicesSection
            :services="services"
            :badge="settings.services_badge"
            :title="settings.services_title"
            :subtitle="settings.services_subtitle"
            :description="settings.services_description"
        />

        <!-- Stats + CTA -->
        <StatsBar :settings="settings" />
    </MainLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import ServicesSection from '@/Components/ServicesSection.vue';
import StatsBar from '@/Components/StatsBar.vue';

defineProps({
    settings: { type: Object, required: true },
    services: { type: Array, required: true },
});
</script>

<style scoped>
.page-header {
    background: var(--color-dark-bg);
    padding: 8rem 1rem 4rem;
    text-align: center;
}

.page-header-content {
    max-width: 42rem;
    margin: 0 auto;
}

.page-header-title {
    font-size: clamp(2rem, 5vw, 3rem);
    font-weight: 900;
    color: #fff;
    line-height: 1.1;
    margin-bottom: 1rem;
}

.page-header-title em {
    color: var(--color-senzu);
    font-style: italic;
}

.page-header-desc {
    color: #9ca3af;
    font-size: 1rem;
    line-height: 1.6;
}
</style>
