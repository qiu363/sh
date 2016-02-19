<?php
	if (isset($_GET['name'])) {
		$name = $_GET['name'];
	} else {
		header("Location: draw.html");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>为青春加FUN - 安利</title>
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
    <style type="text/css">
        body {
            background: #442a2b url(./images/draw_bg.jpg) 0 0 no-repeat;
            background-size: 100% 100%;
        }
    </style>
</head>

<body>

<div class="draw-canvas">
    <img src="./upload/<?php echo $name; ?>.png">
</div>

<div class="draw-btn draw-btn-share">
    <a href="###" class="btn" id="J_share">分享</a>
    <a href="draw.html" class="btn">再做一张</a>
</div>

</body>
</html>