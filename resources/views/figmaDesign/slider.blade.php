<link rel="stylesheet" href="{{ asset('css/figmaDesign-slider.css') }}">

<div class="reviews-carousel-container">
  {{-- <button class="arrow arrow-left">&#10094;</button> --}}
            <button class="arrow arrow-left">
            <img src="images/images/left_arrow.svg" alt="Previous" width="16" height="16">
          </button>
    <div class="carousel-track" id="carousel-track">
      <!-- Testimonial Cards -->
      <div class="card">
        <div class="card-inner">
            <img src="images/images/coms.svg" alt="Quote" class="review-quote">
            <p class="review-text">
              {{ __('app.home.rs_first_review') }}
            </p>
            <div class="review-author">
              <div class="author-info">
                <img src="images/images/img_ellipse_232.png" alt="Emma Loy" class="author-avatar">
                <div class="author-details">
                  <p class="author-name">{{ __('app.home.rs_first_auther_name') }}</p>
                  {{-- <p class="author-title">ceo of silo</p> --}}
                </div>
              </div>
              <div class="review-stars">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
              </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-inner">
            <img src="images/images/coms.svg" alt="Quote" class="review-quote">
            <p class="review-text">
            {{ __('app.home.rs_second_review') }}  
            </p>
            <div class="review-author">
              <div class="author-info">
                <img src="images/images/img_ellipse_232.png" alt="Emma Loy" class="author-avatar">
                <div class="author-details">
                  <p class="author-name">{{ __('app.home.rs_second_auther_name') }}</p>
                  {{-- <p class="author-title">ceo of silo</p> --}}
                </div>
              </div>
              <div class="review-stars">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
              </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-inner">
            <img src="images/images/coms.svg" alt="Quote" class="review-quote">
            <p class="review-text">
            {{ __('app.home.rs_third_review') }}  
            </p>
            <div class="review-author">
              <div class="author-info">
                <img src="images/images/img_ellipse_232.png" alt="Emma Loy" class="author-avatar">
                <div class="author-details">
                  <p class="author-name">{{ __('app.home.rs_third_auther_name') }}</p>
                  {{-- <p class="author-title">ceo of silo</p> --}}
                </div>
              </div>
              <div class="review-stars">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
              </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-inner">
            <img src="images/images/coms.svg" alt="Quote" class="review-quote">
            <p class="review-text">
            {{ __('app.home.rs_forth_review') }}  
            </p>
            <div class="review-author">
              <div class="author-info">
                <img src="images/images/img_ellipse_232.png" alt="Emma Loy" class="author-avatar">
                <div class="author-details">
                  <p class="author-name">{{ __('app.home.rs_forth_auther_name') }}</p>
                  {{-- <p class="author-title">ceo of silo</p> --}}
                </div>
              </div>
              <div class="review-stars">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
              </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-inner">
            <img src="images/images/coms.svg" alt="Quote" class="review-quote">
            <p class="review-text">
            {{ __('app.home.rs_second_review') }}  
            </p>
            <div class="review-author">
              <div class="author-info">
                <img src="images/images/img_ellipse_232.png" alt="Emma Loy" class="author-avatar">
                <div class="author-details">
                  <p class="author-name">{{ __('app.home.rs_second_auther_name') }}</p>
                  {{-- <p class="author-title">ceo of silo</p> --}}
                </div>
              </div>
              <div class="review-stars">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
                <img src="images/images/pink_start.svg" alt="Star" class="star">
              </div>
          </div>
        </div>
      </div>
    </div>
  {{-- <button class="arrow arrow-right">&#10095;</button> --}}
            <button class="arrow arrow-right">
            <img src="images/images/right_arrow.svg" alt="Next" width="16" height="16">
          </button>
    <div class="dots"></div>
  </div>

  <script>
(function() {
  const container = document.querySelector(".reviews-carousel-container");
  const track = container.querySelector("#carousel-track");
  let cards = Array.from(container.querySelectorAll(".card"));
  const prevBtn = container.querySelector(".arrow-left");
  const nextBtn = container.querySelector(".arrow-right");
  const dotsContainer = container.querySelector(".dots");

  let index = 1; // Start at first real card after cloning
    let autoPlayInterval;

  // 🔁 Clone first and last cards for smooth infinite loop
  const firstClone = cards[0].cloneNode(true);
  const lastClone = cards[cards.length - 1].cloneNode(true);
  firstClone.classList.add("clone");
  lastClone.classList.add("clone");

  track.appendChild(firstClone);
  track.prepend(lastClone);

  // Update cards list after cloning
  cards = Array.from(track.children);

  // 🟢 Generate dots dynamically (for real cards only)
    const dots = [];
  for (let i = 0; i < cards.length - 2; i++) {
      const dot = document.createElement("div");
      dot.classList.add("dot");
      if (i === 0) dot.classList.add("active");
      dotsContainer.appendChild(dot);
      dots.push(dot);

      dot.addEventListener("click", () => {
      index = i + 1; // Adjust for cloned card
        updateCarousel();
        resetAutoPlay();
      });
  }

  function updateCarousel(transition = true) {
    const activeCard = cards[index];
    if (!activeCard) return;

    const containerCenter = container.offsetWidth / 2;
    const cardCenter = activeCard.offsetLeft + activeCard.offsetWidth / 2;
    const translateX = cardCenter - containerCenter;

    track.style.transition = transition ? "transform 0.7s ease" : "none";
    track.style.transform = `translateX(-${translateX}px)`;

    cards.forEach((card, i) => {
      card.classList.toggle("active", i === index && !card.classList.contains("clone"));
    });

    let dotIndex = index - 1;
    if (index === 0) {
      dotIndex = dots.length - 1;
    } else if (index === cards.length - 1) {
      dotIndex = 0;
    }

    dots.forEach((dot, i) => {
      dot.classList.toggle("active", i === dotIndex);
    });
    }

    function nextSlide() {
      index++;
      updateCarousel();
    }

    function prevSlide() {
      index--;
      updateCarousel();
    }

  // 🔁 Loop seamlessly on transition end
  track.addEventListener("transitionend", () => {
    if (cards[index].classList.contains("clone") && index === cards.length - 1) {
      track.style.transition = "none";
      index = 1;
      updateCarousel(false);
    }
    if (cards[index].classList.contains("clone") && index === 0) {
      track.style.transition = "none";
      index = cards.length - 2;
      updateCarousel(false);
    }
  });

  // Button actions
    nextBtn.addEventListener("click", () => {
      nextSlide();
      resetAutoPlay();
    });

    prevBtn.addEventListener("click", () => {
      prevSlide();
      resetAutoPlay();
    });

    // function autoPlay() {
    //   autoPlayInterval = setInterval(() => {
    //     nextSlide();
    //   }, 7000);
    // }
    function stopAutoPlay() {
      clearInterval(autoPlayInterval);
    }
    function resetAutoPlay() {
      stopAutoPlay();
      autoPlay();
    }

    window.addEventListener("resize", () => {
      updateCarousel(false);
    });

  // 🟢 Initialize
  updateCarousel(false);
    autoPlay();
})();

  </script>
