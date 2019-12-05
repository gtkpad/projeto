
<div class="row">
<!-- ./col -->

<?php if ($this->auth->adminAuth()): ?>
<div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-warning">
        <div class="inner">
            <h3><?php echo $qntusuarios; ?></h3>

            <p>Usuários Cadastrados</p>
        </div>
        <div class="icon">
            <i class="fas fa-user-plus"></i>
        </div>
            <a href="<?php echo BASE_URL; ?>usuarios" class="small-box-footer">
                Ver Usuários <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
</div>
          <!-- ./col -->

    <?php endif; ?>


<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-success">
        <div class="inner">
            <h3><?php echo $qntprodutos; ?></h3>
            <p>Produtos Registrados</p>
        </div>
        <div class="icon">
            <i class="fas fa-box-open"></i>
        </div>
            <a href="<?php echo BASE_URL; ?>produto" class="small-box-footer">
                Ver Produtos <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
          <!-- ./col -->

</div>
