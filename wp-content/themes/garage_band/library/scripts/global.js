(function($){

    $(document).ready(function(e){
        
        $('#slider').cycle();

        $('#search_form input[type="text"]').focus(function(e){
        
            $this = $(this);
            defaultText = this.defaultValue;
            
            if($this.val() == defaultText){
                $this.val("");
                $this.addClass("active");
            }
        
        });

        $('#search_form input[type="text"]').blur(function(e){
        
            $this = $(this);
            defaultText = this.defaultValue;
            
            if($this.val() == "" || $this.val() == " "){
                $this.val(defaultText);
                $this.removeClass("active");
            }
        
        });
		
		$('.sf-menu').superfish(); 
		
		$("a.fancybox").fancybox({
			'transitionIn'	:	'elastic',
			'transitionOut'	:	'elastic',
			'speedIn'		:	600, 
			'speedOut'		:	200, 
			'overlayShow'	:	true
		});

    });

})(jQuery);