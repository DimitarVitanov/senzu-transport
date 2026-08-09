<script setup>
import { computed } from 'vue';

const props = defineProps({
    phone: { type: String, default: '0424 033 572' },
    phoneRaw: { type: String, default: '+61424033572' },
    titlePre: { type: String, default: 'READY TO' },
    titleAccent: { type: String, default: 'MOVE?' },
    subtitle: { type: String, default: 'Get a fast, obligation-free quote today.' },
    features: { type: Array, default: () => [] },
});

defineEmits(['open-quote']);

const fallback = [
    { icon: 'icon-safe-handlling', title: 'SAFE HANDLING' },
    { icon: 'icon-on-time', title: 'ON-TIME SERVICE' },
    { icon: 'icon-fully-secured', title: 'FULLY INSURED' },
    { icon: 'icon-careful-movers', title: 'CAREFUL MOVERS' },
];

const items = computed(() => (props.features && props.features.length ? props.features : fallback));
</script>

<template>
    <section id="contact" class="cta-section">
        <div class="cta-wrapper">
            <!-- Left Image -->
            <div class="cta-image-wrapper">
                <img
                    src="/images/cta-image.webp"
                    alt="Senzu Transport team"
                    class="cta-image"
                />
            </div>

            <!-- Middle Content -->
            <div class="cta-content">
                <h2 class="cta-title">
                    {{ titlePre }} <span class="text-green">{{ titleAccent }}</span>
                </h2>
                <p class="cta-subtitle">
                    {{ subtitle }}
                </p>
                <div class="cta-buttons">
                    <button type="button" @click="$emit('open-quote')" class="cta-btn-primary">
                        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="16" rx="2" />
                            <path d="M8 11h8M8 15h5M12 2v4M12 20v2" />
                        </svg>
                        GET A FREE QUOTE
                    </button>
                    <a :href="`tel:${phoneRaw}`" class="cta-btn-secondary">
                        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z" />
                        </svg>
                        {{ phone }}
                    </a>
                </div>
            </div>

            <!-- Right Features -->
            <div class="cta-features">
                <div
                    v-for="feature in items"
                    :key="feature.id || feature.title"
                    class="cta-feature-item"
                >
                    <div class="cta-feature-icon">
                        <img
                            :src="`/images/${feature.icon}.svg`"
                            :alt="feature.title"
                            class="feature-icon-img"
                        />
                    </div>
                    <p class="cta-feature-title">{{ feature.title }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.cta-section {
    background-color: #000000;
    padding: 0;
    scroll-margin-top: 5rem;
}

.cta-wrapper {
    display: flex;
    align-items: stretch;
    min-height: 120px;
}

/* Left Image */
.cta-image-wrapper {
    flex: 0 0 30%;
    position: relative;
    overflow: hidden;
    display: flex;
}

.cta-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}


/* Middle Content */
.cta-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 2rem 3rem;
}

.cta-title {
    font-family: 'Poppins', sans-serif;
    font-size: 2.5rem;
    font-weight: 700;
    color: #ffffff;
    text-transform: uppercase;
    margin-bottom: 0.5rem;
    text-align: center;
}

.text-green {
    color: #8dc63f;
}

.cta-subtitle {
    font-size: 1rem;
    color: #9ca3af;
    margin-bottom: 1.5rem;
    text-align: center;
}

.cta-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    justify-content: center;
}

.cta-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background-color: #8dc63f;
    color: #000000;
    font-family: 'Poppins', sans-serif;
    font-size: 0.875rem;
    font-weight: 700;
    text-transform: uppercase;
    padding: 0.875rem 1.5rem;
    border-radius: 0.375rem;
    text-decoration: none;
    transition: background-color 0.2s;
    cursor: pointer;
}

.cta-btn-primary:hover {
    background-color: #7ab52e;
}

.cta-btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background-color: #1f2937;
    color: #ffffff;
    font-family: 'Poppins', sans-serif;
    font-size: 0.875rem;
    font-weight: 700;
    padding: 0.875rem 1.5rem;
    border-radius: 0.375rem;
    text-decoration: none;
    transition: background-color 0.2s;
}

.cta-btn-secondary:hover {
    background-color: #374151;
}

.btn-icon {
    width: 1.25rem;
    height: 1.25rem;
}

/* Right Features */
.cta-features {
    flex: 0 0 30%;
    display: flex;
    align-items: center;
    justify-content: space-around;
    padding: 1rem 2rem;
    gap: 1rem;
}

.cta-feature-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 0.5rem;
}

.cta-feature-icon {
    width: 2.5rem;
    height: 2.5rem;
}

.feature-icon-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.cta-feature-title {
    font-size: 0.9rem;
    color: #9ca3af;
    text-transform: uppercase;
    white-space: pre-line;
    line-height: 1.3;
}

@media (max-width: 1024px) {
    .cta-wrapper {
        flex-direction: column;
    }

    .cta-image-wrapper {
        flex: none;
        height: 150px;
    }

    .cta-image-gradient {
        background: linear-gradient(to bottom, transparent 0%, #000000 100%);
    }

    .cta-content {
        padding: 1.5rem;
        text-align: center;
    }

    .cta-buttons {
        justify-content: center;
    }

    .cta-features {
        flex: none;
        flex-wrap: wrap;
        justify-content: center;
        padding: 1.5rem;
    }

    .cta-feature-item {
        flex: 1 1 40%;
    }
}
</style>
