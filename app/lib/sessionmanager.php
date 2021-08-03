<?php

namespace PHPMVC\LIB;


class SessionManager extends \SessionHandler{
    private $sessionName = 'SESSAPP';
    private $sessionMaxLifeTime = 0;
    private $sessionSSL = false;
    private $sessionHTTPOnly = true;
    private $sessionPath = '/';
    private $sessionDomain = '.mvcapplication.dev';
    private $sessionSavePath = SESSION_NAME_PATH;
    
    private $sessionCipherAlgo = 'aes-128-cbc';
    private $sessionDisjunctionFlags = OPENSSL_RAW_DATA;
    private $sessionPrivateKey = 'asd123442021';
    
    private $ttl = 60;
    public function __construct(){
        ini_set('session_use_cookies', 1);
        ini_set('session_use_only_cookies', 1);
        ini_set('session_use_trans_sid', 0);
        ini_set('session.save_handler', 'files');
        
        session_name($this->sessionName);
        session_save_path($this->sessionSavePath);
        
        session_set_cookie_params($this->sessionMaxLifeTime,  $this->sessionPath,  $this->sessionDomain, $this->sessionSSL, $this->sessionHTTPOnly);
        
        session_set_save_handler($this, true);
    }
    
    public function start(){
        if('' === session_id()){
            if(session_start()){
                $this->setSessionStartTime();
                $this->checkValidateSessionTime();
            }
        }
    }
    public function __isset($key){
    return isset($_SESSION[$key])? TRUE : FALSE;
    }

    public function __set($key, $value){
        $_SESSION[$key] = $value ;
    }
    public function __get($key){
        return FALSE !== $_SESSION[$key]? $_SESSION[$key] : FALSE;
    }
    public function __unset($name) {
        unset($_SESSION[$name]);
    }

    private function setSessionStartTime(){
        if(!isset($this->sessionStartTime)){
            $this->sessionStartTime = time();
        }
        return TRUE;
    }
    private function regenerateSessionid(){
        $this->sessionStartTime = time();
        return session_regenerate_id(true);
    }
    public function checkValidateSessionTime(){
        if((time() - $this->sessionStartTime )> $this->ttl * 60){
            $this->regenerateSessionid();
            $this->generateFingerPrint();
        }
        return TRUE;
    }
    private function encryptOpensslfun($message){
        if (in_array($this->sessionCipherAlgo, openssl_get_cipher_methods())){
            $ivlen = openssl_cipher_iv_length($this->sessionCipherAlgo);
            $iv = openssl_random_pseudo_bytes($ivlen);
            $ciphertext = openssl_encrypt($message, $this->sessionCipherAlgo,  $this->sessionPrivateKey,  $this->sessionDisjunctionFlags, $iv);
            return base64_encode($iv.$ciphertext);
        }  
    }
    private function decryptOpensslfun($message){
        $_message = base64_decode($message);
        $ivlen = openssl_cipher_iv_length($cipher = $this->sessionCipherAlgo);
        $ivve = mb_substr($_message, 0, $ivlen, '8bit');
        $cipher_text = mb_substr($_message,$ivlen ,NULL,'8bit');
        $unciphertext = openssl_decrypt($cipher_text,$cipher, $this->sessionPrivateKey,$this->sessionDisjunctionFlags, $ivve);
        return $unciphertext;
    }
   public function read($id)
    {
        $data = parent::read($id);
        if (!$data) {
            return "";
        } else {
            return $this->decryptOpensslfun($data);
        }
    }
    public function write($sid, $sdata){
        $data_ = $this->encryptOpensslfun($sdata);
        return parent::write($sid, $data_);
    }
    
    public function kill(){
        session_unset();
        setcookie($this->sessionName, '', time()-1000, $this->sessionPath, 'phpworld', $this->sessionSSL, $this->sessionHTTPOnly);
        session_destroy();
    }
    private function generateFingerPrint(){
        $useAgentId = $_SERVER['HTTP_USER_AGENT'];
        $sessionId = session_id();
        $ivlen = openssl_cipher_iv_length($cipher = 'aes-128-cbc');
        $this->cipherKey = openssl_random_pseudo_bytes($ivlen);
        $this->fingerPrint = md5($useAgentId.$sessionId.$this->cipherKey);
    }
    public function checkValidFingerPrint(){
        if(!isset($this->fingerPrint)){
            $this->generateFingerPrint();
        }
        $fingerPrint = md5($_SERVER['HTTP_USER_AGENT'].session_id().$this->cipherKey);
        if($fingerPrint === $this->fingerPrint){
            return TRUE;
        }
        return FALSE;
    }
}
