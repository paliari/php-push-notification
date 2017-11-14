<?php

namespace Paliari;

class Expo extends BasePushNotification implements PushNotification
{

    protected $base_url = 'https://exp.host/--/api/v2/';

    /**
     * @param string $message
     * @param array  $tokens
     * @param array  $options
     *
     * @return array
     */
    public function send($message, $tokens, $options)
    {
        $data = $this->createNotification($message, $tokens, $options);

        return $this->post('push/send', $data);
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
        $data = [];
        foreach ((array)$tokens as $token) {
            $data[] = $this->createOneNotification($message, $token, $extra_options);
        }

        return $data;
    }

    /**
     * @param string $message
     * @param array  $token
     * @param array  $extra_options
     *
     * @return array
     */
    protected function createOneNotification($message, $token, $extra_options = [])
    {
        $options = [
            'to'   => $token,
            'body' => $message,
        ];

        return array_merge($extra_options, $options);
    }

}
