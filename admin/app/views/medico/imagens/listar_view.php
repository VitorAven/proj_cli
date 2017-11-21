
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Galeria 
        <small>Listagem de banners</small>
    </h1>
    <ol class="breadcrumb">
         <li><a href="<?php echo site_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo site_url('galeria/list');?>">Galeria</a></li>
        <li class="active">Imagens</li>
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
                            <label for="exampleInputFile">Selecione o arquivo</label>
                            <input type="file" name="userfile"  id="exampleInputFile" >
                            <p class="help-block"></p>
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
                                <th>IMG</th>
                                <th>Açoes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista as $li): ?>
                                <tr>
                                    <th><?php echo $li['nome']; ?></th>
                                    <th><img src="<?php echo base_url("assets/uploads/galeria") . "/tumb_" . $li['url']; ?>" width="100px" height="100px"></th>
                                    <th>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <a href="<?php echo site_url('galeria/'.$id.'/imagens/excluir/') . '/' . $li['id']; ?>"><button class="btn btn-danger ">Excluir</button></a>
                                    <?php if ($li['ativo'] == 0): ?>
                                        <a href="<?php echo site_url('galeria/'.$id.'/imagens/ativar/') . '/' . $li['id']; ?>">
                                            <button class="btn  btn-primary ">Ativar</button>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($li['ativo'] == 1): ?>
                                        <a href="<?php echo site_url('galeria/'.$id.'/imagens/desativar/') . '/' . $li['id']; ?>">
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
