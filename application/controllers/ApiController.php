<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiController extends CI_Controller {

    /**
     * Retrieve access token from API with detailed error checking
     */
    public function getAccessToken()
    {
        $clientId = 'lGQINYiGbGA23w2fjqum1XVrDWW2QGWKi7zK048fTnWcDoEk';
        $clientSecret = '7yGxKxqNeEPvAHA0ALJQG5d1CYkzdpwE1fOfvARugjv2nZq6nHBjGdu8MdiOyxTz';
        $url = 'https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1/accesstoken?grant_type=client_credentials';

        // Initialize cURL
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query([
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
            ]),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));

        // Execute cURL request
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);

        // Close cURL
        curl_close($curl);

        // Output debugging information
        if ($error) {
            echo json_encode([
                'success' => false,
                'message' => 'cURL Error',
                'error' => $error
            ]);
        } else if ($httpCode !== 200) {
            echo json_encode([
                'success' => false,
                'message' => 'HTTP Error',
                'http_code' => $httpCode,
                'response' => $response
            ]);
        } else {
            echo json_encode([
                'success' => true,
                'message' => 'Request successful',
                'response' => json_decode($response, true) // Decode JSON response
            ]);
        }
    }
}
