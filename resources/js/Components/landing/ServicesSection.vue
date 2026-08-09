<script setup>
import { computed } from 'vue';

const props = defineProps({
    services: { type: Array, default: () => [] },
    title: { type: String, default: 'OUR REMOVAL SERVICES' },
});

const fallback = [
    { icon: 'icon-house', title: 'HOUSE MOVES', description: 'Full home relocations throughout Brisbane and South East Queensland.', image: '/images/service-house-moves.webp' },
    { icon: 'icon-office', title: 'OFFICE RELOCATIONS', description: 'Fast and professional business relocations.', image: '/images/service-office.webp' },
    { icon: 'icon-packing', title: 'PACKING SERVICES', description: 'Furniture wrapping, packing supplies and protection.', image: '/images/service-packing.webp' },
    { icon: 'icon-truck', title: 'INTERSTATE MOVES', description: 'Queensland, New South Wales and beyond.', image: '/images/service-interstate.webp' },
    { icon: 'icon-recycle', title: 'PACKAGING REMOVAL', description: 'Removal of moving boxes and packaging waste.', image: '/images/service-packaging.webp' },
    { icon: 'icon-chair', title: 'FURNITURE DELIVERY', description: 'Single furniture items and specialty deliveries.', image: '/images/service-furniture.webp' },
];

const items = computed(() => (props.services && props.services.length ? props.services : fallback));
</script>

<template>
    <section id="services" class="services-section">
        <div class="services-container">
            <!-- Section Header -->
            <div class="section-header">
                <h2 class="section-title">{{ title }}</h2>
                <div class="section-line" />
            </div>

            <!-- Services Grid -->
            <div class="services-grid">
                <div
                    v-for="service in items"
                    :key="service.id || service.title"
                    class="service-card"
                >
                    <!-- Content Side -->
                    <div class="service-content">
                        <div class="service-icon">
                            <img
                                :src="`/images/${service.icon}.svg`"
                                :alt="service.title"
                                class="icon-img"
                            />
                        </div>
                        <h3 class="service-title">{{ service.title }}</h3>
                        <p class="service-description">{{ service.description }}</p>
                    </div>

                    <!-- Image Side -->
                    <div class="service-image-wrapper">
                        <img
                            :src="service.image"
                            :alt="service.title"
                            class="service-image"
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.services-section {
    background-color: #0a0a0a;
    padding: 4rem 1.5rem;
}

@media (min-width: 1024px) {
    .services-section {
        padding: 5rem 3.5rem;
    }
}

@media (min-width: 1280px) {
    .services-section {
        padding: 5rem 5rem;
    }
}

.services-container {
    max-width: 1600px;
    margin: 0 auto;
}

.section-header {
    text-align: center;
    margin-bottom: 3rem;
}

.section-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: white;
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

.section-line {
    margin: 1rem auto 0;
    width: 3rem;
    height: 0.25rem;
    background-color: #8dc63f;
    border-radius: 9999px;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
}

@media (max-width: 1024px) {
    .services-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 640px) {
    .services-grid {
        grid-template-columns: 1fr;
    }

    .service-card {
        position: relative;
        min-height: 200px;
        background: transparent;
    }

    .service-content {
        position: relative;
        z-index: 2;
        flex: none;
        padding: 1.5rem;
        text-align: center;
    }

    .service-content::after {
        display: none;
    }

    .service-icon {
        width: 2.5rem;
        height: 2.5rem;
        margin: 0 auto 0.75rem;
    }

    .service-icon .icon-img {
        filter: brightness(0) invert(1);
    }

    .service-title {
        font-size: 0.9rem;
        color: white;
    }

    .service-description {
        font-size: 0.85rem;
        color: #e5e7eb;
        line-height: 1.5;
    }

    .service-image-wrapper {
        position: absolute;
        inset: 0;
        z-index: 1;
        border-radius: 0.75rem;
    }

    .service-image-wrapper::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.6) 100%);
        border-radius: 0.75rem;
    }

    .service-image {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
}

.service-card {
    display: flex;
    background: #0a0a0a;
    border: 1px solid #8dc63f;
    border-radius: 0.75rem;
    overflow: hidden;
    min-height: 200px;
    position: relative;
}

.service-content {
    flex: 0 0 45%;
    padding: 1.25rem;
    display: flex;
    flex-direction: column;
    z-index: 2;
    position: relative;
}

.service-content::after {
    content: '';
    position: absolute;
    top: 0;
    right: -25px;
    width: 50px;
    height: 100%;
    background: #0a0a0a;
    transform: skewX(-8deg);
    z-index: -1;
}

.service-image-wrapper {
    flex: 0 0 55%;
    position: relative;
    overflow: hidden;
}

.service-icon {
    width: 2.5rem;
    height: 2.5rem;
    margin-bottom: 0.75rem;
}

.icon-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.service-title {
    font-family: 'Poppins', sans-serif;
    font-size: 0.875rem;
    font-weight: 700;
    color: #a7a7a7;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.5rem;
}

.service-description {
    font-size: 0.8rem;
    color: #9ca3af;
    line-height: 1.5;
    white-space: pre-line;
}

.service-image-wrapper {
    flex: 1;
    position: relative;
    overflow: hidden;
}

.service-image {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}
</style>
