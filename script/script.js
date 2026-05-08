let form = document.getElementById('formulario');

if(form){
form.addEventListener('submit', function(e){

    e.preventDefault();

    let valido = true;

    let nome = document.getElementById("nome").value;
    let senha = document.getElementById("senha").value;

    if(nome.trim() === ""){
        alert('Campo usuário vazio');
        valido = false
    }

    if(senha.trim() === ""){
        alert('Campo senha vazio');
        valido = false
    }

    if(nome.trim() === 'groot1'){

    }else{
       alert('Usuário incorreto');
        valido = false
    }

    if(senha.trim() === '1418'){

    }else{
       alert('Senha incorreta');
        valido = false
    }

    if(nome === 'groot1' && senha === '1418'){
        window.location.href = "";
        alert('Acesso permitido!');
        } else {
    alert("Usuário ou senha incorretos");
  }
})
}