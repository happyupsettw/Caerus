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

    protected function parseJsonRes($res)
    {
        return json_decode($res->getBody()->getContents());
    }

    /**
     * @throws \Exception
     */
    public function get(array $options = [])
    {
        $url = $this->composeUrl();

        return $this->send('GET', $url, $options);
    }

    protected function composeUrl() : string
    {
        return $this->domain();
    }
}