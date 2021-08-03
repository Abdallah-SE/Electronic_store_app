<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= @$text_legend;?></legend>
        <div class="input_wrapper n100 padding">
            <label class="floated"><?= @$text_label_group_title; ?></label>
            <input required type="text" name="GroupName" id="GroupName" value="<?= $group->GroupName;?>" maxlength="30">
        </div>
        <div class="input_wrapper_other">
            <label><?= @$text_label_privilege;?></label>
            <?php if($privileges !== FALSE):foreach ($privileges as $privilege): ?>
            <label class="checkbox block">
                <input type="checkbox" name="privileges[]" id="privileges" <?= in_array($privilege->PrivilegeID, $groupPrivileges)? 'checked' : ''; ?> value="<?= $privilege->PrivilegeID;?>">
                <div class="checkbox_button"></div>
                <span><?= $privilege->PrivilegeTitle;?></span>
            </label>
            <?php endforeach; endif; ?>
        </div>
        <input class="no_float" type="submit" name="submit" value="<?= @$text_label_save ?>">
    </fieldset>
</form>