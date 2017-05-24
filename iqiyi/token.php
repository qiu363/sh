<?php

    $access_token = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxd03d36913f619f3d&secret=39cfd57f892db72903299f9f13f8327a');

    $access_token = @json_decode($access_token, true);

    $token = file_get_contents('https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=' . $access_token['access_token'] . '&type=jsapi');

    $token = json_decode($token, true);

    file_put_contents('token.txt', $token['ticket']);

?>
