<?php

class LoginModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function ingresar($user, $pass){

        try{

            $sql="select id, nombre, rol from persona where codigo=? and contrasena=?";

            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(1, $user);
            $stmt->bindValue(2, $pass);

            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            if ($row != "") {
                $_SESSION['id'] = $row['id'];
                $_SESSION['user'] = $row['nombre'];
                $_SESSION['rol'] = $row['rol'];    
                return true;
            }
            else{
                return false;
            }
        }catch(PDOException $e){
            return false;
        }
    }


}

?>