<div class="container">
    <a href="/usersgroups/create" class="button"><i class="fa fa-plus"></i> <?= @$add_new_group ?></a>
    <table id="myTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?= @$text_user_table_group ?></th>
                    <th><?= @$text_user_table_actions_group ?></th>
                </tr>
            </thead> 
            <tbody>
            <?php if(false !== $groups): foreach ($groups as $group): ?>
                <tr>
                    <td><?= $group->GroupName ?></td>
                    <td>
                        <a href="/usersgroups/edit/<?= $group->GroupID ?>"><i class="fa fa-edit"></i></a>
                        <a href="/usersgroups/delete/<?= $group->GroupID ?>" onclick="if(!confirm('<?= @$text_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
</div>