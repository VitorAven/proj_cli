<section class="content-header">
    <h1>
        Adicionar Banner

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo site_url('noticia/list'); ?>">Noticia</a></li>
        <li class="active">Editar</li>
        <li class="active"><?php echo $item->titulo; ?></li>
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
                        <div class="form-group">
                            <label for="exampleInputNome">Nome</label>
                            <input type="text" class="form-control" id="exampleInputNome" name="nome" placeholder="Digite o Título" value="<?php echo $item->nome; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Capa</label>

                            <input type="file" name="userfile"  id="exampleInputFile" >
                            <p class="help-block">Imagem de 360x360</p>
                            <img src="<?php echo base_url('assets/uploads/galeria') . "/tumb_" . $item->capa; ?>" width="50px" height="50px;">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ativo" value="1" <?php echo $item->ativo == 1 ? 'checked' : ''; ?>>Ativo
                            </label>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <a href="<?php echo site_url() . '/galeria/list'; ?>" class="btn btn-info">
                            <i class="fa fa-arrow-left"></i>
                            Volar
                        </a>
                        <button type="submit" class="btn btn-primary bg-olive">Salvar</button>

                    </div>
                </form>
            </div><!-- /.box -->
        </div>          </div>   <!-- /.row -->
</section><!-- /.content -->
