<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('encrypt_url')) {
    function encrypt_url($string) {
        // Input validation and sanitization
        if ($string === null || $string === '') {
            return '';
        }

        // Force string type and trim
        $string = trim((string)$string);
        if (empty($string)) {
            return '';
        }

        $CI =& get_instance();
        
        if (!isset($CI->encryption)) {
            $CI->load->library('encryption');
            
            // Set encryption configuration
            $config = array(
                'cipher' => 'aes-256',
                'mode' => 'cbc',
                'key' => config_item('encryption_key'),
                'raw_data' => true
            );
            
            $CI->encryption->initialize($config);
        }

        try {
            $encrypted = $CI->encryption->encrypt($string);
            if ($encrypted !== false) {
                return strtr(base64_encode($encrypted), '+/=', '._-');
            }
        } catch (Exception $e) {
            log_message('error', 'Encryption failed: ' . $e->getMessage());
        }

        return '';
    }
}

if (!function_exists('decrypt_url')) {
    function decrypt_url($string) {
        // Input validation and sanitization
        if ($string === null || $string === '') {
            return '';
        }

        // Force string type and trim
        $string = trim((string)$string);
        if (empty($string)) {
            return '';
        }

        $CI =& get_instance();
        
        if (!isset($CI->encryption)) {
            $CI->load->library('encryption');
            
            // Set encryption configuration
            $config = array(
                'cipher' => 'aes-256',
                'mode' => 'cbc',
                'key' => config_item('encryption_key'),
                'raw_data' => true
            );
            
            $CI->encryption->initialize($config);
        }

        try {
            $decoded = base64_decode(strtr($string, '._-', '+/='));
            if ($decoded !== false) {
                $decrypted = $CI->encryption->decrypt($decoded);
                if ($decrypted !== false) {
                    return $decrypted;
                }
            }
        } catch (Exception $e) {
            log_message('error', 'Decryption failed: ' . $e->getMessage());
        }

        return '';
    }
}