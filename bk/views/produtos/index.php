<div class="card">
    <div class="card-header">
        <h3 class="card-title">Produtos</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table id="tabela" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Marca</th>
                    <?php if($this->auth->adminAuth()): ?>            
                        <th>Usuario Cadastrou</th>
                    <?php endif; ?>
                    <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $produto): ?>
                        <tr>
                            <td><?php echo $produto['nome'];?></td>
                            <td><?php echo $produto['categoria'];?></td>
                            <td><?php echo $produto['marca'];?></td>
                            <?php if($this->auth->adminAuth()): ?>  
                                <td><?php echo (!empty($produto['usuario'])) ? $produto['usuario']: "Usuário Deletado";?></td>
                            <?php endif; ?>
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
                        window.location.href = "<?php echo BASE_URL; ?>produto";
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
