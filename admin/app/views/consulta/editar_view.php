<section class="content-header">
    <h1>
        Editar Médico

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo site_url('paciente/list'); ?>">paciente</a></li>
        <li class="active">Editar</li>
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
                            <label for="exampleInputNome">Nome</label>
                            <input type="text" class="form-control" id="exampleInputNome" name="nome" placeholder="Digite o Nome" value="<?php echo $item->nome; ?>">
                        </div>
                        <div class="form-group col-lg-6  col-md-6 col-sm-12 col-xs-12">
                            <label for="exampleInputNome">sobreome</label>
                            <input type="text" class="form-control" id="exampleInputNome" name="sobre_nome" placeholder="Digite o Sobrenomeome" value="<?php echo $item->sobre_nome; ?>">
                        </div>
                        <div class="form-group col-lg-6  col-md-6 col-sm-12 col-xs-12">
                            <label for="exampleInputNome">Data de Nascimento</label>
                            <input type="date" class="form-control" id="exampleInputNome" name="dt_nasc" placeholder="" value="<?php echo $item->dt_nasc; ?>">
                        </div>
                        <div class="form-group col-lg-6  col-md-6 col-sm-12 col-xs-12">
                            <label for="exampleInputNome">RG</label>
                            <input type="text" class="form-control" id="exampleInputNome" data-inputmask='"mask": "99.999.999-99"' name="rg" placeholder="Digite o RG" data-mask value="<?php echo $item->rg; ?>">
                        </div>

                        <div class="form-group col-lg-6  col-md-6 col-sm-12 col-xs-12">
                            <label for="exampleInputNome">CPF</label>
                            <input type="text" name="cpf" placeholder="Digite o CPF" class="form-control" data-inputmask='"mask": "999.999.999-99"' data-mask value="<?php echo $item->cpf; ?>">
                        </div>
                          <div class="form-group col-lg-6  col-md-6 col-sm-12 col-xs-12">
                            <label for="exampleInputNome">CRM</label>
                            <input type="text" name="crm" placeholder="Digite o CPF" class="form-control" value="<?php echo $item->crm; ?>" disabled>
                        </div>


                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                            <a href="<?php echo site_url('medico/list'); ?>" class="btn btn-success">Voltar</a>
                        </div>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>          </div>   <!-- /.row -->
</section><!-- /.content -->
