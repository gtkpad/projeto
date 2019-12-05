<!-- SELECT2 EXAMPLE -->
<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Adicionar Marcas</h3>

        <div class="card-tools">
              <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button> -->
        </div>
    </div>
          <!-- /.card-header -->
    <div class="card-body">
    <form method="POST" action="<?php echo BASE_URL; ?>marca/adicionar">
        <div class="row">
        
            <div class="col-md-12 mb-3">
                <label for="name">Nome</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="inputname"><i class="far fa-copyright"></i></span>
                    </div>
                    <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome" aria-describedby="nome" required>
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

