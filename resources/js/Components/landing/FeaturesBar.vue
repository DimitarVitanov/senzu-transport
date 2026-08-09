<script setup>
import { computed } from 'vue';

const props = defineProps({
    features: { type: Array, default: () => [] },
});

const fallback = [
    { icon: 'shield', title: 'FULLY INSURED', description: 'Your peace of mind is our priority.' },
    { icon: 'truck', title: 'LOCAL & INTERSTATE', description: 'Moving across town or across the country.' },
    { icon: 'house', title: 'RESIDENTIAL & COMMERCIAL', description: 'Solutions for homes and businesses.' },
    { icon: 'people', title: 'EXPERIENCED REMOVALISTS', description: 'Skilled team. Great service every time.' },
    { icon: 'truck', title: 'MODERN FLEET', description: 'Reliable trucks equipped for safe transport.' },
    { icon: 'star', title: 'TRUSTED BY CUSTOMERS', description: '5-star service you can rely on.' },
];

const items = computed(() => (props.features && props.features.length ? props.features : fallback));
</script>

<template>
    <div class="features-bar">
        <div class="features-container">
            <div
                v-for="(feature, index) in items"
                :key="feature.id || feature.title"
                class="feature-item"
                :class="{ 'border-right': index < items.length - 1 }"
            >
                <div class="feature-icon">
                    <img
                        :src="`/images/${feature.icon}.svg`"
                        :alt="feature.title"
                        class="icon-img"
                    />
                </div>
                <div class="feature-content">
                    <h3 class="feature-title">{{ feature.title }}</h3>
                    <p class="feature-description">{{ feature.description }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.features-bar {
    position: relative;
    z-index: 20;
    margin-top: -3rem;
    margin-bottom: 3rem;
    padding: 0 1.5rem;
}

@media (min-width: 1024px) {
    .features-bar {
        padding: 0 3.5rem;
    }
}

@media (min-width: 1280px) {
    .features-bar {
        padding: 0 5rem;
    }
}

.features-container {
    max-width: 1600px;
    margin: 0 auto;
    display: flex;
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.feature-item {
    flex: 1;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 2rem 1.25rem;
    min-width: 0;
}

.border-right {
    border-right: 1px solid #e5e7eb;
}

.feature-icon {
    flex-shrink: 0;
    width: 3.5rem;
    height: 3.5rem;
    color: #8dc63f;
}

.icon-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.feature-content {
    min-width: 0;
}

.feature-title {
    font-family: 'Poppins', sans-serif;
    font-size: 0.75rem;
    font-weight: 700;
    color: #1f2937;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.25rem;
}

.feature-description {
    font-size: 0.75rem;
    color: #6b7280;
    line-height: 1.4;
}

@media (max-width: 1024px) {
    .features-container {
        flex-wrap: wrap;
    }

    .feature-item {
        flex: 1 1 33.333%;
        border-right: none !important;
        border-bottom: 1px solid #e5e7eb;
    }

    .feature-item:nth-child(3),
    .feature-item:nth-child(6) {
        border-bottom: none;
    }

    .feature-item:nth-child(1),
    .feature-item:nth-child(2),
    .feature-item:nth-child(4),
    .feature-item:nth-child(5) {
        border-right: 1px solid #e5e7eb !important;
    }
}

@media (max-width: 640px) {
    .features-bar {
        padding: 0 0.75rem;
    }

    .feature-item {
        flex: 1 1 100%;
        border-right: none !important;
        border-bottom: 1px solid #e5e7eb;
        padding: 1rem;
        gap: 0.5rem;
    }

    .feature-item:last-child {
        border-bottom: none;
    }

    .feature-icon {
        width: 3rem;
        height: 3rem;
    }

    .feature-title {
        font-size: 0.7rem;
    }

    .feature-description {
        font-size: 0.7rem;
    }
}
</style>
