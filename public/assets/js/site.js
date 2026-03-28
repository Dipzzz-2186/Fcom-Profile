document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const siteIntro = document.querySelector('.site-intro');
    const header = document.querySelector('.site-header');
    const heroCopy = document.querySelector('.hero-copy');
    const revealItems = document.querySelectorAll('.reveal');
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    let introStarted = false;

    const finishIntro = () => {
        if (introStarted) {
            return;
        }

        introStarted = true;
        body?.classList.add('is-ready');

        window.setTimeout(() => {
            body?.classList.remove('is-loading');
            body?.classList.add('intro-complete');
        }, 520);
    };

    if (prefersReducedMotion) {
        finishIntro();
    } else if (document.readyState === 'complete') {
        finishIntro();
    } else {
        window.addEventListener('load', finishIntro, { once: true });
        window.setTimeout(finishIntro, 1800);
    }

    siteIntro?.addEventListener('transitionend', (event) => {
        if (event.propertyName === 'opacity') {
            siteIntro.remove();
        }
    });

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

    const needsScrollEffects = Boolean(heroCopy) || !header?.classList.contains('site-header-static');

    if (needsScrollEffects) {
        let ticking = false;

        const applyScrollEffects = () => {
            if (body?.classList.contains('is-loading')) {
                ticking = false;
                return;
            }

            const scrollY = window.scrollY || window.pageYOffset;
            const heroOffset = Math.min(scrollY, 360);

            header?.classList.toggle('is-scrolled', scrollY > 24);

            if (heroCopy) {
                heroCopy.style.transform = `translate3d(0, ${heroOffset * 0.12}px, 0)`;
            }

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
    }

    const slider = document.querySelector('[data-hero-slider]');
    const menuToggle = document.querySelector('[data-menu-toggle]');
    const menuClose = document.querySelector('[data-menu-close]');
    const siteSidebar = document.querySelector('[data-site-sidebar]');
    const sidebarSolutionsToggle = document.querySelector('[data-sidebar-solutions-toggle]');
    const sidebarSolutions = document.querySelector('[data-sidebar-solutions]');
    const desktopSolutionsDropdown = document.querySelector('[data-solutions-dropdown]');
    const desktopSolutionsToggle = document.querySelector('[data-solutions-toggle]');
    const problemButtons = Array.from(document.querySelectorAll('[data-problem-stage]'));
    const problemPanel = document.querySelector('[data-problem-panel]');
    const problemTitle = document.querySelector('[data-problem-title]');
    const problemBody = document.querySelector('[data-problem-body]');

    if (menuToggle && siteSidebar) {
        const setSidebarState = (isOpen) => {
            siteSidebar.classList.toggle('is-open', isOpen);
            siteSidebar.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
            menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            body?.classList.toggle('has-sidebar-open', isOpen);
        };

        menuToggle.addEventListener('click', () => {
            setSidebarState(!siteSidebar.classList.contains('is-open'));
        });

        menuClose?.addEventListener('click', () => {
            setSidebarState(false);
        });

        siteSidebar.addEventListener('click', (event) => {
            if (event.target === siteSidebar) {
                setSidebarState(false);
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                setSidebarState(false);
            }
        });

        siteSidebar.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => setSidebarState(false));
        });
    }

    if (sidebarSolutionsToggle && sidebarSolutions) {
        sidebarSolutionsToggle.addEventListener('click', () => {
            const isOpen = sidebarSolutions.classList.toggle('is-open');
            sidebarSolutionsToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    }

    if (desktopSolutionsDropdown && desktopSolutionsToggle) {
        const setDesktopSolutionsState = (isOpen) => {
            desktopSolutionsDropdown.classList.toggle('is-open', isOpen);
            desktopSolutionsToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        };

        desktopSolutionsToggle.addEventListener('click', () => {
            setDesktopSolutionsState(!desktopSolutionsDropdown.classList.contains('is-open'));
        });

        document.addEventListener('click', (event) => {
            if (!desktopSolutionsDropdown.contains(event.target)) {
                setDesktopSolutionsState(false);
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                setDesktopSolutionsState(false);
            }
        });
    }

    if (problemButtons.length && problemPanel && problemTitle && problemBody) {
        let activeProblemKey = problemButtons.find((button) => button.classList.contains('is-active'))?.getAttribute('data-stage-key') || null;

        const setProblemStage = (button) => {
            const nextProblemKey = button.getAttribute('data-stage-key');
            if (nextProblemKey && nextProblemKey === activeProblemKey) {
                return;
            }

            problemButtons.forEach((item) => {
                item.classList.toggle('is-active', item === button);
            });

            problemPanel.classList.remove('is-switching');
            window.requestAnimationFrame(() => {
                problemTitle.textContent = button.getAttribute('data-stage-title') || '';
                problemBody.textContent = button.getAttribute('data-stage-body') || '';
                problemPanel.classList.add('is-switching');
                activeProblemKey = nextProblemKey;
            });
        };

        problemButtons.forEach((button) => {
            button.addEventListener('mouseenter', () => setProblemStage(button));
            button.addEventListener('focus', () => setProblemStage(button));
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
