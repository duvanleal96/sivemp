<?php

class Visitas extends Controller {

    function __construct() {
        parent::__construct();
        session_start();
        if (!isset($_SESSION['id'])) {
            $this->view->redirect('login');
        }
    }

    private function validarSesion($rol) {
        if ($rol != $_SESSION['rol']) {
            //MENSAJE DE NO TIENE PERMITIDO INGRESAR A ESTA PAGINA
            $this->view->redirect('');
            return true;
        }
        return false;
    }

    private function rolRender($rol, $direcion) {
        switch ($rol) {
            case 1:
                $usuario = 'estudiante';
                break;
            case 2:
                $usuario = 'docente';
                break;
            case 3:
                $usuario = 'director';
                break;
        }
        $this->view->render($usuario . '/' . $direcion);
    }

    //TODAS LAS SESIONES
    //{-------------------------------------------------------------------------

    private function alerta() {
        if (isset($_GET['m'])) {
            switch ($_GET['m']) {
                case 1:
                    $men="La tarea se ha realizado con exito.";
                    break;
                case -1:
                    $men="Ocurrió un error con el servidor.";
                    break;
                case 2:
                    $men="Se ha realizado el registro con exito.";
                    break;
                case -2:
                    $men="Ocurrió un error al realizar el registro.";
                    break;
                case -3:
                    $men="No se ha seleccionado una empresa.";
                    break;
                case -4:
                    $men="No se ha seleccionado una transportadora.";
                    break;
                case 5:
                    $men="Se ha postulado a la visita con exito.";
                    break;
                case -5:
                    $men="Ocurrió un error al postularse.";
                    break;
                case 6:
                    $men="Se ha cancelado su solicitud con exito.";
                    break;
                case -6:
                    $men="Ocurrió un error al cancelar la solicitud.";
                    break;
                case 7:
                    $men="Se subió el informe con exito.";
                    break;
                case -7:
                    $men="Ocurrió un error al subir el informe.";
                    break;
                case -8:
                    $men="Error, no hay mas cupos disponibles.";
                    break;
                case -9:
                    $men="Formato de archivo incorrecto";
                    break;
                default:
                    break;
            }
            $mensajes = new Mensajes();
            $mensajes->show($men);
        }
    }

    function render() {
        $this->lista();
    }

    function lista() {
        $datos = array();
        switch ($_SESSION['rol']) {
            case 1:
                $registrado = $this->model->estaRegistrado($_SESSION['id']);
                if ($registrado) {
                    $this->view->redirect('visitas/visitaRegistrada');
                }
                $datos = $this->model->listaVisitasDisponibles();
                break;
            case 2:
                $datos = $this->model->listaVisitas();
                break;
            case 3:
                $datos = $this->model->listaVisitasEspera();
                break;
        }
        $this->view->datos = $datos;
        $this->rolRender($_SESSION['rol'], 'listaVisitas');
        $this->alerta();
    }

    function detalles() {
        $visita = filter_input(INPUT_POST, "visita");
        if (!isset($visita)) {
            $this->view->redirect('visitas/lista');
            return;
        }
        $datos = $this->model->getVisita($visita);
        $rol = $_SESSION['rol'];
        switch ($rol) {
            case 1:
                $estado = $this->model->getEstadoPersonaVisita($visita, $_SESSION['id']);
                $this->view->estado = $estado;
                $usuario = "estudiante";
                break;
            case 2:
                $estudiantes = $this->model->listaPersonaVisitas($visita);
                if ($datos->estado == "Finalizado") {
                    $informes = $this->model->listaInformes($visita);
                    $this->view->informes = $informes;
                }
                $this->view->estudiantes = $estudiantes;
                $usuario = "docente";
                break;
            case 3:
                $usuario = "director";
                break;
        }
        $this->view->datos = $datos;
        $this->view->render($usuario . '/detalles');
    }

    //}-------------------------------------------------------------------------
    //FUNCIONES DEL DIRECTOR
    //{-------------------------------------------------------------------------

    function cambiarEstado() {
        if ($this->validarSesion(3)) {
            return;
        }
        $visita = filter_input(INPUT_POST, "visita");
        $estado = filter_input(INPUT_POST, "estado");
        if (!isset($visita) || !isset($estado)) {
            $this->view->redirect('visitas/lista');
            return;
        }
        $resp = $this->model->cambiarEstado($visita, $estado);
        if ($resp) {
            $this->view->redirect('visitas/lista?m=1');
        } else {
            $this->view->redirect('visitas/lista?m=-1');
        }
    }

    //}-------------------------------------------------------------------------
    //FUNCIONES DEL DOCENTE
    //{-------------------------------------------------------------------------
    function registroVisita() {
        if ($this->validarSesion(2)) {
            return;
        }
        $transportadora = $this->model->listarTransportadoras();
        $empresa = $this->model->listarEmpresas();
        $this->view->empresa = $empresa;
        $this->view->transportadora = $transportadora;

        $this->view->render('docente/registroVisita');
        $this->alerta();
    }

