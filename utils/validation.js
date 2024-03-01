document.getElementById("form-signup").addEventListener("submit", function(e) {
    let username = document.getElementById("username").value.trim()
    let email = document.getElementById("email").value.trim()
    let password = document.getElementById("password").value
    let password2 = document.getElementById("password2").value
    let errorUsername = document.getElementById("errorUsername")
    let errorEmail = document.getElementById("errorEmail")
    let errorPsswrd1 = document.getElementById("errorPass1")
    let errorPsswrd2 = document.getElementById("errorPass2")
    
    errorUsername.innerHTML = ""
    errorEmail.innerHTML = ""
    errorPsswrd1.innerHTML = ""
    errorPsswrd2.innerHTML = "" 
    
    if(username === "") {
      errorUsername.innerHTML = "Por favor, insira seu nome."
      e.preventDefault()
    }
    
    if(email === "") {
      errorEmail.innerHTML = "Por favor, insira seu email."
      e.preventDefault()
    } else if (!isValidEmail(email)) {
      errorEmail.innerHTML = "Por favor, insira um email válido."
      e.preventDefault()
    }

    if(password === ""){
        errorPsswrd1.innerHTML = "Por favor, digite uma senha."
        e.preventDefault()
    } else if(password.length < 5){
      errorPsswrd1.innerHTML = "Mínimo de 5 caracteres."
      e.preventDefault()
    }

    if(password != password2){
        errorPsswrd2.innerHTML = "As senhas não coincidem."
        e.preventDefault()
    }
})
  
function isValidEmail(email) {
    var re = /\S+@\S+\.\S+/
    return re.test(email)
}