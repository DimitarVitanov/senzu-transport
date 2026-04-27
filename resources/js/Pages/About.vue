<template>
    <Head>
        <title>About Us | Senzu Transport & Logistics Brisbane</title>
        <meta name="description" content="Learn about Senzu Transport & Logistics — a local Brisbane delivery and installation business built on reliability, precision, and doing the job right the first time. White goods, furniture, freight.">
        <meta name="keywords" content="about Senzu Transport, Brisbane delivery company, local delivery Brisbane, transport company Brisbane, delivery and installation team Brisbane">
        <link rel="canonical" href="https://senzutransport.com.au/about">
        <meta property="og:title" content="About Us | Senzu Transport & Logistics">
        <meta property="og:description" content="Brisbane's trusted delivery and installation service — reliability, precision, and doing the job right the first time.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://senzutransport.com.au/about">
        <meta property="og:image" content="https://senzutransport.com.au/images/hero-truck-2.webp">
        <meta name="twitter:title" content="About Us | Senzu Transport & Logistics">
        <meta name="twitter:description" content="Brisbane's trusted delivery and installation service — reliability, precision, and doing the job right.">
        <meta name="twitter:image" content="https://senzutransport.com.au/images/hero-truck-2.webp">
    </Head>

    <MainLayout>
        <!-- Hero Banner -->
        <section class="about-hero">
            <div class="about-hero-overlay"></div>
            <div class="about-hero-content reveal reveal-delay-1">
                <div class="about-hero-badge">
                    <span class="about-hero-badge-line"></span>
                    <span class="about-hero-badge-text">{{ settings.about_badge || 'ABOUT US' }}</span>
                </div>
                <h1 class="about-hero-title">
                    <span>{{ settings.about_title || 'SENZU TRANSPORT' }}</span>
                    <em>{{ settings.about_title_accent || '& LOGISTICS' }}</em>
                </h1>
                <p class="about-hero-subtitle reveal reveal-delay-2">{{ settings.about_subtitle || "Brisbane's trusted delivery and installation service built on reliability, precision, and doing the job right the first time." }}</p>
            </div>
        </section>

        <!-- Main Content -->
        <section class="about-content">
            <div class="about-container">
                <!-- Story Section -->
                <div class="about-story reveal reveal-delay-1">
                    <div class="about-story-text">
                        <p class="about-paragraph">{{ settings.about_paragraph_1 || "We don't just move items from A to B — we handle the full process. From single-item deliveries to full loads, our team takes care of transport, room-of-choice placement, installation, and rubbish removal, so you don't have to deal with multiple providers." }}</p>
                        <p class="about-paragraph">{{ settings.about_paragraph_2 || "With experience across white goods, furniture, store pickups, and general freight, we understand how to handle items safely and professionally. Whether it's a fridge, washing machine, lounge, or pallet delivery, every job is treated with care and attention to detail." }}</p>
                    </div>
                    <div class="about-story-image">
                        <img src="/images/hero-truck-2.webp" alt="Senzu Transport truck" />
                    </div>
                </div>

                <!-- Values Section -->
                <div class="about-values reveal reveal-delay-2">
                    <div class="about-values-card">
                        <div class="about-values-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                <polyline points="22 4 12 14.01 9 11.01"/>
                            </svg>
                        </div>
                        <h2 class="about-values-heading">{{ settings.about_values_heading || 'We focus on what matters most to our customers:' }}</h2>
                        <ul class="about-values-list">
                            <li v-for="i in 4" :key="i" class="about-values-item">
                                <span class="about-values-check">
                                    <svg viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                                <span>{{ settings[`about_value_${i}`] || fallbackValues[i - 1] }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Closing Section -->
                <div class="about-closing reveal reveal-delay-3">
                    <p class="about-paragraph">{{ settings.about_paragraph_3 || "As a local Brisbane business, we take pride in providing a service that's fast, reliable, and easy to deal with. No shortcuts, no excuses — just solid work and consistent results." }}</p>
                    <div class="about-closing-tagline">
                        {{ settings.about_closing || 'Senzu Transport and Logistics — we get it done right.' }}
                    </div>
                </div>
            </div>
        </section>

        <StatsBar :settings="settings" />

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
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import StatsBar from '@/Components/StatsBar.vue';
import CtaSection from '@/Components/CtaSection.vue';
import QuoteModal from '@/Components/QuoteModal.vue';
import { useScrollReveal } from '@/composables/useScrollReveal';

defineProps({
    settings: { type: Object, required: true },
});

const showQuote = ref(false);

const fallbackValues = [
    'Turning up on time',
    'Handling items properly',
    'Communicating clearly',
    'Leaving the space clean and ready to use',
];

useScrollReveal();
</script>

<style scoped>
/* ─── Hero Banner ─── */
.about-hero {
    position: relative;
    min-height: 52vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--color-dark-bg);
    overflow: hidden;
    text-align: center;
    padding: 7rem 1rem 3.5rem;
}

