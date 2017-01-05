<?php
namespace Paliari;

/**
 * Class Api
 * @package Paliari
 */
class Api
{
    /**
     * @var array
     */
    protected $default_curl_options;

    /**
     * Api constructor.
     *
     * @param Config $config
     */
    public function __construct($config)
    {
        $this->default_curl_options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HEADER         => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_URL            => $config->getUri(),
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json; charset=utf-8',
                "Authorization: Basic {$config->getRestApiKey()}"
            ]
        ];
    }

    /**
     * @param array $array1
     * @param array $array2
     *
     * @return array
     */
    protected function mergeCurlOptions($array1, $array2)
    {
        foreach ($array2 as $k => $v) {
            $array1[$k] = $v;
        }

        return $array1;
    }

    /**
     * @param string $path
     * @param array  $params
     *
     * @throws \Exception
     */
    public function get($path, $params)
    {
        throw new \Exception('Not implemented');
    }

    /**
     * @param string $path
     * @param array  $data
     *
     * @return array
     */
    public function post($path, $data)
    {
        $curl         = curl_init();
        $data         = json_encode($data);
        $post_options = [
            CURLOPT_POST          => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS    => $data
        ];
        $this->default_curl_options[CURLOPT_URL] .= $path;
        $options = $this->mergeCurlOptions($this->default_curl_options, $post_options);
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        curl_close($curl);

        return (array)json_decode($response);
    }
}
