<template>
    <div class="hero-wrapper">
        <section id="home" class="hero-section">
            <!-- Full background truck image -->
            <div class="hero-bg hero-bg-desktop">
                <img src="/images/new-hero-image.webp"
                     alt="Senzu Transport - Scania Truck"
                     loading="eager" />
            </div>
            <div class="hero-bg hero-bg-mobile">
                <img src="/images/new-mobile-hero-image.webp"
                     alt="Senzu Transport - Scania Truck"
                     loading="eager" />
            </div>

            <!-- Dark overlays -->
            <div class="hero-overlay-lr"></div>
            <div class="hero-overlay-bt"></div>

            <!-- Content -->
            <div class="hero-content">
                <div class="hero-text">
                    <!-- Badge -->
                    <div class="hero-badge reveal reveal-delay-1">
                        <span class="hero-badge-line"></span>
                        <span class="hero-badge-text">{{ settings.hero_badge }}</span>
                    </div>

                    <!-- Main Title -->
                    <h1 class="hero-title reveal reveal-delay-2">
                        <span>{{ settings.hero_title_line1 }}</span>
                        <span class="hero-title-line2">{{ settings.hero_title_line2 }}</span>
                        <em>{{ settings.hero_title_accent }}</em>
                    </h1>

                    <!-- Description -->
                    <p class="hero-desc reveal reveal-delay-3">{{ settings.hero_description }}</p>

                    <!-- Bullet Points Checklist (2 columns) -->
                    <div v-if="heroBullets.length" class="hero-bullets reveal reveal-delay-4">
                        <div v-for="(bullet, i) in heroBullets" :key="i" class="hero-bullet">
                            <span class="hero-bullet-icon">
                                <svg viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                            <span>{{ bullet }}</span>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="hero-ctas reveal reveal-delay-4">
                        <button @click="$emit('openQuote')" class="cta-primary">
                            {{ settings.hero_cta_primary }}
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </button>
                        <a :href="'tel:' + settings.phone_raw" class="cta-secondary">
                            {{ settings.hero_cta_secondary }}
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Floating features card — positioned at bottom, sticking out -->
            <div class="hero-features-float">
                <slot name="features"></slot>
            </div>
        </section>

        <!-- Mobile: features as a separate section -->
        <div class="hero-features-mobile">
            <slot name="features"></slot>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { useScrollReveal } from '@/composables/useScrollReveal';

const props = defineProps({
    settings: { type: Object, required: true },
});

defineEmits(['openQuote']);

const heroBullets = computed(() => {
    const bullets = [];
    for (let i = 1; i <= 6; i++) {
        const val = props.settings[`hero_bullet_${i}`];
        if (val) bullets.push(val);
    }
    return bullets;
});

useScrollReveal();
</script>

<style scoped>
.hero-wrapper {
    position: relative;
    z-index: 1;
}

.hero-section {
    position: relative;
    min-height: 92vh;
    display: flex;
    align-items: center;
    background: var(--color-dark-bg);
    padding-bottom: 80px; /* space for floating card */
}

.hero-bg {
    position: absolute;
    inset: 0;
}

.hero-bg img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: 60% 50%;
}

.hero-bg-mobile {
    display: none;
}

.hero-overlay-lr {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to right,
        rgba(10,10,10,0.92) 0%,
        rgba(10,10,10,0.70) 28%,
        rgba(10,10,10,0.20) 55%,
        transparent 70%
    );
}

.hero-overlay-bt {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(10,10,10,0.85) 0%,
        rgba(10,10,10,0.30) 25%,
        transparent 50%,
        rgba(10,10,10,0.35) 100%
    );
}

.hero-content {
    position: relative;
    width: 100%;
    margin: 0 auto;
    padding: 5.2rem 1rem 0;
    max-width: 90%;
}

.hero-text {
    max-width: 560px;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.hero-badge-line {
    display: block;
    width: 1.5rem;
    height: 1px;
    background: var(--color-senzu);
}

.hero-badge-text {
    color: var(--color-senzu);
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
}

.hero-title {
    font-size: clamp(1.65rem, 3.4vw, 2.65rem);
    font-weight: 900;
    line-height: 1.05;
    margin-bottom: 1.2rem;
    font-style: italic;
}

.hero-title span {
    display: block;
    color: #fff;
}

.hero-title em {
    display: block;
    color: var(--color-senzu);
    font-style: italic;
}

.hero-title-line2 {
    white-space: nowrap;
}

.hero-desc {
    color: #fff;
    font-size: 0.94rem;
    font-weight: 500;
    line-height: 1.6;
    margin-bottom: 1.2rem;
    max-width: 500px;
    white-space: pre-line;
}

.hero-bullets {
    display: grid;
    grid-template-columns: repeat(2, max-content);
    gap: 0.35rem 1.1rem;
    justify-content: start;
    margin-bottom: 1.25rem;
}

.hero-bullet {
    display: flex;
    align-items: center;
    gap: 0.32rem;
    margin: 0.28rem 0;
}

.hero-bullet-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 1.08rem;
    height: 1.08rem;
    border-radius: 9999px;
    border: 1px solid var(--color-senzu);
    background: var(--color-senzu-light);
    flex-shrink: 0;
}

