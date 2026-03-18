document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('.site-header');
    const heroCopy = document.querySelector('.hero-copy');
    const heroNoise = document.querySelector('.hero-noise');
    const heroArcs = document.querySelectorAll('.hero-arc');
    const heroNetworks = document.querySelectorAll('.hero-network');
    const revealItems = document.querySelectorAll('.reveal');

    if ('IntersectionObserver' in window) {
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.16 });

        revealItems.forEach((item) => revealObserver.observe(item));
    } else {
        revealItems.forEach((item) => item.classList.add('is-visible'));
    }

    const counters = document.querySelectorAll('[data-count]');

    const animateCounter = (element) => {
        const raw = element.getAttribute('data-count') || '';
        const target = parseInt(raw.replace(/\D/g, ''), 10);

        if (!target) {
            return;
        }

        const suffix = raw.replace(/[0-9]/g, '');
        const duration = 1200;
        const start = performance.now();

        const step = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            element.textContent = `${Math.round(target * eased)}${suffix}`;

            if (progress < 1) {
                requestAnimationFrame(step);
            }
        };

        requestAnimationFrame(step);
    };

    if ('IntersectionObserver' in window) {
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.7 });

        counters.forEach((counter) => counterObserver.observe(counter));
    }

    let ticking = false;

    const applyScrollEffects = () => {
        const scrollY = window.scrollY || window.pageYOffset;
        const heroOffset = Math.min(scrollY, 360);

        header?.classList.toggle('is-scrolled', scrollY > 24);

        if (heroCopy) {
            heroCopy.style.transform = `translateY(${heroOffset * 0.12}px)`;
        }

        if (heroNoise) {
            heroNoise.style.transform = `translateY(${heroOffset * 0.08}px) scale(1.02)`;
        }

        heroArcs.forEach((arc, index) => {
            const direction = index % 2 === 0 ? 1 : -1;
            arc.style.transform = `translateX(-50%) translateY(${heroOffset * (0.1 + (index * 0.02))}px) scale(${1 + (heroOffset / 6000) * direction})`;
        });

        heroNetworks.forEach((network, index) => {
            const direction = index === 0 ? -1 : 1;
            network.style.transform = `translateX(${heroOffset * 0.05 * direction}px) translateY(${heroOffset * 0.06}px)`;
        });

        ticking = false;
    };

    const onScroll = () => {
        if (ticking) {
            return;
        }

        ticking = true;
        window.requestAnimationFrame(applyScrollEffects);
    };

    applyScrollEffects();
    window.addEventListener('scroll', onScroll, { passive: true });

    const slider = document.querySelector('[data-hero-slider]');
    const solutionsToggle = document.querySelector('[data-solutions-toggle]');
    const solutionsItem = document.querySelector('.nav-item-has-dropdown');
    const problemButtons = Array.from(document.querySelectorAll('[data-problem-stage]'));
    const problemPanel = document.querySelector('[data-problem-panel]');
    const problemTitle = document.querySelector('[data-problem-title]');
    const problemBody = document.querySelector('[data-problem-body]');

    if (solutionsToggle && solutionsItem) {
        solutionsToggle.addEventListener('click', () => {
            const isOpen = solutionsItem.classList.toggle('is-open');
            solutionsToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        document.addEventListener('click', (event) => {
            if (!solutionsItem.contains(event.target)) {
                solutionsItem.classList.remove('is-open');
                solutionsToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    if (problemButtons.length && problemPanel && problemTitle && problemBody) {
        const setProblemStage = (button) => {
            problemButtons.forEach((item) => {
                item.classList.toggle('is-active', item === button);
            });

            problemPanel.classList.remove('is-switching');
            window.requestAnimationFrame(() => {
                problemTitle.textContent = button.getAttribute('data-stage-title') || '';
                problemBody.textContent = button.getAttribute('data-stage-body') || '';
                problemPanel.classList.add('is-switching');
            });
        };

        problemButtons.forEach((button) => {
            button.addEventListener('click', () => setProblemStage(button));
        });

        problemPanel.addEventListener('animationend', () => {
            problemPanel.classList.remove('is-switching');
        });
    }

    if (!slider) {
        return;
    }

    const slides = Array.from(slider.querySelectorAll('[data-hero-slide]'));
    const dots = Array.from(slider.querySelectorAll('[data-hero-dot]'));
    const nextButton = slider.querySelector('[data-hero-next]');
    const prevButton = slider.querySelector('[data-hero-prev]');

    let activeIndex = 0;
    let autoplayId = null;

    const setActiveSlide = (index) => {
        activeIndex = (index + slides.length) % slides.length;

        slides.forEach((slide, slideIndex) => {
            slide.classList.toggle('is-active', slideIndex === activeIndex);
        });

        dots.forEach((dot, dotIndex) => {
            dot.classList.toggle('is-active', dotIndex === activeIndex);
        });
    };

    const restartAutoplay = () => {
        if (autoplayId) {
            window.clearInterval(autoplayId);
        }

        autoplayId = window.setInterval(() => {
            setActiveSlide(activeIndex + 1);
        }, 5000);
    };

    nextButton?.addEventListener('click', () => {
        setActiveSlide(activeIndex + 1);
        restartAutoplay();
    });

    prevButton?.addEventListener('click', () => {
        setActiveSlide(activeIndex - 1);
        restartAutoplay();
    });

    dots.forEach((dot) => {
        dot.addEventListener('click', () => {
            const nextIndex = Number(dot.getAttribute('data-hero-index') || 0);
            setActiveSlide(nextIndex);
            restartAutoplay();
        });
    });

    setActiveSlide(0);
    restartAutoplay();
});
