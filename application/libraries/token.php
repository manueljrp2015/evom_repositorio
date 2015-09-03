<?php

class token {

    function generateToken($email = null) {
        if ($email == null)
        {
            return FALSE;
        }
        $email = explode("@", $email);
        $tokenrand = '';
        $string = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'Q', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'W', 'X', 'Y', 'Z');
        $number = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
        for ($i = 0; $i <= 5; $i++)
        {
            $rand = rand(0, 24);
            $randn = rand(0, 9);
            $tokenrand .= $number[$randn];
            $tokenrand .= $string[$rand];
        }
        return base64_encode(strtoupper($email[0]) . ':' . $tokenrand);
    }
    
    function generateId() {
        $tokenrand = '';
        $number = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
        for ($i = 0; $i <= 1; $i++)
        {
            $randn = rand(0, 9);
            $tokenrand .= $number[$randn];
        }
        return strtoupper('SKY' . date('ymdhms') . $tokenrand);
    }

}
