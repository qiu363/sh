<?php
//require_once "../../jssdk.php";
//$appId = "wxc3b7846562a4325b";/*咱们自己的appid*/
//$appSecret = "51931f4317bbff42dc01dacb9b2293c9";/*咱们自己的app secret*/
//$jssdk = new JSSDK($appId, $appSecret); 
//$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>搞定室友</title>
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
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link type="text/css" href="./styles/style.css" rel="stylesheet">
    <meta name="x5-page-mode" content="app" />
    <meta name="imagemode" content="force" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="browsermode" content="application" />
</head>

<body>

<!-- 加载页 -->
<section class="loading" id="J_game_loading">
    <div class="loading-main">
        <div class="loading-lamp-line">
            <div class="loading-lamp"></div>
            <div class="loading-cont">
                <img src="./images/loading_cont.png">
            </div>
        </div>
    </div>
</section>

<!-- 游戏封面 -->
<section class="game-cover hide" id="J_game_cover">
    <div class="game-cover-boy J_sel_sex" data-sex="boy"></div>
    <div class="game-cover-boy-arrow"></div>
    <div class="game-cover-girl J_sel_sex" data-sex="girl"></div>
    <div class="game-cover-girl-arrow"></div>
    <div class="game-cover-logo"></div>
    <div class="game-cover-wave-top">
        <div class="game-cover-wave-t-l"></div>
        <!-- <div class="game-cover-wave-t-r"></div> -->
    </div>
    <div class="game-cover-lamp"></div>
    <div class="game-cover-title"></div>
    <div class="game-cover-wave-bot"><p></p></div>

    <div class="game-info hide" id="J_game_info">
        <div class="game-info-cont">
            <input type="text" id="J_user_name">
        </div>
        <div class="game-info-btn" id="J_game_info_btn"></div>
    </div>

    <div class="bg hide" id="J_bg"></div>
</section>

<!-- 游戏中 -->
<section class="game hide" id="J_game">
    <div class="game-title">
        <div class="game-question" id="J_game_title">
            <img src="./images/blank.gif">
            <span></span>
        </div>
    </div>
    <div class="goods1 J_goods" data-ans=""></div>
    <div class="goods2 J_goods" data-ans=""></div>
    <div class="goods3 J_goods" data-ans=""></div>
    <div class="goods4 J_goods" data-ans="l1"></div>
    <div class="goods5 J_goods" data-ans="y1"></div>
    <div class="goods6 J_goods" data-ans="c1"></div>
    <div class="goods7 J_goods" data-ans="s1"></div>
    <div class="goods8 J_goods" data-ans="e1"></div>
    <div class="goods9 J_goods" data-ans="b1"></div>
    <div class="goods10 J_goods" data-ans="x1"></div>
    <div class="goods11 J_goods" data-ans="t1"></div>
    <div class="goods12 J_goods" data-ans="c2"></div>
    <div class="goods13 J_goods" data-ans="z1"></div>
    <div class="goods14 J_goods" data-ans="q1"></div>
    <div class="goods15 J_goods" data-ans=""></div>
    <div class="goods16 J_goods" data-ans="cu1"></div>
    <div class="goods17 J_goods" data-ans="m1"></div>
    <div class="goods18 J_goods" data-ans="q2"></div>
    <div class="goods19 J_goods" data-ans="z2"></div>
    <div class="goods20 J_goods" data-ans="s2"></div>
    <div class="goods21 J_goods" data-ans="f1"></div>
    <div class="goods22 J_goods" data-ans="h1"></div>
    <div class="goods23 J_goods" data-ans="qz1"></div>
    <div class="goods24 J_goods" data-ans="c3"></div>
    <div class="goods25 J_goods" data-ans="qz2"></div>
    <div class="goods26 J_goods" data-ans="b2"></div>
    <div class="goods27 J_goods" data-ans="z3"></div>
    <div class="goods28 J_goods" data-ans="z4"></div>
    <div class="goods29 J_goods" data-ans="q3"></div>
    <div class="goods30 J_goods" data-ans="bo1"></div>
    <div class="goods31 J_goods" data-ans="qz3"></div>
    <div class="goods32 J_goods" data-ans="cl1"></div>
    <div class="goods33 J_goods" data-ans="k1"></div>
    <div class="goods34 J_goods" data-ans=""></div>
    <div class="goods35 J_goods" data-ans="x1"></div>
    <div class="goods36 J_goods" data-ans="cl2"></div>
    <div class="goods37 J_goods" data-ans="bo2"></div>
    <div class="game-time" id="J_game_time">
        <span class="game-ready"></span>
        <span class="game-timer-bell"></span>
    </div>
