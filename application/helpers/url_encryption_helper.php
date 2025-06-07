<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('encrypt_url')) {
    function encrypt_url($string) {
        // Force string conversion first
        $string = (string)$string;
        
        // Early return for empty values
        if (trim($string) === '') {
            log_message('error', 'encrypt_url received empty value');
            return '';
        }

        $CI =& get_instance();
        
        if (!isset($CI->encryption)) {
            $CI->load->library('encryption');
            
            // Set encryption configuration once
            $CI->encryption->initialize([
                'cipher' => 'aes-128',
                'mode' => 'cbc',
                'key' => config_item('encryption_key'),
                'raw_data' => false
            ]);
        }

        try {
            // Ensure string is properly encoded
            $string = base64_encode($string);
            
            // Encrypt the encoded string
            $encrypted = $CI->encryption->encrypt($string);
            
            if ($encrypted !== false) {
                // Make URL safe
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
        // Force string conversion first
        $string = (string)$string;
        
        // Early return for empty values
        if (trim($string) === '') {
            return '';
        }

        $CI =& get_instance();
        
        if (!isset($CI->encryption)) {
            $CI->load->library('encryption');
            
            // Set encryption configuration once
            $CI->encryption->initialize([
                'cipher' => 'aes-128',
                'mode' => 'cbc',
                'key' => config_item('encryption_key'),
                'raw_data' => false
            ]);
        }

        try {
            // Restore base64 string
            $string = strtr($string, '._-', '+/=');
            
            // Decode URL safe string
            $decoded = base64_decode($string);
            if ($decoded === false) {
                return '';
            }
            
            // Decrypt and decode
            $decrypted = $CI->encryption->decrypt($decoded);
            if ($decrypted !== false) {
                return base64_decode($decrypted);
            }
        } catch (Exception $e) {
            log_message('error', 'Decryption failed: ' . $e->getMessage());
        }

        return '';
    }
}