<template>
    <section id="services" class="services-section">
        <div class="services-container">
            <!-- Section Header -->
            <div class="services-header reveal">
                <div class="services-badge">
                    <span class="badge-line"></span>
                    <span class="badge-text">{{ badge }}</span>
                    <span class="badge-line"></span>
                </div>
                <h2 class="services-title">{{ title }} <em>{{ subtitle }}</em></h2>
                <p v-if="description">{{ description }}</p>
            </div>

            <!-- Service Cards -->
            <div class="services-grid">
                <div v-for="(service, idx) in services" :key="service.id" class="service-card reveal" :class="'reveal-delay-' + (idx + 1)">
                    <div class="service-icon">
                        <img :src="serviceIconByIndex(idx)" :alt="service.title + ' icon'" />
                    </div>
                    <div class="service-copy">
                        <!-- Title -->
                        <h4 class="service-title">{{ service.title }}</h4>

                        <!-- Description -->
                        <p class="service-desc">{{ service.description }}</p>
                    </div>

                    <div class="service-divider"></div>

                    <!-- Bullet Points -->
                    <ul v-if="service.bullet_points && service.bullet_points.length" class="service-bullets">
                        <li v-for="(point, idx) in service.bullet_points" :key="idx">
                            <svg class="service-bullet-icon" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ point }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { useScrollReveal } from '@/composables/useScrollReveal';

defineProps({
    services: { type: Array, required: true },
    badge: { type: String, default: 'OUR SERVICES' },
    title: { type: String, default: 'WE DO MORE' },
    subtitle: { type: String, default: "SO YOU DON'T HAVE TO" },
    description: { type: String, default: '' },
});

function serviceIconByIndex(idx) {
    const icons = ['/icons/truck.webp', '/icons/equipment.webp', '/icons/delivery.webp'];
    return icons[idx] || icons[0];
}

useScrollReveal();
</script>

<style scoped>
.services-section {
    background: #fff;
    padding: 64px 0 40px;
}

.services-container {
    max-width: 78rem;
    margin: 0 auto;
    padding: 0 1rem;
}

/* Header */
.services-header {
    text-align: center;
    margin-bottom: 48px;
}

.services-badge {
    display: inline-flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 14px;
}

.badge-line {
    display: block;
    width: 45px;
    height: 1px;
    background: #d1d5db;
}

.badge-text {
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: #6b7280;
}

.services-title {
    font-size: clamp(1.6rem, 3.5vw, 2.4rem);
    font-weight: 900;
    color: #1a1a1a;
    line-height: 1.1;
}

.services-title em {
    color: #8ac507;
    font-style: italic;
}

/* Cards grid */
.services-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 18px;
}

.service-card {
    background: #fff;
    border: 1.2px solid #eef2f6;
    border-bottom: 3px solid #8ac507;
    border-radius: 18px;
    padding: 24px 18px;
    display: flex;
    flex-direction: column;
    align-items: center;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    transition: border-color 0.3s, box-shadow 0.3s, transform 0.3s;
}

.service-card:hover {
    border-color: rgba(138, 197, 7, 0.28);
    box-shadow: 0 8px 30px rgba(138, 197, 7, 0.08);
    transform: translateY(-4px);
}

/* Icon */
.service-icon {
    height: 120px;
    flex-shrink: 0;
    margin-bottom: 14px;
    width: 100%;
    text-align: center;
}

.service-icon img {
    height: 100%;
    width: auto;
    display: inline-block;
}

.service-copy {
    min-width: 0;
    text-align: left;
    width: 80%;
}

/* Title */
.service-title {
    font-size: 16px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    color: #1a1a1a;
    line-height: 1.14;
    min-height: 2.28em;
    margin-bottom: 6px;
}

/* Description */
.service-desc {
    font-size: 13px;
    color: #6b7280;
    line-height: 1.45;
    margin-bottom: 0;
}

.service-divider {
    width: 80%;
    height: 1px;
    background: #e5e7eb;
    margin: 12px 0 14px;
}

/* Bullets */
.service-bullets {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 6px;
    width: 80%;
}

.service-bullets li {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.35;
    color: #374151;
}

.service-bullet-icon {
    width: 17px;
    height: 17px;
    flex-shrink: 0;
    color: #fff;
    background: #8ac507;
    border-radius: 9999px;
    padding: 2px;
}

@media (min-width: 640px) {
    .services-container {
        padding: 0 1.5rem;
    }
}

@media (min-width: 768px) {
    .services-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .services-header {
        margin-bottom: 52px;
    }

    .service-card {
        padding: 22px 16px;
    }

    .service-icon {
        height: 100px;
    }

    .service-copy {
        min-height: 100px;
    }
}

@media (min-width: 1024px) {
    .services-section {
        padding: 76px 0 48px;
    }

    .services-container {
        padding: 0 2rem;
    }

    .services-header {
        margin-bottom: 56px;
    }

    .services-grid {
        gap: 20px;
    }

    .service-card {
        padding: 26px 20px;
    }

    .service-icon {
        height: 100px;
    }

    .service-title {
        font-size: 16px;
    }

    .service-desc {
        font-size: 15.5px;
        width: 100%;
    }

    .service-bullets li {
        font-size: 15px;
    }

    .service-copy {
        min-height: 110px;
    }

    .service-divider {
        margin: 14px 0 16px;
    }
}
</style>
