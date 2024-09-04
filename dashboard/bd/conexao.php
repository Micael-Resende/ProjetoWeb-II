<?php 
class Conexao {	  
    public static function Conectar() {        
        // Definir constantes para a conexão
        define('HOSTNAME', 'localhost');
        define('DBNAME', 'formulario');
        define('USUARIO', 'root');
        define('PASSWORD', '');					        

        $opcoes = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];			

        try {
            // Criar a conexão com o banco de dados
            $conexao = new PDO("mysql:host=".HOSTNAME.";dbname=".DBNAME, USUARIO, PASSWORD, $opcoes);			
            return $conexao;
        } catch (Exception $e) {
            // Exibir mensagem de erro em português
            die("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }
    
    // public static function Desconectar($conexao) {
    //     // Desconectar explicitamente
    //     $conexao = null;
    // }
}

