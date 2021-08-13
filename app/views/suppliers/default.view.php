<div class="container">
    <a href="/suppliers/create" class="button"><i class="fa fa-plus"></i> <?= @$add_new_supplier ?></a>
    <table id="myTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?= @$text_supplier_name; ?></th>
                    <th><?= @$text_supplier_phone; ?></th>
                    <th><?= @$text_supplier_email; ?></th>
                    <th><?= @$text_supplier_address; ?></th>
                    <th><?= @$text_supplier_table_actions; ?></th>
                </tr>
            </thead> 
            <tbody>
            <?php if(false !== $suppliers): foreach ($suppliers as $supplier): ?>
                <tr>
                    <td><?= $supplier->Name; ?></td>
                    <td><?= $supplier->PhoneNumber; ?></td>
                    <td><?= $supplier->Email; ?></td>
                    <td><?= $supplier->Address; ?></td>
                    <td>
                        <a href="/suppliers/edit/<?= $supplier->SupplierID ?>"><i class="fa fa-edit"></i></a>
                        <a href="/suppliers/delete/<?= $supplier->SupplierID ?>" onclick="if(!confirm('<?= @$text_delete_confirm;?>')) return false;"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
</div>