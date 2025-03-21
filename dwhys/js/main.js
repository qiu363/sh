~(function () {
    // 加载资源
    var resources = [
        './img/logo.png',
        './img/bear.png',
        './img/monkey.png',
        './img/success.png',
        './img/question.png',
        './file/success.mp3',
        './file/again.mp3'
    ]
    var resourcesMap = [
        [
            './img/first/bg.png',
            './img/first/zebra_s.png',
            './img/first/giraffe_s.png',
            './file/answer.mp3',
        ],
        [
            './img/second/bg.png',
            './img/second/fk.png',
            './img/second/zebra_s.png',
            './img/second/cow_s.png',
            './file/second/answer.mp3',
        ],
        [
            './img/third/bg.png',
            './img/third/fk.png',
            './img/third/elephant_s.png',
            './img/third/rhinoceros_s.png',
            './file/third/answer.mp3',
        ],
        [
            './img/fourth/bg.png',
            './img/fourth/fk.png',
            './img/fourth/lion_s.png',
            './img/fourth/tiger_s.png',
            './file/fourth/answer.mp3',
        ]
    ]
    resources = resources.concat(resourcesMap[config.index])
    var resourcesNum = 0
    for (var i = 0; i < resources.length; i++) {
        var img = new Image()
        img.src = resources[i]

        img.onload = function () {
            resourcesNum++
            if (resourcesNum === resources.length) {
                setTimeout(function () {
                    loadingFinish()
                }, 300)
            }

            img = null

            $('#J_percent').html(Math.floor(resourcesNum / resources.length * 100))
        }

        img.onerror = function () {
            resourcesNum++
            if (resourcesNum === resources.length) {
                setTimeout(function () {
                    loadingFinish()
                }, 300)
            }

            img = null

            $('#J_percent').html(Math.floor(resourcesNum / resources.length * 100))
        }
    }

    function loadingFinish() {
        $('#J_loading').hide()
        $('#J_content').css({
            display: 'block'
        })

        $('#J_answer')[0].play()
    }

    var isStart = false
    // 防止音频播放失败无法触发答题
    setTimeout(function () {
        isStart = true
    }, 1000 * 12)
    // 开场白结束
    $('#J_answer').bind('ended', function () {
        $('#J_toy').removeClass('toy-ani')

        // 动物提示
        $('.J_shadow').each(function (idx) {
            var that = $(this)
            setTimeout(function () {
                that.addClass('animate-heartBeat animate-animated')

                setTimeout(function () {
                    that.removeClass('animate-heartBeat animate-animated')
                }, 1000)
            }, 1000 * idx)
        })

        setTimeout(function () {
            isStart = true
        }, 1000 * $('.J_shadow').length)
    })

    $('#J_shadow_m').on('click', '.J_shadow', function () {
        if (!isStart) {
            return false
        }

        var type = $(this).attr('data-type')
        if (type === '1') {
            $('#J_success').css({
                display: 'flex',
                display: '-webkit-flex'
            })
            $('#J_question').hide()

            setTimeout(function () {
                $('#J_success .success-cont').addClass('animate-animated animate-bounceInDown')
            }, 20)

            // TODO 调用客户端
            // bridge('next', '111')
            // 测试流程
            setTimeout(function () {
                window.location.href = './video/video'+ (config.index + 2) +'.html'
            }, 3000)

            $('#J_right')[0].play()
        } else {
            var that = $(this)
            that.addClass('animate-animated animate-headShake')
            setTimeout(function () {
                that.removeClass('animate-animated animate-headShake')
            }, 1000)

            $('#J_error')[0].play()
        }
    })

    $('#J_return').click(function () {
        window.location.href = './video/video'+ (config.index + 2) +'.html'
    })

    var winWidth = $(window).width()
    var winHeight = $(window).height()
    function fitScreen() {
        if (winWidth < winHeight) {
            var m = (winHeight - winWidth) / 2
            $('#J_container').css({
                width: winHeight,
                height: winWidth,
                margin: m + 'px 0 0 -' + m + 'px',
                transform: 'rotate(90deg)',
                '-webkit-transform': 'rotate(90deg)'
            })
        } else {
            $('#J_container').css({
                width: winWidth,
                height: winHeight,
                margin: 0,
                transform: 'rotate(0)',
                '-webkit-transform': 'rotate(0)'
            })
        }
    }
    fitScreen()

    $(window).resize(function () {
        winWidth = $(window).width()
        winHeight = $(window).height()

        fitScreen()
    })

    $(window).bind('orientationchange', function () {
        if (window.orientation === 180 || window.orientation === 0) {
            $('#J_tips').css({
                display: 'flex',
                display: '-webkit-flex'
            })
        }
        if (window.orientation === 90 || window.orientation === -90) {
            $('#J_tips').css({
                display: 'none'
            })
        }
    })

    // 手机关闭旋转屏幕无法触发 orientationChange 事件
    window.addEventListener('deviceorientation', orientationListener, false)
    window.addEventListener('devicemotion', orientationListener, false)

    function orientationListener(event){
        var gamma = Math.round(event.gamma)
        var beta = Math.round(event.beta)

        if (beta && gamma) {
            if ((beta < 20 && beta > -20) && (gamma > 20 || gamma < -20)) {
                $('#J_tips').css({
                    display: 'none'
                })
            } else {
                $('#J_tips').css({
                    display: 'flex',
                    display: '-webkit-flex'
                })
            }
        }
    }

    // 客户端桥接
    function bridge(method, params) {
        var ua = window.navigator.userAgent

        try {
            if (ua.indexOf("iPhone") > -1 || ua.indexOf("iOS") > -1) {
                res = window.webkit.messageHandlers[method].postMessage(params)
            }
            if (ua.indexOf("Android") > -1 || ua.indexOf("Linux") > -1) {
                if (params) {
                    res = method(params)
                } else {
                    res = method()
                }
            }

            return res
        } catch (e) {
            alert('客户端调用失败')

            return false
        }
    }

    $('body').bind('touchmove', function (e) {
        e.preventDefault()
    })
})()
