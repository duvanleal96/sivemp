<?php
include_once 'models/combobox.php';
class RegistroModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function cargarEPS(){
        $datos=array();
        $sql="select id,nombre from eps";
        $stmt=$this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row=$stmt->fetch();
        if(empty($row)){
            $item=new Combobox();
            $item->id=-1;
            $item->nombre="No hay eps";
            return array(0 => $item);
        }
        do{
            $item=new Combobox();
            $item->id=$row['id'];
            $item->nombre=$row['nombre'];
            array_push($datos, $item);
        }while($row=$stmt->fetch());
        return $datos;
    }

    public function cargarARL(){
        $datos=array();
        $sql="select id,nombre from arl";
        $stmt=$this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row=$stmt->fetch();
        if(empty($row)){
            $item=new Combobox();
            $item->id=-1;
            $item->nombre="No hay arl";
            return array(0 => $item);
        }
        do{
            $item=new Combobox();
            $item->id=$row['id'];
            $item->nombre=$row['nombre'];
            array_push($datos, $item);
        }while($row=$stmt->fetch());
        return $datos;
    }

    public function registrar($datos){
        $sql="insert into persona(eps,arl,rol,nombre,cedula,codigo,telefono,fechanac,"
        . "direccion,contrasena)values(?,?,?,?,?,?,?,?,?,?)";
        
        try {
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(1, $datos['eps']);
            $stmt->bindValue(2, $datos['arl']);
            $stmt->bindValue(3, $datos['rol']);
            $stmt->bindValue(4, $datos['name']);
            $stmt->bindValue(5, $datos['cc']);
            $stmt->bindValue(6, $datos['codigo']);
            $stmt->bindValue(7, $datos['tel']);
            $stmt->bindValue(8, $datos['date']);
            $stmt->bindValue(9, $datos['direc']);
            $stmt->bindValue(10, $datos['pass']);
            $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }


}

?>