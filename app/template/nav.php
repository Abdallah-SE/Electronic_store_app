<nav class="main_navigation">
    <div class="employee_info">
        <div class="profile_picture">
            <img src="/img/user.png" alt="User Profile Picture">
        </div>
        <span class="name">عبدالله</span>
        <span class="privilege"><?= @$text_app_manger;?></span>
    </div>
    <ul class="app_navigation">
        <li class="<?= $this->matchUrl('/') === true? 'selected': ''?>"><a href="/"><i class="fa fa-dashboard"></i><?= @$text_general_statistics;?></a></li>
        <li class="submenu" >
            <a href="javascript:;"><i class="fa fa-user"></i> <?= @$text_users ?></a>
            <ul>
                <li><a href="/users"><i class="fa fa-user-circle"></i> <?= $text_users_list ?></a></li>
                <li><a href="/usersgroups"><i class="fa fa-group"></i> <?= $text_users_groups ?></a></li>
                <li><a href="/privileges"><i class="fa fa-key"></i> <?= $text_users_privileges ?></a></li>
            </ul>
        </li>        <li><a href="/clients"><i class="fa fa-user-plus"></i><?= @$text_clients;?></a></li>
        <li class="submenu">
            <a href="javascript:;"><i class="fa fa-database"></i><?= @$text_store;?></a>
            <ul>
                <li>
                    <a href="/categories"><i class="fa fa-shopping-basket"></i>
                        <?= @$text_store_categories?>
                    </a>
                </li>   
                <li>
                    <a href="/prodcuts"><i class="fa fa-shopping-bag"></i>
                        <?= @$text_products?>
                    </a>
                </li>
            </ul>
        </li>
        <li  class="submenu">
            <a href="javascript:;"><i class="fa fa-credit-card"></i><?= @$text_transactions;?></a>
            <ul>
                <li>
                    <a href="/purchases"><i class="fa fa-shopping-basket"></i>
                        <?= @$text_transactions_purchases?>
                    </a>
                </li>   
                <li>
                    <a href="/sales"><i class="fa fa-shopping-bag"></i>
                        <?= @$text_transactions_sales?>
                    </a>
                </li>
            </ul>
        </li>
        <li class="<?= $this->matchUrl('/suppliers') === true ? ' selected' : '' ?>"><a href="/suppliers"><i class="fa fa-object-group"></i><?= @$text_suppliers;?></a></li>
        <li class="submenu">
            <a href="javascript:;"><i class="fa fa-money"></i><?= @$text_expensives;?></a>
            <ul>
                <li>
                    <a href="/dailyexpenses"><i class="fa fa-shopping-basket"></i>
                        <?= @$text_expensives_daily?>
                    </a>
                </li>   
                <li>
                    <a href="/expensescategories"><i class="fa fa-shopping-bag"></i>
                        <?= @$text_expensives_categories?>
                    </a>
                </li>
            </ul>
        </li>
        <li class="<?= $this->matchUrl('/reports') === true ? ' selected' : '' ?>"><a href="/reports"><i class="fa fa-bar-chart"></i><?= @$text_reports;?></a></li>
        <li><a href="/notifications"><i class="fa fa-bell"></i><?= @$text_notifications;?></a></li>
        
        <li><a href="/language"><i class="fa fa-language"></i><?= @$text_change_lang;echo" "?><?= $_SESSION['lang'] == 'ar' ? ' To EN ' : ' To AR ' ?></a></li>
    </ul>
</nav>
<div class="action_view">
    <?php $messages = $this->messeger->getMessages(); if(!empty($messages)): foreach ($messages as $message) :?>
    <p class="message t<?= $message[1]?>">
        <?= $message[0]?><a href="" class="closeBtn"><i class="fa fa-times-circle"></i></a>
    </p>
    <?php  endforeach; endif;?>