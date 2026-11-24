/**
 * APR GROUP OF COMPANY - Main Application Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
  // Update footer year dynamically
  const yearElements = document.querySelectorAll('.current-year');
  const currentYear = new Date().getFullYear();
  yearElements.forEach(el => {
    el.textContent = currentYear;
  });

  // Mobile menu toggle
  const hamburger = document.querySelector('.hamburger');
  const mobileNav = document.querySelector('.mobile-nav');

  if (hamburger && mobileNav) {
    hamburger.addEventListener('click', () => {
      hamburger.classList.toggle('is-active');
      mobileNav.classList.toggle('open');
      const isExpanded = hamburger.classList.contains('is-active');
      hamburger.setAttribute('aria-expanded', isExpanded);
      document.body.style.overflow = isExpanded ? 'hidden' : '';
    });
  }

  // Mobile Submenu toggle
  const mobileSubmenuToggles = document.querySelectorAll('.mobile-submenu-toggle');
  mobileSubmenuToggles.forEach(toggle => {
    toggle.addEventListener('click', (e) => {
      e.preventDefault();
      const submenu = toggle.nextElementSibling;
      if (submenu && submenu.classList.contains('mobile-submenu')) {
        submenu.classList.toggle('open');
        toggle.classList.toggle('open');
      }
    });
  });

  // Close mobile nav when clicking a link inside it
  const mobileLinks = document.querySelectorAll('.mobile-nav a:not(.mobile-submenu-toggle)');
  mobileLinks.forEach(link => {
    link.addEventListener('click', () => {
      if (hamburger && mobileNav) {
        hamburger.classList.remove('is-active');
        mobileNav.classList.remove('open');
        document.body.style.overflow = '';
      }
    });
  });

  // Sticky header shadow change
  const header = document.querySelector('.header-main');
  if (header) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 30) {
        header.style.boxShadow = '0 6px 20px rgba(23, 59, 101, 0.12)';
      } else {
        header.style.boxShadow = '0 4px 18px rgba(23, 59, 101, 0.08)';
      }
    });
  }

  // Hero Project Image Carousel
  initHeroCarousel();

  // Customer Review Submission System
  initReviewSystem();
});

/**
 * Hero Automatic Project Image Carousel
 * Displays all 6 APR Group projects with auto-slide, arrows, dots, and pause-on-hover
 */
function initHeroCarousel() {
  const carousel = document.getElementById('heroProjectCarousel');
  if (!carousel) return;

  const slides = carousel.querySelectorAll('.hero-carousel-slide');
  const dots = carousel.querySelectorAll('.carousel-dot');
  const prevBtn = carousel.querySelector('.hero-carousel-arrow.prev');
  const nextBtn = carousel.querySelector('.hero-carousel-arrow.next');

  if (!slides.length) return;

  let currentIndex = 0;
  let autoSlideTimer = null;
  const slideInterval = 4200; // 4.2 seconds per slide

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.classList.toggle('active', i === index);
    });
    dots.forEach((dot, i) => {
      dot.classList.toggle('active', i === index);
      dot.setAttribute('aria-selected', i === index ? 'true' : 'false');
    });
    currentIndex = index;
  }

  function nextSlide() {
    const nextIndex = (currentIndex + 1) % slides.length;
    showSlide(nextIndex);
  }

  function prevSlide() {
    const prevIndex = (currentIndex - 1 + slides.length) % slides.length;
    showSlide(prevIndex);
  }

  function startAutoSlide() {
    stopAutoSlide();
    autoSlideTimer = setInterval(nextSlide, slideInterval);
  }

  function stopAutoSlide() {
    if (autoSlideTimer) {
      clearInterval(autoSlideTimer);
      autoSlideTimer = null;
    }
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      nextSlide();
      startAutoSlide();
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      prevSlide();
      startAutoSlide();
    });
  }

  dots.forEach(dot => {
    dot.addEventListener('click', () => {
      const targetIndex = parseInt(dot.getAttribute('data-slide'), 10);
      if (!isNaN(targetIndex)) {
        showSlide(targetIndex);
        startAutoSlide();
      }
    });
  });

  // Pause on hover
  carousel.addEventListener('mouseenter', stopAutoSlide);
  carousel.addEventListener('mouseleave', startAutoSlide);

  // Keyboard navigation
  carousel.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowRight') {
      nextSlide();
      startAutoSlide();
    } else if (e.key === 'ArrowLeft') {
      prevSlide();
      startAutoSlide();
    }
  });

  // Touch Swipe for Mobile
  let touchStartX = 0;
  let touchEndX = 0;

  carousel.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
    stopAutoSlide();
  }, { passive: true });

  carousel.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].screenX;
    const diff = touchStartX - touchEndX;
    if (Math.abs(diff) > 40) {
      if (diff > 0) {
        nextSlide();
      } else {
        prevSlide();
      }
    }
    startAutoSlide();
  }, { passive: true });

  // Start auto-slide on init
  startAutoSlide();
}

