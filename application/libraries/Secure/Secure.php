<?php

class Secure
{
    /**
     * Algorithm Method
     */
    private $algorithm;

    /**
     * Secret Key
     */
    private $secret;

    /**
     * Non-NULL Initialization Vector for encryption
     */
    private $iv;

    public function __construct()
    {
        $this->algorithm = "AES-256-CBC";
        $this->secret = "thisIsSecretKey";
        $this->iv = "1234567891011122"; // 16 digits
    }

    /**
     * Encrypt some string 
     */
    public function encrypt($data)
    {
        $encrypt = openssl_encrypt($data, $this->algorithm, $this->secret, 0, $this->iv);

        return base64_encode($encrypt);
    }

    /**
     * Decrypt some string
     */
    public function decrypt($data)
    {
        $data = base64_decode($data);
        
        return openssl_decrypt($data, $this->algorithm, $this->secret, 0, $this->iv);
    }
}