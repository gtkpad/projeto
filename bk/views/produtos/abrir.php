<div class="row">
    <div class="col-sm-4">
        <div class="card card-primary card-outline">
            <div class="row">
              <div class="card-body box-profile">
                  <img src="<?php echo BASE_URL; ?>assets/images/produtos/<?php echo $produto['imagem'] ?>" class="img-fluid img-thumbnail rounded mx-auto" alt="">
              </div>
            </div>
            <!-- /.card-body -->
           
          <?php if($this->auth->adminAuth()): ?>
            <div class="card-footer">
              <a href="<?php echo BASE_URL; ?>produto/editar/<?php echo $produto['id']; ?>" class="btn btn-primary btn-block">Editar</a>
            </div>
          <?php endif; ?>

        </div>
        <!-- /.card -->
    </div>
    <div class="col-sm-8">
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Produto</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-box-open mr-1"></i> Nome</strong>

                <p class="text-muted">
                  <?php echo $produto['nome']; ?>
                </p>

                <hr>

                <strong><i class="fas fa-pallet mr-1"></i> Categoria</strong>

                <p class="text-muted"><?php echo $produto['categoria']; ?></p>

                <hr>

                <strong><i class="fas fa-copyright mr-1"></i> Marca</strong>

                <p class="text-muted"> <?php echo $produto['marca']; ?></p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Descrição</strong>

                <p class="text-muted"><?php echo $produto['descricao']; ?></p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
    
    </div>

</div>