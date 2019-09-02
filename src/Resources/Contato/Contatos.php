<?php
namespace Bling\Contato;

use Bling\Bling;
/**
 * Class Contatos
 *
 * Essa classe é resposavel por lidar com os contatos
 * dentro do Bling.
 *
 * @package Bling\Contato
 * @author Andre Bellafronte <andre@eunarede.com>
 * @version 1.0.0
 */
class Contatos extends Bling
{
    public function __construct(array $configurations)
    {
        parent::__construct($configurations);
    }

    /**
     * createContato function
     *
     * Cria o contato dentro do Bling
     *
     * @param array $contatoData
     * @see https://manuais.bling.com.br/manual/?item=contatos#POSTcontato
     * @return bool|array
     * @throws \Exception
     */
    public function createContato(array $contatoData)
    {
        try {
            $request = $this->configurations['guzzle']->request(
                'POST', '/contato/json/',
                ['query' => ['xml' => $contatoData]]
            );
            $response = \json_decode($request->getBody()->getContents(), true);
            if($response && is_array($response)){
                return $response;
            }
            return false;
        } catch (\Exception $e){
            return $this->ResponseException($e);
        }
    }

    /**
     * getAllContatos function
     *
     * Lista todos os contatos no Bling
     *
     * @return bool|array
     * @throws \Exception
     */
    public function getAllContatos()
    {
        try {
            $request = $this->configurations['guzzle']->request(
                'GET', '/contatos/json/'
            );
            $response = \json_decode($request->getBody()->getContents(), true);
            if($response && is_array($response)){
                return $response;
            }
            return false;
        } catch (\Exception $e){
            return $this->ResponseException($e);
        }
    }

    /**
     * function getContato
     *
     * Pega os dados do contato associado
     * ao CPF ou CNPJ passado como parametro.
     *
     * @param string $cpfCnpj
     *
     * @return bool|array
     * @throws \Exception
     */
    public function getContato($cpfCnpj)
    {
        try {
            $request = $this->configurations['guzzle']->request(
                'GET', '/contato/' . $cpfCnpj . '/json/'
            );
            $response = \json_decode($request->getBody()->getContents(), true);
            if($response && is_array($response)){
                return $response;
            }
            return false;
        } catch (\Exception $e){
            return $this->ResponseException($e);
        }
    }

    /**
     * updateContato function
     *
     * Atualiza um contato no Bling com novo array de dados buscando por seu ID
     *
     *
     * @param $userId
     *
     * @return bool|mixed|void
     * @throws \Exception
     */
    public function updateContato($contatoId, $contatoData)
    {
        try {
            $request = $this->configurations['guzzle']->request(
                'PUT', '/contato/'. $contatoId .'/json/',
                ['query' => ['xml' => $contatoData]]
            );
            $response = \json_decode($request->getBody()->getContents(), true);
            if($response && is_array($response)){
                return $response;
            }
            return false;
        } catch (\Exception $e){
            return $this->ResponseException($e);
        }
    }
}
