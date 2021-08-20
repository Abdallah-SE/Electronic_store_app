<form autocomplete="off" class="appForm clearfix" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend><?= @$text_legend;?></legend>
        <div class="input_wrapper n50 border">
            <label class="floated"><?= @$text_label_Name; ?></label>
            <input required type="text" name="Name" id="Name" maxlength="50" value="<?= $this->displayValue('Name')?>">
        </div>  
        <div class="input_wrapper n50 border">
            <label class="floated"><?= @$text_label_Image; ?></label>
            <input required type="file" name="Image" id="Image" maxlength="30" accept="image/*" value="<?= $this->displayValue('Image')?>">
        </div>
        <div class="input_wrapper n50 border">
            <label class="floated"><?= @$text_label_Quantity; ?></label>
            <input required type="number" name="Quantity" id="" min="1" step="1" value="<?= $this->displayValue('Quantity')?>">
        </div>   
        <div class="input_wrapper n50 border">
            <label class="floated"><?= @$text_label_BuyPrice ?></label>
            <input required type="number" name="BuyPrice" id="" min="1" step="1" value="<?= $this->displayValue('BuyPrice')?>">
        </div>
        <div class="input_wrapper n50 border padding">
            <select required name="CategoryID" id="groupName">
                <option value=""><?= @$text_label_CategoryID;?></option>
                <?php if(FALSE !==$categories) : foreach ($categories as $category):?>
                <option value="<?= $category->CategoryID;?>"><?= $category->Name;?></option>
                <?php endforeach; endif; ?>
            </select>
        </div>
        <div class="input_wrapper n50 border">
            <label class="floated"><?= @$text_label_SellPrice; ?></label>
            <input required type="number" name="SellPrice" id="" min="1" step="1" value="<?= $this->displayValue('SellPrice')?>">
        </div>
        <div class="input_wrapper_other n50 select border">
            <select required name="Unit" id="CategoryID">
                <option value=""><?= @$text_label_Unit;?></option>
                <option value="1"><?= @$text_unit_1;?></option>
                <option value="2"><?= @$text_unit_2;?></option>
                <option value="3"><?= @$text_unit_3;?></option>
                <option value="4"><?= @$text_unit_4;?></option>
                <option value="5"><?= @$text_unit_5;?></option>
            </select>
        </div>
        <input class="no_float" type="submit" name="submit" value="<?= @$text_label_save; ?>">
    </fieldset>
</form>