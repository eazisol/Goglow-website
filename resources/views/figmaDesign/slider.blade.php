  <style>
  .reviews-carousel-container * {
      box-sizing: border-box;
    }

  .reviews-carousel-container {
      position: relative;
    width: 100%;
    max-width: 1500px;
    margin: 0 auto;
      overflow: hidden;
    height: 600px;
  }

  .reviews-carousel-container .carousel-track {
    display: flex !important;
    transition: transform 0.7s ease !important;
    align-items: center !important;
    height: 83%;
  }

  .reviews-carousel-container .card {
    flex: 0 0 auto !important;
    width: 500px !important;
    /* padding: 20px !important; */
    opacity: 0.5 !important;
    transform: scale(0.9) !important;
    transition: transform 0.5s ease, opacity 0.5s ease, filter 0.5s ease !important;
    display: flex !important;
    justify-content: center !important;
    transform-origin: center !important;
    filter: blur(3px) !important;
    margin: 0 30px !important;
  }

  .reviews-carousel-container .card-inner {
    background: #fff !important;
    border-radius: 20px !important;
    padding: 112px 30px 80px 30px !important;
    max-width: 500px !important;
    width: 100% !important;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    text-align: center !important;
    position: relative !important;
  }

  .reviews-carousel-container .card.active {
    transform: scale(1.1) !important;
    opacity: 1 !important;
    z-index: 2 !important;
    transform-origin: center !important;
    filter: blur(0px) !important;
  }

  /* .reviews-carousel-container .card-inner p {
    font-style: italic !important;
    color: #76213E !important;
    line-height: 1.6 !important;
    margin-bottom: 20px !important;
  } */

  .reviews-carousel-container .user-info {
    display: flex !important;
    align-items: center !important;
    flex-direction: column !important;
    gap: 5px !important;
  }

  .reviews-carousel-container .user-info img {
    width: 50px !important;
    height: 50px !important;
    border-radius: 50% !important;
    object-fit: cover !important;
  }

  .reviews-carousel-container .user-info h4 {
    margin: 5px 0 0 !important;
    font-size: 1rem !important;
    color: #f54ea2 !important;
  }

  .reviews-carousel-container .user-info span {
    font-size: 0.85rem !important;
    color: #777 !important;
  }

  .reviews-carousel-container .stars {
    color: #ff7676 !important;
    font-size: 1.1rem !important;
    margin-top: 10px !important;
  }

  .reviews-carousel-container .arrow {
    position: absolute !important;
    top: 95% !important;
    transform: translateY(-50%) !important;
    font-size: 2rem !important;
    background: rgba(255, 255, 255, 1) !important;
    border: none !important;
    cursor: pointer !important;
    z-index: 5 !important;
    padding: 10px !important;
    border-radius: 100% !important;
    transition: 0.3s !important;
  }

  .reviews-carousel-container .arrow:hover {
    background: white !important;
    transform: translateY(-50%) scale(1.1) !important;
  }

  .reviews-carousel-container .arrow-left {
    left: 575px !important;
  }

  .reviews-carousel-container .arrow-right {
    right: 575px !important;
  }

  .reviews-carousel-container .dots {
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    margin-top: 20px !important;
    gap: 10px !important;
    position: absolute !important;
    bottom: 20px !important;
    left: 50% !important;
    transform: translateX(-50%) !important;
    z-index: 10 !important;
  }

  .reviews-carousel-container .dot {
    width: 10px !important;
    height: 10px !important;
    background-color: rgba(255, 255, 255, 0.8) !important;
    border-radius: 50% !important;
    transition: all 0.3s ease !important;
    cursor: pointer !important;
    border: 2px solid rgba(255, 255, 255, 0.3) !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    box-sizing: border-box !important;
  }

  .reviews-carousel-container .dot.active {
    width: 16px !important;
    height: 16px !important;
    background-color: #e4005e !important;
    border: 2px solid #fff !important;
    box-shadow: 0 0 10px rgba(228, 0, 94, 0.5) !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    box-sizing: border-box !important;
    }

    @media (max-width: 480px) {
    .reviews-carousel-container .card {
      flex: 0 0 100% !important;
      padding: 10px !important;
    }

    .reviews-carousel-container .card-inner {
      max-width: 90% !important;
      padding: 84px 17px 48px 17px !important;
      margin-top: 90px;
    }

    .reviews-carousel-container .arrow {
      font-size: 1.5rem !important;
      padding: 15px !important;
      top: 90% !important;
    }

    .reviews-carousel-container .arrow-left {
      left: 20px !important;
    }

    .reviews-carousel-container .arrow-right {
      right: 20px !important;
    }
    .reviews-carousel-container .dots{
      bottom: 40px !important;
    }
    .reviews-carousel-container{
      height: 530px;
      }
    }
  </style>

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
