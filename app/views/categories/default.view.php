<div class="container">
    <a href="/categories/create" class="button"><i class="fa fa-plus"></i> <?= @$add_new_category; ?></a>
    <table id="myTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?= @$text_category_name; ?></th>
                    <th><?= @$text_category_table_actions ?></th>
                </tr>
            </thead> 
            <tbody>
            <?php if(false !== $categories): foreach ($categories as $category): ?>
                <tr>
                    <td><?= $category->Name ?></td>
                    <td>
                        <a href="/categories/edit/<?= $category->CategoryID ?>"><i class="fa fa-edit"></i></a>
                        <a href="/categories/delete/<?= $category->CategoryID ?>" onclick="if(!confirm('<?= @$text_delete_confirm; ?>')) return false;"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
</div>