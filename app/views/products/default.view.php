<div class="container">
    <a href="/products/create" class="button"><i class="fa fa-plus"></i> <?= @$add_new_product; ?></a>
    <table id="myTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?= @$text_table_name; ?></th>
                    <th><?= @$text_table_category; ?></th>
                    <th><?= @$text_table_quantity; ?></th>
                    <th><?= @$text_table_buyprice; ?></th>
                    <th><?= @$text_table_unit; ?></th>
                    <th><?= @$text_table_sellprice; ?></th>
                    <th><?= @$text_product_table_actions; ?></th>
                </tr>
            </thead>
            <tbody>
            <?php if(false !== $products): foreach ($products as $product): ?>
                <tr>
                    <td><?= $product->Name; ?></td>
                    <td><?= $product->CategoryID; ?></td>
                    <td><?= $product->Quantity; ?></td>
                    <td><?= $product->BuyPrice; ?></td>
                    <td><?= $product->Unit; ?></td>
                    <td><?= $product->SellPrice; ?></td>
                    <td>
                        <a href="/prodcuts/edit/<?= $user->UserID ?>"><i class="fa fa-edit"></i></a>
                        <a href="/prodcuts/delete/<?= $user->UserID ?>" onclick="if(!confirm('<?= @$text_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
</div>