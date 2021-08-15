<form autocomplete="off" class="appForm clearfix" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend><?= @$text_legend;?></legend>
        <div class="input_wrapper n100 padding">
            <label><?= @$text_label_Name; ?></label>
            <input required type="text" name="Name" id="Name" maxlength="30">
        </div>   
        <div class="input_wrapper n100">
            <label class="floated" style="bottom: 40px; color:#408eba"><?= @$text_label_Image; ?></label>
            <input  type="file"  name="Image" id="Image" maxlength="30" accept="image/*">
        </div>
        
        <input class="no_float" type="submit" name="submit" value="<?= @$text_label_save ?>">
    </fieldset>
</form>