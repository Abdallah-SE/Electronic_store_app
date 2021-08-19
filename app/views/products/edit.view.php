<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= @$text_legend;?></legend>
        <div class="input_wrapper n40 border">
            <label class="floated"><?= @$text_label_phone; ?></label>
            <input required type="number" name="phone" id="" maxlength="15" value="<?= $this->displayValue('PhoneNumber', $user)?>">
        </div>
        <div class="input_wrapper_other n40 select border">
            <select required name="GroupID" id="groupName">
                <option value=""><?= @$text_label_GroupID;?></option>
                <?php if(FALSE !==$groups) : foreach ($groups as $group):?>
                <option value="<?= $group->GroupID;?>" <?= $this->displaySelected('GroupID', $group->GroupID, $user);?>><?= $group->GroupName;?></option>
                <?php endforeach; endif; ?>
            </select>
        </div>
        <input class="no_float" type="submit" name="submit" value="<?= @$text_label_save; ?>">
    </fieldset>
</form>