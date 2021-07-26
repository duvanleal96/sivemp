<?php
require_once 'layout/estudiante_header_layout.php'; //AGREGA EL HEADER A LA PAGINA
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Editar Informacion de Estudiante
        </h1>

    </section>

    <!-- Main content -->
    <div class="col-md-2"></div>
    <div class="col-md-7">

        <section class="content container-fluid">


            <div class="register-box-body">
                <p class="login-box-msg"></p>

                <form action="<?php echo constant('URL'); ?>usuario/editarInformacion" method="post">

                    <input type="hidden" name="id" value=<?php echo '"' . $this->datos['id'] . '"'; ?>>

                    <div class="form-group has-feedback">
                        <input type="text" name="name" class="form-control" placeholder="Nombre" required 
                               value=<?php echo '"' . $this->datos['nombre'] . '"'; ?>>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="text" name="cc" class="form-control" placeholder="Cedula" required 
                               value=<?php echo '"' . $this->datos['cedula'] . '"'; ?>>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="text" name="codigo" class="form-control" placeholder="Codigo" required 
                               value=<?php echo '"' . $this->datos['codigo'] . '"'; ?>>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="text" name="tel" class="form-control" placeholder="Telefono" required 
                               value=<?php echo '"' . $this->datos['telefono'] . '"'; ?>>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="date" name="fechan" class="form-control" placeholder="Fecha de Nacimiento" required 
                               value=<?php echo '"' . $this->datos['fechanac'] . '"'; ?>>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="text" name="dir" class="form-control" placeholder="Direccion" required 
                               value=<?php echo '"' . $this->datos['direccion'] . '"'; ?>>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>


                    <div class="row">
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Editar Informacion</button>
                        </div>
                        <!-- /.col -->
                    </div>

                </form>


            </div>

            <!--------------------------
            | Your Page Content Here |
            -------------------------->

        </section>
    </div>
    <!-- /.content -->
</div>

<?php
require_once 'layout/estudiante_footer_layout.php'; //AGREGA EL FOOTER A LA PAGINA
?>