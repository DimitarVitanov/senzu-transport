<template>
    <section class="stats-cta-section">
        <div class="stats-cta-container">
            <div class="stats-cta-row reveal">
                <div class="stats-panel">
                <!-- Stat 1: 500+ -->
                    <div class="stat-item">
                    <div class="stat-icon">
                        <img src="/icons/team.webp" alt="Team icon" />
                    </div>
                    <div class="stat-text">
                        <span class="stat-number">{{ settings.stat_1_number }}</span>
                        <span class="stat-label">{{ settings.stat_1_label }}</span>
                        <span class="stat-sub">{{ settings.stat_1_sub }}</span>
                    </div>
                </div>

                <!-- Stat 2: 5.0 Star -->
                    <div class="stat-item">
                    <div class="stat-icon">
                        <img src="/icons/star.webp" alt="Star icon" />
                    </div>
                    <div class="stat-text">
                        <span class="stat-number">{{ settings.stat_2_number }}</span>
                        <span class="stat-label">{{ settings.stat_2_label }}</span>
                        <span class="stat-sub">{{ settings.stat_2_sub }}</span>
                    </div>
                </div>

                <!-- Stat 3: Fully Insured -->
                    <div class="stat-item">
                    <div class="stat-icon">
                        <img src="/icons/shield.webp" alt="Shield icon" />
                    </div>
                    <div class="stat-text">
                        <span class="stat-label">{{ settings.stat_3_label }}</span>
                        <span class="stat-sub">{{ settings.stat_3_sub }}</span>
                    </div>
                </div>

                <!-- Stat 4: Local Brisbane -->
                    <div class="stat-item">
                    <div class="stat-icon">
                        <img src="/icons/location.webp" alt="Location icon" />
                    </div>
                    <div class="stat-text">
                        <span class="stat-label">{{ settings.stat_4_label }}</span>
                        <span class="stat-sub">{{ settings.stat_4_sub }}</span>
                    </div>
                </div>

                </div>

                <!-- Black CTA Box -->
                <div class="cta-box">
                    <span class="cta-phone-icon">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" stroke="currentColor" stroke-width="1.8"/>
                        </svg>
                    </span>
                    <div class="cta-content">
                        <div class="cta-top-text">NEED IT DELIVERED TODAY?</div>
                        <a :href="'tel:' + settings.phone_raw" class="cta-phone">CALL {{ settings.phone }}</a>
                        <div class="cta-sub-text">Same-day availability · Fast response</div>
                        <div class="cta-tagline">We get it done right.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { useScrollReveal } from '@/composables/useScrollReveal';

defineProps({
    settings: { type: Object, required: true },
});

useScrollReveal();
</script>

<style scoped>
.stats-cta-section {
    background: #fff;
    padding: 16px 0 32px;
}

.stats-cta-container {
    max-width: 78rem;
    margin: 0 auto;
    padding: 0 1rem;
}

.stats-cta-row {
    display: grid;
    gap: 16px;
    align-items: stretch;
}

.stats-panel {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
    background: #fff;
   /* border: 1px solid #e5e7eb; */
    border-radius: 14px;
    box-shadow: 0 10px 50px rgba(0, 0, 0, 0.15);
    overflow: hidden;
}

.stat-item {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 18px 16px;
    border-bottom: 1px solid #e5e7eb;
    border-right: none;
}

.stat-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 18px;
    bottom: 18px;
    width: 2.2px;
    background: #eef2f6;
}

.stat-item:nth-child(2n + 1)::before {
    display: none;
}

.stat-icon {
    width: 44px;
    height: 44px;
    flex-shrink: 0;
    margin-top: 0;
}

.stat-icon svg {
    width: 100%;
    height: 100%;
}

.stat-icon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

/* Team icon asset has extra internal padding, so it renders visually smaller. */
.stat-item:first-child .stat-icon img {
    transform: scale(1.2);
    transform-origin: center;
}

.stat-text {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.stat-number {
    font-size: 20px;
    font-weight: 800;
    color: #1a1a1a;
    line-height: 1;
}

.stat-label {
    font-size: 15px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: #1a1a1a;
    margin-top: 4px;
}

.stat-sub {
    font-size: 12px;
    color: #6b7280;
    margin-top: 3px;
}

/* Green CTA Box */
.cta-box {
    background: #050608;
    border: 1px solid #050608;
    border-radius: 14px;
    padding: 18px 20px;
    margin: 0;
    height: 100%;
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 14px;
    text-align: left;
}

.cta-content {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.cta-phone-icon {
    width: 44px;
    height: 44px;
    border-radius: 9999px;
    border: 2px solid #8ac507;
    color: #8ac507;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.cta-phone-icon svg {
    width: 20px;
    height: 20px;
}

.cta-top-text {
    font-size: 11px;
    font-weight: 700;
    color: #fff;
    letter-spacing: 0.05em;
    margin-bottom: 2px;
}

.cta-phone {
    font-size: 20px;
    font-weight: 900;
    line-height: 1;
    color: #8ac507;
    text-decoration: none;
    letter-spacing: 0.01em;
}

.cta-phone:hover {
    text-decoration: underline;
}

.cta-sub-text {
    font-size: 11px;
    color: #ffffff;
    font-weight: 600;
    margin-top: 2px;
}

.cta-tagline {
    font-size: 22px;
    font-weight: 700;
    font-style: italic;
    line-height: 1.1;
    color: #8ac507;
    margin-top: 4px;
    font-family: 'Dancing Script', cursive;
}

@media (min-width: 640px) {
    .stats-cta-container {
        padding: 0 1.5rem;
    }
}

@media (min-width: 768px) {
    .stats-cta-row {
        grid-template-columns: minmax(0, 2.1fr) minmax(240px, 1fr);
        gap: 10px;
    }

    .stats-panel {
        grid-template-columns: repeat(4, 1fr);
    }

    .stat-item {
        padding: 18px 12px;
        border-bottom: none;
    }

    .stat-item::before {
        top: 22px;
        bottom: 22px;
    }

    .stat-item:nth-child(2n + 1)::before {
        display: block;
    }

    .stat-item:first-of-type::before {
        display: none;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
    }

    .stat-number {
        font-size: 18px;
    }

    .stat-label {
        font-size: 13px;
    }

    .stat-sub {
        font-size: 11px;
    }

    .cta-box {
        padding: 14px 16px;
    }

    .cta-phone {
        font-size: 17px;
    }

    .cta-tagline {
        font-size: 18px;
    }
}

@media (min-width: 1024px) {
    .stats-cta-section {
        padding: 20px 0 36px;
    }

    .stats-cta-container {
        padding: 0 2rem;
    }

    .stats-cta-row {
        grid-template-columns: minmax(0, 2.1fr) minmax(280px, 1fr);
    }

    .stat-item {
        padding: 22px 18px;
    }

    .stat-item::before {
        top: 28px;
        bottom: 28px;
    }

    .stat-number {
        font-size: 22px;
    }

    .stat-label {
        font-size: 15px;
    }

    .stat-sub {
        font-size: 13px;
        color: #000000;
    }

    .stat-icon {
        width: 54px;
        height: 54px;
    }

    .cta-box {
        margin: 0;
        padding: 18px 22px;
    }

    .cta-phone {
        font-size: 20px;
    }

    .cta-tagline {
        font-size: 22px;
    }
}
</style>
