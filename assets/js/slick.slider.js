
jQuery(document).ready(function(){
jQuery('.your-class').slick({
slidesToShow: 5,
slidesToScroll: 1,
arrows: true,
dots: false,
speed: 300,
infinite: true,
autoplaySpeed: 5000,
autoplay: false,
prevArrow: '<button>prev</button>',
nextArrow: '<button>Next</button>',
responsive: [
{
breakpoint: 991,
settings: {
  slidesToShow: 3,
}
},
{
breakpoint: 767,
settings: {
  slidesToShow: 1,
}
}
]
});
});
