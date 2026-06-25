document.addEventListener('DOMContentLoaded', function () {
  var nav = document.getElementById('vanguard-nav');
  var mobileNav = document.getElementById('nav-mobile');
  var hamburger = document.getElementById('nav-hamburger');

  var syncScrolledState = function () {
    if (!nav) {
      return;
    }

    nav.classList.toggle('vanguard-nav--scrolled', window.scrollY > 10);
  };

  syncScrolledState();
  window.addEventListener('scroll', syncScrolledState, { passive: true });

  if (!mobileNav || !hamburger) {
    return;
  }

  hamburger.setAttribute(
    'aria-expanded',
    mobileNav.classList.contains('hidden') ? 'false' : 'true'
  );

  hamburger.addEventListener('click', function () {
    var isExpanded = hamburger.getAttribute('aria-expanded') === 'true';

    hamburger.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
    mobileNav.classList.toggle('hidden', isExpanded);
    mobileNav.classList.toggle('flex', !isExpanded);
  });
});
