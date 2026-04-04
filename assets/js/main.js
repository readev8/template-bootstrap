(function ($) {
  'use strict';

  $(document).ready(function () {
    var $navbar = $('.glass-navbar');
    if ($navbar.length === 0) {
      return;
    }

    function updateNavbarScroll() {
      if ($(window).scrollTop() > 20) {
        $navbar.addClass('scrolled');
      } else {
        $navbar.removeClass('scrolled');
      }
    }

    $(window).on('scroll', updateNavbarScroll);
    updateNavbarScroll();
  });
})(jQuery);
