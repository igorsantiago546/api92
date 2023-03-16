<?php 
    class Sql extends PDO{
        private $cn;
        public function __construct()
        {
            $this->cn = new PDO("mysql:host=127.0.0.1;dbname=controledb","root","usbw");
        }
        // método que atribui parametros para uma query SQL
        public function SetParams($comando, $parametros = array())
        {
            foreach ($parametros as $key => $value) {
                $this->SetParam($comando, $key, $value);
            }
        }
        // método para tratar o parametro
        public function SetParam($cmd,$key,$value)
        {
            $cmd->bindParam($key, $value);
        }
        // método que executa os comandos SQL no banco
        public function querySql($comandoSql,$params = array())
        {
            $cmd = $this->cn->prepare($comandoSql);
            $this->SetParams($cmd,$params);
            $cmd->execute();
            return $cmd;
        }

        public function select($comandoSql,$params = array())
        {
            $cmd = $this->querySql($comandoSql, $params);
            return $cmd->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>