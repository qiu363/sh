<div class="header">
    <div class="header-inner">
        <h1>
            <a class="logo" href="<?php echo $base_url; ?>">
                <img src="<?php echo $base_url; ?>static/img/logo.png" alt="乐透社">
            </a>
        </h1>
        <ul class="nav">
            <li>
                <a <?php if ($page == 'index') {?>class="on"<?php } ?>href="<?php echo $base_url; ?>" class="selected">首页</a>
            </li>
            <li>
                <a <?php if ($page == 'user') {?>class="on"<?php } ?>href="<?php echo $base_url; ?>user/" class="selected">用户</a>
            </li>
            <li>
                <a <?php if ($page == 'account') {?>class="on"<?php } ?>href="<?php echo $base_url; ?>account/" class="selected">账户</a>
            </li>
            <li>
                <a <?php if ($page == 'betting') {?>class="on"<?php } ?>href="<?php echo $base_url; ?>betting/" class="selected">投注</a>
            </li>
            <li>
                <a <?php if ($page == 'report') {?>class="on"<?php } ?>href="<?php echo $base_url; ?>report/" class="selected">报表</a>
            </li>
            <li>
                <a <?php if ($page == 'team') {?>class="on"<?php } ?>href="<?php echo $base_url; ?>team/" class="selected">团队</a>
            </li>
            <li>
                <a <?php if ($page == 'activity') {?>class="on"<?php } ?>href="<?php echo $base_url; ?>activity/" class="selected">活动</a>
            </li>
        </ul>
        <div class="header-login">
            <a href="<?php echo $base_url; ?>account/sigin/" class="btn">登录</a>
            <a href="<?php echo $base_url; ?>account/sigin/" class="btn btn-zc">注册</a>
        </div>
    </div>
</div>