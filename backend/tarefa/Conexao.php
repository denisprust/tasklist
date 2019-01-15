<?php
/**
 * Created by PhpStorm.
 * User: prust
 * Date: 14/01/2019
 * Time: 18:10
 */

namespace Tarefa;

use PDO;

class Conexao
{
    private static $pdo_compartilhado;

    private $HOST     = 'localhost';
    private $DBNAME   = 'tasklist';
    private $USERNAME = 'root';
    private $PASSWORD = '';

    protected $pdo;

    function __construct()
    {
        if(!self::$pdo_compartilhado){
            try
            {
                self::$pdo_compartilhado = new PDO('mysql:host='.$this->HOST.';dbname='.$this->DBNAME.';charset=utf8', $this->USERNAME, $this->PASSWORD);
                self::$pdo_compartilhado->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(\PDOException $e){
                echo "- Erro ao conectar no banco de dados: <b>".$e->getMessage().'</b>';
                exit;
            }
        }

        $this->pdo = self::$pdo_compartilhado;
    }
}