<?php

class UsuarioModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    //FUNCIONES DEL DIRECTOR
    //{
    public function registrarDocente($datos){
        $sql="insert into persona(rol,nombre,cedula,codigo,telefono,fechanac,"
        . "direccion,contrasena)values(?,?,?,?,?,?,?,?)";
        
        try{
            $stmt = $this->db->connect()->prepare($sql);

            $stmt->bindValue(1, $datos['rol']);
            $stmt->bindValue(2, $datos['name']);
            $stmt->bindValue(3, $datos['cc']);
            $stmt->bindValue(4, $datos['codigo']);
            $stmt->bindValue(5, $datos['tel']);
            $stmt->bindValue(6, $datos['date']);
            $stmt->bindValue(7, $datos['direc']);
            $stmt->bindValue(8, $datos['pass']);
            $stmt->execute();
        } catch (PDOException $ex) {
            return false;
        }
        return true;
    }
    //}

    //FUNCIONES TODAS LAS SESIONES
    //{
    public function informacion(){
        if(isset($_SESSION['id'])){
            $id=$_SESSION['id'];

            $sql="select * from persona where id=".$id;
            $stmt=$this->db->connect()->query($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row=$stmt->fetch();

            if(empty($row['eps'])){
                $eps="Sin EPS";
            }else{
                $sql2="select * from eps where id=".$row['eps'];
                $stmt2=$this->db->connect()->query($sql2);
                $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                $row2=$stmt2->fetch();
                $eps=$row2['nombre'];
            }
            
            if(empty($row['arl'])){
                $arl="Sin ARL";
            }else{
                $sql3="select nombre from arl where id=".$row['arl'];
                $stmt3=$this->db->connect()->query($sql3);
                $stmt3->setFetchMode(PDO::FETCH_ASSOC);
                $row3=$stmt3->fetch();
                $arl=$row3['nombre'];
            }

            $datos = array('id' => $row['id'], 'nombre'=>$row['nombre'],
                'cedula'=>$row['cedula'], 'codigo'=>$row['codigo'],'telefono'=>$row['telefono'],
                'fechanac'=>$row['fechanac'],'direccion'=>$row['direccion'],'eps'=>$eps,'arl'=>$arl);

            return $datos;
        }
        return [];
    }

    public function editar($datos=[]){
        $stmt = $this->db->connect()->prepare(
            "update persona set nombre=?,cedula=?,codigo=?,telefono=?,fechanac=?,"
            . "direccion=? WHERE id=?");

        $stmt->bindValue(1, $datos['name']);
        $stmt->bindValue(2, $datos['cc']);
        $stmt->bindValue(3, $datos['codigo']);
        $stmt->bindValue(4, $datos['tel']);
        $stmt->bindValue(5, $datos['fecha']);
        $stmt->bindValue(6, $datos['direc']);
        $stmt->bindValue(7, $datos['id']);
        try{
           $stmt->execute();
        } catch (PDOException $ex) {
            return false;
        }
        return true;
    }

    public function cerrarSesion(){
        session_start();
        session_unset();
        session_destroy();
    }
    //}

    //FUNCIONES DEL DOCENTE
    //{

    public function registrarEmpresa($datos=[]){
        $sql="insert into empresa(nombre,nit,direccion,descripcion,telefono,".
            "ciudad,replegal)values(?,?,?,?,?,?,?)";
        
        try{
            $stmt = $this->db->connect()->prepare($sql);

            $stmt->bindValue(1, $datos['name']);
            $stmt->bindValue(2, $datos['nic']);
            $stmt->bindValue(3, $datos['dir']);
            $stmt->bindValue(4, $datos['desc']);
            $stmt->bindValue(5, $datos['tel']);
            $stmt->bindValue(6, $datos['ciudad']);
            $stmt->bindValue(7, $datos['replegal']);

            $stmt->execute(); 
        } catch (PDOException $ex) {
            return false;
        }
        return true;
        
        
    }

    public function registrarTransportadora($datos=[]){
        $sql="insert into transportadora(nombre,nit,replegal)values(?,?,?)";

        try{
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(1, $datos['name']);
            $stmt->bindValue(2, $datos['nit']);
            $stmt->bindValue(3, $datos['replegal']);

            $stmt->execute(); 
        } catch (PDOException $ex) {
            return false;
        }
        return true;
    }

    public function registrarEPS($datos=[]){
        $sql="insert into eps(nombre,regimen,fechaafiliacion)values(?,?,?)";
        
        try{
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(1, $datos['name']);
            $stmt->bindValue(2, $datos['regimen']);
            $stmt->bindValue(3, $datos['fechaa']);

            $stmt->execute(); 
        } catch (PDOException $ex) {
            return false;
        }
        return true;
    }
    public function registrarARL($datos=[]){
        $sql="insert into arl(nombre,fechaafiliacion)values(?,?)";
        
        try{
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(1, $datos['name']);
            $stmt->bindValue(2, $datos['fechaa']);

            $stmt->execute(); 
        } catch (PDOException $ex) {
            return false;
        }
        return true;
    }
    //}

}

?>