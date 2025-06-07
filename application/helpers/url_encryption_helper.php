<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('encrypt_url')) {
    function encrypt_url($string) {
        $CI =& get_instance();
        // Load encryption library if not already loaded
        if (!isset($CI->encryption)) {
            $CI->load->library('encryption');
        }
        
        // Configure encryption
        $CI->encryption->initialize(
            array(
                'cipher' => 'aes-256',
                'mode' => 'cbc',
                'key' => config_item('encryption_key')
            )
        );
        
        return strtr(
            base64_encode($CI->encryption->encrypt($string)),
            array(
                '+' => '.',
                '=' => '-',
                '/' => '~'
            )
        );
    }
}

if (!function_exists('decrypt_url')) {
    function decrypt_url($string) {
        $CI =& get_instance();
        if (!isset($CI->encryption)) {
            $CI->load->library('encryption');
        }
        
        $CI->encryption->initialize(
            array(
                'cipher' => 'aes-256',
                'mode' => 'cbc',
                'key' => config_item('encryption_key')
            )
        );
        
        $string = base64_decode(strtr(
            $string,
            array(
                '.' => '+',
                '-' => '=',
                '~' => '/'
            )
        ));
        
        return $CI->encryption->decrypt($string);
    }
}