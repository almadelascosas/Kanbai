@extends('layouts.app')
@section('title', 'Productos')
@section('content')
<section class="section-agents section-t8">
    @if($info['banners']!=null)
    <!-- Second slider. Carousel -->
    <div id="carousel" class="slider slider_second mt-5">
        <div class="slider_viewport">
            <div class="slider_list">
                @foreach($info['banners'] as $item)
                <div class="slider_item">
                    <img src="{{ asset('images/categories/banners/'.$item->file.'') }}">
                </div>
                @endforeach
            </div>
        </div>
        <div class="slider_nav">
            <div class="slider_arrow slider_arrow__left"></div>
            <div class="slider_arrow slider_arrow__right"></div>
        </div>
        <div class="slider_control-nav"></div>
    </div>
    @endif
</section>
<!-- ======= list products Section ======= -->
<section class="section-agents ">
    @if($info['namesubcategory']!=null)
    <div class="miga-pan mt-2">
        <div class="container">
            <a href="/catalogo/{{ $info['slugcategory'] }}">< Volver a {{$info['namecategory']}} </a> 
        </div> 
    </div> 
    @endif 
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-wrap d-flex justify-content-between">
                </div>
            </div>
        </div>
         @livewire('productos',['info'=>$info])
    </div>
</section>
<!-- End list products Section -->
<section class="section-testimonials nav-arrow-a testimonials">
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="card-kanbai">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-6 text-center">
                                <div class="circle-icon text-center">
                                    <img src="{{ asset('images/purple-calendar.png') }}" width="120">
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <h5 class="mt-5 titles-home-categories">¿Tienes un proyecto especifico?</h5>
                            </div>
                            <div class="col-12 text-center">&nbsp;</div>
                            <div class="col-12 text-center">Permitenos crear una propuesta 100% adaptada a tus necesidades</div>
                            <div class="col-12 text-center">&nbsp;</div>
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-shedule">Crear Proyecto</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
(function($) {

    'use strict';

    var slider = function(container, options) {

        var setting = $.extend({
            items: 1,
            autoplay: true,
            interval: 3000,
            loop: false,
            callback: function() {}
        }, options);

        var ANIMATE_SPEED = 50000;

        var $slider = $(container);
        var $sliderControlNav = $slider.find('.slider_control-nav');
        var $sliderArrowLeft = $slider.find('.slider_arrow__left');
        var $sliderArrowRight = $slider.find('.slider_arrow__right');
        var $sliderList = $slider.find('.slider_list');
        var $sliderItemsList = $slider.find('.slider_item');
        var slidesCount = $sliderItemsList.length;
        var slideWidth = $slider.find('.slider_viewport').width();
        var currentSlide = 0;
        var $sliderControlNavList;
        var $firstSlideClone = $sliderList.children().slice(slidesCount - setting.items).clone();
        var $lastSlideClone = $sliderList.children().slice(0, setting.items).clone();
        var isAnimating = false;
        var sliderInterval;

        var init = function() {
            $firstSlideClone.prependTo($sliderList);
            $lastSlideClone.appendTo($sliderList);
            setCountOfSlidesInViewPort();
            createControlNavItems();
            $sliderList.css('transform', 'translate(' + -(slideWidth * setting.items) + 'px)');
            attachHandlers();
            if (!setting.loop) {
                $sliderArrowLeft.hide();
            }
            setSliderInterval();
        };

        var attachHandlers = function() {
            $sliderArrowLeft.on('click', function() {
                setSlide('prev');
            });
            $sliderArrowRight.on('click', function() {
                setSlide('next');
            });
            $sliderControlNav.on('click', '.slider_control-nav-item', function() {
                setSlide($(this).index());
            });
        };

        var setCountOfSlidesInViewPort = function() {
            if (setting.items > 1) {
                slideWidth = slideWidth / setting.items;
            }
            $sliderList.width(slideWidth * (slidesCount + setting.items * 2));
            $slider.find('.slider_item').each(function(i) {
                $(this).css('width', slideWidth).addClass('slider_item-' + i);
            });
        };

        var createControlNavItems = function() {
            var $sliderControlNavItem;

            for (var i = 0; i < slidesCount; i++) {
                $sliderControlNavItem = $('<div class="slider_control-nav-item">');
                $sliderControlNav.append($sliderControlNavItem);
            }

            $sliderControlNavList = $sliderControlNav.find('.slider_control-nav-item');
            $sliderControlNavList.eq(currentSlide).addClass('is-active');
        };

        var setSlide = function(arg) {

            if (!isAnimating) {

                isAnimating = true;

                if (typeof(arg) === 'number' && arg === -1) {
                    isAnimating = false;
                    return;
                }

                clearSliderInterval();

                if (arg === 'next') {
                    if (currentSlide < slidesCount - 1) {
                        currentSlide++;
                        slideAnimate();
                        setCurrentNavItem(currentSlide);
                        $sliderList.css('transform', 'translate(' + -(currentSlide + setting.items) * slideWidth + 'px)');
                    } else if (setting.loop && currentSlide === slidesCount - 1) {
                        currentSlide++;
                        slideAnimate();
                        setCurrentNavItem(0);
                        $sliderList.css('transform', 'translate(' + -(currentSlide + setting.items) * slideWidth + 'px)');
                        setTimeout(function() {
                            currentSlide = 0;
                            $sliderList.css('transform', 'translate(' + -(currentSlide + setting.items) * slideWidth + 'px)');
                        }, ANIMATE_SPEED);
                    }

                    if (!setting.loop && currentSlide === slidesCount - 1) {
                        isAnimating = false;
                    }

                    if (!setting.loop && currentSlide === slidesCount - 1) {
                        $sliderArrowRight.hide();
                    }

                    if (!setting.loop && currentSlide === 1) {
                        $sliderArrowLeft.show();
                    }
                }

                if (arg === 'prev') {
                    if (currentSlide > 0) {
                        currentSlide--;
                        slideAnimate();
                        setCurrentNavItem(currentSlide);
                        $sliderList.css('transform', 'translate(' + -(currentSlide + setting.items) * slideWidth + 'px)');
                    } else if (setting.loop && currentSlide === 0) {
                        slideAnimate();
                        setCurrentNavItem(slidesCount - 1);
                        $sliderList.css('transform', 'translate(' + -slideWidth * (setting.items - 1) + 'px)');
                        setTimeout(function() {
                            currentSlide = slidesCount - 1;
                            $sliderList.css('transform', 'translate(' + -(currentSlide + setting.items) * slideWidth + 'px)');
                        }, ANIMATE_SPEED);
                    }

                    if (!setting.loop && currentSlide === 0) {
                        isAnimating = false;
                    }

                    if (!setting.loop && currentSlide === 0) {
                        $sliderArrowLeft.hide();
                    }

                    if (!setting.loop && currentSlide === slidesCount - 2) {
                        $sliderArrowRight.show();
                    }
                }

                if (typeof(arg) === 'number' && arg >= 0) {
                    currentSlide = arg;
                    slideAnimate();
                    setCurrentNavItem(currentSlide);
                    $sliderList.css('transform', 'translate(' + -(currentSlide + setting.items) * slideWidth + 'px)');
                    if (!setting.loop && currentSlide === 0) {
                        $sliderArrowLeft.hide();
                    }
                    if (!setting.loop && currentSlide === slidesCount - 1) {
                        $sliderArrowRight.hide();
                    }
                    if (!setting.loop && currentSlide > 0) {
                        $sliderArrowLeft.show();
                    }
                    if (!setting.loop && currentSlide < slidesCount - 1) {
                        $sliderArrowRight.show();
                    }
                }

                setSliderInterval();
            }

            setting.callback(currentSlide);

        };

        var slideAnimate = function() {
            $sliderList.addClass('is-animating');
            setTimeout(function() {
                $sliderList.removeClass('is-animating');
                isAnimating = false;
            }, ANIMATE_SPEED);
        };

        var setCurrentNavItem = function(slideNumber) {
            $sliderControlNavList.removeClass('is-active');
            $sliderControlNavList.eq(slideNumber).addClass('is-active');
        };

        var disableArrowRight = function() {
            if (currentSlide === slidesCount - 1) {
                $sliderNavBtnRight.hide();
            } else {
                $sliderNavBtnRight.show();
            }
        };

        var disableArrowLeft = function() {
            if (currentSlide === 0) {
                $sliderNavBtnLeft.hide();
            } else {
                $sliderNavBtnLeft.show();
            }
        };

        var setSliderInterval = function() {
            if (setting.autoplay) {
                sliderInterval = setInterval(function() {
                    setSlide('next');
                }, setting.interval);
            }
        };

        var clearSliderInterval = function() {
            if (setting.autoplay) {
                clearInterval(sliderInterval);
            }
        };

        this.getSlidesCount = function() {
            return slidesCount;
        };

        init();
    };

    $.fn.slider = function(options) {

        if (options === undefined) {
            options = {};
        }

        if (typeof options === 'object') {
            return new slider(this, options);
        }
    }

})(jQuery);

var $slider = $('#slider').slider();
var $carousel = $('#carousel').slider({
    interval: 1000,
    items: 2,
    loop: true,
    callback: function(number) {
        console.log('Current carousel slide - ' + number);
    }
});
var $slider2 = $('#slider2').slider({
    interval: 2000,
    loop: true
});

console.log('Total number of slides - ' + $slider.getSlidesCount());

</script>
@endpush
