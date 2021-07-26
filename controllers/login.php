
<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();
        session_start();
        if (isset($_SESSION['id'])) {
            $this->view->redirect('');
        }
    }

    private function alerta() {
        if (isset($_GET['m'])) {
            if ($_GET['m'] == 0) {
                $men = "Usuario o Contraseña incorrectos.";
            } else if ($_GET['m'] == 1) {
                $men="Registro realizado con éxito.";
            }
            $mensajes = new Mensajes();
            $mensajes->show($men);
        }
    }

    function render() {
        $this->view->render('login');
        $this->alerta();
    }

    function ingresar() {
        $user = $_POST['usuario'];
        $pass = $_POST['contrasenia'];
        $resp = $this->model->ingresar($user, $pass);
        if ($resp) {
            $this->view->redirect('');
        } else {
            $this->view->redirect('login?m=0');
        }
    }

}

?>