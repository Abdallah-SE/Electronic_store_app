<form autocomplete="off" class="appForm clearfix" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend><?= @$text_legend;?></legend>
        <div class="input_wrapper n50 border">
            <label class="floated"><?= @$text_label_Name; ?></label>
            <input required type="text" name="Name" id="Name" maxlength="50" value="<?= $this->displayValue('Name', $product)?>">
        </div>  
        <div class="input_wrapper n50 border">
            <label class="floated"><?= @$text_label_Image; ?></label>
            <input required type="file" name="Image" id="Image" maxlength="30" accept="image/*" value="<?= $this->displayValue('Image', $product)?>">
        </div>
        <div class="input_wrapper n50 border">
            <label class="floated"><?= @$text_label_Quantity; ?></label>
            <input required type="number" name="Quantity" id="" min="1" step="1" value="<?= $this->displayValue('Quantity', $product)?>">
        </div>   
        <div class="input_wrapper n50 border">
            <label class="floated"><?= @$text_label_BuyPrice ?></label>
            <input required type="number" name="BuyPrice" id="" min="1" step="1" value="<?= $this->displayValue('BuyPrice', $product)?>">
        </div>
        <div class="input_wrapper n50 border padding">
            <select required name="CategoryID" id="groupName">
                <option value=""><?= @$text_label_CategoryID;?></option>
                <?php if(FALSE !==$categories) : foreach ($categories as $category):?>
                <option value="<?= $category->CategoryID;?>" <?= $this->displaySelected('CategoryID', $category->CategoryID, $product);?>><?= $category->Name;?></option>
                <?php endforeach; endif; ?>
            </select>
        </div>
        <div class="input_wrapper n50 border">
            <label class="floated"><?= @$text_label_SellPrice; ?></label>
            <input required type="number" name="SellPrice" id="" min="1" step="1" value="<?= $this->displayValue('SellPrice', $product)?>">
        </div>
        <div class="input_wrapper_other n50 select border">
            <select required name="Unit" id="CategoryID">
                <option value=""><?= @$text_label_Unit;?></option>
                <option value="1" <?= $this->displaySelected('Unit',1 , $product);?> ><?= @$text_unit_1;?></option>
                <option value="2" <?= $this->displaySelected('Unit',2 , $product);?> ><?= @$text_unit_2;?></option>
                <option value="3" <?= $this->displaySelected('Unit',3 , $product);?> ><?= @$text_unit_3;?></option>
                <option value="4" <?= $this->displaySelected('Unit',4 , $product);?> ><?= @$text_unit_4;?></option>
                <option value="5" <?= $this->displaySelected('Unit',5 , $product);?> ><?= @$text_unit_5;?></option>
            </select>
        </div>
        <?php if($product->Image !== '' && file_exists(UPLOAD_MEMORY_IMG. DS .$product->Image)):?>
        <div class="input_wrapper_other n100">
            <img src="/uploads/img/<?= $product->Image;?>" alt="<?= $product->Name;?>" width="30%"> 
        </div>
        <?php  else:?>
        <div class="input_wrapper_other n100">
            <p class="message t3">Sorry this Category Not have a pic, you can add suitable one?</p>
        </div>
        <?php endif;?>
        <input class="no_float" type="submit" name="submit" value="<?= @$text_label_save; ?>">
    </fieldset>
</form>