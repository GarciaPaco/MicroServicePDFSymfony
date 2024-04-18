<?php

namespace App\Services;
use Symfony\Component\HttpClient\HttpClient;

class CallApiService
{

    public function sendUrlToGotenberg($url) {
        $client = httpClient::create();
        $response = $client->request('POST', 'http://gotenberg:3000/convert/url', [
            'header' => [
                'Content-Type' => 'multipart/form-data',
            ],
            'body' => [
                'url' => $url,
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Gotenberg API error');
        } else {
            file_put_contents('my_pdf', $response->getContent());
            return $response->getContent();
        }
    }

}