<div class="container">
    <a href="/users/create" class="button"><i class="fa fa-plus"></i> <?= @$add_new_user ?></a>
    <table id="myTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?= @$text_user_table_name; ?></th>
                    <th><?= @$text_user_table_group; ?></th>
                    <th><?= @$text_user_table_email; ?></th>
                    <th><?= @$text_user_table_subscription_date; ?></th>
                    <th><?= @$text_user_table_last_login; ?></th>
                    <th><?= @$text_user_table_actions; ?></th>
                </tr>
            </thead> 
            <tbody>
            <?php if(false !== $users): foreach ($users as $user): ?>
                <tr>
                    <td><?= $user->Username; ?></td>
                    <td><?= $user->GroupName; ?></td>
                    <td><?= $user->Email; ?></td>
                    <td><?= $user->SubscriptionDate; ?></td>
                    <td><?= $user->LastLogin; ?></td>
                    <td>
                        <a href="/users/edit/<?= $user->UserID ?>"><i class="fa fa-edit"></i></a>
                        <a href="/users/delete/<?= $user->UserID ?>" onclick="if(!confirm('<?= @$text_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
</div>