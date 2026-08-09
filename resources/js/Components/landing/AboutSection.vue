<script setup>
import { computed } from 'vue';

const props = defineProps({
    steps: { type: Array, default: () => [] },
    testimonials: { type: Array, default: () => [] },
    serviceAreas: { type: Array, default: () => [] },
    processTitle: { type: String, default: 'MOVING MADE EASY' },
    areasTitle: { type: String, default: 'SERVICE AREAS' },
    reviewsTitle: { type: String, default: 'WHAT OUR CUSTOMERS SAY' },
});

const fallbackSteps = [
    { icon: 'icon-list', title: 'REQUEST A QUOTE', description: 'Tell us what you need moved.' },
    { icon: 'icon-calendar', title: 'BOOK YOUR MOVE', description: 'Choose a time that suits you.' },
    { icon: 'icon-truck-two', title: 'WE PACK & TRANSPORT', description: 'Our team handles everything with care.' },
    { icon: 'icon-chair', title: 'YOU RELAX', description: 'Your items arrive safely at your new home.' },
];

const fallbackAreas = ['Brisbane', 'Gold Coast', 'Logan', 'Sunshine Coast', 'Ipswich', 'Toowoomba'];

const fallbackTestimonials = [
    { rating: 5, content: 'Senzu Transport made our move so easy. The team was on time, careful and very professional.', name: 'Sarah J.' },
    { rating: 5, content: 'Excellent service from start to finish. Highly recommend these guys!', name: 'Michael T.' },
    { rating: 5, content: 'Great communication, fair pricing and nothing was too much trouble. Would use again!', name: 'Lisa P.' },
];

const stepItems = computed(() => (props.steps && props.steps.length ? props.steps : fallbackSteps));
const areaItems = computed(() => (props.serviceAreas && props.serviceAreas.length ? props.serviceAreas : fallbackAreas));
const testimonialItems = computed(() => (props.testimonials && props.testimonials.length ? props.testimonials : fallbackTestimonials));
</script>

