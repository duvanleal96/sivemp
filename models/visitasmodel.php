<?php

include_once 'models/visita.php';
include_once 'models/personavisita.php';
include_once 'models/datos.php';
include_once 'models/informe.php';

class VisitasModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    //FUNCIONES TODAS LAS SESIONES
    //{-------------------------------------------------------------------------
    public function getVisita($visita) {
        $sql = "select  v.id as id, v.nombre as nombre, v.descripcion as descripcion, " .
                "e.nombre as empresa, v.cupos as cupos, t.nombre as transportadora, " .
                "v.fechaini as fechaini, v.estado as estado" .
                " from (visita v join empresa e on v.empresa = e.id)" .
                " join transportadora t on v.transportadora=t.id" .
                " where v.id=" . $visita;
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        $item = new Visita();
        $item->id = $row['id'];
        $item->nombre = $row['nombre'];
        $item->descripcion = $row['descripcion'];
        $item->empresa = $row['empresa'];
        $item->cupos = $row['cupos'];
        $item->transportadora = $row['transportadora'];
        $item->fecha = $row['fechaini'];
        switch ($row['estado']) {
            case 1:
                $item->estado = "En Espera";
                break;

            case 2:
                $item->estado = "Reprobado";
                break;
            case 3:
                $item->estado = "Aprobado";
                break;
            case 4:
                $item->estado = "En Ejecucion";
                break;
            case 5:
                $item->estado = "Finalizado";
                break;
        }

        return $item;
    }

    //}-------------------------------------------------------------------------
    //FUNCIONES DEL DIRECTOR
    //{-------------------------------------------------------------------------
    public function listaVisitasEspera() {
        $datos = array();
        $sql = "select v.id as id, v.nombre as nombre, e.nombre as empresa, t.nombre as transportadora, v.cupos as cupos " .
                "from (visita v join empresa e on v.empresa=e.id ) join transportadora t on v.transportadora=t.id where estado=1";
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $stmt->fetch()) {
            $item = new Visita();
            $item->id = $row['id'];
            $item->nombre = $row['nombre'];
            $item->empresa = $row['empresa'];
            $item->transportadora = $row['transportadora'];
            $item->cupos = $row['cupos'];

            array_push($datos, $item);
        }
        return $datos;
    }

    public function cambiarEstado($visita, $estado) {
        $sql = "update visita set estado=? where id=?";
        
        try{
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(1, $estado);
            $stmt->bindValue(2, $visita);
            $stmt->execute();
        } catch(PDOException $ex){
            return false;
        }
        return true;
    }

    //}-------------------------------------------------------------------------
    //FUNCIONES DEL DOCENTE
    //{-------------------------------------------------------------------------

    public function listarEmpresas() {
        $sql = "select id, nombre from empresa";
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        if (empty($row['id'])) {
            return array(0 => -1, 1 => 'No hay empresas');
        }
        $datos = array();
        do {
            $item = new Datos();
            $item->id = $row['id'];
            $item->nombre = $row['nombre'];
            array_push($datos, $item);
        } while ($row = $stmt->fetch());
        return $datos;
    }

    public function listarTransportadoras() {
        $sql = "select id, nombre from transportadora";
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        if (empty($row['id'])) {
            return array(0 => -1, 1 => 'No hay transportadoras');
        }
        $datos = array();
        do {
            $item = new Datos();
            $item->id = $row['id'];
            $item->nombre = $row['nombre'];
            array_push($datos, $item);
        } while ($row = $stmt->fetch());
        return $datos;
    }

    public function registrarVisita($datos = []) {
        $sql = "insert into visita(nombre,descripcion,empresa,cupos,estado,transportadora,fechaini)" .
                " values (?,?,?,?,?,?,?)";

        try {
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(1, $datos['name']);
            $stmt->bindValue(2, $datos['desc']);
            $stmt->bindValue(3, $datos['empresa']);
            $stmt->bindValue(4, $datos['cupos']);
            $stmt->bindValue(5, 1);
            $stmt->bindValue(6, $datos['transpor']);
            $stmt->bindValue(7, $datos['fechaini']);
            $stmt->execute();
        } catch (PDOException $ex) {
            return false;
        }
        return true;
    }

    public function listaPersonaVisitas($visita) {
        $datos = array();
        $sql = "select pv.id as id, p.nombre as persona, p.id as idPersona, p.codigo as codigo, pv.estado as estado " .
                "from personavisita pv join persona p on pv.persona=p.id where pv.visita=" . $visita;
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $stmt->fetch()) {
            $item = new Personavisita();
            $item->id = $row['id'];
            $item->idPersona = $row['idPersona'];
            $item->nombrePersona = $row['persona'];
            $item->codigoPersona = $row['codigo'];
            switch ($row['estado']) {
                case 1:
                    $item->estado = "Espera";
                    break;

                case 2 :
                    $item->estado = "Reprobado";
                    break;
                case 3 :
                    $item->estado = "Aprobado";
                    break;
                case 4:
                    $item->estado = "En Ejecucion";
            }

            array_push($datos, $item);
        }
        return $datos;
    }

    public function listaVisitas() {
        $datos = array();
        $sql = "select  v.id as id, v.nombre as nombre, " .
                "e.nombre as empresa, t.nombre as transportadora, v.cupos as cupos" .
                " from (visita v join empresa e on v.empresa = e.id)" .
                " join transportadora t on v.transportadora=t.id" .
                " where  estado=3 or estado=4 or estado = 5";
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $stmt->fetch()) {
            $item = new Visita();
            $item->id = $row['id'];
            $item->nombre = $row['nombre'];
            $item->empresa = $row['empresa'];
            $item->transportadora = $row['transportadora'];
            $item->cupos = $row['cupos'];
            array_push($datos, $item);
        }
        return $datos;
    }

    public function hayCupos($visita){
         $sql="select id from visita where id=".$visita." and cupos>0";
         $stmt = $this->db->connect()->query($sql);
         $stmt->setFetchMode(PDO::FETCH_ASSOC);
         $row = $stmt->fetch();
         if(empty($row['id'])){
             return false;
         }
         return true;
    }

    public function evaluarPersonaVisita($persona, $visita, $estado) {
        $sql = "update personavisita set estado=" . $estado . " where visita=" . $visita . " and persona=" . $persona;
        $stmt = $this->db->connect()->prepare($sql);

        if ($stmt->execute()) {
            if ($estado == 3) {
                $this->modificarCuposVisita($visita, -1);
                $sql3 = "update personavisita set estado=2 where persona=" . $persona . " and estado=1";
                $stmt3 = $this->db->connect()->query($sql3);
                if ($stmt3->execute()) {
                    return true;
                }
                return false;
            }
            return true;
        }
        return false;
    }

    private function modificarCuposVisita($visita, $num) {
        $sql = "update visita set cupos=cupos+" . $num . " where id=" . $visita;
        $stmt = $this->db->connect()->query($sql);
    }

    public function ejecutarFinalizarVisita($visita, $estado) {
        $resp = $this->cambiarEstado($visita, $estado);
        if ($resp) {
            $sql = "update personavisita set estado=" . $estado . " where visita=" . $visita . " and (estado=3 or estado=4)";
            $stmt = $this->db->connect()->query($sql);
            $sql2 = "update personavisita set estado=2 where visita=" . $visita . " and estado=1";
            $stmt2 = $this->db->connect()->query($sql2);
            return true;
        }
        return false;
    }

    public function listaInformes($visita) {
        $sql = "select i.id as id, p.id as idPersona, p.nombre as nombre, p.codigo as codigo, i.archivo as archivo " .
                "from (personavisita pv join persona p on pv.persona=p.id) join informe i on pv.id=i.visita " .
                "where pv.visita=" . $visita;
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = array();
        while ($row = $stmt->fetch()) {
            $informe = new Informe();
            $informe->id = $row['id'];
            $informe->archivo = $row['archivo'];
            $informe->persona = $row['nombre'];
            $informe->visita = $visita;
            $informe->codigo = $row['codigo'];
            $informe->idPersona = $row['idPersona'];
            array_push($datos, $informe);
        }
        return $datos;
    }

    //}-------------------------------------------------------------------------
    //FUNCIONES DEL ESTUDIANTE
    //{-------------------------------------------------------------------------
    public function listaVisitasDisponibles() {
        $datos = array();
        $sql = "select v.id as id, v.nombre as nombre, v.cupos as cupos, e.nombre as empresa, t.nombre as transportadora" .
                " from (visita v join empresa e on v.empresa=e.id) " .
                "join transportadora t on v.transportadora=t.id where cupos>0 and estado=3";
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $stmt->fetch()) {
            $item = new Visita();
            $item->id = $row['id'];
            $item->nombre = $row['nombre'];
            $item->empresa = $row['empresa'];
            $item->transportadora = $row['transportadora'];
            $item->cupos = $row['cupos'];


            array_push($datos, $item);
        }
        return $datos;
    }

    public function registrarPersonaVisita($persona, $visita) {

        $sql = "insert into personavisita(visita,persona,fecha,estado)values(?,?,?,?)";

        try {
            $stmt = $this->db->connect()->prepare($sql);
            $stmt->bindValue(1, $visita);
            $stmt->bindValue(2, $persona);
            $stmt->bindValue(3, date("Y-m-d"));
            $stmt->bindValue(4, 1);
            $stmt->execute();
        } catch (Exception $ex) {
            return false;
        }
        return true;
    }

    public function cancelarRegistroPersona($visita) {
        $sql = "delete from personavisita where id=" . $visita;
        try {
            $stmt = $this->db->connect()->query($sql);
        } catch (PDOException $e) {
            return false;
        }
        $this->modificarCuposVisita($visita, 1);
        return true;
    }

    public function getEstadoPersonaVisita($visita, $persona) {
        $sql = "select estado from personavisita where visita=" . $visita . " and persona=" . $persona;
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();

        if (empty($row['estado'])) {
            return "No registrado";
        }
        switch ($row['estado']) {
            case 1:
                return "Postulado";
            case 2:
                return "Reprobado";
            case 3:
                return "Aprobado";
            case 4:
                return "En Ejecucion";
        }
        return "";
    }

    public function estaRegistrado($persona) {
        $sql = "select id from personavisita where persona=" . $persona . " and (estado=3 or estado=4)";
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        if (empty($row['id'])) {
            return false;
        }
        return true;
    }

    public function getVisitaRegistrada($persona) {
        $sql = "select pv.id as id, v.nombre as visita, v.descripcion as descripcion, " .
                "e.nombre as empresa, t.nombre as transportadora, pv.estado as estado, " .
                "p.id as idPersona, v.id as idVisita, v.fechaini as fecha " .
                "from (((personavisita pv join visita v on pv.visita = v.id)" .
                " join persona p on pv.persona = p.id) join empresa e on v.empresa = e.id)" .
                " join transportadora t on v.transportadora = t.id" .
                " where p.id=" . $persona . " and (pv.estado=3 or pv.estado=4)";
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();

        $item = new Visita();
        $item->id = $row['id'];
        $item->nombre = $row['visita'];
        $item->descripcion = $row['descripcion'];
        $item->empresa = $row['empresa'];
        $item->transportadora = $row['transportadora'];
        $item->fecha = $row['fecha'];
        switch ($row['estado']) {
            case 3:
                $item->estado = "Aprobado";
                break;

            case 4:
                $item->estado = "En Ejecución";
                break;
        }

        $item->idPersona = $row['idPersona'];

        return $item;
    }

    public function getInformesPersona($id) {
        $sql = "select * from informe where visita=" . $id;
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        if (empty($row['id'])) {
            return '';
        }
        $datos = array();
        do {
            $informe = new Informe();
            $informe->id = $row['id'];
            $informe->archivo = $row['archivo'];
            $informe->persona = $_SESSION['user'];
            $informe->visita = $id;
            array_push($datos, $informe);
        } while ($row = $stmt->fetch());
        return $datos;
    }

    public function subirInforme($pvisita, $archivo, $persona) {
        $sql = "select visita as visita from personavisita " .
                "where id=" . $pvisita;
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();

        $micarpeta = constant('ROOT') . 'informes/' . $row['visita'] . '/' . $persona . '/';
        if (!file_exists($micarpeta)) {
            mkdir($micarpeta, 0777, true);
        }
        $dirarch = constant('ROOT') . 'informes/' . $row['visita'] . '/' . $persona . '/' . $archivo['name'];
        if (file_exists($dirarch)) {
            return false;
        }
        move_uploaded_file($archivo['tmp_name'], $dirarch);
        $sql = "insert into informe(archivo,visita) values(?,?)";
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->bindValue(1, $archivo['name']);
        $stmt->bindValue(2, $pvisita);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            return false;
        }
        return true;
    }

    public function descargarInforme($informe, $persona) {
        $sql = "select pv.visita as pvisita, i.archivo as archivo, pv.visita as visita " .
                "from personavisita pv join informe i on pv.id=i.visita where i.id=" . $informe;
        $stmt = $this->db->connect()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        $enlace = constant('ROOT') . 'informes/' . $row['visita'] . '/' . $persona . '/' . $row['archivo'];
        header("Content-Disposition: attachment; filename=" . $row['archivo'] . " ");
        header("Content-Type: application/pdf");
        header("Content-Length: " . filesize($enlace));
        readfile($enlace);
    }

    //}-------------------------------------------------------------------------
}

?>