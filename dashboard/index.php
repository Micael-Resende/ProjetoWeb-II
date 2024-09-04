<?php require_once 'vistas/parte_superior.php'?>

<div class="container">
    <h1>Conteudo principal</h1>   
    
<?php
    include_once 'bd/conexao.php';
    $objeto = new Conexao();
    $conexao = $objeto->Conectar();

    $consulta = "SELECT id, nome, email, telefone, senha FROM usuarios";
    $resultado = $conexao->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Novo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>                                
                                <th>Telefone</th>                                
                                <!-- <th>Senha</th> -->
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['nome'] ?></td>
                                <td><?php echo $dat['email'] ?></td>
                                <td><?php echo $dat['telefone'] ?></td>
                                <!-- <td><?php echo $dat['senha'] ?></td> -->
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
<!--Modal CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">
                <div class="form-group">
                <label for="nome" class="col-form-label">Nome:</label>
                <input type="text" class="form-control" id="nome">
                </div>
                <div class="form-group">
                <label for="email" class="col-form-label">Email:</label>
                <input type="text" class="form-control" id="email">
                </div>
                <div class="form-group">
                <label for="tel" class="col-form-label">Telefone:</label>
                <input type="text" class="form-control" id="telefone">
                </div>               
                <!-- <div class="form-group">
                <label for="senha" class="col-form-label">Senha:</label>
                <input type="text" class="form-control" id="senha">
                </div>            -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Salvar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
    
    
</div>

<?php require_once 'vistas/parte_inferior.php'?>