
<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Adicionar Usuário</h3>

        <div class="card-tools">
              <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button> -->
        </div>
    </div>
          <!-- /.card-header -->
    <div class="card-body">
    <form id="formulario" action="javascript:enviar()" data-toggle="validator" role="form">
        <div class="row">
        
            <div class="col-md-6 mb-3">
                <label for="name">Nome</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="inputname"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome" aria-describedby="nome" required>
                </div>
            </div>

            <div class="col-md-6 mb-3">
            
                <label for="email">Email</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="inputemail"><i class="fas fa-at"></i></span>
                    </div>
                    <input type="email" name="email" class="form-control" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Email" aria-describedby="inputGroupPrepend" required>
                </div>
            </div>
            
                <div class="form-group col-md-6 mb-6">
                    <label for="senha">Senha</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputsenha"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha" aria-describedby="senha" data-minlength="8" data-minlength-error="Minimo de 8 Digitos" required>           
                    </div>
                    <div style="color: red" class="help-block with-errors"></div>
                </div>
            

            
                <div class="form-group col-md-6 mb-6">
                    <label for="repitasenha">Repita a Senha</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text" ><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" id="repitasenha" data-match="#senha" data-match-error="Atenção! As senhas não estão iguais." class="form-control" id="repitasenha" placeholder="Repita a Senha" aria-describedby="repitasenha" required>
                        
                    </div>
                    <div style="position: absolute; color: red" class="help-block with-errors"></div>
                </div>
           
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label>Grupo</label>
                    <select name="grupo" class="form-control select2bs4" style="width: 100%;">
                        <?php foreach ($grupos as $grupo): ?>
                            <option value="<?php echo $grupo['id']; ?>"><?php echo $grupo['nome']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

        </div>

        <div class="row justify-content-center">
            <div class="col-md-2 mb-3 justify-content-center">
                
                <div class="input-group">
                    <input type="submit" class="btn btn-success" value="Cadastrar">
                </div>
            </div>
        </div>

    </form>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">

    </div>
</div>
        <!-- /.card -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js" integrity="sha256-dHf/YjH1A4tewEsKUSmNnV05DDbfGN3g7NMq86xgGh8=" crossorigin="anonymous"></script>
<script>

$('#formulario').validator();

function enviar(){
			let dados = $('#formulario').serialize();

			$.ajax({
				type: "POST",
				url: "<?php echo BASE_URL; ?>usuarios/criar",
				data: dados,
				success: function( data )
				{
                    console.log(data)
                     if(data == 1){
                         Swal.fire(
                             'Cadastrado!',
                             'O Usuário foi Cadastrado com sucesso.',
                             'success'
                             ).then((result) => {
                                 if (result.value) {
                                     window.location.href = "<?php echo BASE_URL; ?>usuarios";
                                 }
                                 })
                     } else{
                        Swal.fire(
                                'Erro!',
                                'Email já existente',
                                'error'
                                )
                    }
				}
			});
			
			return false;
}
</script>