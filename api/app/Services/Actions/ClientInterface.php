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
     *
     * @return string
     */
    public function getRootUri(): string;

    /**
     * Gets the request URI.
     *
     * @return string
     */
    public function getUri(): string;

    /**
     * Return the API key.
     *
     * @return string
     */
    public function getAppid(): string;

    /**
     * Holds the results of the query.
     *
     * @return string
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
     * @throws GuzzleException
     */
    public function makeRequest();
}
