<?php //print_r($lista);die(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Consultas
        <small>Listagem de Consultas</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Consultas</li>
        <li class="active">Listagem</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Paciente</th>
                                <th>Médico</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista as $li): ?>
                                <tr>
                                    <th>
                                        <?php
                                        $date = new DateTime($li['data']);
                                        echo $date->format('d/m/Y');
                                        //echo date("d/m/y");
                                        ?>
                                    </th>
                                    <th><?php echo $li['hora']; ?></th>
                                    <th><?php echo $li['paciente_nome']; ?></th>
                                    <th><?php echo $li['medico_nome']; ?></th>
                                    <th>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <!--
                                                                                                <a href="<?php echo site_url('medico') . '/' . $li['id']; ?>">
                                                                                                    <button class="btn  btn-success ">Editar</button>
                                                                                                </a>-->
                                                <a href="<?php echo site_url('medico/excluir/') . '/' . $li['id']; ?>"><button class="btn  btn-danger ">Excluir</button></a>

                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Paciente</th>
                                <th>Médico</th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
