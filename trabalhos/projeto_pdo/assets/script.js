function mostrarSenha() {
    let icon = document.getElementById("icon_eye");
    let input_senha = document.getElementsByName("senha")[0];

    if (input_senha.type === "password") {
        input_senha.type = "text";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    }
    else {
        input_senha.type = "password";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    }
}