.hero-bullet-icon svg {
    width: 0.68rem;
    height: 0.68rem;
    color: #0a0a0a;
}

.hero-bullet span {
    color: #fff;
    font-size: 0.84rem;
    font-weight: 500;
    line-height: 1.15;
}

.hero-ctas {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
    margin-top: 1.4rem;
}

.cta-primary,
.cta-secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-weight: 700;
    font-size: 0.98rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    padding: 0.78rem 1.75rem;
    transition: all 0.3s;
    cursor: pointer;
    text-decoration: none;
    border-radius: 0.5rem;
    min-width: 13.2rem;
}

.cta-primary {
    background: var(--color-senzu);
    color: var(--color-dark-bg);
    border: none;
}

.cta-primary:hover {
    background: var(--color-senzu-dark);
    box-shadow: 0 8px 20px rgba(138,197,7,0.2);
}

.cta-secondary {
    background: transparent;
    color: #fff;
    border: 1.5px solid rgba(255,255,255,0.9);
    padding-inline: 2rem;
}

.cta-secondary:hover {
    border-color: #fff;
}

.cta-primary svg,
.cta-secondary svg {
    width: 0.95rem;
    height: 0.95rem;
    transition: transform 0.3s;
}

.cta-primary:hover svg,
.cta-secondary:hover svg {
    transform: translateX(4px);
}

/* Floating features card — absolute, sticking out below the hero */
.hero-features-float {
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translate(-50%, 50%);
    width: 100%;
    max-width: 78rem;
    padding: 0 1rem;
    z-index: 20;
}

.hero-features-mobile {
    display: none;
}

@media (min-width: 640px) {
    .hero-content {
        padding: 5.3rem 1.5rem 0;
    }
    .hero-features-float {
        padding: 0 1.5rem;
    }
}

@media (max-width: 767px) {
    .hero-bg-desktop {
        display: none;
    }

    .hero-bg-mobile {
        display: block;
    }

    .hero-bg-mobile img {
        object-position: center bottom;
        object-fit: cover;
    }

    .hero-section {
        min-height: 100vh;
        min-height: 100dvh;
        padding-bottom: 0;
        align-items: stretch;
    }

    .hero-content {
        display: flex;
        flex-direction: column;
        padding: 5.5rem 1rem 2.5rem;
        min-height: 100vh;
        min-height: 100dvh;
    }

    .hero-text {
        max-width: 100%;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .hero-overlay-lr {
        background: linear-gradient(
            to bottom,
            rgba(10,10,10,0.95) 0%,
            rgba(10,10,10,0.85) 35%,
            rgba(10,10,10,0.4) 55%,
            transparent 70%
        );
    }

    .hero-overlay-bt {
        background: none;
    }

    .hero-title {
        font-size: clamp(1.5rem, 7vw, 2rem);
        line-height: 1.02;
    }

    .hero-title-line2 {
        white-space: normal;
    }

    .hero-desc {
        font-size: 0.82rem;
        line-height: 1.5;
        max-width: 100%;
    }

    .hero-bullets {
        display: none;
    }

    .hero-ctas {
        width: 100%;
        flex-direction: column;
        gap: 0.65rem;
        margin-top: auto;
        padding-top: 2rem;
    }

    .cta-primary,
    .cta-secondary {
        width: 100%;
        justify-content: center;
        padding: 0.55rem 0.75rem;
        font-size: 0.8rem;
        min-width: unset;
    }

    .hero-features-float {
        display: none;
    }

    .hero-features-mobile {
        display: block;
        background: #fff;
        padding: 10px 0 0;
    }
}

@media (min-width: 768px) {
    .hero-section {
        min-height: 88vh;
        padding-bottom: 70px;
    }
    .hero-content {
        padding: 4.5rem 1.5rem 0;
    }
}

@media (min-width: 1024px) {
    .hero-section {
        min-height: 92vh;
        padding-bottom: 80px;
    }
    .hero-content {
        padding: 3.5rem 2rem 0;
    }
    .hero-bg img {
        object-position: 60% 50%;
    }
    .hero-features-float {
        padding: 0 2rem;
    }
}
</style>
