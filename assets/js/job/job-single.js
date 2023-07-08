(function ($) {
    'use strict';

    // Lets submit the form
    $("#nsm-job-form").on('submit', function(e){
        e.preventDefault();

        let request,
        data,
        $this = $(this);

        // Abort any pending request
        if (request) 
        request.abort();

        // Let's not move forward if form was invalid
        if(!$this.parsley().isValid())
        return false;

        let $btn = $this.find('.submit-contact');

        $btn.prop('disabled', true);
        
        data = $this.serialize();

        request = $.ajax({
            url: nsm_ajax_object.ajaxurl,
            type: "post",
            data: new FormData(this),
            processData: false,
            contentType: false,
        });

        // Callback handler that will be called on success
        request.done(function (response){

            if( response.success == true ){
                $btn.remove();
                $this.append(`<div class="px-15 py-15 mt-20 fw-500 fs-14" style="background-color: #f5fff6; color: #0f8f25">${response.data.message}</div>`)
                return true;
            }

        });
      
        // Callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function () {
            $btn.prop('disabled', false);
        });

    });

})(jQuery);