 $('.section-card_images_col4-box_cards').slick({
    responsive: [
     {
	    breakpoint: 5000,
	    settings: "unslick"
	  },
    {
      breakpoint: 480,
      settings: {
        dots: true,
        speed: 300,
        infinite: false,
        slidesToShow: 1,
        centerMode: true,
        variableWidth: true,
        adaptiveHeight: true
      }
    }]
 }); 
 
$('.section-noticitas-cards').slick({
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1,
    variableWidth: true,
    mobileFirst: true,
      responsive: [
    {
        breakpoint: 768,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            centerMode: false,
        }
    },
    {      
        breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false,
            }
        }
    ]
 }); 
 
$('.section-sostenibilidad-cards').slick({
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    prevArrow: $(".section-sostenibilidad-cards-button.prev"),
    nextArrow: $(".section-sostenibilidad-cards-button.next"),
 });
 
 $('.section-talento-card-content').slick({
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 2.5,
    slidesToScroll: 2,
    prevArrow: $(".section-sostenibilidad-button.prev"),
    nextArrow: $(".section-sostenibilidad-button.next"),
 });
 