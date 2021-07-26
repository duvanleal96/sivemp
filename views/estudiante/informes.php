<?php
require_once 'layout/estudiante_header_layout.php'; //AGREGA EL HEADER A LA PAGINA
?>  
<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->


<!-- Main content -->


<div class="content-wrapper">
    <div class="content" >

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h1>Subir Informe</h1>
                        <div class="register-box-body ">

                            <form action="<?php echo constant('URL'); ?>visitas/subirInforme" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="visita" value="<?php echo $this->pvisita ?>">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group has-feedback  ">
                                            <label>Seleccione informe en pdf:</label>
                                            <input required type="file" id="archivo" name="archivo" class="form-control">
                                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                        </div>

                                        <div class="row">
                                            <!-- /.col -->
                                            <div class="col-xs-4"></div>
                                            <div class="col-xs-4">
                                                <button type="submit" class="btn btn-primary btn-block btn-flat">Subir</button>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Lista de Informes</h3>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre de Archivo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($this->datos)) {
                                        echo '<tr><td>No hay informes registrados</td></tr>';
                                    } else {
                                        foreach ($this->datos as $dato) {
                                            echo "<tr>";
                                            echo "<td>" . $dato->archivo . "</td>";
                                            echo '<td>
                                                            <form action="' . constant('URL') . 'visitas/descargarInforme" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="informe" value="' . $dato->id . '">
                                                                <input type="submit"  class="btn btn-primary" value="Descargar">
                                                            </form>
                                                        </td>';
                                            echo "</tr>";
                                        }
                                    }
                                    ?>

                                </tbody>

                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div>



    </div>
</div>
<!-- /.content-wrapper -->

<?php
require_once 'layout/estudiante_footer_layout.php'; //AGREGA EL FOOTER A LA PAGINA
?>