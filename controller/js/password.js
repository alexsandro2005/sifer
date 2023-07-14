const formulario = document.getElementById("formulario");
const campoPassword = document.getElementById("password");

formulario.addEventListener("submit", function(event) {
  if (!validarPassword(campoPassword.value)) {
    alert("El password no puede contener espacios");
    event.preventDefault(); // Evita que el formulario se envíe
  }
});
