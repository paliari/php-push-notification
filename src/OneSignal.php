<?php
namespace Dflourusso;

/**
 * Class OneSignal
 * @package Dflourusso
 */
class OneSignal
{

    private static $_instance;

    /**
     * @var Api
     */
    protected $api;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @return static
     */
    public static function instance()
    {
        return static::$_instance = static::$_instance ?: new static();
    }

    /**
     * @param string $application_id
     * @param string $rest_api_key
     *
     * @return $this
     */
    public function init($application_id, $rest_api_key)
    {
        $this->config = new Config($application_id, $rest_api_key);
        $this->api    = new Api($this->config);

        return $this;
    }

    /**
     * @param string $message
     * @param array  $players
     * @param array  $extra_options
     *
     * @return array
     */
    public function createNotification($message, $players, $extra_options = [])
    {
        $options = [
            'app_id'             => $this->config->getAppId(),
            'include_player_ids' => (array)$players,
            'contents'           => ['en' => $message]
        ];

        return $this->api->post('notifications', array_merge($extra_options, $options));
    }
}
