<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Gerenciador de Produtos</title>

  <!-- jQuery -->
  <script src="<?php echo BASE_URL; ?>plugins/jquery/jquery.min.js"></script>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- Select2 -->
  <script src="<?php echo BASE_URL; ?>plugins/select2/js/select2.full.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<?php if ($_SESSION['auth'] == true && !empty($_SESSION['auth'])): ?>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

   
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-sm-inline-block">
        <a href="<?php echo BASE_URL; ?>login/logout" class="nav-link">Logout</a>
      </li>
    </ul>
    
  </nav>
  <!-- /.navbar -->
          <?php endif; ?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <?php if ($_SESSION['auth'] == true && !empty($_SESSION['auth'])): ?>
    <!-- Brand Logo -->
    <a href="<?php echo BASE_URL; ?>" class="brand-link">
      <img src="<?php echo BASE_URL; ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Gerenciador</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo BASE_URL; ?>dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?php echo BASE_URL; ?>usuarios/abrir/<?php echo $_SESSION['usuario']; ?>" class="d-block"><?php echo $_SESSION['nome_usuario']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>" class="nav-link <?php echo (strstr($viewName, 'dashboard')) ? 'active': ''; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php echo (strstr($viewName, 'produto')) ? 'menu-open': ''; ?>">
            <a href="#" class="nav-link <?php echo (strstr($viewName, 'produto')) ? 'active': ''; ?>" >
              <i class="nav-icon fas fa-box-open"></i>
              <p>
                Produtos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if($this->auth->adminAuth()): ?>
                <li class="nav-item">
                  <a href="<?php echo BASE_URL; ?>produto/adicionar" class="nav-link <?php echo (strstr($viewName, 'adicionar') && strstr($viewName, 'produto')) ? 'active': ''; ?>">
                    <i class="fas fa-plus nav-icon"></i>
                    <p>Adicionar</p>
                  </a>
                </li>
              <?php endif; ?>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>produto" class="nav-link <?php echo (strstr($viewName, 'index') && strstr($viewName, 'produto')) ? 'active': ''; ?>">
                  <i class="fas fa-eye nav-icon"></i>
                  <p>Visualizar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?php echo (strstr($viewName, 'categoria')) ? 'menu-open': ''; ?>">
            <a href="#" class="nav-link <?php echo (strstr($viewName, 'categoria')) ? 'active': ''; ?>">
              <i class="nav-icon fas fa-pallet"></i>
              <p>
                Categorias
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if($this->auth->adminAuth()): ?>
                <li class="nav-item">
                  <a href="<?php echo BASE_URL; ?>categoria/adicionar" class="nav-link <?php echo (strstr($viewName, 'adicionar') && strstr($viewName, 'categoria')) ? 'active': ''; ?>">
                    <i class="fas fa-plus nav-icon"></i>
                    <p>Adicionar</p>
                  </a>
                </li>
              <?php endif; ?>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>categoria" class="nav-link <?php echo (strstr($viewName, 'index') && strstr($viewName, 'categoria')) ? 'active': ''; ?>">
                  <i class="fas fa-eye nav-icon"></i>
                  <p>Visualizar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?php echo (strstr($viewName, 'marca')) ? 'menu-open': ''; ?>">
            <a href="#" class="nav-link <?php echo (strstr($viewName, 'marca')) ? 'active': ''; ?>">
              <i class="nav-icon far fa-copyright"></i>
              <p>
                Marcas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if($this->auth->adminAuth()): ?>
                <li class="nav-item">
                  <a href="<?php echo BASE_URL; ?>marca/adicionar" class="nav-link <?php echo (strstr($viewName, 'adicionar') && strstr($viewName, 'marca')) ? 'active': ''; ?>">
                    <i class="fas fa-plus nav-icon"></i>
                    <p>Adicionar</p>
                  </a>
                </li>
              <?php endif; ?>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>marca" class="nav-link <?php echo (strstr($viewName, 'index') && strstr($viewName, 'marca')) ? 'active': ''; ?>" >
                  <i class="fas fa-eye nav-icon"></i>
                  <p>Visualizar</p>
                </a>
              </li>
            </ul>
          </li>

        <?php 
        $authPanel = new authController();
          if ($authPanel->adminAuth()):
          ?>
          <li class="nav-item has-treeview <?php echo (strstr($viewName, 'usuario')) ? 'menu-open': ''; ?>">
            <a href="#" class="nav-link  <?php echo (strstr($viewName, 'usuarios')) ? 'active': ''; ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuários
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>usuarios/adicionar" class="nav-link <?php echo (strstr($viewName, 'adicionar') && strstr($viewName, 'usuario')) ? 'active': ''; ?>">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Adicionar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL ?>usuarios" class="nav-link <?php echo (strstr($viewName, 'index') && strstr($viewName, 'usuario')) ? 'active': ''; ?>">
                  <i class="fas fa-eye nav-icon"></i>
                  <p>Visualizar</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    <?php endif; ?>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      
        <!-- Load View -->
        <?php $this->loadViewInTemplate($viewName, $viewData); ?>
     
     
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="#">Gabriel Vargas Padilha</a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo BASE_URL; ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo BASE_URL; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo BASE_URL; ?>dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="<?php echo BASE_URL; ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo BASE_URL; ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- Select2 -->
<script src="<?php echo BASE_URL; ?>plugins/select2/js/select2.full.min.js"></script>
<!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<script>
    $(document).ready(function() {
        $('#tabela').DataTable({
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });
    });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>

</body>
</html>
