//图片轮播
$(function() {
    var now = 0;
    var $slider = $(".slider");
    var $sliderContent = $slider.find(".slider-content");
    var $items = $sliderContent.find(".slider-item");
    var $leftControl = $slider.find(".slider-left-control");
    var $rightControl = $slider.find(".slider-right-control");
    var timer;
    var interval = 5000;
    var len = $items.length;
    var slideWidth = $items.eq(0).width();
    var w = parseInt($slider.width());
    var h = parseInt($slider.height());
    //进度条
    var $process = $("<div id='Gprocess'><div class='thumb'></div></div>").css({"top": h-14+"px"});

    //添加小圆点
    var _li = '';
    for(var i= 0; i<len;i++){
        _li= _li + '<li></li>'
    }
    $slider.find(".slider-indicator").append(_li);
    var $indicators = $slider.find(".slider-indicator li");

    //进度条
    //$slider.append($process);

    for (var i= 0; i<len;i++) {
        $indicators[i].index = i;
    }
    $indicators.eq(now).addClass("active");
    $items.eq(now).addClass("active");
    slide();
    $(".slider-indicator").on("click", "li", function(ev) {
        if (now % len == ev.target.index) return;
        goto(ev.target.index);
    });
    $slider.on("mouseover", function () {
        $process.stop(true);
        clearInterval(timer);
        timer = null;
        $slider.addClass('hover');
    });
    $slider.on("mouseout",  function () {
        slide();
        $slider.removeClass('hover');
    });
    $leftControl.on("click", function () {
        prev();
    });
    $rightControl.on("click", function () {
        next();
    });

    function goto (num) {
        $process.css("width","0");
        var x = now % len, y= num % len;
        $indicators.eq(x).removeClass("active");
        $indicators.eq(y).addClass("active");
        if (now > num) {
            $items.eq(x).stop().css("left", 0).animate({left: slideWidth}, function() {$items.eq(x).removeClass("active");});
            $items.eq(y).stop().css("left", -slideWidth).addClass("active").animate({left: 0});
        } else {
            $items.eq(x).stop().css("left", 0).animate({left: -slideWidth}, function() {$items.eq(x).removeClass("active");});
            $items.eq(y).stop().css("left", slideWidth).addClass("active").animate({left: 0});
        }
        now = num;
    }
    function prev() {
        goto(now-1);
    }
    function next() {
        goto(now+1);
    }
    //进度条的运动效果
    function process(timmer) {
        $process.fadeIn().animate({"width":"100%"},timmer,"linear").fadeOut().animate({"width":"0"},function(){
            next();
        });
    }
    function slide() {
        clearInterval(timer);
        var nowW = $process.width();
        var ratio = (w-nowW)/w
        process(interval*ratio);
        timer = setInterval(function () {
            process(interval);
        }, interval*ratio);
    }
    var timer1 = setTimeout(function() {
        $(window).on("resize", function() {
            clearTimeout(timer1);
            slideWidth = $items.eq(0).width();
        })
    }, 2000);
});