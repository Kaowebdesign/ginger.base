// Preloader js    
$(window).on('load', function () {
	$('.preloader').fadeOut(100);
});
//basic functions
$(document).ready(function () {
	'use strict';

	let nav = $('.nav'),
		navButton = $('.nav__icon'),
		navLink = $('.nav__link');

		navButton.on('click',function(e){
			e.preventDefault();
			$(this).closest(nav).toggleClass('active');
		});
		
		navLink.on('click',function(e){
			e.preventDefault();
			$(this).closest(nav).toggleClass('active');
		});

	let footerLogo = $('.footer__logo');

		footerLogo.on('click',function(e){
			e.preventDefault();
			$('html, body').animate({
				scrollTop:0
			}, {
				duration: 370,
				easing: "linear"
			});
		})
});
//outside el click
$(document).on('click',function (e) {
	'use strict';

	let el = '.nav';
	
	if (jQuery(e.target).closest(el).length) return;
	$(el).removeClass('active');
});
//smooth scroll
$('.scrollto').on('click', function() {

    let href = $(this).attr('href');

    $('html, body').animate({
        scrollTop: $(href).offset().top
    }, {
        duration: 370,
        easing: "linear"
    });

    return false;
});

function getScreenHeight(){
	return Math.max(document.documentElement.clientHeight, window.innerHeight);
}

var projects = $('.project-card'),
	viewportH = getScreenHeight(),
	i = 1,
	deltaY = 300;

$(window).scroll(function(){
	
	if((($(window).scrollTop()+viewportH) - $('div[data-position="'+i+'"').offset().top) > deltaY && i <= projects.length){
		
		$('div[data-position="'+i+'"').addClass('color');

		i = i!==projects.length ? i+1 : i;
	}
	
});

$( "body" ).on( "beforeSend", "#contact-form", function(e) {
    e.preventDefault();
}).on('submit', function(e){
    e.preventDefault();
    var form = $('#contact-form');
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
            data = jQuery.parseJSON(data);
            if (data.status !== undefined) {
                if(data.status == 'success') {
                    form.find('input').removeClass('has-error');
                    alert('hood job');
                } else {
                    alert(data.message)
                }
            } else {
                $.each( data, function( key, value ) {
                    textConteinerBlock = form.find('.field-'+key);
                    if(textConteinerBlock.length) {
                        textConteinerBlock.addClass('has-error');
                        // textConteinerBlock.find('.help-block').text(value);
                    }
                });
            }
        }
	});
});