/**
 * Customer Review Submission System
 * Handles interactive 1-5 star ratings and saves reviews pending admin approval
 */
function initReviewSystem() {
  const form = document.getElementById('aprReviewForm');
  if (!form) return;

  const starBtns = form.querySelectorAll('.star-btn');
  const ratingInput = document.getElementById('reviewRatingInput');
  const ratingText = document.getElementById('ratingTextLabel');
  const alertSuccess = document.getElementById('reviewSuccessAlert');

  const ratingDescriptions = {
    '1': '1 Star - Unsatisfactory',
    '2': '2 Stars - Needs Improvement',
    '3': '3 Stars - Satisfactory',
    '4': '4 Stars - Very Good Experience',
    '5': '5 Stars - Outstanding Experience'
  };

  function updateStars(val) {
    starBtns.forEach(btn => {
      const btnRating = parseInt(btn.getAttribute('data-rating'), 10);
      btn.classList.toggle('selected', btnRating <= val);
    });
    if (ratingText && ratingDescriptions[val]) {
      ratingText.textContent = ratingDescriptions[val];
    }
  }

  starBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const val = parseInt(btn.getAttribute('data-rating'), 10);
      if (ratingInput) ratingInput.value = val;
      updateStars(val);
    });

    btn.addEventListener('mouseenter', () => {
      const hoverVal = parseInt(btn.getAttribute('data-rating'), 10);
      starBtns.forEach(b => {
        const r = parseInt(b.getAttribute('data-rating'), 10);
        b.classList.toggle('hovered', r <= hoverVal);
      });
    });

    btn.addEventListener('mouseleave', () => {
      starBtns.forEach(b => b.classList.remove('hovered'));
    });
  });

  // Default to 5 stars
  updateStars(5);

  // Form submission
  form.addEventListener('submit', (e) => {
    e.preventDefault();

    const nameInput = document.getElementById('revCustomerName');
    const mobileInput = document.getElementById('revMobileNumber');
    const projectInput = document.getElementById('revProjectSelect');
    const reviewTextInput = document.getElementById('revReviewText');

    const name = nameInput ? nameInput.value.trim() : '';
    const mobile = mobileInput ? mobileInput.value.trim() : '';
    const project = projectInput ? projectInput.value : '';
    const reviewText = reviewTextInput ? reviewTextInput.value.trim() : '';
    const rating = ratingInput ? parseInt(ratingInput.value, 10) || 5 : 5;

    if (!name || name.length < 2) {
      alert('Please enter your full name.');
      if (nameInput) nameInput.focus();
      return;
    }

    if (!reviewText || reviewText.length < 10) {
      alert('Please write at least a few words describing your experience (minimum 10 characters).');
      if (reviewTextInput) reviewTextInput.focus();
      return;
    }

    // Prepare pending review object
    const newReview = {
      id: 'rev_' + Date.now(),
      name: name,
      mobile: mobile || 'Not Provided',
      project: project || 'General Consultation',
      rating: rating,
      reviewText: reviewText,
      status: 'pending_admin_approval',
      submittedAt: new Date().toLocaleString('en-IN', { timeZone: 'Asia/Kolkata' })
    };

    // Save to LocalStorage under 'apr_pending_reviews'
    try {
      const pendingList = JSON.parse(localStorage.getItem('apr_pending_reviews') || '[]');
      pendingList.unshift(newReview);
      localStorage.setItem('apr_pending_reviews', JSON.stringify(pendingList));
    } catch (storageErr) {
      console.warn('LocalStorage error:', storageErr);
    }

    // Display confirmation message
    if (alertSuccess) {
      alertSuccess.innerHTML = `
        <h4>✓ Review Submitted Successfully</h4>
        <p>Thank you, <strong>${escapeHtml(name)}</strong>! Your <strong>${rating}-Star</strong> review has been received. In accordance with APR GROUP's authenticity policy, all customer reviews are kept pending administrative verification before appearing publicly on the website.</p>
      `;
      alertSuccess.style.display = 'block';
      alertSuccess.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    // Reset form fields
    form.reset();
    updateStars(5);
    if (ratingInput) ratingInput.value = 5;
  });
}

function escapeHtml(str) {
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}
