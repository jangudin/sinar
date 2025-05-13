<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function custom_encrypt($data, $key) {
    $cipher = 'AES-256-CBC';
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext = openssl_encrypt($data, $cipher, $key, 0, $iv);
    if ($ciphertext === false) {
        return false;
    }
    // Gabungkan IV dan ciphertext untuk penyimpanan
    return base64_encode($iv . $ciphertext);
}

function custom_decrypt($data, $key) {
    $cipher = 'AES-256-CBC';
    $data = base64_decode($data);
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = substr($data, 0, $ivlen);
    $ciphertext = substr($data, $ivlen);
    return openssl_decrypt($ciphertext, $cipher, $key, 0, $iv);
}
