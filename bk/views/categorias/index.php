<div class="card">
    <div class="card-header">
        <h3 class="card-title">Categorias</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table id="tabela" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th>Nome</th>
                    <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $categoria): ?>
                        <tr>
                            <td><?php echo $categoria['nome'];?></td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="<?php echo BASE_URL; ?>categoria/abrir/<?php echo $categoria['id']; ?>">Abrir</a>  

                                <?php if($this->auth->adminAuth()): ?>
                                    <button class="btn btn-sm btn-danger" onclick="deletar(<?php echo $categoria['id']; ?>)">Remover</button>
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
        url: "<?php echo BASE_URL; ?>categoria/deletar/"+id,
        type: "GET",
        dataType: "html"

        }).done(function(data) {
            console.log(data);
            if (data == 1){
                Swal.fire(
                    'Removido!',
                    'A categoria foi deletada.',
                    'success'
                    ).then((result) => {
                        if (result.value) {
                            window.location.href = "<?php echo BASE_URL; ?>categoria";
                        }
                        })
            } else{
                Swal.fire({
                    icon: 'error',
                    title: 'Erro ao deletar categoria',
                    text: 'Não é possivel remover uma categoria com produtos vinculados!'
                })
            }

        }).fail(function(jqXHR, textStatus ) {
            console.log("Request failed: " + textStatus);

        }).always(function() {
            console.log("completou");
        });


       
    }
    })
}
</script>
