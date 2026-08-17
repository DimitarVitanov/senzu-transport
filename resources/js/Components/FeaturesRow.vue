<template>
    <div class="features-card">
        <div class="features-grid">
            <div
                v-for="(feature, idx) in features"
                :key="feature.id"
                class="feature-item reveal"
                :class="'reveal-delay-' + (idx + 1)"
            >
                <div class="feature-inner">
                    <!-- Icon -->
                    <div class="feature-icon">
                        <img :src="iconSource(feature.icon)" :alt="feature.title + ' icon'" />
                    </div>
                    <!-- Text -->
                    <div class="feature-text">
                        <h3 class="feature-title">
                            <span class="feature-title-accent">{{ getTitleParts(feature).accent }}</span>
                            <span class="feature-title-rest">{{ getTitleParts(feature).rest }}</span>
                        </h3>
                        <p class="feature-desc">{{ feature.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useScrollReveal } from '@/composables/useScrollReveal';

defineProps({
    features: { type: Array, required: true },
});

function iconSource(icon) {
    if (icon === 'cube') return '/icons/box.webp';
    if (icon === 'clock') return '/icons/clock.webp';
    if (icon === 'shield') return '/icons/shield.webp';
    return '/icons/like.webp';
}

function getTitleParts(feature) {
    if (feature.icon === 'cube') {
        return { accent: 'SINGLE ITEM', rest: 'DELIVERIES' };
    }
    if (feature.icon === 'clock') {
        return { accent: 'SAME-DAY &', rest: 'URGENT JOBS' };
    }
    if (feature.icon === 'shield') {
        return { accent: 'FULLY INSURED', rest: '& RELIABLE' };
    }
    return { accent: 'LOCAL BRISBANE', rest: 'BUSINESS' };
}

useScrollReveal();
</script>

<style scoped>
.features-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 10px 50px rgba(0, 0, 0, 0.15);
    overflow: hidden;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
}

.feature-item {
    padding: 22px 18px 22px 0;
    position: relative;
}

/* Divider lines with top/bottom spacing */
.feature-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 28px;
    bottom: 28px;
    width: 2.2px;
    background: #eef2f6;
}

.feature-item:first-child::before {
    display: none;
}

.feature-inner {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding-left: 16px;
}

.feature-icon {
    flex-shrink: 0;
    width: 56px;
    height: 56px;
    margin-top: 0;
}

.feature-icon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.feature-title {
    font-size: 13px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: #1a1a1a;
    line-height: 1.36;
    margin-bottom: 3px;
}

.feature-title-accent,
.feature-title-rest {
    display: block;
}

.feature-title-accent {
    color: #52a001;
}

.feature-desc {
    font-size: 12.5px;
    color: #6b7280;
    line-height: 1.5;
}

.feature-text {
    padding-right: 0;
}

/* Mobile: show divider only between the 2 columns */
.feature-item:nth-child(2n + 1)::before {
    display: none;
}

@media (min-width: 768px) {
    .features-grid {
        grid-template-columns: repeat(4, 1fr);
    }

    .feature-item {
        padding: 22px 14px 22px 0;
    }

    .feature-inner {
        padding-left: 14px;
        gap: 8px;
    }

    .feature-icon {
        width: 56px;
        height: 56px;
    }

    .feature-title {
        font-size: 12px;
        margin-bottom: 3px;
    }

    .feature-desc {
        font-size: 11.5px;
        line-height: 1.35;
    }

    .feature-text {
        padding-right: 0;
    }

    /* Reset mobile rule, show all dividers except first */
    .feature-item:nth-child(2n + 1)::before {
        display: block;
    }

    .feature-item:first-child::before {
        display: none;
    }
}

@media (min-width: 1024px) {
    .feature-item {
        padding: 28px 22px 28px 0;
    }

    .feature-inner {
        padding-left: 18px;
        gap: 10px;
    }

    .feature-icon {
        width: 76px;
        height: 76px;
    }

    .feature-title {
        font-size: 14px;
        margin-bottom: 4px;
    }

    .feature-desc {
        font-size: 12.5px;
    }
}

@media (max-width: 767px) {
    .features-card {
        background: transparent;
        box-shadow: none;
        border-radius: 0;
        overflow: visible;
        padding: 0 1rem;
        margin-top: 10px;
    }

    .features-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .feature-item {
        background: #fff;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        width: auto;
        box-sizing: border-box;
        margin: 0;
        padding: 14px 10px 12px;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05);
    }

    .feature-item::before,
    .feature-item:nth-child(2n + 1)::before {
        display: none;
    }

    .feature-inner {
        padding-left: 0;
        gap: 8px;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .feature-icon {
        width: 56px;
        height: 56px;
        margin-bottom: 1px;
    }

    .feature-text {
        width: 100%;
        padding-right: 0;
    }

    .feature-title {
        font-size: 0.85rem;
        margin-bottom: 4px;
    }

    .feature-desc {
        font-size: 0.78rem;
        line-height: 1.35;
    }
}

@media (max-width: 379px) {
    .features-grid {
        grid-template-columns: 1fr;
    }
}
</style>
