<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Focus Carousel</title>
<style>
  * {
    box-sizing: border-box;
  }

  body {
    font-family: "Jura", sans-serif;
    background: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    padding: 30px;
  }

  h1 {
    font-size: 1.2rem;
    margin-bottom: 20px;
  }

  /* Carousel Container */
  .carousel {
    display: flex;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    scroll-behavior: smooth;
    gap: 20px;
    padding: 20px;
    width: 90%;
    max-width: 750px;
    scrollbar-width: none;
  }

  .carousel::-webkit-scrollbar {
    display: none;
  }

  /* Each Slide */
  .carousel > div {
    flex: 0 0 250px;
    text-align: center;
    scroll-snap-align: center;
    transition: all 0.4s ease;
    opacity: 0.5;
    transform: scale(0.8);
    filter: blur(1px) grayscale(100%);
  }

  .carousel .img {
    width: 100%;
    aspect-ratio: 3 / 4;
    overflow: hidden;
    border-radius: 20px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
  }

  .carousel .img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .carousel h2 {
    font-size: 1rem;
    margin: 10px 0 3px;
    font-weight: 500;
    transition: 0.3s;
  }

  .carousel p {
    font-size: 0.85rem;
    color: #666;
    margin: 0;
    transition: 0.3s;
  }

  /* Active (centered) Slide */
  .carousel > div.active {
    transform: scale(1.1);
    opacity: 1;
    filter: none;
  }

  .carousel > div.active h2 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #000;
  }

  .carousel > div.active p {
    color: #222;
  }

  /* Navigation Buttons */
  .nav-buttons {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    margin-top: 15px;
  }

  .nav-buttons button {
    background-color: #0f172b;
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    cursor: pointer;
    font-size: 20px;
    transition: 0.3s ease;
  }

  .nav-buttons button:hover {
    background-color: #e50050;
  }
</style>
</head>
<body>

<h1>Team Members Carousel</h1>

<div class="carousel" id="carousel">
  <div>
    <div class="img"><img src="https://i.pravatar.cc/400?img=53" alt="Raymond McKenzie"></div>
    <h2>Raymond McKenzie</h2>
    <p>CEO</p>
  </div>
  <div>
    <div class="img"><img src="https://i.pravatar.cc/300?img=5" alt="Elizabeth Turner"></div>
    <h2>Elizabeth Turner</h2>
    <p>Marketing Director</p>
  </div>
  <div>
    <div class="img"><img src="https://i.pravatar.cc/300?img=44" alt="Suzanne Yorke"></div>
    <h2>Suzanne Yorke</h2>
    <p>Creative Director</p>
  </div>
  <div>
    <div class="img"><img src="https://i.pravatar.cc/300?img=12" alt="Simon Hadley"></div>
    <h2>Simon Hadley</h2>
    <p>Social Media</p>
  </div>
  <div>
    <div class="img"><img src="https://i.pravatar.cc/300?img=27" alt="Harriet Johnson"></div>
    <h2>Harriet Johnson</h2>
    <p>Front-End Developer</p>
  </div>
  <div>
    <div class="img"><img src="https://i.pravatar.cc/300?img=15" alt="Jonathon Simmons"></div>
    <h2>Jonathon Simmons</h2>
    <p>Back-End Developer</p>
  </div>
</div>

<div class="nav-buttons">
  <button onclick="scrollCarousel(-1)">❮</button>
  <button onclick="scrollCarousel(1)">❯</button>
</div>

<script>
  const carousel = document.getElementById('carousel');
  const slides = Array.from(carousel.children);

  function scrollCarousel(direction) {
    const itemWidth = slides[0].offsetWidth + 20;
    carousel.scrollBy({ left: direction * itemWidth, behavior: 'smooth' });
  }

  // Highlight the centered (active) slide
  function setActiveSlide() {
    let center = carousel.scrollLeft + carousel.offsetWidth / 2;
    let closest = slides.reduce((prev, curr) => {
      let prevCenter = prev.offsetLeft + prev.offsetWidth / 2;
      let currCenter = curr.offsetLeft + curr.offsetWidth / 2;
      return Math.abs(currCenter - center) < Math.abs(prevCenter - center) ? curr : prev;
    });
    slides.forEach(slide => slide.classList.remove('active'));
    closest.classList.add('active');
  }

  carousel.addEventListener('scroll', () => {
    clearTimeout(carousel._timeout);
    carousel._timeout = setTimeout(setActiveSlide, 100);
  });

  // Set the first active on load
  window.addEventListener('load', setActiveSlide);
</script>

</body>
</html>
