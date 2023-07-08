jQuery(document).ready( function($) {

    $("body").on('submit', ".shortcode-form", function(e){
        e.preventDefault();
        e.stopPropagation();

        let $code = $(this).prev('.shortcode-inner').find('code'),
        fields = $(this).serializeArray(),
        newCode = null;

        newCode = `[${$code.data('shortcode')}`;

        fields.forEach(element => {
            console.log(element);
            newCode += ` ${element.name}="${element.value}" `;
        });

        newCode += ']';

        $code.text(newCode);
    
    });

    $("body").on('click', ".shortcoder-trigger", function(){
        $('body').toggleClass('shortcoder-active');
    });

    $("body").on('click', ".shortcoder-tabs li", function(){
        $(".shortcoder-tabs li").removeClass('active');
        $(this).addClass('active');

        $(".shortcoder-section").removeClass('active');
        $(".shortcoder-section").eq($(this).index()).addClass('active');
    });

    $("body").on('click', ".copy", function(){
        let $this = $(this);
        copyToClipboard($this.prev().find('.shortcode-contents'));

        $this.text('Copied!');

        setTimeout(function(){
            $this.html('<span class="dashicons dashicons-clipboard"></span> Copy to Clipboard!');
        }, 500);

    });

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }
	
});