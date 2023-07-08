(function ($) {
    'use strict';

    // Mobile Menu
    let mmTrigger = document.querySelectorAll('.mm-trigger');
    if( mmTrigger.length ){
        for (let i = 0; i < mmTrigger.length; i++) {
            mmTrigger[i].addEventListener('click', function(event) {
                event.preventDefault();
                document.body.classList.toggle("mm-active");
            });
        }
    }
    let mmMenuItems = document.querySelectorAll('.mm .menu-item-has-children > a, .mm .page_item_has_children > a');
    if( mmMenuItems.length ){
        for (let i = 0; i < mmMenuItems.length; i++) {
            let span = document.createElement('span');
            mmMenuItems[i].appendChild(span);
        }
    }
 
    $(".mm .menu-item-has-children > a > span, .mm .page_item_has_children > a > span").on('click', function(){
        $(this).closest('li').toggleClass('active');
    });
    $('body').on('click', '.mm .menu-item-has-children > a, .mm .page_item_has_children > a', function(e){

        if( e.target.tagName == 'SPAN' ){
            e.preventDefault();
            return false;
        }

   });

    // To top toggle
    let toTop = document.querySelector('.to-top');
    let stickBackToTop = () => {
        if(toTop == null)
            return false;

        if (window.pageYOffset > 400) {
            toTop.classList.add('active');
        }else{
            toTop.classList.remove('active');
        }
    }
    stickBackToTop();

    // Back to top
    let animateToTop = () => {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    }

    // Toggle active class
    let activeTrigger = document.querySelectorAll('.active-trigger');
    if(activeTrigger.length){
        for (let i = 0; i < activeTrigger.length; i++) {
            activeTrigger[i].addEventListener('click', function() {
                activeTrigger[i].closest('.active-parent').classList.toggle("active");
            });
        }
    }

    // Listeners
    if(toTop != null){
        toTop.addEventListener('click', animateToTop);
        window.addEventListener('scroll', stickBackToTop);
    }

    //Disabled search form enter
    $("form.form--disable-enter-key").bind("keypress", function(e) {
        if (e.keyCode == 13) {
            return false;
        }
    });

    // cf7 form
    $('.float-input').on( 'focus', function(){
		$(this).closest('.spcl-float-label').find('.floatit-label').addClass('floatit');
	});
	$('.float-input').on( 'blur', function(){
		if($(this).val() == ''){
			$(this).closest('.spcl-float-label').find('.floatit-label').removeClass('floatit');
		}
	});

})(jQuery);



