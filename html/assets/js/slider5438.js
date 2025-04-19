(function (jQuery) {
    "use strict";
    callCardSwiper();
  
    jQuery(".swiper-nav").on("click touch", function (e) {
      e.preventDefault();
      let arrow = jQuery(this);
      if (!arrow.hasClass("animate")) {
        arrow.addClass("animate");
        setTimeout(() => {
          arrow.removeClass("animate");
        }, 1600);
      }
    });
  
    // common card slider start
    function callCardSwiper() {
      window.swiperInit = [];
      jQuery(document)
        .find(".swiper.swiper-card")
        .each(function (index) {
          let slider = jQuery(this);
  
          var sliderAutoplay = slider.data("autoplay");
          var swiper;
  
          var breakpoint = {
            // when window width is >= 0px
            0: {
              slidesPerView: slider.data("mobile-sm"),
              spaceBetween: 0,
            },
            576: {
              slidesPerView: slider.data("mobile"),
              spaceBetween: 0,
            },
            // when window width is >= 768px
            768: {
              slidesPerView: slider.data("tab"),
              spaceBetween: 0,
            },
            // when window width is >= 1025px
            1025: {
              slidesPerView: slider.data("laptop"),
              spaceBetween: 0,
            },
            // when window width is >= 1500px
            1500: {
              slidesPerView: slider.data("slide"),
              spaceBetween: 0,
            },
          };
  
          if (slider.data("navigation")) {
            var navigationVal = {
              nextEl: slider.find(".swiper-button-next")[0],
              prevEl: slider.find(".swiper-button-prev")[0],
            };
          } else {
            var navigationVal = false;
          }
  
          if (slider.data("pagination")) {
            var paginationVal = {
              el: slider.find(".swiper-pagination")[0],
              dynamicBullets: true,
              clickable: true,
            };
          } else {
            var paginationVal = false;
          }
  
          var sw_config = {
            loop: slider.data("loop"),
            speed: 1000,
            spaceBetween: 0,
            slidesPerView: slider.data("slide"),
            centeredSlides: slider.data("center"),
            mousewheel: slider.data("mousewheel"),
            autoplay: sliderAutoplay,
            effect: slider.data("effect"),
            navigation: navigationVal,
            pagination: paginationVal,
            breakpoints: breakpoint,
            on: {
              init: function () {
                swiper = this; // Assign the swiper object when it initializes
                addCustomClassToVisibleSlides(swiper, slider); // Add custom class to visible slides initially
              },
              transitionEnd: function () {
                swiper = this; // Assign the swiper object when the transition ends
                addCustomClassToVisibleSlides(swiper, slider); // Add custom class to visible slides on transition end
              },
            },
          };
  
          function addCustomClassToVisibleSlides(swiper, slider) {
            if (swiper) {
              // Remove the custom classes from all slides
              slider.find(".swiper-slide").removeClass("swiper-active last");
  
              // Get the position and dimensions of the slider container
              var sliderRect = slider[0].getBoundingClientRect();
  
              var lastVisibleSlide = null;
  
              // Loop through slides and add class to visible ones
              swiper.slides.forEach(function (slide) {
                var slideRect = slide.getBoundingClientRect();
  
                // Check if at least 50% of the slide is visible
                if (
                  slideRect.left >= sliderRect.left &&
                  slideRect.right <= sliderRect.right
                ) {
                  // The slide is fully visible
                  jQuery(slide).addClass("swiper-active");
                  lastVisibleSlide = slide;
                }
              });
  
              // Add the 'last' class to the last visible slide with 'swiper-active' class
              if (lastVisibleSlide) {
                jQuery(lastVisibleSlide).addClass("last");
              }
            }
          }
          const uuid = _.uniqueId("swiper");
          window.swiperInit = [
            ...window.swiperInit,
            { init: {}, config: {}, elem: null, id: null },
          ];
          window.swiperInit[index].id = uuid;
          window.swiperInit[index].init = new Swiper(slider[0], sw_config); // Initialize swiper here
          window.swiperInit[index].config = sw_config;
          window.swiperInit[index].elem = slider[0];
          document.addEventListener("theme_scheme_direction", (e) => {
            window.swiperInit[index].init.destroy(true, true);
            setTimeout(() => {
              window.swiperInit[index].init = new Swiper(
                window.swiperInit[index].elem,
                window.swiperInit[index].config
              );
            }, 500);
          });
        });
    }
    // common card slider end
  
  
  })(jQuery);
  

//new
var swiper = new Swiper(".mySwiper", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 5,
    spaceBetween: 40,
    coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 142,
        modifier: 1,
        slideShadows: true,
    },
    loop: true,
    breakpoints: {
        0: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
       
        375: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
     
        768: {
            slidesPerView: 3,
            spaceBetween: 30,
        },
     
        1024: {
            slidesPerView: 5,
            spaceBetween: 30,
            // depth: 100,
        },
        1500: {
            slidesPerView: 5,
            spaceBetween: 30,
          },
    },
    on: {
        click: function() {
            if (event.clientX < swiper.width / 2) {
                swiper.slidePrev();
            } else {
                swiper.slideNext();
            }
        }
    },
});
