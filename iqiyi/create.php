<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>爱奇艺</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link type="text/css" href="./styles/style.css" rel="stylesheet">
    <meta name="x5-page-mode" content="app" />
    <meta name="imagemode" content="force" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="browsermode" content="application" />
    <script type="text/javascript">
        (function(){
            var phoneWidth = parseInt(window.screen.width);
            var phoneScale = phoneWidth/640;

            var ua = navigator.userAgent;
            if (/Android (\d+\.\d+)/.test(ua)) {
                document.write('<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">');
            } else {
                document.write('<meta name="viewport" content="width=320, user-scalable=no, target-densitydpi=device-dpi">');
            }
        })();
    </script>
</head>

<body>

<div id="J_upload" class="upload">
    <div class="upload-cont">
        上传你的靓照
        <input type="file" id="J_file">

        <canvas width="308" height="154" id="J_canvas"></canvas>

        <img class="up-cl" src="./images/cl.png">
        <img class="up-move1" src="./images/move1.png">
    </div>

    <div class="upload-txt">
        <input type="text" id="J_name" maxlength="8" placeholder="请输入姓名">
        <p>只能输入汉字和英文，长度不能超过8字符</p>
    </div>

    <div class="upload-radio" id="J_radio">
        姓名
        <span data-val="0" class="cur"><i></i> 男</span>
        <span data-val="1"><i></i> 女</span>
    </div>

    <div class="ani">
        <img class="tv" src="./images/iqiyi.png">
    </div>

    <a href="###" id="J_create" class="create-btn create-btn1"></a>

    <img class="up-hj1" src="./images/hj1.png">
    <img class="up-dp" src="./images/dp.png">
    <img class="up-fdj1" src="./images/fdj1.png">
    <img class="up-yz" src="./images/yz.png">
</div>

<div id="J_loading" class="upload hide">
    <div class="upload-cont upload-cont-loading" id="J_com">
        <p id="J_com_c"></p>
        <span id="J_anl">正在分析测试结果</span>
    </div>

    <div class="ani" style="z-index:10;">
        <img class="tv" src="./images/tv1.png">
    </div>

    <img class="up-xq2" src="./images/xq2.png">
    <img class="up-hj2" src="./images/hj2.png">
    <img class="up-xq3" src="./images/xq3.png">
    <img class="up-fdj2" src="./images/fdj2.png">
</div>

<img class="hide" id="J_img_tmp" src="./images/fdj2.png">

