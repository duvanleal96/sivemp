<?php
require_once 'layout/director_header_layout.php'; //AGREGA EL HEADER A LA PAGINA
?>   

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="row">

            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Datos Personales</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-responsive table-striped table-hover">
                            <tbody>

                                <tr>
                                    <td class="col-md-2" rowspan="7" >
                                        <div class="pull-right">
                                            <img src="<?php echo constant('URL'); ?>dist/img/avatar5.png" class="img-responsive img-circle" alt="">
                                        </div>
                                    </td>
                                    <th>Nombre:</th>
                                    <?php
                                    echo '<th>' . $this->datos['nombre'] . '</th>';
                                    ?>
                                </tr>
                                <tr>
                                    <th>Cedula: </th>
                                    <?php
                                    echo '<th>' . $this->datos['cedula'] . '</th>';
                                    ?>
                                </tr>
                                <tr>
                                    <th>Codigo: </th>
                                    <?php
                                    echo '<th>' . $this->datos['codigo'] . '</th>';
                                    ?>
                                </tr>
                                <tr>
                                    <th>Telefono: </th>
                                    <?php
                                    echo '<th>' . $this->datos['telefono'] . '</th>';
                                    ?>
                                </tr>
                                <tr>
                                    <th>Fecha de Nacimiento: </th>
                                    <?php
                                    echo '<th>' . $this->datos['fechanac'] . '</th>';
                                    ?>
                                </tr>
                                <tr>
                                    <th>Direccion: </th>
                                    <?php
                                    echo '<th>' . $this->datos['direccion'] . '</th>';
                                    ?>
                                </tr>
                                <tr>
                                    <th>
                                        <form action="<?php echo constant('URL'); ?>usuario/editar" method="post">

                                            <button type="submit"  class="btn btn-primary">Editar  <i class="glyphicon glyphicon-pencil"></i> </button>
                                        </form>
                                    </th>
                                </tr>

                            </tbody>


                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content -->
</div>




<?php
require_once 'layout/director_footer_layout.php'; //AGREGA EL FOOTER A LA PAGINA
?>