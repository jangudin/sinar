<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('encrypt_url')) {
    function encrypt_url($string) {
        // Input validation
        if (empty($string)) {
            return '';
        }

        // Convert to string if not already
        $string = (string)$string;

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
        
        try {
            $encrypted = $CI->encryption->encrypt($string);
            if ($encrypted === false) {
                log_message('error', 'Encryption failed for string: ' . substr($string, 0, 32));
                return '';
            }
            
            return strtr(
                base64_encode($encrypted),
                array(
                    '+' => '.',
                    '=' => '-',
                    '/' => '~'
                )
            );
        } catch (Exception $e) {
            log_message('error', 'Encryption exception: ' . $e->getMessage());
            return '';
        }
    }
}

if (!function_exists('decrypt_url')) {
    function decrypt_url($string) {
        // Input validation
        if (empty($string)) {
            return '';
        }

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
        
        try {
            $string = base64_decode(
                strtr(
                    $string,
                    array(
                        '.' => '+',
                        '-' => '=',
                        '~' => '/'
                    )
                )
            );
            
            if ($string === false) {
                log_message('error', 'Base64 decode failed');
                return '';
            }
            
            $decrypted = $CI->encryption->decrypt($string);
            if ($decrypted === false) {
                log_message('error', 'Decryption failed');
                return '';
            }
            
            return $decrypted;
        } catch (Exception $e) {
            log_message('error', 'Decryption exception: ' . $e->getMessage());
            return '';
        }
    }
}