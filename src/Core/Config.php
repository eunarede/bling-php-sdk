<?php
namespace Zoop\Core;

/**
 * Config class
 *
 * A classe de configuração do fluxo da aplicação
 * é extremamente flexivel e pode ser alterada para diversas
 * formas simples de usabilidade, podendo substituir por exemplo
 * o guzzle e suas configuração de timeout pelo Zend Http.
 *
 * @method Zoop/Core/Config::configure(string $token, string $marketplace, string $vendedor)
 *
 * @package Zoop/Core
 * @author italodeveloper <italoaraujo788@gmail.com>
 * @version 1.0.0
 */
class Config
{
    public static function configure($token, $marketplace, $vendedor, $is_zend = null)
    {
        $configurations = [
            'marketplace' => $marketplace,
            'gateway' => 'bling',
            'base_url' => 'https://bling.com.br/Api/v2',
            'auth' => [
                'on_behalf_of' => $vendedor,
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
                'timeout' => 10,
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
