(function($) {
  $.fn.captcha = function(options) {
    
    var defaults = {
     path: '/captcha.php',
     font: '/fonts/monofont.ttf',
     background: '6aa72d',
     noise: '4e8616',
     color: 'ffffff',
     width: 100,
     height: 30,
     length: 6
    };
    
    var options = $.extend(defaults, options);

    return this.each(function() {
  
    $obj = $(this);
    
    $('<img src="'+options.path+'?f='+options.font+'&amp;b='+options.background+'&amp;n='+options.noise+'&amp;c='+options.color+'&amp;w='+options.width+'&amp;h='+options.height+'&amp;l='+options.length+'" class="captcha_image" border="0" />').insertAfter($obj);
        
    });
  }
})(jQuery);