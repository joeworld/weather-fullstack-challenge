<?php

namespace App\Services\Actions;

use GuzzleHttp\Exception\GuzzleException;

/**
 * Interface ClientInterface.
 */
interface ClientInterface
{
    /**
     * Return the request root URI.
     */
    public function getRootUri(): string;

    /**
     * Gets the request URI.
     */
    public function getUri(): string;

    /**
     * Return the API key.
     */
    public function getAppid(): string;

    /**
     * Holds the results of the query.
     */
    public function getData(): string;

    /**
     * Get array output.
     */
    public function toArray(): array;

    /**
     * Do the request.
     *
     * @return mixed
     *
     * @throws GuzzleException
     */
    public function makeRequest();
}
