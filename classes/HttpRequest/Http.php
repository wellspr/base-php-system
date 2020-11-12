<?php

namespace HttpRequest;

class Http
{

    public function request($url)
    {
        // Initialize a cURL session
        $curlRequest = curl_init();

        // Options
        $options = [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
        ];

        // Return page contents
        curl_setopt_array($curlRequest, $options);

        // Save Result
        $result = curl_exec($curlRequest);

        // Close connection
        curl_close($curlRequest);

        return $result;
    }


    public function getRequest($url)
    {
        // Initialize a cURL session
        $curlRequest = curl_init();

        // Options
        $options = [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
        ];

        // Return page contents
        curl_setopt_array($curlRequest, $options);

        // Save Result
        $result = curl_exec($curlRequest);

        // Close connection
        curl_close($curlRequest);

        return $result;
    }


    public function postRequest($url, $data, $sendHeaders=0, $headers=[])
    {
        // Initialize a cURL session
        $curlRequest = curl_init();

        // Options
        $options = [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HEADER=> $sendHeaders,
            CURLOPT_HTTPHEADER => $headers
        ];

        // Return page contents
        curl_setopt_array($curlRequest, $options);

        // Save Result
        $result = curl_exec($curlRequest);

        // Close connection
        curl_close($curlRequest);

        return $result;
    }

}
