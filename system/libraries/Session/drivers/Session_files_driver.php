<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CI_Session_files_driver extends CI_Session_driver implements SessionHandlerInterface {

    protected $_save_path;
    protected $_file_handle;
    protected $_file_path;
    protected $_file_new;

    public function open($save_path, $session_name) {
        $this->_config['_sid_length'] = strlen(session_id());
        $this->_config['_sid_regexp'] = '[0-9a-zA-Z,-]{'.$this->_config['_sid_length'].'}';

        $this->_save_path = $save_path;

        return TRUE;
    }

    public function close() {
        if (is_resource($this->_file_handle)) {
            flock($this->_file_handle, LOCK_UN);
            fclose($this->_file_handle);

            $this->_file_handle = $this->_file_path = NULL;
        }

        return TRUE;
    }

    public function read($session_id) {
        if ($this->_file_path === NULL) {
            $this->_file_path = $this->_save_path . DIRECTORY_SEPARATOR . $session_id;
        }

        if (!is_file($this->_file_path)) {
            $this->_file_new = TRUE;
            return '';
        }

        if (($this->_file_handle = fopen($this->_file_path, 'r+b')) === FALSE) {
            return '';
        }

        flock($this->_file_handle, LOCK_EX);
        $this->_file_new = FALSE;

        return (string) fread($this->_file_handle, filesize($this->_file_path));
    }

    public function write($session_id, $session_data) {
        if ($this->_file_path === NULL) {
            $this->_file_path = $this->_save_path . DIRECTORY_SEPARATOR . $session_id;
        }

        if ($this->_file_handle === NULL) {
            if (($this->_file_handle = fopen($this->_file_path, 'c+b')) === FALSE) {
                return FALSE;
            }
        }

        if (flock($this->_file_handle, LOCK_EX) === FALSE) {
            return FALSE;
        }

        rewind($this->_file_handle);
        $written = fwrite($this->_file_handle, $session_data);
        fflush($this->_file_handle);
        ftruncate($this->_file_handle, ftell($this->_file_handle));

        return is_int($written);
    }

    public function destroy($session_id) {
        if ($this->_file_path === NULL) {
            $this->_file_path = $this->_save_path . DIRECTORY_SEPARATOR . $session_id;
        }

        if ($this->_file_handle !== NULL) {
            fclose($this->_file_handle);
            $this->_file_handle = NULL;
        }

        return (@unlink($this->_file_path) && !file_exists($this->_file_path));
    }

    public function gc($maxlifetime) {
        $deletedCount = 0; // Inisialisasi penghitung untuk file yang dihapus
        foreach (glob($this->_save_path . DIRECTORY_SEPARATOR . '*') as $file) {
            if (is_file($file) && (filemtime($file) + $maxlifetime) < time()) {
                if (@unlink($file)) {
                    $deletedCount++; // Tambah penghitung jika file berhasil dihapus
                }
            }
        }
        return $deletedCount > 0 ? $deletedCount : false; // Kembalikan jumlah file yang dihapus atau false
    }
}