</section>

<!-- 游戏结束 -->
<section class="game-end game-end-fail hide" id="J_game_end">
    <div class="game-end-wrap">
        <div class="game-end-cont"></div>
    </div>
</section>

<!-- 游戏分享 -->
<section class="game-share hide" id="J_game_share">
    <div class="game-share-logo"></div>
    <div class="game-share-tips">
        <div class="game-share-t" id="J_share"></div>
        <div class="game-share-boy"></div>
    </div>
    <div class="game-replay">
        <div class="game-share-r" id="J_replay"></div>
        <div class="game-share-girl"></div>
    </div>
    <div class="game-share-bottom"></div>
    <div class="game-share-t-lamp">
        <div class="game-share-lamp" id="J_game_share_lamp"></div>
    </div>
</section>

<audio autoplay="autoplay" loop="loop">
    <source src="./data/Bgm.ogg" type="audio/ogg">
    <source src="./data/Bgm.mp3" type="audio/mpeg">
    Your browser does not support the audio tag.
</audio>

<audio id="J_right">
    <source src="./data/right.ogg" type="audio/ogg">
    <source src="./data/right.mp3" type="audio/mpeg">
    Your browser does not support the audio tag.
</audio>

<audio id="J_error">
    <source src="./data/error.ogg" type="audio/ogg">
    <source src="./data/error.mp3" type="audio/mpeg">
    Your browser does not support the audio tag.
</audio>

<audio loop="loop" id="J_bell">
    <source src="./data/bell.ogg" type="audio/ogg">
    <source src="./data/bell.mp3" type="audio/mpeg">
    Your browser does not support the audio tag.
</audio>

<audio id="J_boom">
    <source src="./data/boom.ogg" type="audio/ogg">
    <source src="./data/boom.mp3" type="audio/mpeg">
    Your browser does not support the audio tag.
</audio>

<audio id="J_xu">
    <source src="./data/xu.ogg" type="audio/ogg">
    <source src="./data/xu.mp3" type="audio/mpeg">
    Your browser does not support the audio tag.
</audio>

<audio id="J_gz">
    <source src="./data/gz.ogg" type="audio/ogg">
    <source src="./data/gz.mp3" type="audio/mpeg">
    Your browser does not support the audio tag.
</audio>

