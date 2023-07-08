(function ($) {
    'use strict';

    let productSticky = document.querySelector('.product-sticky'),
    productActions = document.querySelector('#product-fold'),
    oldScroll = 0,
    newScroll = 0;
    let stickyproductCard = () => {

        newScroll = window.pageYOffset;

        if (productActions.getBoundingClientRect().bottom < 0 && oldScroll > newScroll ) {
            productSticky.classList.add('active');
        }else{
            productSticky.classList.remove('active');
        }

        if( (window.innerHeight + window.scrollY) >= document.body.offsetHeight )
        productSticky.classList.remove('active');

        oldScroll = newScroll;

    }
    stickyproductCard();

    window.addEventListener('scroll', stickyproductCard);

})(jQuery);