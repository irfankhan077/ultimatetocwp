(function ($) {
    'use strict';

    /*==========================
    MODULE GLOBAL
    ==========================*/

    // Add Background Image
    let addBackground = (module, value) => {
        module.style.backgroundImage = value != undefined ? value : '';
    }

    // Add Background Position
    let addBackgroundPosition = (module, value) => {
        module.style.backgroundPosition = value != undefined ? value : '';
    }

    // Add Background Color
    let addBackgroundColor = (module, value) => {
        module.style.backgroundColor = value != undefined ? value : '';
    }

    // Add Background Repeat
    let addBackgroundRepeat = (module, value) => {
        module.style.backgroundRepeat = value != undefined ? value : '';
    }

    // Add Background Size
    let addBackgroundSize = (module, value) => {
        module.style.backgroundSize = value != undefined ? value : '';
    }

    // Add Background Attachment
    let addBackgroundAttachment = (module, value) => {
        module.style.backgroundAttachment = value != undefined ? value : '';
    }

    // Add Print the options into the element
    let printOption = (option, module) => {

        let dataVal = window.innerWidth < 768 ? module.dataset[option+'_mobile'] : module.dataset[option+'_desktop'];

        if(option == 'bg'){
            addBackground(module, dataVal);
        }else if(option == 'bg_pos'){
            addBackgroundPosition(module, dataVal);
        }else if(option == 'bg_color'){
            addBackgroundColor(module, dataVal);
        }else if(option == 'bg_repeat'){
            addBackgroundRepeat(module, dataVal);
        }else if(option == 'bg_size'){
            addBackgroundSize(module, dataVal);
        }else if(option == 'bg_attachment'){
            addBackgroundAttachment(module, dataVal);
        }

    };
    
    // Loop through every option in every screen in every module
    let getAllOptions = () => {
        let screens = ['desktop', 'mobile'],
        options = ['bg', 'bg_pos', 'bg_color', 'bg_repeat', 'bg_size', 'bg_attachment'],
        modules = document.querySelectorAll('.lx-module');

        modules.forEach( module => {
            screens.forEach( screen => {
                options.forEach( option => {
                    if(module.dataset[option+'_'+screen] != undefined){
                        printOption(option, module);
                    }
                });
            });
        });
    }

    window.addEventListener('load', getAllOptions);
    window.addEventListener('resize', getAllOptions);
    
    /*==========================
    FAQ MODULE
    ==========================*/
    $(".faq-question").on('click', function(){
        $(this).parent().toggleClass('active');
        $(this).next().slideToggle();
    });

    // Lets submit the form
    $("#nsm-cf-form").on('submit', function(e){
        e.preventDefault();

        let request,
        data,
        $this = $(this);

        // Abort any pending request
        if (request) {
            request.abort();
        }

        // Let's not move forward if form was invalid
        if(!$this.parsley().isValid())
        return false;

        let $btn = $this.find('.submit-contact');

        $btn.prop('disabled', true);
        
        data = $this.serialize();

        request = $.ajax({
            url: nsm_ajax_object.ajaxurl,
            type: "post",
            data: data
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



