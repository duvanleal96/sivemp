<?php
require_once 'layout/docente_header_layout.php'; //AGREGA EL HEADER A LA PAGINA
?>  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>

            Registro Empresa
        </h1>

    </section>
    <!-- Main content -->
    <section class="content container-fluid">


        <div class="register-box-body ">
            <p class="login-box-msg">Registro de Nuevo Empresa</p>

            <form action="<?php echo constant('URL'); ?>usuario/registrarEmpresa" method="post">



                <div class="row">

                    <div class="col-xs-6 col-sm-12">
                        <div class="form-group has-feedback  ">
                            <input required type="text" id="name" name="name" class="form-control" placeholder="Nombre">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback ">
                            <input required type="text" id="nic" name="nic" class="form-control" placeholder="Nit">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <input required type="text" id="dir" name="dir" class="form-control" placeholder="Direccion">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <input required type="text-area" id="desc" name="desc" class="form-control" placeholder="Descripcion">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <input type="text" id="tel" name="tel" class="form-control" placeholder="Telefono">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <input required type="text" id="ciudad" name="ciudad" class="form-control" placeholder="Ciudad">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <input required type="text" id="replegal" name="replegal" class="form-control" placeholder="Replegal">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>

                        <div class="row">
                            <!-- /.col -->
                            <div class="col-xs-6 col-sm-4"></div>
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
                            </div>
                            <!-- /.col -->
                        </div>

                    </div>

                </div>



            </form>



        </div>




    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
require_once 'layout/docente_footer_layout.php'; //AGREGA EL FOOTER A LA PAGINA
?>