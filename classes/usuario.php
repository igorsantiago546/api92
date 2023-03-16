<?php 
    class Usuario{
        // atributos
        private $id;
        private $nome;
        private $usuario;
        private $senha;
        private $senha_original;
        private $nivel;
        private $ativo;
        private $avatar;
        //declaração de métodos de acesso (Getters and Setters) ==== Propriedade no C#
        public function getId(){return $this->id;}
        public function setId($value){ $this->id = $value;}
        public function getNome(){return $this->nome;}
        public function setNome($value){ $this->nome = $value;}
        public function getUsuario(){return $this->usuario;}
        public function setUsuario($value){ $this->usuario = $value;}
        public function getSenha(){return $this->senha;}
        public function setSenha($value){ $this->senha = $value;}
        public function getSenhaOriginal(){return $this->senha_original;}
        public function setSenhaOriginal($value){ $this->senha_original = $value;}
        public function getNivel(){return $this->nivel;}
        public function setNivel($value){ $this->nivel = $value;}
        public function getAtivo(){return $this->ativo;}
        public function setAtivo($value){ $this->ativo = $value;}
        public function getAvatar(){return $this->avatar;}
        public function setAvatar($value){ $this->avatar = $value;}
        
        public function loadById($_id)
        {
            $sql = new Sql();
            $result = $sql->select("select * from usuarios where id = :id",array(':id'=>$_id));
            if (count($result)>0) {
                $this->setData($result[0]);
            }
        }
        public function setData($dados)
        {
            $this->setId($dados['id']);
            $this->setNome($dados['nome']);
            $this->setUsuario($dados['usuario']);
            $this->setSenha($dados['senha']);
            $this->setSenhaOriginal($dados['senha_original']);
            $this->setNivel($dados['nivel']);
            $this->setAtivo($dados['ativo']);
        }
        public function getList()
        {
            $sql = new Sql;
            return $sql->select("select * form usuarios order by nome");
        }
        public function search($_nome)
        {
            $sql = new SQl();
            return $sql->select("select * from usuarios where nome like :nome",array(':nome'=>"%".$_nome."%"));
        }
        public function efetuarLogin($_usuario, $_senha):bool
        {
            $sql = new Sql();
            $senhaCript = md5($_senha);
            $res = $sql->select("select * from usuarios where usuario = :usuario and senha = :senha",array(':usuario'=>$_usuario,':senha'=>$senhaCript));
            if (count($res)>0) {
                $this->setData($res[0]);
                return true;
            }
            return false;
        }
        public function insert()
        {
            $sql = new Sql();
            $res = $sql->querySql("insert usuarios (nome, usuario , senha, senha_original , nivel, ativo) values (:nome, :usuario, :senha, :senha_original, :nivel, :ativo)",
        array(
            ":nome"=>$this->getNome(),
            ":usuario"=>$this->getUsuario(),
            ":senha"=> md5($this->getSenha()),
            ":senha_original"=>$this->getSenha(),
            ":nivel"=>$this->getNivel(),
            ":ativo"=>$this->getAtivo()
        ));
        }
        public function update():bool
        {
            $sql = new Sql();
            $res = $sql->querySql("update usuarios set nome = :nome, senha = :senha, nivel = :nivel where id = :id",
        array(
            ":id"=>$this->getId(),
            ":nome"=>$this->getNome(),
            ":senha"=>$this->getSenha(),
            ":nivel"=>$this->getNivel()
        ));
        if ($res) {
            return true;
        }else{
            return false;
        }
        }
        public function delete($_id)
        {
            $sql = new Sql();
            $res = $sql->querySql("update usuarios set ativo = 0 where id = :id",
        array(
            ":id"=>$_id
        ));
        return $res;
        }
        public function ativar($_id)
        {
            $sql = new Sql();
            $res = $sql->querySql("update usuarios set ativo = 1 where id = :id",
        array(
            ":id"=>$_id
        ));
        return $res;
        }
        public function __construct($_nome="",$_usuario="",$_senha="",$_nivel="",$_ativo="")
        {
            $this->nome = $_nome;
            $this->usuario = $_usuario;
            $this->senha = $_senha;
            $this->nivel = $_nivel;
            $this->ativo = $_ativo;
        }
    }

?>