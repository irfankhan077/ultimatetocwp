(function ($) {
    'use strict';

    // Open the cart
    $("body").on('click', '.cart-trigger', function(e){
        e.preventDefault();
        $("body").toggleClass('cart-open');
    });

    // Open the wishlist
    $("body").on('click', '.wishlist-trigger', function(e){
        e.preventDefault();
        $("body").toggleClass('wishlist-open');
    });

    // Lets update the Wishlist fragment in the header
    $(document).on( 'added_to_wishlist removed_from_wishlist', function() {
        $.get( yith_wcwl_l10n.ajax_url, {
            action: 'yith_wcwl_update_wishlist_count'
        }, function( data ) {
            $('.yith-wcwl-items-count').html(data.count);
        });
    });

})(jQuery);