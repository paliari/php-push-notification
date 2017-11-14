<?php

namespace Paliari;

interface PushNotification
{

    /**
     * @param string $message
     * @param array  $tokens
     * @param array  $options
     *
     * @return array
     */
    public function send($message, $tokens, $options);

    /**
     * @param array $config
     *
     * @return $this
     */
    public function init($config);

}
