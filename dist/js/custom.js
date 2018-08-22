$('#black-transparent').click(lightboxToggle);
$('#lightbox').click(lightboxToggle);

function lightboxToggle(){
	$('#black-transparent').toggle();
	$('#lightbox').toggle();
}

function lightboxShowApiImage(img){
	$('#lightbox').html("<p class=\"text-center\"><img src=\"http://nthuee.org:8081/api/v1.1/download/img/"+img+"\" style=\"max-width:100%; max-height:80vh\"></p>");
	lightboxToggle();
}
