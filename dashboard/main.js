$(document).ready(function(){
    var tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
            "targets": -1,
            "data":null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Deletar</button></div></div>"  
        }],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "Não se encontraram resultados",
            "info": "Mostrando registros de _START_ a _END_ de um total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros de 0 a 0 de um total de 0 registros",
            "infoFiltered": "(filtrado de um total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Seguinte",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
    $("#btnNuevo").click(function(){
        $("#formPersonas").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nova Pessoa");            
        $("#modalCRUD").modal("show");        
        id = null;
        opcao = 1;
    });

    var fila;

    // Botão EDITAR
    $(document).on("click", ".btnEditar", function() {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        nome = fila.find('td:eq(1)').text();
        email = fila.find('td:eq(2)').text();
        telefone = fila.find('td:eq(3)').text();
        senha = fila.find('td:eq(4)').text();
        
        $("#nome").val(nome);
        $("#email").val(email);
        $("#telefone").val(telefone);
        $("#senha").val(senha);
        
        opcao = 2; //editar

        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Pessoa");            
        $("#modalCRUD").modal("show");  
    });

    // Botão deletar
    $(document).on("click", ".btnBorrar", function(){   
        fila = $(this).closest("tr");        
        id = parseInt(fila.find('td:eq(0)').text());

        opcao = 3; //opção para deletar

        var resposta = confirm("Tem certeza que deseja deletar o registro: "+id+"?");
        if(resposta){
            $.ajax({
                url: "bd/crud.php",
                type: "POST",
                dataType: "json",
                data: {opcao:opcao, id:id},
                success: function(){
                    tablaPersonas.row(fila).remove().draw();
                }
            });
        }   
    });

    $("#formPersonas").submit(function(e){
        e.preventDefault();    
        nome = $.trim($("#nome").val());
        email = $.trim($("#email").val());
        telefone = $.trim($("#telefone").val());
        senha = $.trim($("#senha").val());
    
        // Cria uma string de asteriscos com o mesmo comprimento da senha
        const senhaOculta = '*'.repeat(senha.length);
    
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {id:id, nome:nome, email:email, telefone:telefone, senha:senha, opcao:opcao},
            success: function(data){  
                id = data[0].id;            
                nome = data[0].nome;
                email = data[0].email;
                telefone = data[0].telefone;
                senha = data[0].senha;
    
                if(opcao == 1){
                    tablaPersonas.row.add([id,nome,email,telefone,senha]).draw();
                } else {
                    tablaPersonas.row(fila).data([id,nome,email,telefone,senha]).draw();
                }            
            }        
        });
        $("#modalCRUD").modal("hide");    
    });
    
});