<template>
    <section id="about" class="about-section">
        <!-- Moving Made Easy -->
        <div class="process-section">
            <div class="process-wrapper">
                <div class="process-left">
                    <div class="process-header">
                        <h2 class="process-title">{{ processTitle }}</h2>
                        <div class="process-line" />
                    </div>

                    <div class="process-steps">
                        <div
                            v-for="(step, index) in stepItems"
                            :key="step.id || step.title"
                            class="step-item"
                        >
                            <div class="step-header-row">
                                <div class="step-number">{{ index + 1 }}</div>
                                <div class="step-icon">
                                    <img
                                        :src="`/images/${step.icon}.svg`"
                                        :alt="step.title"
                                        class="step-icon-img"
                                    />
                                </div>
                            </div>
                            <h3 class="step-title">{{ step.title }}</h3>
                            <p class="step-description">{{ step.description }}</p>

                            <!-- Arrow between steps (except last) -->
                            <div v-if="index < stepItems.length - 1" class="step-arrow">
                                <img
                                    src="/images/icon-arrow.svg"
                                    alt="Next"
                                    class="arrow-img"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="process-image-wrapper">
                    <img
                        src="/images/process-image.webp"
                        alt="Senzu Transport team moving furniture"
                        class="process-image"
                    />
                    <div class="process-image-gradient" />
                </div>
            </div>
        </div>

        <!-- Service Areas & Testimonials -->
        <div class="info-section">
            <div class="process-container">
                <!-- Service Areas -->
                <div id="service-areas" class="service-areas">
                    <h3 class="info-title">{{ areasTitle }}</h3>
                    <div class="info-line" />
                    <div class="areas-content">
                        <div class="areas-list">
                            <div
                                v-for="area in areaItems"
                                :key="area"
                                class="area-item"
                            >
                                <img
                                    src="/images/icon-pin.svg"
                                    alt="Location"
                                    class="area-pin"
                                />
                                <span class="area-name">{{ area }}</span>
                            </div>
                        </div>
                        <div class="areas-map">
                            <img
                                src="/images/map.webp"
                                alt="Queensland Service Areas"
                                class="map-img"
                            />
                        </div>
                    </div>
                </div>

                <!-- Testimonials -->
                <div id="reviews" class="testimonials">
                    <h3 class="info-title">{{ reviewsTitle }}</h3>
                    <div class="info-line" />
                    <div class="testimonials-grid">
                        <div
                            v-for="testimonial in testimonialItems"
                            :key="testimonial.id || testimonial.name"
                            class="testimonial-card"
                        >
                            <div class="testimonial-stars">
                                <img
                                    v-for="n in (testimonial.rating || 5)"
                                    :key="n"
                                    src="/images/icon-testimonial-star.svg"
                                    alt="Star"
                                    class="star-img"
                                />
                            </div>
                            <p class="testimonial-text">"{{ testimonial.content }}"</p>
                            <p class="testimonial-author">- {{ testimonial.name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.about-section {
    background-color: #ffffff;
}

/* Process Section */
.process-section {
 padding-bottom:1.5rem;
}

.process-wrapper {
    display: flex;
    align-items: center;
    gap: 2rem;
    overflow: hidden;
}

.process-left {
    padding-left: 1.5rem;
}

@media (min-width: 1024px) {
    .process-left {
        padding-left: 3.5rem;
    }
}

@media (min-width: 1280px) {
    .process-left {
        padding-left: 10rem;
    }
}

.process-left {
    flex: 1;
}

.process-image-wrapper {
    flex: 0 0 28%;
    position: relative;
    height: 200px;
    border-radius: 0.5rem;
    overflow: hidden;
    align-self: center;
}

.process-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.process-image-gradient {
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, #ffffff 0%, transparent 40%);
}

@media (max-width: 1024px) {
    .process-wrapper {
        flex-direction: column;
    }

    .process-left {
        padding-right: 0;
    }

    .process-image-wrapper {
        position: relative;
        right: auto;
        top: auto;
        width: 100%;
        flex: none;
        height: 200px;
    }

    .process-image-wrapper img {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .process-image-gradient {
        background: linear-gradient(to bottom, #ffffff 0%, transparent 40%);
    }
}

.process-container {
    max-width: 1600px;
    margin: 0 auto;
}

.process-header {
    margin-bottom: 3rem;
}

.process-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    padding-top:.2rem
}

.process-line {
    margin-top: 0.75rem;
    width: 3rem;
    height: 0.25rem;
    background-color: #8dc63f;
    border-radius: 9999px;
}

.process-steps {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 1rem;
}

@media (max-width: 768px) {
    .process-section {
        padding: 2rem 0 1rem;
    }

    .process-wrapper {
        flex-direction: column;
        gap: 1.5rem;
        padding: 0;
    }

    .process-left {
        width: 100%;
        text-align: center;
        padding: 0 1rem;
    }

    .process-header {
        align-items: center;
    }

    .process-line {
        margin-left: auto;
        margin-right: auto;
    }

    .process-steps {
        flex-direction: column;
        gap: 1.5rem;
        align-items: center;
    }

    .step-item {
        flex: none;
        width: 100%;
        max-width: 200px;
        align-items: center;
        text-align: center;
    }

    .step-header-row {
        justify-content: center;
        gap: 0.5rem;
    }

    .step-number {
        width: 1.25rem;
        height: 1.25rem;
        font-size: 0.7rem;
    }

    .step-icon {
        width: 2rem;
        height: 2rem;
    }

    .step-title {
        font-size: 0.75rem;
    }

    .step-description {
        font-size: 0.7rem;
    }

    .process-image-wrapper {
        width: 100%;
        height: 180px;
        margin: 0 auto;
    }

    .info-section {
        padding: 0 0 2rem;
    }

    .info-section .process-container {
        grid-template-columns: 1fr;
    }

    .service-areas {
        border-right: none;
        border-bottom: 1px solid #e5e7eb;
    }
}

.step-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    position: relative;
    flex: 1;
    max-width: 180px;
}

.step-header-row {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    margin-bottom: 0.5rem;
}

.step-number {
    width: 1.5rem;
    height: 1.5rem;
    border-radius: 50%;
    background-color: #8dc63f;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.75rem;
    flex-shrink: 0;
}

.step-icon {
    width: 2.5rem;
    height: 2.5rem;
}

.step-icon-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    filter: brightness(0);
}

/* Make chair icon (step 4) black */
.step-item:nth-child(4) .step-icon-img {
    /* filter: brightness(0); */
}

.step-title {
    font-family: 'Poppins', sans-serif;
    font-size: 0.875rem;
    font-weight: 700;
    color: #000000;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.25rem;
}

.step-description {
    font-size: 0.8rem;
    color: #000000;
    line-height: 1.4;
    white-space: pre-line;
    text-align: center;
}

.step-arrow {
    position: absolute;
    top: 2.5rem;
    right: -5.65rem;
    width: 1.5rem;
    height: 0.75rem;
}

.arrow-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

@media (max-width: 768px) {
    .step-arrow {
        display: none;
    }
}

/* Info Section */
.info-section {
    padding: 0 1.5rem 2rem;
    position: relative;
    z-index: 2;
}

@media (min-width: 1024px) {
    .info-section {
        padding: 0 3.5rem 2rem;
    }
}

@media (min-width: 1280px) {
    .info-section {
        padding: 0 5rem 2rem;
    }
}

.info-section .process-container {
    display: grid;
    grid-template-columns: 0.5fr 1fr;
    gap: 0;
    border: 1px solid #e5e7eb;
    border-radius: 0.75rem;
    overflow: hidden;
    background: white;
    position: relative;
    z-index: 2;
}

.service-areas {
    padding: 1rem 1.5rem;
    border-right: 1px solid #e5e7eb;
    scroll-margin-top: 6rem;
}

.testimonials {
    padding: 1rem 1.5rem;
    scroll-margin-top: 6rem;
}

@media (max-width: 768px) {
    .info-section {
        padding: 0 0 2rem;
    }

    .info-section .process-container {
        grid-template-columns: 1fr;
        gap: 0;
        border-radius: 0;
        border-left: none;
        border-right: none;
    }

    .service-areas {
        border-right: none;
        border-bottom: 1px solid #e5e7eb;
    }
}

.info-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1rem;
    font-weight: 700;
    color: #1f2937;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.5rem;
}