<script type="text/javascript" src="./js/zepto.min.js"></script>
<script type="text/javascript" charset="utf-8" >
//微信分享内容
var shareData={
    title:'看脸的世界也不能缺少实力，《一年级》等你不服来辩！',
    desc:'看脸的世界也不能缺少实力，《一年级》等你不服来辩！',
    link:'http://wx.shuangqiao.com/bojia/gdsy/index.php',
    imgUrl:'http://wx.shuangqiao.com/bojia/gdsy/images/wx_share_icon.jpg'
};
$(document).trigger('shareDataChanged');
</script>
<script type="text/javascript">
    ;(function () {
        //用户输入名字
        window.userName = "";
        //预加载图片
        var first_img = [
            "./images/bell.png",
            "./images/boy_arrow.png",
            "./images/boy.png",
            "./images/game_boy_bg.jpg",
            "./images/game_title.png",
            "./images/girl_arrow.png",
            "./images/girl.png",
            "./images/index_title.png",
            "./images/index_bg.jpg",
            "./images/logo.png",
            "./images/ready.png",
            "./images/time_up.png",
            "./images/wave.png",
            "./images/game_girl_bg.jpg",
            "./images/question/question_1.png",
            "./images/question/question_2_b.png",
            "./images/question/question_3.png",
            "./images/question/question_4.png",
            "./images/question/question_5_b.png",
            "./images/question/question_6.png",
            "./images/question/question_7.png",
            "./images/question/question_8_b.png",
            "./images/question/question_9.png",
            "./images/question/question_10.png",
            "./images/question/question_2_g.png",
            "./images/question/question_5_g.png",
            "./images/question/question_8_g.png",
            "./images/info_girl.png",
            "./images/info_boy.png",
            "./images/info_start.png",
            "./images/info_bg.jpg"
        ];
        for(var i = 9; i < 36; i++){
            first_img.push("./images/goods/"+ i +".png");
            first_img.push("./images/goods/"+ i +"_h.png");
        }
        var first_loading_num = 0;
        for (var i = 0; i < first_img.length; i++){
            var img = new Image();
            img.src = first_img[i];

            img.onload = function(){
                first_loading_num++;
                if (first_loading_num == first_img.length) {
                    setTimeout(function () {
                        $("#J_game_cover").show();
                        $("#J_game_loading").hide();
                    }, 500);
                }
            };
        }

        var sex = "";
        var cur_tm = "";
        var cur_ans = "";
        var tm = {
            boy: [
                "question_1",
                "question_2_b",
                "question_3",
                "question_4",
                "question_5_b",
                "question_6",
                "question_7",
                "question_8_b",
                "question_9",
                "question_10"
            ],
            girl: [
                "question_1",
                "question_2_g",
                "question_3",
                "question_4",
                "question_5_g",
                "question_6",
                "question_7",
                "question_8_g",
                "question_9",
                "question_10"
            ]
        };
        var anwser = {
            boy: [
                ["c1", "c2", "c3"],
                ["cl1", "cl2", "h1"],
                ["y1", "q1", "q2"],
                ["b1", "b2", "x1"],
                ["s1", "s2", "k1"],
                ["t1", "e1"],
                ["l1", "cu1"],
                ["bo1", "bo2"],
                ["z1", "z2", "z3", "z4"],
                ["m1"]
            ],
            girl: [
                ["c1", "c2", "c3"],
                ["qz1", "qz2", "qz3", "h1"],
                ["y1", "q1", "q2"],
                ["b1", "b2", "x1"],
                ["s1", "s2", "f1"],
                ["t1", "e1"],
                ["l1", "cu1"],
                ["bo1"],
                ["z1", "z2", "z3", "z4"],
                ["m1"]
            ]
        };

        var game = {
            tm_i: 0,
            tm_num: 6,
            _time: 30,
            sex: "",
            cru_ans_a: "",
            cur_ans: "",
            cur_tm: "",
            _timer: "",
            init: function () {
                $("#J_game_end").removeClass("game-end-fail");
                game.tm_i = 0;
                game.cur_ans = "";
                game.time = game._time;

                game.cru_ans_a = game.clone(anwser[game.sex]);
                game.cur_tm = game.clone(tm[game.sex]);

                game.sex == "girl" ? $("#J_game").addClass("game-girl") : $("#J_game").removeClass("game-girl");

                $("#J_game_time").html('<span class="game-ready"></span>');
                $("#J_game_title").parent().css({
                    "-webkit-transform": "translate3d(0, 0, 0)"
                });
                setTimeout(function () {
                    $(".game-ready").css({
                        "-webkit-transform" : "scale(1.8, 1.8)",
                        "opacity": 0
                    });
                }, 10);
                setTimeout(function () {
                    var sw = Math.floor(game.time / 10);
                    var sec = game.time % 10;
                    var b_pos = "style='background-position:0 -"+ sw*25 +"px'";
                    var b_pos_sec = "style='background-position:0 -"+ sec*25 +"px'";
                    $("#J_game_time").html('<span class="game-timer" id="J_timer"><em '+ b_pos +'></em><em '+ b_pos_sec +'></em></span>');

                    game.timer();
                    game.next();
                }, 500);
                
            },
            timer: function () {
                game._timer = setTimeout(function () {
                    game.time--;

                    if (game.time < 0) {
                        $("#J_game_time").html('<span class="game-timer-over"></span>');

                        setTimeout(function () {
                             $(".game-timer-over").css({
                                "-webkit-transform" : "scale(1.2, 1.2)"
                            });
                        }, 20);
                        
                        $("#J_bell")[0].currentTime = 0;
                        $("#J_bell")[0].pause();
                        
                        $("#J_boom")[0].play();
                        setTimeout(function () {
                            $("#J_boom")[0].currentTime = 0;
                            $("#J_boom")[0].pause();

                            game.end(false);
                        }, 1000);
                    }else if (game.time <= 3) {
                        $("#J_game_time").html('<span class="game-timer-bell"></span>');

                        if (game.time == 3) {
                            $("#J_bell")[0].play();
                        }

                        game.timer();
                    } else {
                        var sec = game.time % 10;
                        var sw = Math.floor(game.time / 10);

                        $("#J_timer").find("em").eq(0).css({
                                "background-position" : "0 -"+ sw*25 +"px"
                            });

                        $("#J_timer").find("em").eq(1).css({
                            "background-position" : "0 -"+ sec*25 +"px"
                        });

                        game.timer();
                    }
                }, 1000);
            },
            end: function (res) {
                if (res) {
                    $("#J_game_end").addClass();
                    $("#J_gz")[0].play();

                    shareData.title = "恭喜" + userName + "成功入住上海戏剧学院一年级新生宿舍，高颜值同学值得你拥有！";
                    $(document).trigger('shareDataChanged');
                } else {
                    $("#J_game_end").addClass("game-end-fail");
                    $("#J_xu")[0].play();

                    shareData.title = "too young too simple！再挑战一次就能成功入住上海戏剧学院一年级新生宿舍咯。";
                    $(document).trigger('shareDataChanged');
                }

                $("#J_game_end").show();
                $("#J_game").hide();

                $(".J_goods").each(function () {
                    var index = $(".J_goods").index(this);
                    $(this).removeClass("goods"+ (index + 1) +"-cur");
                });
                $("#J_game_title").css({
                    "opacity": 0,
                    "-webkit-transform": "translate3d(-10px, 0, 0)"
                });
                $("#J_game_title").parent().css({
                    "-webkit-transform": "translate3d(-100%, 0, 0)"
                });

                setTimeout(function () {
                    $("#J_game_end").hide();
                    $("#J_game_share").show();
                }, 3000);
            },
            next: function () {
                if (game.tm_i >= game.tm_num) {
                    clearTimeout(game._timer);
                    game.end(true);
                    return false;
                }

                var random = Math.floor(Math.random() * game.cur_tm.length);
                var question = game.cur_tm[random];

                game.cur_tm[random] = game.cur_tm[game.cur_tm.length - 1];
                game.cur_tm.pop();

                game.cur_ans = game.clone(game.cru_ans_a[random]);

                game.cru_ans_a[random] = game.cru_ans_a[game.cru_ans_a.length - 1];
                game.cru_ans_a.pop();

                game.tm_i++;

                $("#J_game_title").css({
                    "opacity": 0,
                    "-webkit-transform": "translate3d(-10px, 0, 0)"
                });
                setTimeout(function(){
                    $("#J_game_title").find("img").attr("src", "./images/question/"+ question +".png");
                    $("#J_game_title").css({
                        "opacity": 1,
                        "-webkit-transform": "translate3d(0, 0, 0)"
                    }).find("span").html(game.tm_i);
                }, 40);
            },
            in_array: function (str, arr) {
                for(var i = 0; i < arr.length; i++){
                    if (str == arr[i]) {
                        arr[i] = arr[arr.length - 1]
                        arr.pop();

                        return true;
                    }
                }
                return false;
            },
            clone: function (obj) {
                var new_obj = [];

                for(var i = 0; i < obj.length; i++){
                    if (typeof obj[i] == "object") {
                        game.clone(obj[i]);
                    }

                    new_obj[i] = obj[i];
                }

                return new_obj;
            }
        };

        $(".J_sel_sex").bind("tap", function () {
            game.sex = $(this).attr("data-sex");

            if (game.sex == "girl") {
                $("#J_game_info").addClass("game-info-girl");
            } else {
                $("#J_game_info").removeClass("game-info-girl");
            }

            $("#J_game_info").show();
            $("#J_bg").show();
        });

        $("#J_game_info_btn").bind("tap", function () {
            if ($("#J_user_name").val() == "") {
                alert("请输入名字");
                $("#J_user_name").focus();
                return false;
            }

            $("#J_user_name").blur();
            userName = $("#J_user_name").val();

            $("#J_game").show();
            $("#J_game_cover").hide();

            $("#J_game_info").hide();
            $("#J_bg").hide();

            game.init();
        });

        $(".J_goods").bind("tap", function () {
            var _this = $(this);
            var index = $(".J_goods").index(this);
            var ans = $(this).attr("data-ans");

            if (ans == "") {
                return false;
            }

            if (game.in_array(ans, game.cur_ans)) {
                $(this).addClass("goods"+ (index + 1) +"-cur");

                $("#J_right")[0].currentTime = 0;
                $("#J_right")[0].play();
            } else {
                $(this).addClass("goods-error");

                setTimeout(function () {
                    _this.removeClass("goods-error");
                }, 500);

                $("#J_error")[0].currentTime = 0;
                $("#J_error")[0].play();
            }

            if (game.cur_ans.length == 0) {
                game.next();
            }
        });

        $("#J_share").bind("tap", function () {
            $("#J_game_share_lamp").addClass("game-share-lamp-light");
        });
        $("#J_replay").bind("tap", function () {
            $("#J_game_cover").show();
            $("#J_game_share").hide();

            $("#J_game_share_lamp").removeClass("game-share-lamp-light");
            
            shareData.title = "看脸的世界也不能缺少实力，《一年级》等你不服来辩！";
            $(document).trigger('shareDataChanged');
        });

        $("body").bind("touchmove", function(e){
            e.preventDefault();
        });

    })();
