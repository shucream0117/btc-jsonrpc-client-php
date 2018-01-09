# btcphp

Bitcoin(Litecoin, Monacoin) library for PHP. 

## Requirement

- PHP ≧ 7.1

## Installation

via composer.

```console
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar require shucream0117/btcphp:dev-master
```

## Example

```php
$btc = new \Shucream0117\Bitcoin\Bitcoin(
    'username', // rpcuser
    'password', // rpcpassword
    'localhost', // host
    19402, // port
    false // if use HTTPS
);

$response = $btc->callApi('getinfo');
$responseArray = json_decode($response->getBody()->getContents(), true);
var_dump($responseArray);

// arguments can be passed as array
// array[0] is argument1, array[1] is argument2...
$response = $btc->callApi(
    'gettransaction',
    ['dee2406ae3ed5e1edc923d69ba795edfc9e01e5cc632ed8b7bb4365df5b106c9']
);
```
