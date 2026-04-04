(function ($) {
  "use strict";

  $(document).ready(function () {
    var $navbar = $(".glass-navbar");

    if ($navbar.length === 0) {
      alert("ERROR: Navbar tidak ditemukan!");
      return;
    }

    function updateNavbarScroll() {
      var scrollTop = $(window).scrollTop();

      if (scrollTop > 20) {
        $navbar.addClass("scrolled");
        console.log("Scrolled class ditambahkan. Scroll:", scrollTop);
      } else {
        $navbar.removeClass("scrolled");
        console.log("Scrolled class dihapus. Scroll:", scrollTop);
      }
    }

    $(window).on("scroll", updateNavbarScroll);
    updateNavbarScroll(); // Jalankan sekali saat load
  });
})(jQuery);
