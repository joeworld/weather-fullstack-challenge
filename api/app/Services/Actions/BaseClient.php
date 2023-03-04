<?php

namespace App\Services\Actions;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

/**
 * Class BaseClient.
 */
abstract class BaseClient implements ClientInterface
{
    use KeyableTrait;

    /**
     * Holds the results of the query.
     *
     * @var string
     */
    private string $data;

    /**
     * BaseClient constructor.
     *
     * @param string $appid
     */
    public function __construct(string $appid)
    {
        $this->appid = $appid;
    }

    /**
     * {@inheritdoc}
     */
    public function getRootUri(): string
    {
        return 'https://api.openweathermap.org/data/3.0/onecall/'.$this->getUri();
    }

    /**
     * {@inheritdoc}
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * {@inheritdoc}
     */
    public function makeRequest()
    {
        $client = new Client();

        $response = $client->get($this->getRootUri(), [
            RequestOptions::QUERY => $this->toArray(),
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
