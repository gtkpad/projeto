<div class="card">
    <div class="card-header">
        <h3 class="card-title">Usuários</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table id="tabela" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Cadastrado Em</th>
                    <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo $usuario['nome'];?></td>
                            <td><?php echo $usuario['email'];?></td>
                            <td><?php echo date("d/m/Y h:i:s", strtotime($usuario['data_cadastro']));?></td>
                            <td><a class="btn btn-sm btn-primary" href="<?php echo BASE_URL; ?>usuarios/abrir/<?php echo $usuario['id']; ?>">Abrir</a>   <button class="btn btn-sm btn-danger" onclick="deletar(<?php echo $usuario['id']; ?>)">Remover</a></td>
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
        url: "<?php echo BASE_URL; ?>usuarios/deletar/"+id,
        type: "GET"

        }).done(function(data) {
            if(data == 1){
                Swal.fire(
                    'Removido!',
                    'O Usuário foi deletado.',
                    'success'
                    ).then((result) => {
                        if (result.value) {
                            window.location.href = "<?php echo BASE_URL; ?>usuarios";
                        }
                        })
            } else {
                Swal.fire(
                    'Erro!',
                    'Você não pode excluir o próprio usuário',
                    'error'
                    ).then((result) => {
                        if (result.value) {
                            window.location.href = "<?php echo BASE_URL; ?>usuarios";
                        }
                        })
            }
        })

       
    }
    })
}
</script>
