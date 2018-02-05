<?php

namespace Shucream0117\Bitcoin;

use Psr\Http\Message\ResponseInterface;

interface BitcoinJsonRpcClientInterface
{
    public function callApi(string $command, array $params = []): ResponseInterface;
}
