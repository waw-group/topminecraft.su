<?php
class Auth extends Singleton
{
    /**
     * @param int $length
     * @return string
     */
    public function generateSalt($length = 32)
    {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double)microtime()*1000000);
        $i = 1;
        $salt = '' ;
        
        while ($i <= $length)
        {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $salt .= $tmp;
            $i++;
        }
        return $salt;
    }
    /***
     * @param $salt
     * @param $password
     * @return string
     */
    public function MakeHash($salt,$password) {
        $hash = sha1(md5(md5($salt.md5($password))));
        $hash = md5(substr($hash,-5));
        return $hash;
    }

    /**
     * @param $hash
     * @param $salt
     * @param $password
     * @return bool
     */
    public function CheckPassword($hash,$salt,$password) {
        $mkhash = $this->MakeHash($salt,$password);
        $return = strcmp($hash,$mkhash) == 0 ? true : false;
        return $return;
    }

    /**
     * @param $str
     * @return string
     */
    public function EscapeStr($str) {
        return trim(htmlspecialchars($str));
    }

    /**
     * @param $name
     * @return bool
     */
    public function RemoveCookie($name) 
    { 
        unset($_COOKIE[$name]); 
        return setcookie($name, NULL, -1); 
    }
}