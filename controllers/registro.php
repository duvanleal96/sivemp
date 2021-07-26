
<?php

class Registro extends Controller {

    function __construct() {
        parent::__construct();
        session_start();
        if (isset($_SESSION['id'])) {
            $this->view->redirect('');
        }
    }

    private function alerta() {
        if (isset($_GET['m'])) {
            switch ($_GET['m']) {
                case 0:
                    $men="Las contraseñas no coinciden.";
                    break;
                case -1:
                    $men="No se ha seleccionado una EPS.";
                    break;
                case -2:
                    $men="No se ha seleccionado una ARL.";
                    break;
                case -3:
                    $men="Ha ocurrido un error al registrarse.";
                    break;
                default:
                    break;
            }
            $mensajes = new Mensajes();
            $mensajes->show($men);
        }
    }

    function render() {
        $eps = $this->model->cargarEPS();
        $arl = $this->model->cargarARL();
        $this->view->eps = $eps;
        $this->view->arl = $arl;
        $this->view->render('registro');
        $this->alerta();
    }

    function registrar() {
        $name = filter_input(INPUT_POST, "name");
        $cc = filter_input(INPUT_POST, "cc");
        $codigo = filter_input(INPUT_POST, "codigo");
        $tel = filter_input(INPUT_POST, "tel");
        $fecha = filter_input(INPUT_POST, "fechan");
        $date = new DateTime($fecha);
        $direc = filter_input(INPUT_POST, "dir");
        $arl = filter_input(INPUT_POST, "arl");
        $eps = filter_input(INPUT_POST, "eps");
        $pass = filter_input(INPUT_POST, "pass");
        $pass2 = filter_input(INPUT_POST, "pass2");
        if ($pass != $pass2) {
            //ERROR NO COINCIDEN LAS CONTRASEÑAS
            $this->view->redirect('registro?m=0');
            return;
        }
        if ($eps == -1) {
            //NO HA SELECCIONADO EPS
            $this->view->redirect('registro?m=-1');
            return;
        }
        if ($arl == -1) {
            //NO HA SELECCIONADO ARL
            $this->view->redirect('registro?m=-2');
            return;
        }
        $datos = array('rol' => 1, 'name' => $name, 'cc' => $cc, 'codigo' => $codigo, 'tel' => $tel, 'date' => $date->format('Y-m-d')
            , 'direc' => $direc, 'pass' => $pass, 'eps' => $eps, 'arl' => $arl);
        $resp = $this->model->registrar($datos);
        if ($resp) {
            //REGISTRO CORRECTAMENTE
            $this->view->redirect('login?m=1');
        } else {
            //OCURRIO UN ERROR AL REGISTRARSE
            $this->view->redirect('registro?m=-3');
        }
    }

}

?>