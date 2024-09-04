$('#formLogin').submit(function(e){
    e.preventDefault();
    var nome = $.trim($("#nome").val());    
    var senha =$.trim($("#senha").val());    
     
    if(nome.length == "" || senha == ""){
       Swal.fire({
           type:'warning',
           title:'Você deve inserir um nome e/ou senha',
       });
       return false; 
     }else{
         $.ajax({
            url:"bd/login.php",
            type:"POST",
            datatype: "json",
            data: {nome:nome, senha:senha}, 
            success:function(data){               
                if(data == "null"){
                    Swal.fire({
                        type:'error',
                        title:'nome ou senha incorreta',
                    });
                }else{
                    Swal.fire({
                        type:'success',
                        title:'Conexao efetuada!',
                        confirmButtonColor:'#3085d6',
                        confirmButtonText:'Ingresar'
                    }).then((result) => {
                        if(result.value){
                            //window.location.href = "vistas/pag_inicio.php";
                            window.location.href = "dashboard/index.php";
                        }
                    })
                    
                }
            }    
         });
     }     
 });