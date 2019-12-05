
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gerenciador de Produtos</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    Gerenciador de Produtos
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Alterar Senha</p>

      <form id="recuperasenha" action="javascript:teste()" method="POST">

        <div class="form-group mb-6">
            <label for="senha">Senha</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputsenha"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha" aria-describedby="senha" data-minlength="8" data-minlength-error="Minimo de 8 Digitos" required>           
            </div>
            <div style="color: red" class="help-block with-errors"></div>
        </div>
            

            
        <div class="form-group mb-3">
            <label for="repitasenha">Repita a Senha</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="repitasenha"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" data-match="#senha" data-match-error="Atenção! As senhas não estão iguais." class="form-control" id="repitasenha" placeholder="Repita a Senha" aria-describedby="repitasenha" required>
                        
            </div>
            <div style="color: red" class="help-block with-errors"></div>
        </div>        


        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Alterar senha</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="<?php echo BASE_URL; ?>login">Login</a>
      </p>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


<!-- jQuery -->
<script src="<?php echo BASE_URL; ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo BASE_URL; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo BASE_URL; ?>dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
function teste(){
		var dados =$('#recuperasenha').serialize();
      console.log(dados);
			$.ajax({
				type: "POST",
				url: "<?php echo BASE_URL; ?>esqueci/recuperar/<?php echo $hash; ?>",
				data: dados,
				success: function( data )
				{
          console.log(data);
					if (data == 0){
						
						Swal.fire({
						icon: 'error',
						title: 'Não foi possivel alterar a senha',
						text: 'Por favor verifique com o Administrador do sistema'
						}).then((result) => {
							if (result.value) {
								window.location.href = "<?php echo BASE_URL; ?>login";
							}
							})
					} else{
						Swal.fire({
						icon: 'success',
						title: 'Senha alterada',
						text: 'para logar, utilize a nova senha'
						}).then((result) => {
							if (result.value) {
								window.location.href = "<?php echo BASE_URL; ?>login";
							}
							})
					}
				}
			});
			
			return false;
		
	}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js" integrity="sha256-dHf/YjH1A4tewEsKUSmNnV05DDbfGN3g7NMq86xgGh8=" crossorigin="anonymous"></script>
<script>
    $('#recuperasenha').validator();
</script>
</body>
</html>
