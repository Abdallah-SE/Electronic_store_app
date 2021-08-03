<header class="main">
    <a href="javascript:;" data-menu-status="false" class="menu_switch"><i class="fa fa-bars"></i></a>
    <h1><?=@$text_dashboard;?>
        <?php if (isset($title)):{?>
         <?php   echo '>>'.$title;}?>
       <?php endif; ?>
    </h1>
    <div class="user_menu_container">
        <a href="javascript:;" class="language_switch user">
            <span><?= @$text_welcome ?> <?php echo 'Abdallah';?></span>
            <i class="material-icons">keyboard_arrow_down</i>
        </a>
        <ul class="user_menu">
            <li><a href="/"><i class="fa fa-user"></i><?= @$text_profile ?></a></li>
            <li><a href="/"><i class="fa fa-key"></i><?= @$text_change_password ?></a></li>
            <li><a href="/"><i class="fa fa-gear"></i><?= @$text_account_settings ?></a></li>
            <li><a href="/authenticating/logout"><i class="fa fa-sign-out"></i><?= @$text_logout ?></a></li>
        </ul>
    </div>
    <a href="/messages" class="language_switch"><i class="fa fa-envelope"></i></a>
    <a href="javascript:;" class="language_switch notifications"><i class="fa fa-bell"></i></a>
    <a href="/language" class="language_switch"><i class="fa fa-language"></i><?php echo" "?><?= $_SESSION['lang'] == 'ar' ? ' (الانجليزيه)English' : ' (Arabic) العربيه' ?></a>

</header>