    function registrarVisita() {
        if ($this->validarSesion(2)) {
            return;
        }
        $name = filter_input(INPUT_POST, "name");
        $desc = filter_input(INPUT_POST, "desc");
        $empresa = filter_input(INPUT_POST, "empresa");
        $transpor = filter_input(INPUT_POST, "transpor");
        if ($empresa == -1) {
            //NO HA SELECCIONADO EMPRESA
            $this->view->redirect('visitas/registrovisita?m=-3');
            return;
        }
        if ($transpor == -1) {
            //NO HA SELECCIONADO TRANSPORTADORA
            $this->view->redirect('visitas/registrovisita?m=-4');
            return;
        }
        $cupos = filter_input(INPUT_POST, "cupos");
        $date = filter_input(INPUT_POST, "fecha");
        $fecha = new DateTime($date);

        $datos = array('name' => $name, 'desc' => $desc, 'empresa' => $empresa,
            'transpor' => $transpor, 'cupos' => $cupos, 'fechaini' => $fecha->format("Y-m-d"));
        $resp = $this->model->registrarVisita($datos);
        if ($resp) {
            //REGISTRO CORRECTO
            $this->view->redirect('visitas/registrovisita?m=2');
        } else {
            //ERROR AL REGISTRAR
            $this->view->redirect('visitas/registrovisita?m=-2');
        }
    }

    function evaluarPersonaVisita() {
        $visita = filter_input(INPUT_POST, "visita");
        $persona = filter_input(INPUT_POST, "estudiante");
        $estado = filter_input(INPUT_POST, "estado");
        $resp1 = $this->model->hayCupos($visita);
        if(!$resp1){
            $this->view->redirect('visitas/lista?m=-8');
            return;
        }
        $resp = $this->model->evaluarPersonaVisita($persona, $visita, $estado);
        if ($resp) {
            //SE HA REALIZADO EL CAMBIO DE ESTADO
            $this->view->redirect('visitas/lista?m=1');
        } else {
            //OCURRIO UN ERROR AL CAMBIAR DE ESTADO
            $this->view->redirect('visitas/lista?m=-1');
        }
    }

    function ejecutarFinalizarVisita() {
        $visita = filter_input(INPUT_POST, "visita");
        $estado = filter_input(INPUT_POST, "estado");
        $resp = $this->model->ejecutarFinalizarVisita($visita, $estado);
        if (!$reps) {
            //SE HA REALIZADO EL CAMBIO DE ESTADO
            $this->view->redirect('visitas/lista?m=1');
        } else {
            //OCURRIO UN ERROR AL CAMBIAR DE ESTADO
            $this->view->redirect('visitas/lista?m=-1');
        }
    }

    //}-------------------------------------------------------------------------
    //FUNCIONES DEL ESTUDIANTE
    //{-------------------------------------------------------------------------
    function registrarPersonaVisita() {
        if ($this->validarSesion(1)) {
            return;
        }
        $persona = $_SESSION['id'];
        $visita = filter_input(INPUT_POST, "visita"); //peticion post por formulario, toma el 'name' como variable
        $resp = $this->model->registrarPersonaVisita($persona, $visita);
        
        if($resp){
            $this->view->redirect('visitas/lista?m=5');
        } else{
            $this->view->redirect('visitas/lista?m=-5');
        }
    }

    function cancelarRegistro() {

        $visita = filter_input(INPUT_POST, "visita");

        $reps = $this->model->cancelarRegistroPersona($visita);

        if ($reps) {
            //SE CANCELO CORRECTAMENTE
            $this->view->redirect('visitas/lista?m=6');
        } else {
            //ERROR AL CANCELAR EL REGISTRO
            $this->view->redirect('visitas/lista?m=-6');
        }
    }

    function visitaRegistrada() {
        if($this->validarSesion(1)){
            return;
        }
        $persona = $_SESSION['id'];
        $datos = $this->model->getVisitaRegistrada($persona);
        $this->view->datos = $datos;
        $this->view->render('estudiante/visitaActiva');
        $this->alerta();
    }

    function informes() {
        $personavisita = filter_input(INPUT_POST, "visita");
        if (!isset($personavisita)) {
            $this->view->redirect('visitas/visitaRegistrada');
        } else {
            $datos = $this->model->getInformesPersona($personavisita);
            $this->view->datos = $datos;
            $this->view->pvisita = $personavisita;
            $this->view->render('estudiante/informes');
        }
    }

    function subirInforme() {
        if (isset($_FILES['archivo']) && $_FILES['archivo']['type'] == 'application/pdf') {
            $archivo = $_FILES['archivo'];
            $pvisita = filter_input(INPUT_POST, "visita");
            $persona = $_SESSION['user'];
            $resp = $this->model->subirInforme($pvisita, $archivo, $persona);
            if ($resp) {
                //SE SUBIO CORRECTAMENTE
                $this->view->redirect('visitas/visitaRegistrada?m=7');
            } else {
                //EL ARCHIVO YA EXISTE U OCURRIO UN ERROR AL SUBIR
                $this->view->redirect('visitas/visitaRegistrada?m=-7');
            }
        } else{
            $this->view->redirect('visitas/visitaRegistrada?m=-9');
        }
    }

    function descargarInforme() {
        $informe = filter_input(INPUT_POST, "informe");
        $persona = filter_input(INPUT_POST, "persona");
        if(!isset($informe)){
            $this->view->redirect('visitas/visitaRegistrada');
            return;
        }
        if (!isset($persona)) {
            $persona = $_SESSION['user'];
        }
        if (isset($informe)) {
            $this->model->descargarInforme($informe, $persona);
        }
    }

    //}-------------------------------------------------------------------------
}

?>