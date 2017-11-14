<?php

namespace Paliari;

use Paliari\Utils\A;

/**
 * Class OneSignal
 * @package Paliari
 */
class OneSignal extends BasePushNotification implements PushNotification
{

    protected $app_id = '';

    protected $base_url = 'https://onesignal.com/api/v1/';

    /**
     * The $config receives a mapped array with the keys and values example:
     * <code>
     * $config = [
     *  'app_id'       => '<yor app_id>',
     *  'rest_api_key' => '<yor rest_api_key>',
     * ]
     * </code>
     *
     * @param array $config
     *
     * @return $this
     */
    public function init($config)
    {
        $this->app_id = A::get($config, 'app_id');
        $rest_api_key = A::get($config, 'rest_api_key');
        parent::init($config);
        $this->api->setAuthorization("Basic $rest_api_key");

        return $this;
    }

    /**
     * @param string $message
     * @param array  $tokens
     * @param array  $extra_options
     *
     * @return array
     */
    protected function createNotification($message, $tokens, $extra_options = [])
    {
        $options = [
            'app_id'             => $this->app_id,
            'include_player_ids' => (array)$tokens,
            'contents'           => ['en' => $message],
        ];
        if ($title = A::get($extra_options, 'title')) {
            $options['headings'] = ['en' => $title];
            unset($extra_options['title']);
        }

        return array_merge($extra_options, $options);
    }

    public function send($message, $tokens, $options, $title = '')
    {
        $data = $this->createNotification($message, $tokens, $options);

        return $this->post('notifications', $data);
    }

}
