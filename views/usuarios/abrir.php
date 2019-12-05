<div class="row">
    <div class="col-sm-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <h3 class="profile-username text-center"><?php echo $usuario['nome']; ?></h3>

                    <p class="text-muted text-center"><?php echo $usuario['grupo_nome']; ?></p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Data de Cadastro</b><a class="float-right"><?php echo date('d-m-Y', strtotime($usuario['data_cadastro'])); ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Produtos cadastrados</b> <a class="float-right"><?php echo $qntprodutos; ?></a>
                        </li>
                    </ul>



                <a href="<?php echo BASE_URL ?>usuarios/editar/<?php echo $usuario['id']; ?>" class="btn btn-primary btn-block"><b>Editar</b></a>

 
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <div class="col-sm-9">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Produtos Cadastrados</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabela" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Marca</th>
                            <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produtos as $produto): ?>
                                <tr>
                                    <td><?php echo $produto['nome'];?></td>
                                    <td><?php echo $produto['categoria'];?></td>
                                    <td><?php echo $produto['marca'];?></td>
                                    <td><a class="btn btn-sm btn-primary" href="<?php echo BASE_URL; ?>usuarios/abrir/<?php echo $usuario['id']; ?>">Abrir</a>   <a class="btn btn-sm btn-danger" href="<?php echo BASE_URL; ?>usuarios/remover/<?php echo $usuario['id']; ?>">Remover</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        
                    </table>
             </div>
            </div>
        </div>
    
    </div>

</div>