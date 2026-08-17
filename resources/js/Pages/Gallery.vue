<template>
    <Head>
        <title>Gallery | Senzu Transport & Logistics Brisbane</title>
        <meta name="description" content="See Senzu Transport in action — photos of our deliveries, installations, and team at work across Brisbane. White goods, furniture, and freight delivery gallery.">
        <meta name="keywords" content="Senzu Transport gallery, Brisbane delivery photos, delivery and installation images, transport team Brisbane, white goods delivery photos">
        <link rel="canonical" href="https://senzutransport.com.au/gallery">
        <meta property="og:title" content="Gallery | Senzu Transport & Logistics">
        <meta property="og:description" content="See our team delivering, installing, and getting the job done across Brisbane.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://senzutransport.com.au/gallery">
        <meta property="og:image" content="https://senzutransport.com.au/images/hero-truck-2.webp">
        <meta name="twitter:title" content="Gallery | Senzu Transport & Logistics">
        <meta name="twitter:description" content="See our team delivering, installing, and getting the job done across Brisbane.">
        <meta name="twitter:image" content="https://senzutransport.com.au/images/hero-truck-2.webp">
    </Head>

    <MainLayout>
        <!-- Hero Banner -->
        <section class="gallery-hero">
            <div class="gallery-hero-content reveal reveal-delay-1">
                <div class="gallery-hero-badge">
                    <span class="gallery-hero-badge-line"></span>
                    <span class="gallery-hero-badge-text">GALLERY</span>
                </div>
                <h1 class="gallery-hero-title">
                    <span>OUR WORK</span>
                    <em>IN ACTION</em>
                </h1>
                <p class="gallery-hero-subtitle">See our team delivering, installing, and getting the job done across Brisbane.</p>
            </div>
        </section>

        <!-- Gallery Grid -->
        <section class="gallery-section">
            <div class="gallery-container">
                <div v-if="images.length" class="gallery-grid">
                    <div v-for="(image, idx) in images" :key="image.id"
                         class="gallery-item reveal"
                         :class="'reveal-delay-' + ((idx % 4) + 1)"
                         @click="openLightbox(idx)">
                        <img :src="image.url" :alt="image.alt_text || 'Senzu Transport'" loading="lazy" />
                        <div class="gallery-item-overlay">
                            <svg class="gallery-item-zoom" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                                <path d="M11 8v6M8 11h6"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div v-else class="gallery-empty">
                    <p>Gallery images coming soon.</p>
                </div>
            </div>
        </section>

        <!-- Lightbox -->
        <teleport to="body">
            <transition enter-active-class="transition duration-200 ease-out"
                        enter-from-class="opacity-0"
                        enter-to-class="opacity-100"
                        leave-active-class="transition duration-150 ease-in"
                        leave-from-class="opacity-100"
                        leave-to-class="opacity-0">
                <div v-if="lightboxOpen" class="lightbox" @click.self="closeLightbox">
                    <!-- Close -->
                    <button @click="closeLightbox" class="lightbox-close">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <!-- Prev -->
                    <button v-if="images.length > 1" @click.stop="prevImage" class="lightbox-nav lightbox-prev">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    <!-- Image -->
                    <img :src="images[lightboxIndex]?.url" :alt="images[lightboxIndex]?.alt_text" class="lightbox-image" />

                    <!-- Next -->
                    <button v-if="images.length > 1" @click.stop="nextImage" class="lightbox-nav lightbox-next">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    <!-- Counter -->
                    <div class="lightbox-counter">{{ lightboxIndex + 1 }} / {{ images.length }}</div>
                </div>
            </transition>
        </teleport>

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
import { ref, onMounted, onUnmounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import CtaSection from '@/Components/CtaSection.vue';
import QuoteModal from '@/Components/QuoteModal.vue';
import { useScrollReveal } from '@/composables/useScrollReveal';

const props = defineProps({
    settings: { type: Object, required: true },
    images: { type: Array, default: () => [] },
});

const showQuote = ref(false);
const lightboxOpen = ref(false);
const lightboxIndex = ref(0);

function openLightbox(idx) {
    lightboxIndex.value = idx;
    lightboxOpen.value = true;
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    lightboxOpen.value = false;
    document.body.style.overflow = '';
}

function nextImage() {
    lightboxIndex.value = (lightboxIndex.value + 1) % props.images.length;
}

function prevImage() {
    lightboxIndex.value = (lightboxIndex.value - 1 + props.images.length) % props.images.length;
}

function handleKeydown(e) {
    if (!lightboxOpen.value) return;
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowRight') nextImage();
    if (e.key === 'ArrowLeft') prevImage();
}

onMounted(() => window.addEventListener('keydown', handleKeydown));
onUnmounted(() => {
    window.removeEventListener('keydown', handleKeydown);
    document.body.style.overflow = '';
});

useScrollReveal();
</script>

<style scoped>
/* ─── Hero Banner ─── */
.gallery-hero {
    position: relative;
    min-height: 44vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--color-dark-bg);
    overflow: hidden;
    text-align: center;
    padding: 7rem 1rem 3rem;
}

