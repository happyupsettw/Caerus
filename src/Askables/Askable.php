<?php
/**
 * Author: Panigale
 * Date: 2023/8/9
 * Time: 4:30 PM
 */

namespace Panigale\Caerus\Askables;

abstract class Askable
{
    use Apis;

    protected $client;

    public function createConnection()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * @throws \Exception
     */
    public function send(string $method , string $url , array $options = [])
    {
        $this->createConnection();

        return retry(3, function () use ($method, $url, $options) {
            return $this->client->request($method, $url, $options);
        }, 100);
    }

    protected function sendRequest(string $method ,string $url)
    {
        
    }

    public function domain()
    {
        return env('CAERUS_DOMAIN');
    }
}