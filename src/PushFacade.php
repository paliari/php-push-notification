<?php

namespace Paliari;

use DomainException;

class PushFacade
{

    const ONE_SIGNAL = 'one_signal';
    const EXPO       = 'expo';

    /**
     * @param string $provider
     * @param string $app_name
     *
     * @return PushNotification
     */
    public static function provider($provider, $app_name)
    {
        switch ($provider) {
            case static::ONE_SIGNAL :
                return OneSignal::instance($app_name);
            case static::EXPO :
                return Expo::instance($app_name);
            default :
                throw new DomainException("Provider '$provider' not found!");
        }
    }

    /**
     * The $configs is a mapped array with the keys as providers and values as array of config,
     * example:
     * <code>
     * $configs = [
     *  'one_signal' => [
     *    '<yor app name>' => [<...your one signal $config...>],
     *  ],
     *  'expo'       => [...],
     * ]
     * </code>
     *
     * @param array $configs
     */
    public static function setUp($configs)
    {
        foreach ($configs as $provider => $app_config) {
            static::setUpApp($provider, $app_config);
        }
    }

    /**
     * @param string $provider
     * @param array  $app_config
     */
    protected static function setUpApp($provider, $app_config)
    {
        foreach ($app_config as $app_name => $config) {
            static::provider($provider, $app_name)->init($config);
        }
    }

}
