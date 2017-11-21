<section class="content-header">
    <h1>
        Adicionar Consulta

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo site_url('consulta/list'); ?>">consulta</a></li>
        <li class="active">Adicionar</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class=" col-lg-12 col-md-12 ">

            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Informações</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <form role="form" method="post" action="" enctype="multipart/form-data" >
                    <div class="box-body">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="exampleInputNome">Paciente</label>
                            <select name="paciente" class="form-control" id="exampleInputNome" required >
                                <?php foreach ($paciente as $pac): ?>    
                                    <option value="<?php echo $pac['id']; ?>"><?php echo $pac['cpf'] . '---' . $pac['nome'] . " " . $pac['sobre_nome'] ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                        <div class="form-group col-lg-6  col-md-6 col-sm-12 col-xs-12">
                            <label for="exampleInputNome">Médico</label>
                            <select name="medico" class="form-control" id="exampleInputNome" required >
                                <?php foreach ($medico as $med): ?>    
                                    <option value="<?php echo $med['id']; ?>"><?php echo $med['crm'] . '---' . $med['nome'] . " " . $med['sobre_nome'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6  col-md-6 col-sm-12 col-xs-12">
                            <label for="exampleInputNome">Data da Consulta</label>
                            <input type="date" class="form-control" id="exampleInputNome" name="data" placeholder="" required>
                        </div>
                        <div class="form-group col-lg-6  col-md-6 col-sm-12 col-xs-12">
                            <label for="exampleInputNome">Hora da Consulta</label>
                            <input type="time" class="form-control" id="exampleInputNome" name="hora" placeholder="" required>
                        </div>
                       


                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>          </div>   <!-- /.row -->
</section><!-- /.content -->
