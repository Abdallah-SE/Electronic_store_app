<?php
namespace PHPMVC\LIB;
class Language {
    private $list_words = array();

    public function changeLangaugeDefault(){
        $this->DEFAULT_LANGUAGE = 'en';
    }
    public function load($path){
        $defaultLanguage = DEFAULT_LANGUAGE;
        if(isset($_SESSION['lang'])) {
            $defaultLanguage = $_SESSION['lang'];
            //var_dump($defaultLanguage);
        } 
        $pathReturned = explode('.', $path);
        $laguageFile = LANGUAGE_PATH . $defaultLanguage .DS. $pathReturned[0] .DS. $pathReturned[1]. '.lang.php';
        if(file_exists($laguageFile)){
            require $laguageFile;
            if(is_array($_)&& !empty($_)){
                foreach ($_ as $key_ => $value) {
                    $this->list_words [$key_] = $value;
                }
            }  else {
                trigger_error('Sorry the file is empty or not an array', E_USER_WARNING);
            }
        }  else {
            trigger_error('Sorry the path is not found', E_USER_WARNING); 
        }
    }
    public function getListsOfWords() {
        return $this->list_words;
    }
    public function get($key){
        if(array_key_exists($key, $this->list_words)){
            return $this->list_words[$key];
        }
    }
    public function prepareKey($key, $phrase){
        if(array_key_exists($key, $this->list_words)){
            array_unshift($phrase, $this->list_words[$key]);
            return call_user_func_array('sprintf', $phrase);
    }

}
}