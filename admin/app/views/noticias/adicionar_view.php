<section class="content-header">
    <h1>
        Adicionar Banner

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo site_url('noticia/list'); ?>">Noticia</a></li>
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
                            <label for="exampleInputNome">Título</label>
                            <input type="text" class="form-control" id="exampleInputNome" name="titulo" placeholder="Digite o Título">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputNome">Subtitulo</label>
                            <input type="text" class="form-control" id="exampleInputNome" name="subtitulo" placeholder="Digite o Subtitulo">
                        </div>
                        <div class="form-group">
                            <label>Texto</label>
                            <textarea class="form-control" rows="3" placeholder="Digite o texto ..." name="texto" ></textarea>
                        </div>
                       

                        <div class="form-group">
                            <label for="exampleInputFile">Capa</label>
                            <input type="file" name="userfile"  id="exampleInputFile" >
                            <p class="help-block">Imagem de 360x360</p>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ativo" value="1">Ativo
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
