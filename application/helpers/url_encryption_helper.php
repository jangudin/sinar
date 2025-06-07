<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('encrypt_url')) {
    function encrypt_url($string) {
        $CI =& get_instance();
        $CI->load->library('encryption');
        
        return strtr(
            $CI->encryption->encrypt($string),
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
        $CI->load->library('encryption');
        
        $string = strtr(
            $string,
            array(
                '.' => '+',
                '-' => '=',
                '~' => '/'
            )
        );
        
        return $CI->encryption->decrypt($string);
    }
}