<form autocomplete="off" class="appForm clearfix" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend><?= @$text_legend;?></legend>
        <div class="input_wrapper n100 padding">
            <label class="floated"><?= @$text_label_Name; ?></label>
            <input required type="text" name="Name" id="Name" maxlength="35" value="<?= $this->displayValue('Name', $category)?>">
        </div>   
        <div class="input_wrapper n100">
            <label class="floated" style="bottom: 40px; color:#408eba"><?= @$text_label_Image; ?></label>
            <input  type="file"  name="Image" id="Image" maxlength="30" accept="image/*" value="<?= $this->displayValue('Image', $category)?>">
        </div>
        <?php if($category->Image !== '' && file_exists(UPLOAD_MEMORY_IMG. DS .$category->Image)):?>
        <div class="input_wrapper_other n100">
            <img src="/uploads/img/<?= $category->Image;?>" alt="<?= $category->Name;?>" width="30%"> 
        </div>
        <?php  else:?>
        <div class="input_wrapper_other n100">
            <p class="message t3">Sorry this Category Not have a pic, you can add suitable one?</p>
        </div>
        <?php endif;?>
        <input class="no_float" type="submit" name="submit" value="<?= @$text_label_save ?>">
    </fieldset>
</form>