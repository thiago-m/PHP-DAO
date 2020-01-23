<?php 
    class Usuario {
        private $idusuario;
        private $deslogin;
        private $dessenha;
        private $dtcadastro;

        public function __construct($login = "", $senha = "") {
            $this->setDeslogin($login);
            $this->setDessenha($senha);
        }

        public function getIdusuario() {
            return $this->idusuario;
        }
        public function getDeslogin() {
            return $this->deslogin;
        }
        public function getDessenha() {
            return $this->dessenha;
        }
        public function getDtcadastro() {
            return $this->dtcadastro;
        }

        public function setIdusuario($value) {
            $this->idusuario = $value;
        }
        public function setDeslogin($value) {
            $this->deslogin = $value;
        }
        public function setDessenha($value) {
            $this->dessenha = $value;
        }
        public function setDtcadastro($value) {
            $this->dtcadastro = $value;
        }

        public function setData($data) {
            $this->setIdusuario($data['idusuario']);
            $this->setDeslogin($data['deslogin']);
            $this->setDessenha($data['dessenha']);
            $this->setDtcadastro(new DateTime($data['dtcadastro']));
        }

        public function loadById($id) {
            $sql = new Sql();
            $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
                ":ID"=>$id
            ));
            if(count($results) > 0){
                $row = $results[0];
                $this->setData($results[0]);
            }
        }

        public static function getList() {
            $sql = new Sql();
            return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
        }

        public static function search($login) {
            $sql = new Sql();
            return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :LOGIN", array(
                ":LOGIN"=>'%'.$login.'%'
            ));
        }

        public function login($login, $password) {
            $sql = new Sql();
            $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
                ":LOGIN"=>$login,
                ":PASSWORD"=>$password
            ));
            if(count($results) > 0){
                $this->setData($results[0]);
            } else {
                throw new Exception("Login e/ou senha invalidos");
            }
        }

        public function insert() {
            $sql = new Sql();
            $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
                ':LOGIN'=>$this->getDeslogin(),
                ':PASSWORD'=>$this->getDessenha()
            ));
            if(count($results) > 0) {
                $this->setData($results[0]);
            }
        }

        public function update($login, $senha) {
            $this->setDeslogin($login);
            $this->setDessenha($senha);
            $sql = new Sql();
            $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
                ':LOGIN'=>$this->getDeslogin(),
                ':PASSWORD'=>$this->getDessenha(),
                ':ID'=>$this->getIdusuario()
            ));
        }

        public function __toString() {
            return json_encode(array(
                "idusuario"=>$this->getIdusuario(),
                "deslogin"=>$this->getDeslogin(),
                "dessenha"=>$this->getDessenha(),
                "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
            ));
        }
    }
?>