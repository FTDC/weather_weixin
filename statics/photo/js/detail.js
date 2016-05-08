define(function (require, exports, module) {

    var target = '';

    var contentSwiper = new Swiper('.swiper-container', {
        touchAngle: 20
    });

    var hArr = [], pro_cache = [];

    function setHeight ( i ) {
        hArr = [];
        contentSwiper.slides.each(function () {
            var h = 0;
            $(this).children().each(function(){
                h += $(this).height();
            })
            h += 60;
            hArr.push(h);
        })
        var index = i || contentSwiper.activeIndex;
        contentSwiper.wrapper.height( hArr[index] );
    }

    setHeight();

    require.async('photo', function(pw){
        pw.init( $('.user-images') );
    });

    contentSwiper.on('slideChangeStart', function (swiper) {
        var index = swiper.activeIndex;
        $tab.removeClass('active').eq(index).addClass('active');

        var $currentSwiper = swiper.slides.eq(index);
        target = $tab.eq(index).attr('data-target');
        setHeight();
        fullContent(target);

        if (index == 1) {
            var $images = $('.user-images img');
            $images.each(function () {
                this.src = this.getAttribute('data-src');
            })
        }
    });

});