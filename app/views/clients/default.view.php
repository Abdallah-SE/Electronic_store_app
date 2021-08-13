<div class="container">
    <a href="/clients/create" class="button"><i class="fa fa-plus"></i> <?= @$add_new_client ?></a>
    <table id="myTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?= @$text_client_name; ?></th>
                    <th><?= @$text_client_phone; ?></th>
                    <th><?= @$text_client_email; ?></th>
                    <th><?= @$text_client_address; ?></th>
                    <th><?= @$text_client_table_actions; ?></th>
                </tr>
            </thead> 
            <tbody>
            <?php if(false !== $clients): foreach ($clients as $client): ?>
                <tr>
                    <td><?= $client->Name; ?></td>
                    <td><?= $client->PhoneNumber; ?></td>
                    <td><?= $client->Email; ?></td>
                    <td><?= $client->Address; ?></td>
                    <td>
                        <a href="/clients/edit/<?= $client->ClientID ?>"><i class="fa fa-edit"></i></a>
                        <a href="/clients/delete/<?= $client->ClientID ?>" onclick="if(!confirm('<?= @$text_delete_confirm;?>')) return false;"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
</div>