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
        $this->encrName_getExten();
    }
    // get the extension and encrypt name of the file
    public function encrName_getExten(){
        preg_match_all('/([a-z]{1,4})$/i', $this->name, $match);
        $this->file_extension = strtolower($match[0][0]);
        $name =  md5(strtolower(md5($this->name) .  time()));
        $this->name = $name;
        return  $name;
    }
    public function checkExtension(){
        return in_array($this->file_extension, $this->extension_list,  $strict = false); 
    }
    // check the size of the file before  upload it
    public function checkFileSize(){
        preg_match_all('/(\d+)([MG])$/i', UPLOAD_FILE_SIZE_ALLOWED, $ma);
        $maxFileSize = $ma[1][0];
        $unitFile = $ma[2][0];
        $conFileSize = ($unitFile == 'M') ?($this->size / 1024 / 1024) : ($this->size / 1024 / 1024 / 1024);
        $conFileSize = ceil($conFileSize);
        return (bool) $conFileSize <= $maxFileSize;
    }
    public function checkImage(){
        return preg_match('/image/i', $this->type);
    }
    
    // get the file name with it's extension by merge
    public function getFile(){
        $actualName = $this->name . '.' . $this->file_extension;
        return $actualName;
    }
    public function uploadFile(){
        if($this->error !=0){
            throw new \Exception('Error in upload this file please try again!');
        } elseif (!$this->checkExtension()) {
            throw new \Exception ('Not allowed file extension!', E_USER_WARNING);
        }  elseif (!$this->checkFileSize()) {
            throw new \Exception('Size is not allowed', E_USER_ERROR);
        }  else {
            $FilePosition = $this->checkImage()? UPLOAD_MEMORY_IMG : UPLOAD_MEMORY_DOC;
            if(is_writable($FilePosition)){
                move_uploaded_file($this->tmp_name, $FilePosition. DS . $this->getFile());
            }  else {
                throw new \Exception('Folder is not writable!', E_USER_ERROR);
            }
        }
        return $this;
    }
    
    
}