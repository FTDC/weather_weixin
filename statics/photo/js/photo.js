define(function(require, exports, module) {

    require('./photoswipe.all.js');
    require('./photoswipe.all.css');

    var tpl = require('./photoswipe-tpl.html');

    var list = [];

    function show(i) {
        var pswpElement = document.querySelectorAll('.pswp')[0];

        // build items array
        var items = list;

        // define options (if needed)
        var options = {
            // optionName: 'option value'
            // for example:
            index: i || 0 // start at first slide
        };

        // Initializes and opens PhotoSwipe
        var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();
    }

    exports.init = function ($el) {
        $('body').append(tpl);
        var w = $(window).width();
        var h = $(window).height();
        $el.find('img').each(function(){
            var w = $(window).width();
            var h = $(window).height();
            list.push({
                src : $(this).data('src') || this.src,
                w: $(this).data('width') || w * 0.8,
                h: $(this).data('height') || h * 0.8
            })
        })


        $el.find('.pic').click(function(){
            show( $(this).index() );
        })

    }

});