!(function () {
    var win_width = $(window).width();
    var win_height = $(window).height();

    var loading_img = [];
    var loading_num = 0;
    $('#J_loading').css({
        height: win_height
    });
    $('body').find('img').each(function () {
        loading_img.push($(this).attr('data-src'));
    });
    for (var i = 0, len = loading_img.length; i < len; i++){
        var img = new Image();
        img.src = loading_img[i];

        img.onload = function(){
            loading_num++;

            $('#J_loading_pro').css({
                width: 250 * loading_num / loading_img.length
            });

            if(loading_num >= loading_img.length - 10){
                $('body').find('img').each(function () {
                    $(this).attr('src', $(this).attr('data-src'));
                });
                $('#J_loading_pro').css({
                    width: 250
                });
                $('#J_loading').hide();
                $('#J_main').show();

                win_height = $(window).height();

                init();
            }

            img.onload = null;
        };
    }

    function init() {
        var section_obj = $('#J_main').find('section');
        section_obj.each(function () {
            var index = section_obj.index(this);
            if (index === 0 || index === 1 || index === 7) {
                $(this).css({
                    height: win_height
                });
            }
        });

        var scrollTop = 0;
        var changeTop = 0;
        var startPos = 0;
        var actPos = 0;
        var endPos = 0;
        var statePos = 0;
        var curPage = 1;
        $('body').bind('touchstart', function (ev) {
            var tev = ev.touches[0];

            startPos = tev.clientY;
            changeTop = 0;
        });
        $('body').bind('touchmove', function (ev) {
            var tev = ev.touches[0];

            endPos = tev.clientY;

            changeTop = endPos - startPos;

            main();

            $('.J_sec2_jb_info').hide();

            return false;
        });
        $('body').bind('touchend', function (ev) {
            var tev = ev.touches[0];
            if (changeTop !== 0) {
                scrollTop = changeTop;
            }

            if (scrollTop > 0) {
                scrollTop = 0;
            }
        });

        function main() {
            changeTop = scrollTop + changeTop;
            if (changeTop < 0) {
                var tmpChangeTop = changeTop;
                var index = 1;
                section_obj.each(function () {
                    if (tmpChangeTop < 0) {
                        index = section_obj.index(this);
                        if (index === 0 || index === 1 || index === 7) {
                            tmpChangeTop = tmpChangeTop + win_height;
                        } else {
                            tmpChangeTop = tmpChangeTop + $(this).height();
                        }
                    }
                });

                var pi = index + 1;
                if (pi > 7) {
                    changeTop = - ($('#J_main').height() - win_height);
                    $('#J_main').css({
                        '-webkit-transform': 'translate3d(0, ' + changeTop + 'px, 0)',
                        'transform': 'translate3d(0, ' + changeTop + 'px, 0)'
                    });
                }
                !!ani['page'+ pi] && ani['page'+ pi]();
            } else {
                $('#J_main').css({
                    '-webkit-transform': 'translate3d(0, 0, 0)',
                    'transform': 'translate3d(0, 0, 0)'
                });
            }
        }

        var ani = {
            page1: function () {
                $('#J_idx_banner').css({
                    '-webkit-transform': 'translate3d(' + (-changeTop/win_height*160) + '%, -60%, 0)',
                    'transform': 'translate3d(' + (-changeTop/win_height*160) + '%, -60%, 0)'
                });

                $('#J_idx_bottom').css({
                    '-webkit-transform': 'translate3d(-' + (-changeTop/win_height*160) + '%, 0, 0)',
                    'transform': 'translate3d(-' + (-changeTop/win_height*160) + '%, 0, 0)'
                });

                if (-changeTop < win_height / 2) {
                    $('#J_index').css({
                        background: '#8FDBD2'
                    });
                } else {
                    $('#J_index').css({
                        background: '#F5E9D8'
                    });
                    $('#J_sec1_chart').css({
                        '-webkit-transform': 'translate3d(' + (100 - (-changeTop - win_height / 2)/(win_height / 2)*100) + '%, ' + (100 - (-changeTop - (win_height / 2)/win_height / 2)*100) + '%, 0)',
                        'transform': 'translate3d(' + (100 - (-changeTop - win_height / 2)/(win_height / 2)*100) + '%, ' + (100 - (-changeTop - win_height / 2)/(win_height / 2)*100) + '%, 0)'
                    });
                    $('.J_sec1_arr img').css({
                        '-webkit-transform': 'translate3d(-' + (100 - (-changeTop - win_height / 2)/(win_height / 2)*100) + '%, 0, 0)',
                        'transform': 'translate3d(-' + (100 - (-changeTop - win_height / 2)/(win_height / 2)*100) + '%, 0, 0)'
                    });
                    $('#J_sec1_book').css({
                        '-webkit-transform': 'translate3d(-' + (100 - (-changeTop - win_height / 2)/(win_height / 2)*100) + '%, ' + (100 - (-changeTop - (win_height / 2)/win_height / 2)*100) + '%, 0)',
                        'transform': 'translate3d(-' + (100 - (-changeTop - win_height / 2)/(win_height / 2)*100) + '%, ' + (100 - (-changeTop - win_height / 2)/(win_height / 2)*100) + '%, 0)'
                    });
                }

                $('#J_main').css({
                    '-webkit-transform': 'translate3d(0, ' + changeTop + 'px, 0)',
                    'transform': 'translate3d(0, ' + changeTop + 'px, 0)'
                });
            },
            page2: function () {
                var tmpChangeTop = changeTop + win_height;
                if (-tmpChangeTop < win_height / 3) {
                    $('.J_sec1_t3').css({
                        opacity: 1 - -(-tmpChangeTop - win_height / 3)/(win_height / 3)
                    });
                    $('#J_sec1_rmb').css({
                        opacity: 1 - -(-tmpChangeTop - win_height / 3)/(win_height / 3),
                        top: - (4 + 80 * -(-tmpChangeTop - win_height / 3)/(win_height / 3))
                    });
                    if (-tmpChangeTop < win_height / 5) {
                        $('#J_sec1_word').css({
                            opacity: 1 - -(-tmpChangeTop - win_height / 5)/(win_height / 5)
                        });
                    }
                } else if (-tmpChangeTop > win_height / 3 && -tmpChangeTop < win_height / 1.5) {
                    $('#J_sec2_wenhao').css({
                        '-webkit-transform': 'translate3d(' + (100 - (-tmpChangeTop - win_height / 3)/(win_height / 3)*100) + '%, 0, 0) rotate(' + 3.6 * (-tmpChangeTop - win_height / 3)/(win_height / 3)*100 + 'deg)',
                        'transform': 'translate3d(' + (100 - (-tmpChangeTop - win_height / 3)/(win_height / 3)*100) + '%, 0, 0) rotate(' + 3.6 * (-tmpChangeTop - win_height / 3)/(win_height / 3)*100 + 'deg)'
                    });
                    $('.J_sec2_t').css({
                        '-webkit-transform': 'scale(' + (-tmpChangeTop - win_height / 3)/(win_height / 3) + ', ' + (-tmpChangeTop - win_height / 3)/(win_height / 3) + ')',
                        'transform': 'scale(' + (-tmpChangeTop - win_height / 3)/(win_height / 3) + ', ' + (-tmpChangeTop - win_height / 3)/(win_height / 3) + ')'
                    });
                    $('#J_sec2_title1').css({
                        width: 0
                    });
                } else {
                    $('#J_sec2_wenhao').css({
                        '-webkit-transform': 'translate3d(0, 0, 0) rotate(360deg)',
                        'transform': 'translate3d(0, 0, 0) rotate(360deg)'
                    });


                }
                if (-tmpChangeTop > win_height / 1.5) {
                    $('#J_sec2_title1').css({
                        width: 240 * (-tmpChangeTop - win_height / 1.5)/(win_height / 1.5) * 2
                    });
                    $('#J_sec2_bing2').css({
                        opacity: (-tmpChangeTop - win_height / 1.5)/(win_height / 1.5) * 2
                    });
                }

                $('#J_main').css({
                    '-webkit-transform': 'translate3d(0, ' + changeTop + 'px, 0)',
                    'transform': 'translate3d(0, ' + changeTop + 'px, 0)'
                });
            },
            page3: function () {
                var tmpChangeTop = changeTop + win_height * 2;
                var page_height = section_obj.eq(2).height();

                if (-tmpChangeTop < page_height / 4) {
                    if (-tmpChangeTop < page_height / 5) {
                        $('#J_sec2_zx').css({
                            width: 62 * (1 - -(-tmpChangeTop - page_height / 5)/(page_height / 5))
                        });
                        $('#J_sec2_bing1').css({
                            opacity: 0
                        });
                    } else {
                        $('#J_sec2_bing1').css({
                            opacity: (-tmpChangeTop - page_height / 5)/(page_height / 5) * 4
                        });

                        $('#J_sec2_bing3').css({
                            '-webkit-transform': 'translate3d(' + (100 - (-tmpChangeTop - page_height / 5)/(page_height / 5) * 4 * 100) + '%, 0, 0) rotate(' + 3.6 * (-tmpChangeTop - page_height / 5)/(page_height / 5) * 4 * 100 + 'deg)',
                            'transform': 'translate3d(' + (100 - (-tmpChangeTop - page_height / 5)/(page_height / 5) * 4 * 100) + '%, 0, 0) rotate(' + 3.6 * (-tmpChangeTop - page_height / 5)/(page_height / 5) * 4 * 100 + 'deg)'
                        });
                    }
                }
                if (-tmpChangeTop > page_height / 4) {
                    $('#J_sec2_bing3').css({
                        '-webkit-transform': 'translate3d(0, 0, 0) rotate(360deg)',
                        'transform': 'translate3d(0, 0, 0) rotate(360deg)'
                    });
                    $('#J_sec2_renwu').css({
                        '-webkit-transform': 'translate3d(0, 0, 0)',
                        'transform': 'translate3d(0, 0, 0)'
                    });
                }
                if (-tmpChangeTop > page_height / 8 && -tmpChangeTop < page_height / 4) {
                    $('#J_sec2_renwu').css({
                        '-webkit-transform': 'translate3d(' + (100 - (-tmpChangeTop - page_height / 8)/(page_height / 8) * 100) + '%, 0, 0)',
                        'transform': 'translate3d(' + (100 - (-tmpChangeTop - page_height / 8)/(page_height / 8) * 100) + '%, 0, 0)'
                    });
                }

                if (-tmpChangeTop > page_height / 3) {
                    $('#J_sec3_title').css({
                        '-webkit-transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 3)/(page_height / 3) * 100) + '%, 0, 0)',
                        'transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 3)/(page_height / 3) * 100) + '%, 0, 0)'
                    });

                    $('.J_sec3_bing').eq(0).css({
                        'opacity': (-tmpChangeTop - page_height / 3)/(page_height / 3) / 2,
                        '-webkit-transform': 'scale(' + (-tmpChangeTop - page_height / 3)/(page_height / 3)  / 2+ ', ' + (-tmpChangeTop - page_height / 3)/(page_height / 3) / 2 + ')',
                        'transform': 'scale(' + (-tmpChangeTop - page_height / 3)/(page_height / 3) / 2 + ', ' + (-tmpChangeTop - page_height / 3)/(page_height / 3) / 2 + ')'
                    });

                    if (-tmpChangeTop > page_height / 2) {
                        $('.J_sec3_bing').eq(1).css({
                            'opacity': (-tmpChangeTop - page_height / 3)/(page_height / 3) / 2,
                            '-webkit-transform': 'scale(' + (-tmpChangeTop - page_height / 3)/(page_height / 3)  / 2+ ', ' + (-tmpChangeTop - page_height / 3)/(page_height / 3) / 2 + ')',
                            'transform': 'scale(' + (-tmpChangeTop - page_height / 3)/(page_height / 3) / 2 + ', ' + (-tmpChangeTop - page_height / 3)/(page_height / 3) / 2 + ')'
                        });
                    }
                    if (-tmpChangeTop > page_height / 1.5) {
                        $('.J_sec3_bing').eq(2).css({
                            'opacity': (-tmpChangeTop - page_height / 3)/(page_height / 3) / 2,
                            '-webkit-transform': 'scale(' + (-tmpChangeTop - page_height / 3)/(page_height / 3)  / 2+ ', ' + (-tmpChangeTop - page_height / 3)/(page_height / 3) / 2 + ')',
                            'transform': 'scale(' + (-tmpChangeTop - page_height / 3)/(page_height / 3) / 2 + ', ' + (-tmpChangeTop - page_height / 3)/(page_height / 3) / 2 + ')'
                        });
                        $('.J_sec3_c').css({
                            'opacity': (-tmpChangeTop - page_height / 3)/(page_height / 3) / 2,
                            '-webkit-transform': 'scale(' + (-tmpChangeTop - page_height / 3)/(page_height / 3)  / 2+ ', ' + (-tmpChangeTop - page_height / 3)/(page_height / 3) / 2 + ')',
                            'transform': 'scale(' + (-tmpChangeTop - page_height / 3)/(page_height / 3) / 2 + ', ' + (-tmpChangeTop - page_height / 3)/(page_height / 3) / 2 + ')'
                        });
                    }
                }

                $('#J_main').css({
                    '-webkit-transform': 'translate3d(0, ' + changeTop + 'px, 0)',
                    'transform': 'translate3d(0, ' + changeTop + 'px, 0)'
                });
            },
            page4: function () {
                var tmpChangeTop = changeTop;
                section_obj.each(function () {
                    var index = section_obj.index(this);
                    if (index < 3) {
                        if (index === 0 || index === 1 || index === 7) {
                            tmpChangeTop = tmpChangeTop + win_height;
                        } else {
                            tmpChangeTop = tmpChangeTop + $(this).height();
                        }
                    }
                });
                var page_height = section_obj.eq(3).height();

                if (-tmpChangeTop < page_height / 3) {
                    $('.J_sec3_bing1').eq(2).css({
                        'opacity': 1 + (-tmpChangeTop - page_height / 3)/(page_height / 3) / 2,
                        '-webkit-transform': 'scale(' + (1 + (-tmpChangeTop - page_height / 3)/(page_height / 3)) + ', ' + (1 + (-tmpChangeTop - page_height / 3)/(page_height / 3)) + ')',
                        'transform': 'scale(' + (1 + (-tmpChangeTop - page_height / 3)/(page_height / 3)) + ', ' + (1 + (-tmpChangeTop - page_height / 3)/(page_height / 3)) + ')'
                    });
                    $('.J_sec3_c1').css({
                        'opacity': 1 + (-tmpChangeTop - page_height / 3)/(page_height / 3) / 2,
                        '-webkit-transform': 'scale(' + (1 + (-tmpChangeTop - page_height / 3)/(page_height / 3)) + ', ' + (1 + (-tmpChangeTop - page_height / 3)/(page_height / 3)) + ')',
                        'transform': 'scale(' + (1 + (-tmpChangeTop - page_height / 3)/(page_height / 3)) + ', ' + (1 + (-tmpChangeTop - page_height / 3)/(page_height / 3)) + ')'
                    });
                }

                if (-tmpChangeTop > page_height / 3 &&  -tmpChangeTop < page_height / 1.5) {
                    $('#J_sec3_t1').css({
                        '-webkit-transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 3)/(page_height / 3) * 100) + '%, 0, 0)',
                        'transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 3)/(page_height / 3) * 100) + '%, 0, 0)'
                    });

                    $('#J_sec3_t2').css({
                        '-webkit-transform': 'translate3d(' + (100 - (-tmpChangeTop - page_height / 3)/(page_height / 3) * 100) + '%, 0, 0)',
                        'transform': 'translate3d(' + (100 - (-tmpChangeTop - page_height / 3)/(page_height / 3) * 100) + '%, 0, 0)'
                    });

                    $('#J_sec3_com').css({
                        '-webkit-transform': 'scale(' + (-tmpChangeTop - page_height / 3)/(page_height / 3) + ', ' + (-tmpChangeTop - page_height / 3)/(page_height / 3) + ')',
                        'transform': 'scale(' + (-tmpChangeTop - page_height / 3)/(page_height / 3) + ', ' + (-tmpChangeTop - page_height / 3)/(page_height / 3) + ')'
                    });
                }

                if (-tmpChangeTop < page_height / 5) {
                    $('.J_sec3_bing1').eq(0).css({
                        'opacity': 1 + (-tmpChangeTop - page_height / 5)/(page_height / 5),
                        '-webkit-transform': 'scale(' + (1 + (-tmpChangeTop - page_height / 5)/(page_height / 5)) + ', ' + (1 + (-tmpChangeTop - page_height / 5)/(page_height / 5)) + ')',
                        'transform': 'scale(' + (1 + (-tmpChangeTop - page_height / 5)/(page_height / 5)) + ', ' + (1 + (-tmpChangeTop - page_height / 5)/(page_height / 5)) + ')'
                    });
                    $('#J_sec3_cont').css({
                        'opacity': 1 + (-tmpChangeTop - page_height / 5)/(page_height / 5),
                    });
                }

                if (-tmpChangeTop < page_height / 4) {
                    $('.J_sec3_bing1').eq(1).css({
                        'opacity': 1 + (-tmpChangeTop - page_height / 4)/(page_height / 4),
                        '-webkit-transform': 'scale(' + (1 + (-tmpChangeTop - page_height / 4)/(page_height / 4)) + ', ' + (1 + (-tmpChangeTop - page_height / 4)/(page_height / 4)) + ')',
                        'transform': 'scale(' + (1 + (-tmpChangeTop - page_height / 4)/(page_height / 4)) + ', ' + (1 + (-tmpChangeTop - page_height / 4)/(page_height / 4)) + ')'
                    });
                }

                if (-tmpChangeTop > page_height / 3 &&  -tmpChangeTop < page_height / 1.5) {
                    $('#J_sec4_title').css({
                        '-webkit-transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 3)/(page_height / 3) * 100) + '%, 0, 0)',
                        'transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 3)/(page_height / 3) * 100) + '%, 0, 0)'
                    });

                    $('#J_sec4_cont1').css({
                        '-webkit-transform': 'translate3d(' + (100 - (-tmpChangeTop - page_height / 3)/(page_height / 3) * 100) + '%, 0, 0)',
                        'transform': 'translate3d(' + (100 - (-tmpChangeTop - page_height / 3)/(page_height / 3) * 100) + '%, 0, 0)'
                    });
                }

                if (-tmpChangeTop > page_height / 1.5) {
                    $('#J_sec4_cont3').css({
                        'opacity': (-tmpChangeTop - page_height / 1.5)/(page_height / 1.5) * 2
                    });
                }

                $('#J_main').css({
                    '-webkit-transform': 'translate3d(0, ' + changeTop + 'px, 0)',
                    'transform': 'translate3d(0, ' + changeTop + 'px, 0)'
                });
            },
            page5: function () {
                var tmpChangeTop = changeTop;
                section_obj.each(function () {
                    var index = section_obj.index(this);
                    if (index < 4) {
                        if (index === 0 || index === 1 || index === 7) {
                            tmpChangeTop = tmpChangeTop + win_height;
                        } else {
                            tmpChangeTop = tmpChangeTop + $(this).height();
                        }
                    }
                });
                var page_height = section_obj.eq(4).height();

                if (-tmpChangeTop < page_height / 6) {
                    $('#J_sec4_tag').css({
                        'opacity': 1 + (-tmpChangeTop - page_height / 6)/(page_height / 6),
                        '-webkit-transform': 'translate3d(0, -' + -(-tmpChangeTop - page_height / 6)/(page_height / 6) * 100 / 10 + '%, 0)',
                        'transform': 'translate3d(0, -' + -(-tmpChangeTop - page_height / 6)/(page_height / 6) * 100 / 10 + '%, 0)'
                    });
                }

                if (-tmpChangeTop < page_height / 4) {
                    $('.J_xc1_i1').eq(0).css({
                        'opacity': 1 + (-tmpChangeTop - page_height / 4)/(page_height / 4),
                        '-webkit-transform': 'translate3d(0, -' + -(-tmpChangeTop - page_height / 4)/(page_height / 4) * 100 / 10 + '%, 0)',
                        'transform': 'translate3d(0, -' + -(-tmpChangeTop - page_height / 4)/(page_height / 4) * 100 / 10 + '%, 0)'
                    });
                    $('.J_xc1_i2').eq(0).css({
                        'opacity': 1 + (-tmpChangeTop - page_height / 4)/(page_height / 4),
                        '-webkit-transform': 'translate3d(0, -' + -(-tmpChangeTop - page_height / 4)/(page_height / 4) * 100 / 10 + '%, 0)',
                        'transform': 'translate3d(0, -' + -(-tmpChangeTop - page_height / 4)/(page_height / 4) * 100 / 10 + '%, 0)'
                    });
                }

                if (-tmpChangeTop > page_height / 4 && -tmpChangeTop < page_height / 3) {
                    $('.J_xc1_i1').eq(1).css({
                        'opacity': (-tmpChangeTop - page_height / 4)/(page_height / 4) * 3.33,
                        '-webkit-transform': 'translate3d(0, ' + (10 - (-tmpChangeTop - page_height / 4)/(page_height / 4) * 100 / 10 * 3.33) + '%, 0)',
                        'transform': 'translate3d(0, ' + (10 - (-tmpChangeTop - page_height / 4)/(page_height / 4) * 100 / 10 * 3.33) + '%, 0)'
                    });
                    $('.J_xc1_i2').eq(1).css({
                        'opacity': (-tmpChangeTop - page_height / 4)/(page_height / 4) * 3.33,
                        '-webkit-transform': 'translate3d(0, ' + (10 - (-tmpChangeTop - page_height / 4)/(page_height / 4) * 100 / 10 * 3.33) + '%, 0)',
                        'transform': 'translate3d(0, ' + (10 - (-tmpChangeTop - page_height / 4)/(page_height / 4) * 100 / 10 * 3.33) + '%, 0)'
                    });
                }
                if (-tmpChangeTop > page_height / 4 && -tmpChangeTop < page_height / 2) {
                    $('#J_sec4_rw').css({
                        '-webkit-transform': 'translate3d(0, -' + (100 - (-tmpChangeTop - page_height / 4)/(page_height / 4) * 100) + '%, 0)',
                        'transform': 'translate3d(0, -' + (100 - (-tmpChangeTop - page_height / 4)/(page_height / 4) * 100) + '%, 0)'
                    });
                }

                if (-tmpChangeTop > page_height / 1.8 && -tmpChangeTop < page_height / 1.3) {
                    $('#J_sec4_hf1').css({
                        '-webkit-transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 1.8)/(page_height / 1.8) * 770) + '%, 0, 0)',
                        'transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 1.8)/(page_height / 1.8) * 770) + '%, 0, 0)'
                    });
                }
                if (-tmpChangeTop > page_height / 1.6 && -tmpChangeTop < page_height / 1.2) {
                    $('#J_sec4_hf2').css({
                        '-webkit-transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 1.6)/(page_height / 1.6) * 700) + '%, 0, 0)',
                        'transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 1.6)/(page_height / 1.6) * 700) + '%, 0, 0)'
                    });
                }
                if (-tmpChangeTop > page_height / 1.6 && -tmpChangeTop < page_height / 1.1) {
                    $('#J_sec4_hf3').css({
                        '-webkit-transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 1.6)/(page_height / 1.6) * 300) + '%, 0, 0)',
                        'transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 1.6)/(page_height / 1.6) * 300) + '%, 0, 0)'
                    });
                }

                if (-tmpChangeTop > page_height / 1.2 && -tmpChangeTop < page_height / 1.1) {
                    $('#J_sec5_title').css({
                        '-webkit-transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 1.2)/(page_height / 1.2) * 1100) + '%, 0, 0)',
                        'transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 1.2)/(page_height / 1.2) * 1100) + '%, 0, 0)'
                    });

                    $('#J_sec5_cont1').css({
                        '-webkit-transform': 'translate3d(' + (100 - (-tmpChangeTop - page_height / 1.2)/(page_height / 1.2) * 1100) + '%, 0, 0)',
                        'transform': 'translate3d(' + (100 - (-tmpChangeTop - page_height / 1.2)/(page_height / 1.2) * 1100) + '%, 0, 0)'
                    });
                }
                if (-tmpChangeTop > page_height / 1.1) {
                    $('#J_sec5_cont2').css({
                        'opacity': (-tmpChangeTop - page_height / 1.1)/(page_height / 1.1) * 10
                    });
                    $('#J_sec5_cont3').css({
                        'opacity': (-tmpChangeTop - page_height / 1.1)/(page_height / 1.1) * 10
                    });
                }

                $('#J_main').css({
                    '-webkit-transform': 'translate3d(0, ' + changeTop + 'px, 0)',
                    'transform': 'translate3d(0, ' + changeTop + 'px, 0)'
                });
            },
            page6: function () {
                var tmpChangeTop = changeTop;
                section_obj.each(function () {
                    var index = section_obj.index(this);
                    if (index < 5) {
                        if (index === 0 || index === 1 || index === 7) {
                            tmpChangeTop = tmpChangeTop + win_height;
                        } else {
                            tmpChangeTop = tmpChangeTop + $(this).height();
                        }
                    }
                });
                var page_height = section_obj.eq(5).height();

                if (-tmpChangeTop < page_height / 5) {
                    $('#J_sec5_rw').css({
                        '-webkit-transform': 'translate3d(0, -' + (-(-tmpChangeTop - page_height / 5)/(page_height / 5) * 100) + '%, 0)',
                        'transform': 'translate3d(0, -' + (-(-tmpChangeTop - page_height / 5)/(page_height / 5) * 100) + '%, 0)'
                    });
                }

                if (-tmpChangeTop > page_height / 3 && -tmpChangeTop < page_height / 2) {
                    $('#J_sec5_hf1').css({
                        '-webkit-transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 3)/(page_height / 3) * 200) + '%, 0, 0)',
                        'transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 3)/(page_height / 3) * 200) + '%, 0, 0)'
                    });
                }
                if (-tmpChangeTop > page_height / 2 && -tmpChangeTop < page_height / 1.5) {
                    $('#J_sec5_hf2').css({
                        '-webkit-transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 2)/(page_height / 2) * 700) + '%, 0, 0)',
                        'transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 2)/(page_height / 2) * 700) + '%, 0, 0)'
                    });
                }
                if (-tmpChangeTop > page_height / 2 && -tmpChangeTop < page_height / 1.3) {
                    $('#J_sec5_hf3').css({
                        '-webkit-transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 2)/(page_height / 2) * 300) + '%, 0, 0)',
                        'transform': 'translate3d(-' + (100 - (-tmpChangeTop - page_height / 2)/(page_height / 2) * 300) + '%, 0, 0)'
                    });
                }

                if (-tmpChangeTop > page_height / 1.5 && -tmpChangeTop < page_height / 1.2) {
                    $('#J_sec6_title').css({
                        '-webkit-transform': 'translate3d(-' + (200 - (-tmpChangeTop - page_height / 2)/(page_height / 2) * 300) + '%, 0, 0)',
                        'transform': 'translate3d(-' + (200 - (-tmpChangeTop - page_height / 2)/(page_height / 2) * 300) + '%, 0, 0)'
                    });
                    $('#J_sec6_cont1').css({
                        '-webkit-transform': 'scale(' + (1 + (-tmpChangeTop - page_height / 1.2)/(page_height / 1.2) * 5) + ', ' + (1 + (-tmpChangeTop - page_height / 1.2)/(page_height / 1.2) * 5) + ')',
                        'transform': 'scale(' + (1 + (-tmpChangeTop - page_height / 1.2)/(page_height / 1.2) * 5) + ', ' + (1 + (-tmpChangeTop - page_height / 1.2)/(page_height / 1.2) * 5) + ')'
                    });
                    $('#J_sec6_cont2').css({
                        'opacity': 1 + (-tmpChangeTop - page_height / 1.2)/(page_height / 1.2) * 5
                    });
                }

                if (-tmpChangeTop > page_height / 1.2) {
                    $('#J_sec6_cont3').css({
                        '-webkit-transform': 'translate3d(-' + (300 - (-tmpChangeTop - page_height / 2)/(page_height / 2) * 300) + '%, 0, 0)',
                        'transform': 'translate3d(-' + (300 - (-tmpChangeTop - page_height / 2)/(page_height / 2) * 300) + '%, 0, 0)'
                    });
                }

                $('#J_main').css({
                    '-webkit-transform': 'translate3d(0, ' + changeTop + 'px, 0)',
                    'transform': 'translate3d(0, ' + changeTop + 'px, 0)'
                });
            },
            page7: function () {
                var tmpChangeTop = changeTop;
                section_obj.each(function () {
                    var index = section_obj.index(this);
                    if (index < 6) {
                        if (index === 0 || index === 1 || index === 7) {
                            tmpChangeTop = tmpChangeTop + win_height;
                        } else {
                            tmpChangeTop = tmpChangeTop + $(this).height();
                        }
                    }
                });
                var page_height = section_obj.eq(6).height();

                if (-tmpChangeTop < page_height / 4) {
                    $('#J_sec6_cont4').css({
                        '-webkit-transform': 'translate3d(' + ((-tmpChangeTop - page_height / 4)/(page_height / 4) * 100) + '%, 0, 0)',
                        'transform': 'translate3d(' + ((-tmpChangeTop - page_height / 4)/(page_height / 4) * 100) + '%, 0, 0)'
                    });
                }

                if (-tmpChangeTop < page_height / 3) {
                    $('#J_sec6_cont5').css({
                        '-webkit-transform': 'translate3d(' + ((-tmpChangeTop - page_height / 3)/(page_height / 3) * 100) + '%, 0, 0)',
                        'transform': 'translate3d(' + ((-tmpChangeTop - page_height / 3)/(page_height / 3) * 100) + '%, 0, 0)'
                    });
                }

                if (-tmpChangeTop < page_height / 2) {
                    $('#J_sec6_cont6').css({
                        '-webkit-transform': 'translate3d(' + ((-tmpChangeTop - page_height / 2)/(page_height / 2) * 100) + '%, 0, 0)',
                        'transform': 'translate3d(' + ((-tmpChangeTop - page_height / 2)/(page_height / 2) * 100) + '%, 0, 0)'
                    });
                }

                $('#J_main').css({
                    '-webkit-transform': 'translate3d(0, ' + changeTop + 'px, 0)',
                    'transform': 'translate3d(0, ' + changeTop + 'px, 0)'
                });
            }
        }

        var deng_len = 5;
        var dengi = 0;
        var yun_len = 7;
        var yuni = 0;
        var wjj_len = 7;
        var wjji = 0;
        var zj = 0;
        var zj1 = 0;
        setInterval(function () {
            if (zj === 1) {
                dengi--;
            } else {
                dengi++;
            }
            if (zj1 === 1) {
                yuni--;
                wjji--;
            } else {
                yuni++;
                wjji++;
            }

            if (dengi > 3) {
                zj = 1;
            }
            if (dengi === 0) {
                zj = 0;
            }
            if (yuni > 5) {
                zj1 = 1;
            }
            if (yuni === 0) {
                zj1 = 0;
            }
            if (wjji > 5) {
                zj1 = 1;
            }
            if (wjji === 0) {
                zj1 = 0;
            }

            $('#J_sec6_deng').css({
                'background-position': -dengi*26 + 'px 0'
            });
            $('#J_sec6_yun').css({
                'background-position': -yuni*35 + 'px 0'
            });
            $('#J_sec6_wjj').css({
                'background-position': -wjji*26 + 'px 0'
            });
        }, 300);

        $('#J_sec7_cont').bind('click', function () {
            $('.sec7-cont-main').hide();
            $(this).parent().find('.sec7-cont-main').show();
        });
        $('#J_sec7_cont1').bind('click', function () {
            $('.sec7-cont-main').hide();
            $(this).parent().find('.sec7-cont-main').show();
        });

        $('.J_sec2_jb').bind('click', function () {
            var index = $('.J_sec2_jb').index(this);

            $('.J_sec2_jb_info').hide().eq(index).show();

            return false;
        });
    }


    $(window).bind('resize', function () {
        win_width = $(window).width();
        win_height = $(window).height();

    });
})();
