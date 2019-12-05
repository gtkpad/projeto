<!-- SELECT2 EXAMPLE -->
<div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Adicionar Produto</h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
              <form action="<?php echo BASE_URL; ?>produto/adicionar" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="inputnome">Nome</label>
                    <input type="text" name="nome" class="form-control" id="inputnome" placeholder="Nome">
                  </div>
                </div>
               
                <div class="col-md-6"> 
                  <div class="form-group">
                    <label>Categorias</label>
                    <select name="categoria" class="form-control select2bs4" style="width: 100%;">
                      <?php foreach($categorias as $categoria): ?>
                        <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nome']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                  <!-- /.form-group -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Marcas</label>
                    <select class="form-control select2bs4" name="marca" style="width: 100%;">
                    <?php foreach($marcas as $marca): ?>
                        <option value="<?php echo $marca['id']; ?>"><?php echo $marca['nome']; ?></option>
                      <?php endforeach; ?>                      
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputfile">Imagem do Produto (JPG, PNG)</label>
                    <input type="file" name="imagem" class="form-control-file" id="inputfile" required>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea class="form-control" name="descricao" id="descricao" rows="3"></textarea>
                  </div>
                </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
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
    
        <!-- /.card -->