</script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript" charset="utf-8">
wx.config({
    // debug:true,
    appId: '<?php //echo $signPackage["appId"];?>',
    timestamp: '<?php //echo $signPackage["timestamp"];?>',
    nonceStr: '<?php //echo $signPackage["nonceStr"];?>',
    signature: '<?php //echo $signPackage["signature"];?>',
    jsApiList: [
        'checkJsApi',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'onMenuShareQZone',
        'hideMenuItems',
        'showMenuItems',
        'hideAllNonBaseMenuItem',
        'showAllNonBaseMenuItem',
        'translateVoice',
        'startRecord',
        'stopRecord',
        'onRecordEnd',
        'playVoice',
        'pauseVoice',
        'stopVoice',
        'uploadVoice',
        'downloadVoice',
        'chooseImage',
        'previewImage',
        'uploadImage',
        'downloadImage',
        'getNetworkType',
        'openLocation',
        'getLocation',
        'hideOptionMenu',
        'showOptionMenu',
        'closeWindow',
        'scanQRCode',
        'chooseWXPay',
        'openProductSpecificView',
        'addCard',
        'chooseCard',
        'openCard'
    ]
});
wx.ready(function() {
    wx.onMenuShareAppMessage({
        title: "搞定室友",
        desc: "看脸的世界也不能缺少实力，《一年级》等你不服来辩！",
        link: shareData.link,
        imgUrl: shareData.imgUrl,
        success: function() {},
        cancel: function() {}
    });
    wx.onMenuShareTimeline({
        title: shareData.title,
        link: shareData.link,
        imgUrl: shareData.imgUrl,
        success: function() {},
        cancel: function() {}
    });
});
$(document).on('shareDataChanged',function(){
    wx.ready(function() {
        wx.onMenuShareAppMessage({
            title: "搞定室友",
            desc: "看脸的世界也不能缺少实力，《一年级》等你不服来辩！",
            link: shareData.link,
            imgUrl: shareData.imgUrl,
            success: function() {},
            cancel: function() {}
        });
        wx.onMenuShareTimeline({
            title: shareData.title,
            link: shareData.link,
            imgUrl: shareData.imgUrl,
            success: function() {},
            cancel: function() {}
        });
    });
});
</script>

</body>
</html>