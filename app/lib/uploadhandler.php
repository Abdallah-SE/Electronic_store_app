<?php
namespace PHPMVC\LIB;

class UploadHandler {
    public $name;
    public $type;
    public $tmp_name;
    public $error;
    public $size;
    public $file_extension;
    
    public $extension_list = [
        'jpg', 'jpeg', 'png', 'gif', 'psd', 'tiff', 'raw', 'doc', 'docs', 'pdf', 'xls'
    ];

    public function __construct(array $file) {
        $this->name = $file['name'];
        $this->type = $file['type'];
        $this->tmp_name = $file['tmp_name'];
        $this->error = $file['error'];
        $this->size = $file['size'];
    }
    // get the extension and encrypt name of the file
    public function encrName_getExten($name){
        preg_match_all('/([a-z]{1,4})$/i', $name, $match);
        $this->file_extension = $match[0];
        return md5(strtolower(md5($this->name . time())));
    }
    public function checkExtension(){
        return in_array($this->file_extension, $this->extension_list);  
    }
    // check the size of the file before  upload it
    public function checkFileSize(){
        
    }
    
    
}