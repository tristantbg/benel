/* globals $:false */
var width = $(window).width(),
    height = $(window).height(),
    isMobile = false,
    $root = '/';
$(function() {
    var app = {
        init: function() {
            $(window).resize(function(event) {});
            $(document).ready(function($) {
                $body = $('body');
                app.loadSlider();
                $(document).keyup(function(e) {
                    //esc
                    //left
                    if (e.keyCode === 37 && $slider) app.goPrev($slider);
                    //right
                    if (e.keyCode === 39 && $slider) app.goNext($slider);
                });
                $(window).load(function() {
                    $(".loader").fadeOut("fast");
                });
            });
        },
        sizeSet: function() {
            width = $(window).width();
            height = $(window).height();
            if (width <= 770 || Modernizr.touch) isMobile = true;
            if (isMobile) {
                if (width >= 770) {
                    //location.reload();
                    isMobile = false;
                }
            }
        },
        loadSlider: function() {
            //var wrap = ($body.hasClass('shop') ? false : true);
            $slider = $('.slider').flickity({
                cellSelector: '.content-item',
                imagesLoaded: false,
                lazyLoad: 4,
                cellAlign: 'left',
                setGallerySize: false,
                percentPosition: false,
                accessibility: false,
                wrapAround: true,
                prevNextButtons: false,
                pageDots: false,
                draggable: true
            });
            var isSliding = false;
            // setTimeout(function() {
            //     $slider.flickity('resize');
            // }, 300);
            flkty = $slider.data('flickity');
            $caption = $('#slide-caption');
            if (flkty) {
                nbCells = flkty.cells.length;
            }
            $slider.on('select.flickity', function() {
                if (flkty) {
                    var slidecaption = $(flkty.selectedElement).attr('data-caption');
                    if (typeof slidecaption !== typeof undefined && slidecaption !== false) {
                        $caption.html(pad(flkty.selectedIndex + 1) + "/" + nbCells + "&nbsp;&nbsp;" + slidecaption);
                    }
                }
            });
            $slider.on('staticClick.flickity', function(event, pointer, cellElement, cellIndex) {
                if (!cellElement || $body.hasClass('shop')) {
                    return;
                }
                app.goNext($slider);
            });
            $slider.on('settle.flickity', function(event, pointer, cellElement, cellIndex) {
                isSliding = false;
            });
            $slider.bind('mousewheel', function(evt) {
                if (!isSliding) {
                    var delta = evt.originalEvent.wheelDelta;
                    if (delta < -10) {
                        app.goNext($slider);
                        isSliding = true;
                    } else if (delta > 10) {
                        app.goPrev($slider);
                        isSliding = true;
                    }
                }
            });
            // $slider.click(function(event) {
            //     if (!isMobile) {
            //         event.preventDefault();
            //         if ($body.hasClass('hover-left')) {
            //             app.goPrev($slider);
            //         } else if ($body.hasClass('hover-right')) {
            //             app.goNext($slider);
            //         }
            //     }
            // });
        },
        goNext: function($slider) {
            $slider.flickity('next', false);
        },
        goPrev: function($slider) {
            $slider.flickity('previous', false);
        },
        loadContent: function(url, target) {
            $.ajax({
                url: url,
                success: function(data) {
                    $(target).html(data);
                }
            });
        }
    };
    app.init();
});

function pad(d) {
    return (d < 10) ? '0' + d.toString() : d.toString();
}