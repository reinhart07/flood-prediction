// ===================================
// FLOODGUARD JAKARTA - MAIN JS
// ===================================

// === MOBILE MENU TOGGLE ===
const navToggle = document.querySelector('.nav-toggle');
const navMenu = document.querySelector('.nav-menu');

if (navToggle) {
    navToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active');
    });
}

// Close menu when clicking outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('.navbar')) {
        navMenu?.classList.remove('active');
    }
});

// === HERO CAROUSEL ===
let currentSlide = 0;
const slides = document.querySelectorAll('.carousel-slide');
const indicators = document.querySelectorAll('.indicator');
const prevBtn = document.querySelector('.carousel-control.prev');
const nextBtn = document.querySelector('.carousel-control.next');

function showSlide(n) {
    if (!slides.length) return;
    
    // Loop slides
    if (n >= slides.length) currentSlide = 0;
    if (n < 0) currentSlide = slides.length - 1;
    
    // Hide all slides
    slides.forEach(slide => slide.classList.remove('active'));
    indicators?.forEach(indicator => indicator.classList.remove('active'));
    
    // Show current slide
    slides[currentSlide].classList.add('active');
    if (indicators[currentSlide]) {
        indicators[currentSlide].classList.add('active');
    }
}

function nextSlide() {
    currentSlide++;
    showSlide(currentSlide);
}

function prevSlide() {
    currentSlide--;
    showSlide(currentSlide);
}

// Auto slide every 2 seconds
let autoSlide = setInterval(nextSlide, 2000);

// Manual controls
prevBtn?.addEventListener('click', () => {
    clearInterval(autoSlide);
    prevSlide();
    autoSlide = setInterval(nextSlide, 2000);
});

nextBtn?.addEventListener('click', () => {
    clearInterval(autoSlide);
    nextSlide();
    autoSlide = setInterval(nextSlide, 2000);
});

// Indicator clicks
indicators?.forEach((indicator, index) => {
    indicator.addEventListener('click', () => {
        clearInterval(autoSlide);
        currentSlide = index;
        showSlide(currentSlide);
        autoSlide = setInterval(nextSlide, 2000);
    });
});

// Pause on hover
const carouselContainer = document.querySelector('.carousel-container');
carouselContainer?.addEventListener('mouseenter', () => {
    clearInterval(autoSlide);
});

carouselContainer?.addEventListener('mouseleave', () => {
    autoSlide = setInterval(nextSlide, 2000);
});

// === ANIMATED COUNTERS ===
const counters = document.querySelectorAll('.stat-number');
const speed = 200;

const animateCounter = (counter) => {
    const target = +counter.getAttribute('data-target');
    const increment = target / speed;
    let count = 0;
    
    const updateCount = () => {
        count += increment;
        if (count < target) {
            counter.textContent = Math.ceil(count);
            setTimeout(updateCount, 10);
        } else {
            counter.textContent = target;
        }
    };
    
    updateCount();
};

// Intersection Observer for counters
const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateCounter(entry.target);
            counterObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.5 });

counters.forEach(counter => {
    counterObserver.observe(counter);
});

// === SMOOTH SCROLL ===
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#' && href !== '#chatbot') {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
    });
});

// === SCROLL TO TOP BUTTON ===
const createScrollTopBtn = () => {
    const btn = document.createElement('button');
    btn.innerHTML = '<i class="fas fa-arrow-up"></i>';
    btn.className = 'scroll-top-btn';
    btn.style.cssText = `
        position: fixed;
        bottom: 100px;
        right: 20px;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #3b82f6 0%, #1e3a8a 100%);
        color: #f1f5f9;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: none;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 999;
        transition: all 0.3s ease;
    `;
    
    document.body.appendChild(btn);
    
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            btn.style.display = 'flex';
        } else {
            btn.style.display = 'none';
        }
    });
    
    btn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    btn.addEventListener('mouseenter', () => {
        btn.style.transform = 'scale(1.1)';
    });
    
    btn.addEventListener('mouseleave', () => {
        btn.style.transform = 'scale(1)';
    });
};

createScrollTopBtn();

// === LOADING ANIMATION ===
window.addEventListener('load', () => {
    document.body.classList.add('loaded');
});

// === NAVBAR SCROLL EFFECT ===
let lastScroll = 0;
const navbar = document.querySelector('.navbar');

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;
    
    if (currentScroll > 100) {
        navbar.style.boxShadow = '0 10px 15px -3px rgba(0, 0, 0, 0.2)';
    } else {
        navbar.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
    }
    
    lastScroll = currentScroll;
});

// === TOOLTIP ===
const tooltips = document.querySelectorAll('.info-tooltip');

tooltips.forEach(tooltip => {
    tooltip.addEventListener('mouseenter', function() {
        const title = this.getAttribute('title');
        if (title) {
            const tooltipBox = document.createElement('div');
            tooltipBox.className = 'tooltip-box';
            tooltipBox.textContent = title;
            tooltipBox.style.cssText = `
                position: absolute;
                background: #0f172a;
                color: #f1f5f9;
                padding: 0.5rem 1rem;
                border-radius: 6px;
                font-size: 0.85rem;
                white-space: nowrap;
                z-index: 1000;
                pointer-events: none;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            `;
            
            this.appendChild(tooltipBox);
            this.removeAttribute('title');
            
            const rect = this.getBoundingClientRect();
            tooltipBox.style.top = '-35px';
            tooltipBox.style.left = '50%';
            tooltipBox.style.transform = 'translateX(-50%)';
        }
    });
    
    tooltip.addEventListener('mouseleave', function() {
        const tooltipBox = this.querySelector('.tooltip-box');
        if (tooltipBox) {
            this.setAttribute('title', tooltipBox.textContent);
            tooltipBox.remove();
        }
    });
});

// === CONSOLE WELCOME MESSAGE ===
console.log('%c🌊 FloodGuard Jakarta', 'color: #3b82f6; font-size: 24px; font-weight: bold;');
console.log('%cSistem Prediksi Banjir Berbasis AI', 'color: #64748b; font-size: 14px;');
console.log('%cDeveloped for PROX x CORIS 2026', 'color: #10b981; font-size: 12px;');