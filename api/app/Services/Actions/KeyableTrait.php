<?php

namespace App\Services\Actions;

/**
 * Trait KeyableTrait.
 */
trait KeyableTrait
{
    /**
     * The key used to authenticate with the service.
     */
    protected string $appid;

    /**
     * Return the API key.
     */
    public function getAppid(): string
    {
        return $this->appid;
    }
}
