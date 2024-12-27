document.addEventListener("DOMContentLoaded", () => {
    const sliderTrack = document.querySelector(".testimonial-track");
    const testimonials = document.querySelectorAll(".testimonial-card");
    const prevButton = document.querySelector(".prev");
    const nextButton = document.querySelector(".next");
  
    // Dimensions of a single testimonial card
    const cardWidth = testimonials[0].offsetWidth;
    const gap = parseInt(getComputedStyle(sliderTrack).gap) || 0; // Gap between cards
    const totalWidth = cardWidth + gap;
  
    let currentIndex = 0;
  document.addEventListener("DOMContentLoaded", () => {
  const sliderTrack = document.querySelector(".testimonial-track");
  const testimonials = document.querySelectorAll(".testimonial-card");
  const prevButton = document.querySelector(".prev");
  const nextButton = document.querySelector(".next");

  // Dimensions of a single testimonial card
  const cardWidth = testimonials[0].offsetWidth;
  const gap = parseInt(getComputedStyle(sliderTrack).gap) || 0; // Gap between cards
  const totalWidth = cardWidth + gap;

  let currentIndex = 0;

  // Update slider position
  const updateSliderPosition = () => {
    sliderTrack.style.transform = `translateX(-${currentIndex * totalWidth}px)`;
  };

  // Event listeners for navigation buttons
  prevButton.addEventListener("click", () => {
    if (currentIndex > 0) {
      currentIndex--;
      updateSliderPosition();
    }
  });

  nextButton.addEventListener("click", () => {
    if (currentIndex < testimonials.length - 1) {
      currentIndex++;
      updateSliderPosition();
    }
  });

  // Optional: Auto-slide every 5 seconds
  let autoSlideInterval = setInterval(() => {
    if (currentIndex < testimonials.length - 1) {
      currentIndex++;
    } else {
      currentIndex = 0; // Reset to the first card
    }
    updateSliderPosition();
  }, 5000);

  // Pause auto-slide on hover
  sliderTrack.addEventListener("mouseover", () => clearInterval(autoSlideInterval));
  sliderTrack.addEventListener("mouseout", () => {
    autoSlideInterval = setInterval(() => {
      if (currentIndex < testimonials.length - 1) {
        currentIndex++;
      } else {
        currentIndex = 0;
      }
      updateSliderPosition();
    }, 5000);
  });
});

    // Update slider position
    const updateSliderPosition = () => {
      sliderTrack.style.transform = `translateX(-${currentIndex * totalWidth}px)`;
    };
  
    // Event listeners for navigation buttons
    prevButton.addEventListener("click", () => {
      if (currentIndex > 0) {
        currentIndex--;
        updateSliderPosition();
      }
    });
  
    nextButton.addEventListener("click", () => {
      if (currentIndex < testimonials.length - 1) {
        currentIndex++;
        updateSliderPosition();
      }
    });
  
    // Optional: Auto-slide every 5 seconds
    let autoSlideInterval = setInterval(() => {
      if (currentIndex < testimonials.length - 1) {
        currentIndex++;
      } else {
        currentIndex = 0; // Reset to the first card
      }
      updateSliderPosition();
    }, 5000);
  
    // Pause auto-slide on hover
    sliderTrack.addEventListener("mouseover", () => clearInterval(autoSlideInterval));
    sliderTrack.addEventListener("mouseout", () => {
      autoSlideInterval = setInterval(() => {
        if (currentIndex < testimonials.length - 1) {
          currentIndex++;
        } else {
          currentIndex = 0;
        }
        updateSliderPosition();
      }, 5000);
    });
  });
  