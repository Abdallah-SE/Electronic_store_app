<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= @$text_legend;?></legend>
        <div class="input_wrapper n80 border">
            <label class="floated"><?= @$text_label_userName; ?></label>
            <input required type="text" name="userName" id="userName" maxlength="15" value="<?= $this->displayValue('userName')?>">
        </div>  
        <div class="input_wrapper n40 border">
            <label class="floated"><?= @$text_label_password; ?></label>
            <input required type="password" name="password" id="" maxlength="60" value="<?= $this->displayValue('password')?>">
        </div>
        <div class="input_wrapper n40 border">
            <label class="floated"><?= @$text_label_cPassword; ?></label>
            <input required type="password" name="cPassword" id="" maxlength="60" value="<?= $this->displayValue('cPassword')?>">
        </div>   
        <div class="input_wrapper n40 border">
            <label class="floated"><?= @$text_label_email ?></label>
            <input required type="email" name="email" id="" maxlength="50" value="<?= $this->displayValue('email')?>">
        </div>
        <div class="input_wrapper n40 border">
            <label class="floated"><?= @$text_label_cEmail; ?></label>
            <input required type="email" name="cEmail" id="Privilege" maxlength="50" value="<?= $this->displayValue('cEmail')?>">
        </div>
        <div class="input_wrapper n40 border">
            <label class="floated"><?= @$text_label_phone; ?></label>
            <input required type="number" name="phone" id="" maxlength="15" value="<?= $this->displayValue('phone')?>">
        </div>
        <div class="input_wrapper_other n40 select border">
            <select required name="GroupID" id="groupName">
                <option value=""><?= @$text_label_GroupID;?></option>
                <?php if(FALSE !==$groups) : foreach ($groups as $group):?>
                <option value="<?= $group->GroupID;?>"><?= $group->GroupName;?></option>
                <?php endforeach; endif; ?>
            </select>
        </div>
        <input class="no_float" type="submit" name="submit" value="<?= @$text_label_save; ?>">
    </fieldset>
</form>