.gallery-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 30% 50%, rgba(138,197,7,0.07), transparent 50%),
        radial-gradient(circle at 70% 30%, rgba(138,197,7,0.04), transparent 40%);
}

.gallery-hero-content {
    position: relative;
    max-width: 42rem;
}

.gallery-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1.25rem;
}

.gallery-hero-badge-line {
    display: block;
    width: 1.5rem;
    height: 1px;
    background: var(--color-senzu);
}

.gallery-hero-badge-text {
    color: var(--color-senzu);
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
}

.gallery-hero-title {
    font-size: clamp(2rem, 5vw, 3.2rem);
    font-weight: 900;
    line-height: 1.05;
    margin-bottom: 1rem;
    font-style: italic;
}

.gallery-hero-title span {
    display: block;
    color: #fff;
}

.gallery-hero-title em {
    display: block;
    color: var(--color-senzu);
    font-style: italic;
}

.gallery-hero-subtitle {
    color: #9ca3af;
    font-size: clamp(0.95rem, 1.5vw, 1.05rem);
    line-height: 1.6;
}

/* ─── Gallery Grid ─── */
.gallery-section {
    background: #fff;
    padding: 3.5rem 0 2rem;
}

.gallery-container {
    max-width: 78rem;
    margin: 0 auto;
    padding: 0 1rem;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
}

.gallery-item {
    position: relative;
    border-radius: 0.75rem;
    overflow: hidden;
    cursor: pointer;
    aspect-ratio: 1;
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.gallery-item:hover img {
    transform: scale(1.05);
}

.gallery-item-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.4);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.gallery-item:hover .gallery-item-overlay {
    opacity: 1;
}

.gallery-item-zoom {
    width: 2.5rem;
    height: 2.5rem;
    color: #fff;
}

.gallery-empty {
    text-align: center;
    padding: 4rem 0;
    color: var(--color-light-muted);
    font-size: 1rem;
}

/* ─── Lightbox ─── */
.lightbox {
    position: fixed;
    inset: 0;
    z-index: 200;
    background: rgba(0,0,0,0.92);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.lightbox-image {
    max-width: 90vw;
    max-height: 85vh;
    object-fit: contain;
    border-radius: 0.5rem;
}

.lightbox-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    color: #fff;
    background: rgba(255,255,255,0.1);
    border: none;
    border-radius: 50%;
    width: 2.5rem;
    height: 2.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s;
    z-index: 10;
}

.lightbox-close:hover {
    background: rgba(255,255,255,0.2);
}

.lightbox-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: #fff;
    background: rgba(255,255,255,0.1);
    border: none;
    border-radius: 50%;
    width: 3rem;
    height: 3rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s;
    z-index: 10;
}

.lightbox-nav:hover {
    background: rgba(255,255,255,0.2);
}

.lightbox-prev {
    left: 1rem;
}

.lightbox-next {
    right: 1rem;
}

.lightbox-counter {
    position: absolute;
    bottom: 1.5rem;
    left: 50%;
    transform: translateX(-50%);
    color: rgba(255,255,255,0.6);
    font-size: 0.85rem;
    font-weight: 600;
}

/* ─── Responsive ─── */
@media (min-width: 640px) {
    .gallery-container {
        padding: 0 1.5rem;
    }
    .gallery-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }
}

@media (min-width: 1024px) {
    .gallery-hero {
        min-height: 48vh;
        padding: 8rem 2rem 3.5rem;
    }
    .gallery-container {
        padding: 0 2rem;
    }
    .gallery-section {
        padding: 4.5rem 0 3rem;
    }
    .gallery-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 1.1rem;
    }
}
</style>