<script type="text/javascript" src="./js/zepto.min.js"></script>
<script type="text/javascript" src="./js/exif.js"></script>
<script type="text/javascript">
    !(function () {
        var sex = 0;
        var imgData = '';
        var orientation = 0;

        var imgList = [
            './images/xq.png',
            './images/xq1.png',
            './images/cl.png',
            './images/dp.png',
            './images/move1.png',
            './images/pen.png',
            './images/yz.png',
            './images/xq2.png',
            './images/movie.png',
        ];
        for (var i = 0; i < imgList.length; i++) {
            var tmpImg = new Image();
            tmpImg.src = imgList[i];
        }

        var wording = [
            [
                '《最好的我们2》男一号确定，男神{%name%}饰演余淮',
                '{%name%}做客爱奇艺《大学生来了》被封新一代国民偶像。',
                '《老九门》观众反响火爆，续集筹备{%name%}将出任男主',
                '惊爆！{%name%}未毕业已成爱奇艺最年轻股东',
                '《姐姐好饿》录制现场，{%name%}被四千年美女表白',
                '《灭罪师》广受好评，幕后英雄{%name%}接受爱奇艺专访',
                '《不良人》续集开拍，新任男主{%name%}到底是何来路',
                '爱奇艺宣布{%name%}成为终身VIP会员',
                '{%name%}取代秀贤仲基成为新晋国民老公',
                '传{%name%}牵手某黄金白富美，惊爆娱乐圈',
                '{%name%}成为爱奇艺影业最新大片男主，即将奔赴奥斯卡',
                '{%name%}打败众多一线明星，签约爱奇艺校招代言人',
                '{%name%}偶滴歌神最终夺魁，惊呆娜姐',
                '今晚21点{%name%}空降爱奇艺泡泡',
                '{%name%}连续一个月稳居爱奇艺泡泡明星排行榜首位'
            ],
            [
                '《最好的我们2》女主角确定，{%name%}饰演耿耿。',
                '爱奇艺年度最美大学生评选{%name%}全票胜出。',
                '{%name%}做客爱奇艺《大学生来了》被封新一代国民女神。',
                '{%name%}击败众多一线明星，成为爱奇艺最受欢迎女主持',
                '女神{%name%}牵手某国民男神被拍，刷爆各大新闻头条',
                '{%name%}携新作《我的朋友陈白露》续集，登上爱奇艺首页',
                '《请回答2017》开拍，{%name%}火速加盟出任女一号',
                '爱奇艺宣布{%name%}成为终身VIP会员',
                '{%name%}签约成为爱奇艺奇秀2017年度主播',
                '{%name%}成为爱奇艺影业最新大片女主，即将奔赴奥斯卡',
                '{%name%}成为爱奇艺最新手游老九门形象代言人',
                '{%name%}偶滴歌神最终夺魁，惊呆娜姐',
                '传{%name%}牵手某钻石王老五，惊爆娱乐圈',
                '校花的贴身高手2热播，{%name%}火速成为新晋宅男女神',
                '{%name%}打败众多一线明星，签约爱奇艺校招代言人',
                '今晚21点{%name%}空降爱奇艺泡泡',
                '{%name%}连续一个月稳居爱奇艺泡泡明星排行榜首位'
            ]
        ];

        $('#J_radio span').click(function () {
            $('#J_radio span').removeClass('cur');
            $(this).addClass('cur');

            sex = $(this).data('val');
        });

        // 上传照片
        $('#J_file').bind('change', function (evt) {
            if (!window.FileReader) {
                return false;
            }

            var files = evt.target.files;

            for (var i = 0, f; f = files[i]; i++) {
                if (!f.type.match('image.*')) {
                    continue;
                }

                var reader_i = new FileReader();

                reader_i.onload = (function (f) {
                    return function (e) {
                        imgData = e.target.result;

                        var img = new Image();
                        img.src = imgData;

                        $('#J_img_tmp').attr('src', imgData);

                        img.onload = function () {
                            EXIF.getData(document.getElementById('J_img_tmp'), function() {
                                orientation = EXIF.getTag(this, 'Orientation');
                            });
                            var ori = {
                                '0': 0,
                                '6': 90,
                                '8': 270,
                                '3': 180
                            };

                            var cav = document.querySelector('#J_canvas');
                            var ctx = cav.getContext("2d");

                            if (orientation == 6 || orientation == 8) {
                                ctx.translate(154, 77);
                                ctx.rotate(ori[orientation]*Math.PI/180);
                                ctx.translate(-77, -154);

                                ctx.drawImage(img, 0, 0, 154, 308);
                            } else {
                                ctx.translate(154, 77);
                                ctx.rotate(ori[orientation]*Math.PI/180);
                                ctx.translate(-154, -77);

                                ctx.drawImage(img, 0, 0, 308, 154);
                            }
                        }
                    };
                })(f);

                reader_i.readAsDataURL(f);
            }
        });

        var loadEd = 0;
        var resData = '';
        $('#J_create').click(function () {
            var name = $('#J_name').val();
            var nameRex = /^[\u4e00-\u9fa5]|[a-zA-Z]+$/i;

            if (name.replace(/\s+/g, '') == '') {
                alert('请输入姓名');
                return false;
            }
            var tmpName = name.replace(/[\u4e00-\u9fa5]/g, '');
            tmpName = tmpName.replace(/[a-zA-Z]/g, '');
            if (tmpName != '') {
                alert('请输入正确的姓名格式');
                return false;
            }
            if (imgData == '') {
                alert('请上传你的靓照');
                return false;
            }

            $('#J_upload').hide();
            $('#J_loading').show();

            $.ajax({
                url: 'save.php',
                type: 'POST',
                data: {
                    imgdata: imgData
                },
                dataType: 'text',
                success: function (data) {
                    resData = data;
                    if (loadEd === 1) {
                        setTimeout(function () {
                            window.location.href = 'share.php?name=' + name + '&img=' + resData + '&sex=' + sex + '&r=' + Math.floor(Math.random() * wording[sex].length);
                        }, 1000);
                        clearTimeout(timer);
                        $('#J_com_c').html('测试完成');
                    } else {
                        loadEd = 1;
                    }
                },
                error: function () {}
            });

            var dot = 1;
            var timer = setInterval(function () {
                var dotC = '';
                for (var i = 0; i < dot; i++) {
                    dotC += '.';
                }
                dot++;
                $('#J_anl').html('正在分析测试结果' + dotC);
                if (dot > 6) {
                    dot = 1;
                }

                $('#J_com_c').html('<img height="76" src="' + imgList[Math.floor(Math.random() * imgList.length)] + '">');
            }, 300);

            setTimeout(function () {
                if (loadEd === 1) {
                    setTimeout(function () {
                        window.location.href = 'share.php?name=' + name + '&img=' + resData + '&sex=' + sex + '&r=' + Math.floor(Math.random()*3);
                    }, 1000);
                    clearTimeout(timer);
                    $('#J_com_c').html('测试完成');
                } else {
                    loadEd = 1;
                }
            }, 3000);

            return false;
        });
    })();
</script>
<script type="text/javascript">
    <?php
        $url = 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        if (!empty($_SERVER['QUERY_STRING'])) {
            $url .= '?' . $_SERVER['QUERY_STRING'];
        }
    ?>
    var share = {
        url        : window.location.href,
        picurl     : 'http://' + window.location.host + "/sh/iqiyi/images/logo.jpg",
        title      : '爱奇艺校招季火爆开幕，造星or招聘？奇艺之旅，要你好看！',
        content    : '爱奇艺校招季火爆开幕，造星or招聘？奇艺之旅，要你好看！',
        appId      : 'wxd03d36913f619f3d',
        timestamp  : '<?php $timer = time();echo $timer;?>',
        nonceStr   : '1234567',
        signature  : '<?php echo sha1('jsapi_ticket='. file_get_contents('token.txt') .'&noncestr=1234567&timestamp='. $timer .'&url='. $url); ?>'
    };
</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
    var wxconf = {
        title: share.title,
        desc: share.content,
        link: encodeURI(share.url),
        imgUrl: share.picurl,
        success: function() {},
        cancel: function() {}
    };

    wx.config({
        debug: false,
        appId: share.appId,
        timestamp: share.timestamp,
        nonceStr: share.nonceStr,
        signature: share.signature,
        jsApiList: [
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo'
        ]
    });

    wx.ready(function() {
        wx_share();
    });

    function wx_share(){
        wx.onMenuShareTimeline(wxconf);
        wx.onMenuShareAppMessage(wxconf);
        wx.onMenuShareQQ(wxconf);
        wx.onMenuShareWeibo(wxconf);
    }
</script>

</body>
</html>
