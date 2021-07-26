
<?php

class Usuario extends Controller{

    function __construct(){
        parent::__construct();
        session_start();
        if(!isset($_SESSION['id'])){
        	$this->view->redirect('login');
        }
    }

    private function validarSesion($rol){
        if($rol!=$_SESSION['rol']){
            //MENSAJE DE NO TIENE PERMITIDO INGRESAR A ESTA PAGINA
            $this->view->redirect();
            return true;
        }
        return false;
    }

    private function rolRender($rol, $direcion){
        switch ($rol) {
            case 1:
                $usuario='estudiante';
                break;
            case 2:
                $usuario='docente';
                break;
            case 3:
                $usuario='director';
                break;
        }
        $this->view->render($usuario.'/'.$direcion);
    }

    function render(){
       $this->informacion();
    }

    //FUNCIONES DEL DIRECTOR
    //{------------------------------------------------------------------------
    function registroDocente(){
        if($this->validarSesion(3)){
            return;
        }
        $this->view->render('director/registroDocente');
        $this->alerta();
    }

    function registrarDocente(){
        if($this->validarSesion(3)){
            return;
        }
        $name = filter_input(INPUT_POST, "name");
        $cc = filter_input(INPUT_POST, "cc");
        $codigo = filter_input(INPUT_POST, "codigo");
        $tel = filter_input(INPUT_POST, "tel");
        $fecha = filter_input(INPUT_POST, "fechan");
        $date = new DateTime($fecha);
        $direc = filter_input(INPUT_POST, "dir");
        $pass = filter_input(INPUT_POST, "pass");
        $pass2 = filter_input(INPUT_POST, "pass2");
        if($pass!=$pass2){
            //ERROR NO COINCIDEN LAS CONTRASEÑAS
            return;
        }
        $datos = array('rol' => 2,'name' => $name, 'cc' => $cc, 'codigo' => $codigo,
         'tel' => $tel, 'date' => $date->format('Y-m-d'), 'direc' => $direc, 'pass' => $pass);
        $resp=$this->model->registrarDocente($datos);
        if($resp){
            //REGISTRO CORRECTAMENTE
            $this->view->redirect('usuario/registroDocente?m=2');
        } else {
            $this->view->redirect('usuario/registroDocente?m=-2');
        }
    }
    //}------------------------------------------------------------------------

    //TODAS LAS SESIONES
    //{------------------------------------------------------------------------
    private function cargarDatos(){
        $datos=array();
        $datos=$this->model->informacion();
        $this->view->datos=$datos;
    }
    
    private function alerta() {
        if(isset($_GET['m'])){
            switch ($_GET['m']) {
                case 1:
                    $men="Información editada con éxito.";
                    break;
                case -1:
                    $men="Ocurrió un error al editar la información.";
                    break;
                case 2:
                    $men="Se ha realizado el registro con exito.";
                    break;
                case -2:
                    $men="Ocurrió un error al realizar el registro.";
                    break;
                default:
                    break;
            }
            $mensajes=new Mensajes();
            $mensajes->show($men);
        }
    }

    function informacion(){
    	$this->cargarDatos();
        $this->rolRender($_SESSION['rol'], 'informacion');
        $this->alerta();
    }

    function editar(){
        $this->cargarDatos();
        $this->rolRender($_SESSION['rol'],'editar');
    }

    function editarInformacion(){
        $id = filter_input(INPUT_POST, "id");
        $eps = isset($_POST['eps'])?filter_input(INPUT_POST, "eps"):null;
        $arl = isset($_POST['arl'])?filter_input(INPUT_POST, "arl"):null;
        $name = filter_input(INPUT_POST, "name");
        $cc = filter_input(INPUT_POST, "cc");
        $codigo = filter_input(INPUT_POST, "codigo");
        $tel = filter_input(INPUT_POST, "tel");
        $fecha = filter_input(INPUT_POST, "fechan");
        $date = new DateTime($fecha);
        $direc = filter_input(INPUT_POST, "dir");
        $datos=array('eps' => $eps, 'arl' => $arl, 'id'=>$id, 'name'=>$name, 'cc'=>$cc, 'codigo'=>$codigo, 
            'tel'=>$tel, 'fecha'=>$date->format('Y-m-d'), 'direc'=>$direc);
        $resp=$this->model->editar($datos);
        if($resp){
            $this->view->redirect('usuario/informacion?m=1');
        }else{
            $this->view->redirect('usuario/informacion?m=-1');
        }
    }

    function cerrarSesion(){
        $this->model->cerrarSesion();
        $this->view->redirect('login');
    }
    //}------------------------------------------------------------------------


    //FUNCIONES DEL DOCENTE
    //{------------------------------------------------------------------------
    function empresa(){
        $this->rolRender(2,'registroEmpresa');
        $this->alerta();
    }

    function registrarEmpresa(){
        $name = filter_input(INPUT_POST, "name");
        $nit = filter_input(INPUT_POST, "nic");
        $dir = filter_input(INPUT_POST, "dir");
        $desc = filter_input(INPUT_POST, "desc");
        $tel = filter_input(INPUT_POST, "tel");
        $ciudad = filter_input(INPUT_POST, "ciudad");
        $replegal = filter_input(INPUT_POST, "replegal");
        $datos=array('name' => $name, 'nic' => $nit, 'dir' => $dir, 'desc' => $desc, 
            'tel' => $tel, 'ciudad' => $ciudad, 'replegal' => $replegal);
        $resp=$this->model->registrarEmpresa($datos);
        if($resp){
            $this->view->redirect('usuario/empresa?m=2');
        }else{
            $this->view->redirect('usuario/empresa?m=-2');
        }
    }

    function transportadora(){
        $this->rolRender(2,'registroEmpTransport');
        $this->alerta();
    }

    function registrarTransportadora(){
        $name = filter_input(INPUT_POST, "name");
        $nit = filter_input(INPUT_POST, "nit");
        $replegal = filter_input(INPUT_POST, "replegal");
        $datos=array('name' => $name, 'nit' => $nit, 'replegal' => $replegal);
        $resp=$this->model->registrarTransportadora($datos);
        if($resp){
            $this->view->redirect('usuario/transportadora?m=2');
        }else{
            $this->view->redirect('usuario/transportadora?m=-2');
        }
    }

    function eps(){
        $this->rolRender(2,'registroEps');
        $this->alerta();
    }

    function registrarEPS(){
        $name = filter_input(INPUT_POST, "name");
        $regimen = filter_input(INPUT_POST, "regimen");
        $fechaa = filter_input(INPUT_POST, "fechaa");
        $date = new DateTime($fechaa);
        $datos=array('name' => $name, 'regimen' => $regimen,
            'fechaa' => $date->format("Y-m-d"));
        $resp=$this->model->registrarEPS($datos);
        if($resp){
            $this->view->redirect('usuario/eps?m=2');
        }else{
            $this->view->redirect('usuario/eps?m=-2');
        }
    }

    function arl(){
        $this->rolRender(2,'registroArl');
        $this->alerta();
    }

    function registrarARL(){
        $name = filter_input(INPUT_POST, "name");
        $fechaa = filter_input(INPUT_POST, "fechaa");
        $date = new DateTime($fechaa);
        $datos=array('name' => $name, 'fechaa' => $date->format("Y-m-d"));
        $resp=$this->model->registrarARL($datos);
        if($resp){
            $this->view->redirect('usuario/arl?m=2');
        }else{
            $this->view->redirect('usuario/arl?m=-2');

        }
    }    

    //}------------------------------------------------------------------------

    
}

?>