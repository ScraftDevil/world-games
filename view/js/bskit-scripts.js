/*	Javascript code for all elements
/*----------------------------------------------------*/
$(document).ready(function() {
	initMap(".map");
});


$(document).ready(function() {
    count(".coming-soon");           
});


/* -------- Owl Carousel -------- */
$("#quote-carousel").owlCarousel({
	slideSpeed : 300,
	autoPlay : true,
	paginationSpeed : 400,
	singleItem : true,		
});
// End Owl Carousel


/* -------- Counter Up -------- */
$('.counter').counterUp({
	delay: 10,
	time: 1000
});
// End Counter Up


/*	Count Down
/*----------------------------------------------------*/
function count(elem){	
	if($(elem).length==0){
		return 0;
	};

	//CountDown
    var dateOfBeginning = "Jan 21, 2015", //type your date of the Beginnig
        dateOfEnd = "Apr 10, 2015"; //type your date of the end

    countDown(dateOfBeginning, dateOfEnd); 

}


/* -------- Isotope Filtering -------- */
var $container = $('#isotope-gallery-container');
var $filter = $('.filter');
$(window).load(function () {
    // Initialize Isotope
    $container.isotope({
        itemSelector: '.gallery-item-wrapper'
    });
    $('.filter a').click(function () {
        var selector = $(this).attr('data-filter');
        $container.isotope({ filter: selector });
        return false;
    });
    $filter.find('a').click(function () {
        var selector = $(this).attr('data-filter');
        $filter.find('a').parent().removeClass('active');
        $(this).parent().addClass('active');
    });
});
$(window).smartresize(function () {
    $container.isotope('reLayout');
});
// End Isotope Filtering


/* -------- Gallery Popup -------- */
$(document).ready(function(){
	$('.gallery-zoom').magnificPopup({ 
		type: 'image'
		// other options
	});
});
// End Gallery Popup


/* -------- Google Map -------- */
function initMap(elem) {

	if($(elem).length==0){
		return 0;
	};

	//Map start init
    var mapOptions = {
        center: new google.maps.LatLng(51.5111507, -0.1239844),
        zoom: 15,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.DEFAULT,
        },
        disableDoubleClickZoom: false,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
        },
        scaleControl: true,
        scrollwheel: false,
        streetViewControl: true,
        draggable : true,
        overviewMapControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
		styles: [{stylers:[{saturation:-100},{gamma:1}]},{elementType:"labels.text.stroke",stylers:[{visibility:"off"}]},{featureType:"poi.business",elementType:"labels.text",stylers:[{visibility:"off"}]},{featureType:"poi.business",elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"poi.place_of_worship",elementType:"labels.text",stylers:[{visibility:"off"}]},{featureType:"poi.place_of_worship",elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"road",elementType:"geometry",stylers:[{visibility:"simplified"}]},{featureType:"water",stylers:[{visibility:"on"},{saturation:50},{gamma:0},{hue:"#50a5d1"}]},{featureType:"administrative.neighborhood",elementType:"labels.text.fill",stylers:[{color:"#333333"}]},{featureType:"road.local",elementType:"labels.text",stylers:[{weight:0.5},{color:"#333333"}]},{featureType:"transit.station",elementType:"labels.icon",stylers:[{gamma:1},{saturation:50}]}]
		}
                    
    var map = new google.maps.Map(document.getElementById('map'),mapOptions);
    var marker = new google.maps.Marker({
    	icon: 'images/map-pin.png',
        map: map,
        position: map.getCenter() 
    });
}
//end Google Map



/* -------- Header 1 Nav -------- */
$(".headroom").headroom({
});
    
/* -------- Header 3 Nav -------- */
$(window).load(function() {
	
	/* -------- Header 3 Nav -------- */
	$('.nav-slide-btn').click(function() {
		$('.pull').slideToggle();
	});

});

document.querySelector("#nav-toggle").addEventListener("click", function() {
	this.classList.toggle("active");
});

