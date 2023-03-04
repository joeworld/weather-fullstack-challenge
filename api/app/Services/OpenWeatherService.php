<?php

namespace App\Services;

use App\Services\Actions\BaseClient;

/**
 * Class OpenWeatherService
 */
class OpenWeatherService extends BaseClient
{
    /**
     * Geographical coordinates latitude
     */
    protected float $lat;

    /**
     * Geographical coordinates longitude
     */
    protected float $lon;

    /**
     * Timestamp (Unix time, UTC time zone), e.g. dt=1586468027
     */
    protected ?string $dt;

    /**
     * Units of measurement. standard, metric and imperial units are available.
     */
    protected ?string $units = 'metric';

    /**
     * lang parameter to get the output in your language
     * learn more at https://openweathermap.org/api/one-call-3#multi
     */
    protected ?string $lang;

    /**
     * WeatherService constructor.
     */
    public function __construct(string $key)
    {
        parent::__construct($key);
    }

    /**
     * {@inheritdoc}
     */
    public function getUri(): string
    {
        return 'timemachine';
    }

    /**
     * @return $this
     */
    public function setLat(float $lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * @return $this
     */
    public function setLon(float $lon): OpenWeatherService
    {
        $this->lon = $lon;

        return $this;
    }

    /**
     * @return $this
     */
    public function setDt(string $dt): OpenWeatherService
    {
        $this->dt = $dt;

        return $this;
    }

    /**
     * @return $this
     */
    public function setUnits(string $units): OpenWeatherService
    {
        $this->units = $units;

        return $this;
    }

    /**
     * @return $this
     */
    public function setLang($lang): OpenWeatherService
    {
        $this->lang = $lang;

        return $this;
    }
}