.info-line {
    width: 2rem;
    height: 0.2rem;
    background-color: #8dc63f;
    border-radius: 9999px;
    margin-bottom: 1.5rem;
}

/* Service Areas */
.areas-content {
    display: flex;
    gap: 1.5rem;
   /* align-items: center;*/
}

.areas-list {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
}

.area-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.area-pin {
    width: 1rem;
    height: 1rem;
    flex-shrink: 0;
}

.area-name {
    font-size: 0.85rem;
    color: #4b5563;
}

.areas-map {
    flex: 0 0 140px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.map-img {
    max-width: 100%;
    max-height: 150px;
    width: auto;
    height: auto;
    object-fit: contain;
}

/* Testimonials */
.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

@media (max-width: 768px) {
    .testimonials-grid {
        grid-template-columns: 1fr;
    }
}

.testimonial-card {
    display: flex;
    flex-direction: column;
}

.testimonial-stars {
    display: flex;
    gap: 0.25rem;
    margin-bottom: 1rem;
}

.star-img {
    width: 1rem;
    height: 1rem;
}

.testimonial-text {
    font-size: 0.85rem;
    color: #4b5563;
    line-height: 1.5;
    margin-bottom: 1rem;
    flex-grow: 1;
}

.testimonial-author {
    font-size: 0.8rem;
    color: #1f2937;
    font-weight: 600;
}
</style>
