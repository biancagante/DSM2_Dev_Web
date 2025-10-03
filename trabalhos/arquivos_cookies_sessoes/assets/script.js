function alterarVisibilidadeSenha() {
    let visibilidade = document.getElementById("campoSenha");
    let icon = document.getElementById("olho");
    
    if (visibilidade.type === "password") {
        visibilidade.type = "text";
        icon.classList.remove("bi", "bi-eye-slash");
        icon.classList.add("bi", "bi-eye");
    }
    else {
        visibilidade.type = "password";
        icon.classList.remove("bi", "bi-eye");
        icon.classList.add("bi",    "bi-eye-slash"); 
    }
}