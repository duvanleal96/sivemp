<?php
require_once'layout/docente_header_layout.php'; //AGREGA EL HEADER A LA PAGINA
?> 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Registro ARL 
        </h1>

    </section>

    <!-- Main content -->
    <section class="content container-fluid">


        <div class="register-box-body ">
            <p class="login-box-msg">Registro ARL</p>

            <form action="<?php echo constant('URL'); ?>usuario/registrarArl" method="post">



                <div class="row">

                    <div class="col-xs-6 col-sm-12">
                        <div class="form-group has-feedback  ">
                            <input required type="text" class="form-control" id="name" name="name" placeholder="Nombre">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback ">
                            <input required type="date" id="fechaa" name="fechaa" class="form-control" placeholder="Fecha de Afiliacion ">
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






        <!--------------------------
        | Your Page Content Here |
        -------------------------->

    </section>
    <!-- /.content -->
</div>



<?php
require_once 'layout/director_footer_layout.php'; //AGREGA EL FOOTER A LA PAGINA
?>