<?php

class Pakasir {
    private $apiKey;
    private $projectSlug;
    private $baseUrl = 'https://app.pakasir.com/api';

    public function __construct($apiKey, $projectSlug) {
        $this->apiKey = $apiKey;
        $this->projectSlug = $projectSlug;
    }

    public function createTransaction($orderId, $amount, $method = 'qris') {
        $url = $this->baseUrl . '/transactioncreate/' . $method;
        $data = [
            'project' => $this->projectSlug,
            'order_id' => $orderId,
            'amount' => (int)$amount,
            'api_key' => $this->apiKey
        ];

        return $this->request($url, $data);
    }

    public function checkTransaction($orderId, $amount) {
        // GET method for details
        $url = $this->baseUrl . "/transactiondetail?project={$this->projectSlug}&amount={$amount}&order_id={$orderId}&api_key={$this->apiKey}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return ['error' => $error];
        }

        return json_decode($response, true);
    }

    private function request($url, $data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return ['error' => $error];
        }

        return json_decode($response, true);
    }
}
