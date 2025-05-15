<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

function encrypt_url($string) {
    $output = false;

    // Baca konfigurasi dari file security.ini
    $security = parse_ini_file('security.ini');

    $secret_key = $security['encryption_key'];
    $secret_iv = $security['iv'];
    $encrypt_method = $security['encryption_mechanism'];

    // Hash
    $key = hash('sha256', $secret_key);

    // IV untuk AES-256-CBC (16 bytes)
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    // Enkripsi string
    $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($result);

    return $output;
}

function decrypt_url($string) {
    $output = false;

    // Baca konfigurasi dari file security.ini
    $security = parse_ini_file('security.ini');

    $secret_key = $security['encryption_key'];
    $secret_iv = $security['iv'];
    $encrypt_method = $security['encryption_mechanism'];

    // Hash
    $key = hash('sha256', $secret_key);

    // IV untuk AES-256-CBC (16 bytes)
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    // Dekripsi string
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

    return $output;
}
