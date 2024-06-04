<?php


class HttpClient {

    public function post(string $url): string {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json'
        ]);
        
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            throw new RuntimeException('cURL error: ' . curl_error($ch));
        }
        
        curl_close($ch);

        return $response;
    }
}

class DataInserter {
    public function __construct(private HttpClient $httpClient) {

    }

    public function insertData(string $endpoint): void {
        try {
            $response = $this->httpClient->post($endpoint);
            echo 'Response from ' . $endpoint . ': ' . $response . "\n";
        } catch (Exception $e) {
            echo 'Error sending request to ' . $endpoint . ': ' . $e->getMessage() . "\n";
        }
    }
}

$users = 'http://rest-api.localhost/api/users/create';
$posts = 'http://rest-api.localhost/api/posts/create';


$httpClient = new HttpClient();
$dataInsertor = new DataInserter($httpClient);

$dataInsertor->insertData($users);
$dataInsertor->insertData($posts);

echo "Data Insertion Request Sent\n";