<?php 

    //裁剪图片
    $source_image = imagecreatefromjpeg('a.jpeg');

    $cropped_image = imagecreatetruecolor(535, 535);

    imagecopy($cropped_image, $source_image, -52, -130, 0, 0, 587, 665);

    //合并图片
    $cover_image = imagecreatefrompng('cover.png');

    imagealphablending($cropped_image, true);

    imagecopy($cropped_image, $cover_image, 0, 0, 0, 0, 535, 535);

    header('Content-Type: image/jpeg');
    imagejpeg($cropped_image);

    imagedestroy($source_image);
    imagedestroy($cropped_image);
    imagedestroy($cover_image);