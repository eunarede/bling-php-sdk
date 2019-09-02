<?php
namespace Bling\Core;

/**
 * Config class
 *
 * A classe de configuração do fluxo da aplicação
 * é extremamente flexivel e pode ser alterada para diversas
 * formas simples de usabilidade, podendo substituir por exemplo
 * o guzzle e suas configuração de timeout pelo Zend Http.
 *
 * @method Bling/Core/Config::configure(string $token, string $marketplace, string $vendedor)
 *
 * @package Bling/Core
 * @author Andre Bellafronte <andre@eunarede.com>
 * @version 1.0.0
 */
class Config
{
    public static function configure($token, $is_zend = null)
    {
        $configurations = [
            'gateway' => 'bling',
            'base_url' => 'https://bling.com.br/Api/v2',
            'auth' => [
                'token' => $token
            ],
            'configurations' => [
                'limit' => 20,
                'sort' => 'time-descending',
                'offset' => 0,
                'date_range' => null,
                'date_range[gt]' => null,
                'date_range[gte]' => null,
                'date_range[lt]'=> null,
                'date_range[lte]' => null,
                'reference_id'=> null,
                'status' => null,
                'payment_type' => null,
            ],
            'guzzle' => [
                'base_uri' => 'https://bling.com.br/Api/v2',
                'timeout' => 30,
                'headers' => [
                    'User-Agent' => 'EunaRede/1.0'
                ],
                'query' => [
                  'apikey' => $token
                ]
            ]
        ];
        return self::ClientHelper($configurations, $is_zend);
    }

    private static function ClientHelper(array $configurations, $is_zend = null)
    {
        $client = $configurations['guzzle'];
        unset($configurations['guzzle']);
        if(\is_null($is_zend)){
            $configurations['guzzle'] = new \GuzzleHttp\Client($client);
        } else {
            $configurations['guzzle'] = new \ZendAdapter\ZendRequest($client);
        }
        return $configurations;
    }
}
