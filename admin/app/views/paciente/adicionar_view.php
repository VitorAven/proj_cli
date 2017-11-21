<section class="content-header">
    <h1>
        Adicionar Paciente

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo site_url('paciente/list'); ?>">paciente</a></li>
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
                            <label for="exampleInputNome">Nome</label>
                            <input type="text" class="form-control" id="exampleInputNome" name="nome" placeholder="Digite o Nome" required>
                        </div>
                        <div class="form-group col-lg-6  col-md-6 col-sm-12 col-xs-12">
                            <label for="exampleInputNome">sobreome</label>
                            <input type="text" class="form-control" id="exampleInputNome" name="sobre_nome" placeholder="Digite o Sobrenomeome" required>
                        </div>
                         <div class="form-group col-lg-6  col-md-6 col-sm-12 col-xs-12">
                            <label for="exampleInputNome">Data de Nascimento</label>
                            <input type="date" class="form-control" id="exampleInputNome" name="dt_nasc" placeholder="" required>
                        </div>
                         <div class="form-group col-lg-6  col-md-6 col-sm-12 col-xs-12">
                            <label for="exampleInputNome">RG</label>
                            <input type="text" class="form-control" id="exampleInputNome" data-inputmask='"mask": "99.999.999-99"' name="rg" placeholder="Digite o RG" data-mask required>
                        </div>
                        
                         <div class="form-group col-lg-6  col-md-6 col-sm-12 col-xs-12">
                            <label for="exampleInputNome">CPF</label>
                            <input type="text" name="cpf" placeholder="Digite o CPF" class="form-control" data-inputmask='"mask": "999.999.999-99"' data-mask required>
                        </div>
                        
                      
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>          </div>   <!-- /.row -->
</section><!-- /.content -->
