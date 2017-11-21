
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Banners 
        <small>Listagem de banners</small>
    </h1>
    <ol class="breadcrumb">
         <li><a href="<?php echo site_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Banners</li>
        <li class="active">Listagem</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
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
                            <input type="text" class="form-control" id="exampleInputNome" name="nome" placeholder="Digite o nome do banner">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputTexto">Descrição</label>
                            <input type="text" class="form-control" id="exampleInputTexto" name="desc" placeholder="Digite o texto do banner">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputTexto">URL</label>
                            <input type="text" class="form-control" id="exampleInputTexto" name="url" placeholder="Digite o texto do banner">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Selecione o arquivo</label>
                            <input type="file" name="userfile"  id="exampleInputFile" >
                            <p class="help-block">Imagem de 1200px</p>
                        </div>
                        <!--<div class="checkbox">
                            <label>
                                <input type="checkbox" name="ativo">Ativo
                            </label>
                        </div>-->
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div><!-- /.box -->

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>URL</th>
                                <th>Açoes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($banners as $ban): ?>
                                <tr>
                                    <th><?php echo $ban['nome']; ?></th>
                                    <th><?php echo $ban['url']; ?></th>
                                    <th>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <a href="<?php echo site_url('banner/excluir/') . '/' . $ban['id']; ?>"><button class="btn btn-danger ">Excluir</button></a>
                                    <?php if ($ban['ativo'] == 0): ?>
                                        <a href="<?php echo site_url('banner/ativar/') . '/' . $ban['id']; ?>">
                                            <button class="btn  btn-primary ">Ativar</button>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($ban['ativo'] == 1): ?>
                                        <a href="<?php echo site_url('banner/desativar/') . '/' . $ban['id']; ?>">
                                            <button class="btn  btn-warning ">Desativar</button>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            </th>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>URL</th>
                                <th>

                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
