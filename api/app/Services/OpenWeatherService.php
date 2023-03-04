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
     *
     * @var float
     */
    protected float $lat;

    /**
     * Geographical coordinates longitude
     *
     * @var float
     */
    protected float $lon;

    /**
     * Timestamp (Unix time, UTC time zone), e.g. dt=1586468027
     *
     * @var string|null
     */
    protected ?string $dt;

    /**
     * Units of measurement. standard, metric and imperial units are available.
     *
     * @var string|null
     */
    protected ?string $units = 'metric';

    /**
     * lang parameter to get the output in your language
     * learn more at https://openweathermap.org/api/one-call-3#multi
     *
     * @var string|null
     */
    protected ?string $lang;

    /**
     * WeatherService constructor.
     * @param string $key
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
     * @param float $lat
     * @return $this
     */
    public function setLat(float $lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * @param float $lon
     * @return $this
     */
    public function setLon(float $lon): OpenWeatherService
    {
        $this->lon = $lon;

        return $this;
    }

    /**
     * @param string $dt
     * @return $this
     */
    public function setDt(string $dt): OpenWeatherService
    {
        $this->dt = $dt;

        return $this;
    }

    /**
     * @param string $units
     * @return $this
     */
    public function setUnits(string $units): OpenWeatherService
    {
        $this->units = $units;

        return $this;
    }

    /**
     * @param $lang
     * @return $this
     */
    public function setLang($lang): OpenWeatherService
    {
        $this->lang = $lang;

        return $this;
    }
}
