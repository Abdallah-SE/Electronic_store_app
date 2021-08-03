<div class="container">
    <a href="/privileges/create" class="button"><i class="fa fa-plus"></i> <?= @$add_new_privilege; ?></a>
    <table id="myTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?= @$privilege_title; ?></th>
                    <th><?= @$text_user_table_actions_privilege; ?></th>
                </tr>
            </thead> 
            <tbody>
            <?php if(false !== $privileges): foreach ($privileges as $privilege): ?>
                <tr>
                    <td><?= $privilege->PrivilegeTitle; ?></td>
                    <td>
                        <a href="/privileges/edit/<?= $privilege->PrivilegeID; ?>"><i class="fa fa-edit"></i></a>
                        <a href="/privileges/delete/<?= $privilege->PrivilegeID; ?>" onclick="if(!confirm('<?= @$text_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
</div>