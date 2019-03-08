/* globals $:false */
var width = $(window).width(),
    height = $(window).height(),
    isMobile = null,
    $root = '/';
$(function() {
    var app = {
        init: function() {
            $(window).resize(function(event) {
                app.sizeSet();
            });
            $(document).ready(function($) {
                $body = $('body');
                app.sizeSet();
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
            if (isMobile !== null && isMobile && width > 1023) {
              location.reload();
            }
            if (isMobile !== null && !isMobile && width <= 1023) {
              location.reload();
            }
            isMobile = width <= 1023;
        },
        loadSlider: function() {
            //var wrap = ($body.hasClass('shop') ? false : true);
            if (isMobile) {
                // $('.video-item').remove();
                var $captions = $('[data-caption]');
                $captions.each(function(index, el) {
                  var c = el.dataset.caption;
                  $(el).append('<div id="slide-caption">'+pad(index+1)+'/'+pad($captions.length)+'   '+c+'</div>');
                });
            } else {
                var videos = document.getElementsByTagName('video');
                for (var i = videos.length - 1; i >= 0; i--) {
                    videos[i].addEventListener('loadeddata', function() {
                        $slider.flickity('resize');
                    }, false);
                }
            }
            if (isMobile) return;
            $slider = $('.slider').flickity({
                cellSelector: '.content-item',
                imagesLoaded: false,
                lazyLoad: 3,
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
                nbCells = pad(flkty.cells.length);
            }
            $slider.on('select.flickity', function() {
                if (flkty) {
                    var slidecaption = $(flkty.selectedElement).attr('data-caption');
                    if (typeof slidecaption !== typeof undefined && slidecaption !== false) {
                        $caption.html(pad(flkty.selectedIndex + 1) + "/" + nbCells + "&nbsp;&nbsp;" + slidecaption);
                    }
                    $(flkty.selectedElement).find('video').each(function(i, video) {
                        video.play();
                    });
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