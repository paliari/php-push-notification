<?php

namespace Paliari;

use Paliari\Utils\A;

abstract class BasePushNotification
{

    protected $base_url;

    /**
     * @var Api
     */
    protected $api;

    protected static $_instances = [];

    /**
     * @param string $app_name
     *
     * @return static
     */
    public static function instance($app_name)
    {
        $key = get_called_class() . $app_name;
        if (!isset(static::$_instances[$key])) {
            static::$_instances[$key] = new static();
        }

        return static::$_instances[$key];
    }

    public function init($config)
    {
        $this->base_url = A::get($config, 'base_url', $this->base_url);
        $this->api      = $this->newApi($this->base_url);

        return $this;
    }

    protected function newApi($base_url)
    {
        return new Api($base_url);
    }

    protected function post($path, $data)
    {
        return $this->api->post($path, $data);
    }

}
