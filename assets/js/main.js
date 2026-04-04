document.addEventListener('DOMContentLoaded', function () {
  const navbar = document.querySelector('.glass-navbar');
  if (!navbar) return;

  const scrollThreshold = 10;

  function handleScroll() {
    if (window.scrollY > scrollThreshold) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  }

  window.addEventListener('scroll', handleScroll, { passive: true });
  handleScroll();
});
