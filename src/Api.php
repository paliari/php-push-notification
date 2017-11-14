<?php

namespace Paliari;

use Exception;

/**
 * Class Api
 * @package Paliari
 */
class Api
{

    /**
     * @var array
     */
    protected $curl_options;

    /**
     * @var array
     */
    protected $headers = ['Content-Type' => 'application/json; charset=utf-8'];

    protected $base_url;

    /**
     * Api constructor.
     *
     * @param string $base_url
     * @param array  $curl_options
     */
    public function __construct($base_url, $curl_options = [])
    {
        $this->base_url     = $base_url;
        $this->curl_options = $this->mergeCurlOptions([
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HEADER         => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_URL            => $base_url,
        ], $curl_options);
    }

    public function setAuthorization($authorization)
    {
        return $this->setHeader('Authorization', $authorization);
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function setHeader($key, $value)
    {
        $this->headers[$key] = $value;

        return $this;
    }

    public function getHeaders()
    {
        $headers = [];
        foreach ($this->headers as $k => $v) {
            $headers[] = "$k: $v";
        }

        return $headers;
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
        throw new Exception('Not implemented');
    }

    /**
     * @param string $path
     * @param array  $data
     *
     * @return array
     */
    public function post($path, $data)
    {
        $post_options = [
            CURLOPT_POST          => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS    => json_encode($data)
        ];
        $options      = $this->curlOptions($post_options, $path);

        return $this->send($this->curlInit(), $options);
    }

    protected function curlInit()
    {
        return curl_init();
    }

    protected function send($curl, $options)
    {
        $this->setCurlOptions($curl, $options);
        $response = $this->curlExec($curl);
        $this->close($curl);

        return $this->parseResponse($response);
    }

    protected function setCurlOptions($curl, $options)
    {
        curl_setopt_array($curl, $options);
    }

    protected function close($curl)
    {
        curl_close($curl);
    }

    protected function curlExec($curl)
    {
        return curl_exec($curl);
    }

    protected function parseResponse($response)
    {
        return (array)json_decode($response);
    }

    protected function url($path = '')
    {
        if ($path) {
            return rtrim($this->base_url, '/') . '/' . ltrim($path, '/');
        }

        return $this->base_url;
    }

    protected function curlOptions($options, $path)
    {
        $options                     = $this->mergeCurlOptions($this->curl_options, $options);
        $options[CURLOPT_URL]        = $this->url($path);
        $options[CURLOPT_HTTPHEADER] = $this->getHeaders();

        return $options;
    }

    /**
     * @param string $path
     * @param array  $data
     *
     * @throws \Exception
     */
    public function put($path, $data)
    {
        throw new Exception('Not implemented');
    }

    /**
     * @param string $path
     * @param array  $data
     *
     * @throws \Exception
     */
    public function delete($path, $data)
    {
        throw new Exception('Not implemented');
    }

}
