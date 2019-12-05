
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
      <p class="login-box-msg">Informe o email para recuperar a senha</p>

      <form id="recuperasenha" method="POST">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Recuperar senha</button>
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
$(document).ready(function(){
		$('#recuperasenha').submit(function(){
			var dados = $( this ).serialize();
      console.log(dados);
			$.ajax({
				type: "POST",
				url: "<?php echo BASE_URL; ?>esqueci/solicitar",
				data: dados,
				success: function( data )
				{
          console.log(data);
					if (data == 0){
						
						Swal.fire({
						icon: 'error',
						title: 'Não foi possivel enviar o email de recuperação',
						text: 'Verifique se já não foi solicitado uma recuperação'
						}).then((result) => {
							if (result.value) {
								window.location.href = "<?php echo BASE_URL; ?>login";
							}
							})
					} else{
						Swal.fire({
						icon: 'success',
						title: 'Email enviado',
						text: 'Verifique sua caixa de entrada'
						}).then((result) => {
							if (result.value) {
								window.location.href = "<?php echo BASE_URL; ?>login";
							}
							})
					}
				}
			});
			
			return false;
		});
	});
</script>

</body>
</html>
