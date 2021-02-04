 $(window).scroll(function() {
        if ($("#menu").offset().top >56) {
            $("#menu").addClass("bg-white");
        } else {
            $("#menu").removeClass("bg-white");
            
        }
      });