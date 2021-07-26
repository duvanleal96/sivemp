<?php
require_once 'layout/director_header_layout.php'; //AGREGA EL HEADER A LA PAGINA
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>

            <small>Registrar docente </small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <div class="register-box-body">
            <p class="login-box-msg">Registro Nuevo Docente</p>

            <form action="<?php echo constant('URL'); ?>usuario/registrarDocente" method="post">


                <div class="form-group has-feedback">
                    <input required type="text" id="name" name="name" class="form-control" placeholder="Nombre">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input required type="text" id="cc" name="cc" class="form-control" placeholder="Cedula">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input required type="text" id="codigo" name="codigo" class="form-control" placeholder="Codigo">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input required type="text" id="tel" name="tel" class="form-control" placeholder="Telefono">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input required type="date" id="fechan" name="fechan" class="form-control" placeholder="Fecha de Nacimiento">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input required type="text" id="dir" name="dir" class="form-control" placeholder="Direccion">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input required type="password" id="pass" name="pass" class="form-control" placeholder="Contraseña">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input required type="password" id="pass2" name="pass2" class="form-control" placeholder="Verificar Contraseña">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>




                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-4"></div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
                    </div>
                    <!-- /.col -->
                </div>

            </form>




        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
require_once'layout/director_footer_layout.php'; //AGREGA EL HEADER A LA PAGINA
?>   
