<section class="content-header">
    <h1>
        Adicionar Banner

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo site_url('banner'); ?>">Banner</a></li>
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
                    <div class="form-group">
                        <label for="exampleInputNome">Nome</label>
                        <input type="text" class="form-control" id="exampleInputNome" name="nome" placeholder="Digite o nome do banner" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputTexto">Descrição</label>
                        <input type="text" class="form-control" id="exampleInputTexto" name="desc" placeholder="Digite o texto do banner">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputTexto">Texto</label>
                        <input type="text" class="form-control" id="exampleInputTexto" name="texto" placeholder="Digite o texto do banner">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Selecione o arquivo</label>
                        <input type="file" name="userfile"  id="exampleInputFile" required>
                        <p class="help-block">Imagem de 1200px</p>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="ativo">Ativo
                        </label>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div><!-- /.box -->
        </div>          </div>   <!-- /.row -->
</section><!-- /.content -->