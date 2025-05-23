<?php
class Api_model extends CI_Model {

    public function check_verification_status() {
        $timestamp = time(); // Generate current timestamp automatically

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mutufasyankes.kemkes.go.id/api/status_verif_katim',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'x-id: mutukemenkes',
                'x-pass: rsonline!@#$',
                'x-timestamp: ' . $timestamp,
                'cookie: TS01151b7a=0172bf5c62dd2ceae2dd097a56722b10bb38b719d6b709567a435f0acbfd7609311be64adf63726518bbb53037b16ed3f2fe02ddf983b945f66ac1a7309e127d73534784bd; ci_session=a%3A5%3A%7Bs%3A10%3A%22session_id%22%3Bs%3A32%3A%222851dca30c974d506d165ee0889fbea9%22%3Bs%3A10%3A%22ip_address%22%3Bs%3A14%3A%22172.68.153.143%22%3Bs%3A10%3A%22user_agent%22%3Bs%3A21%3A%22PostmanRuntime%2F7.29.2%22%3Bs%3A13%3A%22last_activity%22%3Bi%3A1735797792%3Bs%3A9%3A%22user_data%22%3Bs%3A0%3A%22%22%3B%7D601bd67b566384524bd50202bec6e5e6'
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            curl_close($curl);
            log_message('error', 'cURL error: ' . $error_msg);
            return array('error' => 'An error occurred while processing the request. Please try again later.');
        }

        curl_close($curl);

        // Decode the JSON response
        $result = json_decode($response, true);

        // Check if the response is valid
        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', 'JSON decode error: ' . json_last_error_msg());
            return array('error' => 'Invalid response from API.');
        }

        return $result; // Return the decoded response
    }
}
