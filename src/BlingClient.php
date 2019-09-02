<?php
namespace Bling;

use Bling\Bling;

/**
 * BlingClient class
 * Esta classe é responsável por ser a primeira camada (uma espacie de guarda chuva)
 * para tidas as classes registradas dentro da aplicação em formato de bundle.
 * Os bundles (classes que podem ser chamadas seus metodos publicos por esta classe cliente)
 * são registrados dentra da classe abstrata extendida pelo cliente Blig\Bling
 */
class BlingClient extends Bling
{

  function __construct($configurations)
  {
    parent::__contruct($configurations);
  }
}