.about-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 20% 50%, rgba(138,197,7,0.08), transparent 50%),
        radial-gradient(circle at 80% 30%, rgba(138,197,7,0.05), transparent 40%);
}

.about-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to bottom,
        rgba(10,10,10,0.6) 0%,
        rgba(10,10,10,0.9) 100%
    );
}

.about-hero-content {
    position: relative;
    max-width: 48rem;
}

.about-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1.25rem;
}

.about-hero-badge-line {
    display: block;
    width: 1.5rem;
    height: 1px;
    background: var(--color-senzu);
}

.about-hero-badge-text {
    color: var(--color-senzu);
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
}

.about-hero-title {
    font-size: clamp(2rem, 5vw, 3.2rem);
    font-weight: 900;
    line-height: 1.05;
    margin-bottom: 1.25rem;
    font-style: italic;
}

.about-hero-title span {
    display: block;
    color: #fff;
}

.about-hero-title em {
    display: block;
    color: var(--color-senzu);
    font-style: italic;
}

.about-hero-subtitle {
    color: #9ca3af;
    font-size: clamp(0.95rem, 1.5vw, 1.1rem);
    line-height: 1.7;
    max-width: 38rem;
    margin: 0 auto;
}

/* ─── Main Content ─── */
.about-content {
    background: #fff;
    padding: 3.5rem 0 2rem;
}

.about-container {
    max-width: 78rem;
    margin: 0 auto;
    padding: 0 1rem;
}

/* ─── Story (text + image grid) ─── */
.about-story {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
    margin-bottom: 3rem;
}

.about-story-text {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
    justify-content: center;
}

.about-paragraph {
    color: var(--color-light-text);
    font-size: 1rem;
    line-height: 1.8;
}

.about-story-image {
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.12);
}

.about-story-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    min-height: 250px;
}

/* ─── Values Card ─── */
.about-values {
    margin-bottom: 3rem;
}

.about-values-card {
    background: var(--color-dark-bg);
    border-radius: 1.25rem;
    padding: 2.5rem 2rem;
    border: 1px solid var(--color-dark-border);
    position: relative;
    overflow: hidden;
}

.about-values-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 10% 20%, rgba(138,197,7,0.1), transparent 40%),
        radial-gradient(circle at 90% 80%, rgba(56,189,248,0.06), transparent 35%);
    pointer-events: none;
}

.about-values-icon {
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
    border: 2px solid var(--color-senzu);
    color: var(--color-senzu);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.25rem;
    position: relative;
}

.about-values-icon svg {
    width: 1.4rem;
    height: 1.4rem;
}

.about-values-heading {
    color: #fff;
    font-size: clamp(1.1rem, 2vw, 1.35rem);
    font-weight: 700;
    margin-bottom: 1.5rem;
    position: relative;
}

.about-values-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    grid-template-columns: 1fr;
    gap: 0.85rem;
    position: relative;
}

.about-values-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: #e5e7eb;
    font-size: 1rem;
    font-weight: 500;
    line-height: 1.4;
}

.about-values-check {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 1.35rem;
    height: 1.35rem;
    border-radius: 9999px;
    border: 1.5px solid var(--color-senzu);
    background: rgba(138,197,7,0.15);
    flex-shrink: 0;
}

.about-values-check svg {
    width: 0.8rem;
    height: 0.8rem;
    color: var(--color-senzu);
}

/* ─── Closing ─── */
.about-closing {
    text-align: center;
    max-width: 44rem;
    margin: 0 auto 2rem;
}

.about-closing .about-paragraph {
    margin-bottom: 1.75rem;
}

.about-closing-tagline {
    font-family: var(--font-display);
    font-size: clamp(1.4rem, 3vw, 2rem);
    font-weight: 800;
    font-style: italic;
    color: var(--color-senzu);
    line-height: 1.2;
}

/* ─── Responsive ─── */
@media (min-width: 640px) {
    .about-container {
        padding: 0 1.5rem;
    }
    .about-values-list {
        grid-template-columns: 1fr 1fr;
    }
}

@media (min-width: 768px) {
    .about-content {
        padding: 4.5rem 0 2.5rem;
    }
    .about-story {
        grid-template-columns: 1.2fr 1fr;
        gap: 3rem;
        margin-bottom: 4rem;
    }
    .about-values {
        margin-bottom: 4rem;
    }
    .about-values-card {
        padding: 3rem 2.5rem;
    }
}

@media (min-width: 1024px) {
    .about-hero {
        min-height: 56vh;
        padding: 8rem 2rem 4rem;
    }
    .about-container {
        padding: 0 2rem;
    }
    .about-content {
        padding: 5rem 0 3rem;
    }
    .about-story {
        gap: 4rem;
    }
    .about-values-card {
        padding: 3.5rem 3rem;
    }
}
</style>
