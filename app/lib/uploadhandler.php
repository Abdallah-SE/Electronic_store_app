<?php
namespace PHPMVC\LIB;

class UploadHandler {
    public $name;
    public $type;
    public $tmp_name;
    public $error;
    public $size;
    private $file_extension;
    
    private $extension_list = [
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
    public function encrName_getExten(){
        preg_match_all('/([a-z]{1,4})$/i', $this->name, $match);
        $this->file_extension = strtolower($match[0][0]);
        return md5(strtolower(md5($this->name . time())));
    }
    public function checkExtension(){
        $this->encrName_getExten();
        return in_array($this->file_extension, $this->extension_list,  $strict = false); 
    }
    // check the size of the file before  upload it
    public function checkFileSize(){
        preg_match_all('/(\d+)([MG])$/i', UPLOAD_FILE_SIZE_ALLOWED, $ma);
        $maxFileSize = $ma[1][0];
        $unitFile = $ma[2][0];
        $conFileSize = ($unitFile == 'M') ?($this->size / 1024 / 1024) : ($this->size / 1024 / 1024 / 1024);
        $conFileSize = ceil($conFileSize);
        return (bool)$conFileSize <= $maxFileSize;
    }
    public function checkImage(){
        return preg_match('/image/i', $this->type);
    }
    
    // get the file name with it's extension by merge
    public function getFile(){
        return $this->name . '.' . $this->file_extension;
    }
    public function uploadFile(){
        if($this->error !=0){
            trigger_error ('Error in upload this file please try again!', E_USER_WARNING);
        } elseif (!$this->checkExtension()) {
            trigger_error ('Not allowed file extension!', E_USER_WARNING);
        }  elseif (!$this->checkFileSize()) {
            trigger_error('Size is not allowed', E_USER_ERROR);
        }  else {
            if($this->checkImage()){
                move_uploaded_file($this->tmp_name, UPLOAD_MEMORY_IMG. DS . $this->getFile());
            }  else {
                move_uploaded_file($this->tmp_name, UPLOAD_MEMORY_DOC. DS . $this->getFile());
            }
            echo 'The File is be uploaded correctly, please continue';
        }
        return $this;
    }
    
    
}