<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= @$text_legend;?></legend>
        <div class="input_wrapper n40 border">
            <label class="floated"><?= @$text_label_Name; ?></label>
            <input required type="text" name="Name" id="Name" maxlength="40" value="<?= $this->displayValue('Name', $client)?>">
        </div>  
        <div class="input_wrapper n40 border">
            <label class="floated"><?= @$text_label_PhoneNumber; ?></label>
            <input required type="number" name="PhoneNumber" id="PhoneNumber" maxlength="15" value="<?= $this->displayValue('PhoneNumber', $client)?>">
        </div>
        <div class="input_wrapper n40 border">
            <label class="floated"><?= @$text_label_Email; ?></label>
            <input required type="email" name="Email" id="" maxlength="40" value="<?= $this->displayValue('Email', $client)?>">
        </div>   
        <div class="input_wrapper n40 border">
            <label class="floated"><?= @$text_label_Address ?></label>
            <input required type="text" name="Address" id="" maxlength="50" value="<?= $this->displayValue('Address', $client)?>">
        </div>
        
        <input class="no_float" type="submit" name="submit" value="<?= @$text_label_save; ?>">
    </fieldset>
</form>