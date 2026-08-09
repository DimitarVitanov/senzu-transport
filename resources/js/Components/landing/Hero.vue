<script setup>
defineProps({
    phone: { type: String, default: '0424 033 572' },
    phoneRaw: { type: String, default: '+61424033572' },
    title1: { type: String, default: 'FURNITURE' },
    title2: { type: String, default: 'REMOVALS' },
    accent: { type: String, default: 'BRISBANE' },
    subtitlePre: { type: String, default: 'SAFE.' },
    subtitleAccent: { type: String, default: 'RELIABLE' },
    subtitlePost: { type: String, default: 'STRESS FREE.' },
    description: {
        type: String,
        default: "We handle your furniture with care from start to finish. Whether you're moving a single item, an apartment, or a large family home, our experienced team makes moving easy.",
    },
});

defineEmits(['open-quote']);
</script>

<template>
    <section
        id="home"
        class="relative min-h-screen overflow-hidden pt-20"
    >
        <!-- Background Image with gradient overlay -->
        <div class="hero-bg" />
        <!-- White gradient overlay from left side only, limited width -->
        <div class="hero-gradient" />
        <!-- Mobile full white overlay -->
        <div class="hero-mobile-overlay" />

        <!-- Content -->
        <div
            class="relative z-10 mx-auto flex h-full min-h-[calc(100vh-5rem)] max-w-[1600px] items-center px-6 lg:px-14 xl:px-20"
        >
            <div class="max-w-xl py-16 lg:py-20">
                <!-- Main headline -->
                <h1 class="hero-title">
                    {{ title1 }}<br />{{ title2 }}
                    <span class="text-senzu">{{ accent }}</span>
                </h1>

                <!-- Subheadline -->
                <p class="hero-subtitle">
                   {{ subtitlePre }}<span class="text-senzu">{{ subtitleAccent }}</span> <span class="text-gray-900">{{ subtitlePost }}</span>
                </p>

                <!-- Decorative line -->
                <div class="hero-line" />

                <!-- Description -->
                <p class="hero-description">
                    {{ description }}
                </p>

                <!-- Buttons -->
                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <button
                        type="button"
                        @click="$emit('open-quote')"
                        class="hero-btn hero-btn-primary"
                    >
                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                            <line x1="16" y1="2" x2="16" y2="6" />
                            <line x1="8" y1="2" x2="8" y2="6" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                        GET A FREE QUOTE
                    </button>
                    <a
                        :href="`tel:${phoneRaw}`"
                        class="hero-btn hero-btn-secondary"
                    >
                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"
                            />
                        </svg>
                        {{ phone }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.hero-bg {
    position: absolute;
    inset: 0;
    background-image: url('/images/hero-section-mobile.webp');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

@media (min-width: 769px) {
    .hero-bg {
        background-image: url('/images/hero-section-1.webp');
    }
}

.hero-gradient {
    position: absolute;
    inset: 0;
    left: 0;
    width: 45%;
    background: linear-gradient(to right, white, white, transparent);
}

.hero-mobile-overlay {
    display: none;
}

.hero-title {
    font-family: 'Poppins', sans-serif;
    font-size: 3rem;
    font-weight: 800;
    line-height: 0.95;
    letter-spacing: -0.02em;
    text-transform: uppercase;
    color: #1a1a1a;
}

@media (min-width: 768px) {
    .hero-title {
        font-size: 4rem;
    }
}

@media (min-width: 1024px) {
    .hero-title {
        font-size: 5rem;
    }
}

.hero-subtitle {
    margin-top: 1rem;
    font-family: 'Poppins', sans-serif;
    font-size: 1.125rem;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: #1f2937;
}

.hero-line {
    margin-top: 1rem;
    height: 0.25rem;
    width: 4rem;
    border-radius: 9999px;
    background-color: #8DC63F;
}

.hero-description {
    margin-top: 1.5rem;
    max-width: 28rem;
    font-size: 1rem;
    line-height: 1.625;
    color: #4b5563;
}

@media (min-width: 1024px) {
    .hero-description {
        max-width: 23rem;
    }
}

@media (max-width: 768px) {
    .hero-section {
        height: auto;
        min-height: 100vh;
    }

    .hero-gradient {
        display: none;
    }

    .hero-mobile-overlay {
        display: block;
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.62);
        z-index: 1;
    }

    .hero-content {
        padding: 6rem 1rem 2rem;
    }

    .hero-title {
        font-size: 2.2rem;
        color: #111827;
        text-shadow: 0 1px 2px rgba(255,255,255,0.8);
    }

    .hero-subtitle {
        text-shadow: 0 1px 3px rgba(255, 255, 255, 0.9);
    }

    .hero-subtitle :deep(.text-gray-900) {
        color: #111827 !important;
        text-shadow: 0 1px 3px rgba(255, 255, 255, 0.9);
    }

    .hero-title span {
        color: #7cb342;
    }

    .hero-tagline {
        color: #374151;
        font-weight: 600;
        letter-spacing: 0.1em;
    }

    .hero-description {
        color: #1f2937;
        max-width: 100%;
        font-weight: bold;
        line-height: 1.7;
        text-shadow: 0 1px 1px rgba(255,255,255,0.6);
    }

    .hero-btn {
        padding: 0.875rem 1.5rem;
        font-size: 0.9rem;
    }

    .hero-btn-secondary {
        background: #1f2937;
        color: white;
    }
}

.hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    border-radius: 0.375rem;
    padding: 0.875rem 1.5rem;
    font-size: 0.875rem;
    font-weight: 700;
    transition: all 0.2s;
    cursor: pointer;
}

.hero-btn-primary {
    background-color: #8DC63F;
    color: white;
}

.hero-btn-primary:hover {
    background-color: #5DA713;
}

.hero-btn-secondary {
    border: 2px solid #1f2937;
    background-color: #111827;
    color: white;
}

.hero-btn-secondary:hover {
    background-color: #8DC63F;
    border-color: #8DC63F;
}
</style>
