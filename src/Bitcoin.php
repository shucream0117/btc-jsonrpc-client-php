<?php

namespace Shucream0117\Bitcoin;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Bitcoin
{
    /** @var string */
    protected $user;

    /** @var string */
    protected $password;

    /** @var string */
    protected $host;

    /** @var int */
    protected $port;

    /** @var bool */
    protected $ssl;

    /** @var int */
    protected $id = 1;

    /** @var Client */
    protected $httpClient;

    /**
     * Bitcoin constructor.
     *
     * @param string $user
     * @param string $password
     * @param string $host
     * @param int $port
     * @param bool $ssl
     * @param Client|null $httpClient
     */
    public function __construct(
        string $user,
        string $password,
        string $host,
        int $port,
        bool $ssl = false,
        Client $httpClient = null
    )
    {
        $this->user = $user;
        $this->password = $password;
        $this->host = $host;
        $this->port = $port;

        if (!$httpClient) {
            $httpClient = new Client();
        }
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $command
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\RequestException
     */
    public function callApi(string $command, array $params = []): ResponseInterface
    {
        $protocol = $this->ssl ? 'https' : 'http';
        $url = "{$protocol}://{$this->host}:{$this->port}";
        return $this->httpClient->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode("{$this->user}:{$this->password}"),
            ],
            'json' => [
                'method' => $command,
                'params' => array_values($params),
                'id' => $this->id++,
            ]
        ]);
    }
}
