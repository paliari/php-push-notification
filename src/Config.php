<?php
namespace Paliari;

/**
 * Class Config
 * @package Paliari
 */
class Config
{
    /**
     * @var string
     */
    private $uri = 'https://onesignal.com/api/v1/';

    /**
     * @var string
     */
    protected $app_id;

    /**
     * @var string
     */
    protected $rest_api_key;

    /**
     * Config constructor.
     *
     * @param string $application_id
     * @param string $rest_api_key
     */
    public function __construct($application_id, $rest_api_key)
    {
        $this->app_id       = $application_id;
        $this->rest_api_key = $rest_api_key;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getAppId()
    {
        return $this->app_id;
    }

    /**
     * @param string $app_id
     *
     * @return Config
     */
    public function setAppId($app_id)
    {
        $this->app_id = $app_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getRestApiKey()
    {
        return $this->rest_api_key;
    }

    /**
     * @param string $rest_api_key
     *
     * @return Config
     */
    public function setRestApiKey($rest_api_key)
    {
        $this->rest_api_key = $rest_api_key;

        return $this;
    }

}
