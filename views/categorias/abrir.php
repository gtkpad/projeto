<div class="row">
    <div class="col-sm-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <h3 class="profile-username text-center"><?php echo $categoria['nome']; ?></h3>


                    <ul class="list-group list-group-unbordered mb-3">

                        <li class="list-group-item">
                            <b>Produtos Vinculados</b> <a class="float-right"><?php echo $qntprodutos; ?></a>
                        </li>
                    </ul>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card --> 
    </div>
    <div class="col-sm-9">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Produtos da categoria</h5>
            </div>
            <div class="card-body box-profile">
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
                                    <td><?php echo $produto['nome']; ?></td>
                                    <td><?php echo $produto['categoria'];?></td>
                                    <td><?php echo $produto['marca'];?></td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="<?php echo BASE_URL; ?>produto/abrir/<?php echo $produto['id']; ?>">Abrir</a>  
                                        <?php if($this->auth->adminAuth()): ?>
                                           <button class="btn btn-sm btn-danger" onclick="deletar(<?php echo $produto['id']; ?>)">Remover</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

<?php if($this->auth->adminAuth()): ?>
    <div class="col-sm-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Editar</h5>
            </div>
            <div class="card-body">

            <form method="POST" action="<?php echo BASE_URL; ?>categoria/editar/<?php echo $categoria['id']; ?>">
                <div class="row">
                
                    <div class="col-md-12 mb-3">
                        <label for="name">Nome</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="inputname"><i class="far fa-copyright"></i></span>
                            </div>
                            <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome" aria-describedby="nome" value="<?php echo $categoria['nome']; ?>" required>
                        </div>
                    </div>

                </div>

                <div class="row justify-content-center">
                <div class="col-md-2 mb-3 justify-content-center">
                    
                    <div class="input-group">
                        <input type="submit" class="btn btn-success" value="Editar">
                    </div>
                </div>
                </div>

            </form>

            </div>
        </div>
    
    </div>
<?php endif; ?>

</div>

<?php if($this->auth->adminAuth()): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
    function deletar(id){

        Swal.fire({
        title: 'Tem certeza que deseja deletar?',
        text: "Essa operação não pode ser revertida",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim, Desejo deletar!'
        }).then((result) => {
        if (result.value) {

                $.ajax({
            url: "<?php echo BASE_URL; ?>produto/deletar/"+id,
            type: "GET",
            dataType: "html"

            }).done(function(data) {
                Swal.fire(
                    'Removido!',
                    'O Produto foi deletado.',
                    'success'
                    ).then((result) => {
                        if (result.value) {
                            window.location.href = "<?php echo BASE_URL; ?>categoria/abrir/<?php echo $categoria['id']; ?>";
                        }
                        })
                console.log(resposta);

            }).fail(function(jqXHR, textStatus ) {
                console.log("Request failed: " + textStatus);

            }).always(function() {
                console.log("completou");
            });


           
        }
        })
    }
    </script>
<?php endif; ?>