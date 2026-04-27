import { onMounted, onUnmounted } from 'vue';

/**
 * Scroll-reveal composable using IntersectionObserver.
 * Add the class "reveal" to any element you want to animate in on scroll.
 * Elements start hidden (opacity 0, translateY) and get class "revealed" when visible.
 *
 * Usage: import and call useScrollReveal() inside <script setup>.
 * Optionally pass a ref to scope the observer to a specific container.
 */
export function useScrollReveal(containerRef = null) {
    let observer = null;

    onMounted(() => {
        observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.15 }
        );

        const root = containerRef?.value || document;
        const elements = root.querySelectorAll('.reveal');
        elements.forEach((el) => observer.observe(el));
    });

    onUnmounted(() => {
        if (observer) observer.disconnect();
    });
}
