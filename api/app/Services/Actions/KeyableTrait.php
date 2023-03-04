<?php

namespace App\Services\Actions;

/**
 * Trait KeyableTrait.
 */
trait KeyableTrait
{
    /**
     * The key used to authenticate with the service.
     *
     * @var string
     */
    protected string $appid;

    /**
     * Return the API key.
     *
     * @return string
     */
    public function getAppid(): string
    {
        return $this->appid;
    }
}
