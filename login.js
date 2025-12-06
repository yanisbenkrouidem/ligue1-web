// Animations
const registerButton = document.getElementById("register");
const loginButton = document.getElementById("login");
const container = document.getElementById("container");

registerButton.addEventListener("click", () => {
  container.classList.add("right-panel-active");
});

loginButton.addEventListener("click", () => {
  container.classList.remove("right-panel-active");
});

// ---------------------------
// INSCRIPTION
// ---------------------------
const form = document.querySelector('form')
const username = document.getElementById('username')
const usernameError = document.querySelector("#username-error")
const email = document.getElementById('email')
const emailError = document.querySelector("#email-error")
const password = document.getElementById('password')
const passwordError = document.querySelector("#password-error")

function showError(input, message) {
    const formControl = input.parentElement
    formControl.className = 'form-control error'
    const small = formControl.querySelector('small')
    small.innerText = message
}

function showSuccess(input) {
    const formControl = input.parentElement
    formControl.className = 'form-control success'
    const small = formControl.querySelector('small')
    small.innerText = ''
}

function checkEmail(email) {
    const emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
    return emailRegex.test(email);
}

email.addEventListener("input", function(){
    if (!checkEmail(email.value)) {
        emailError.textContent = "*L'e-mail n'est pas valide"
    } else {
        emailError.textContent = "";
    }
})

username.addEventListener("input", function(){
    if (username.value.length < 4) {
        usernameError.textContent = "*Le nom d'utilisateur doit comporter au moins 4 caractères."
    } else if(username.value.length > 20){
        usernameError.textContent = "*Le nom d'utilisateur doit comporter moins de 20 caractères.";
    } else {
        usernameError.textContent = "";
    }
})

password.addEventListener("input", function(){
    if (password.value.length < 8) {
        passwordError.textContent = "*Le mot de passe doit comporter au moins 8 caractères."
    } else if(password.value.length > 20){
        passwordError.textContent = "*Le mot de passe doit comporter moins de 20 caractères."
    } else {
        passwordError.textContent = "";
    }
})

function checkRequired(inputArr) {
    let isRequired = false
    inputArr.forEach(function(input) {
        if (input.value.trim() === '') {
            showError(input, `*${getFieldName(input)} est requis`)
            isRequired = true
        } else {
            showSuccess(input)
        }
    })
    return isRequired
}

function getFieldName(input) {
    return input.id.charAt(0).toUpperCase() + input.id.slice(1)
}

// Ne bloque pas l'envoi ici
form.addEventListener('submit', function (e) {
    if (!checkRequired([username, email, password])) {
        if (!checkEmail(email.value)) {
            emailError.textContent = "*L'e-mail n'est pas valide"
            e.preventDefault()
        }
    } else {
        e.preventDefault()
    }
})

// ---------------------------
// CONNEXION
// ---------------------------
let lgForm = document.querySelector('.form-lg')
let lgEmail = document.querySelector('.email-2')
let lgEmailError = document.querySelector(".email-error-2")
let lgPassword = document.querySelector('.password-2')
let lgPasswordError = document.querySelector(".password-error-2")

function showError2(input, message) {
    const formControl2 = input.parentElement
    formControl2.className = 'form-control2 error'
    const small2 = formControl2.querySelector('small')
    small2.innerText = message
}

function showSuccess2(input) {
    const formControl2 = input.parentElement
    formControl2.className = 'form-control2 success'
    const small2 = formControl2.querySelector('small')
    small2.innerText = '';
}

function checkEmail2(lgEmail) {
    const emailRegex2 = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
    return emailRegex2.test(lgEmail);
}

lgEmail.addEventListener("input", function(){
    if (!checkEmail2(lgEmail.value)) {
        lgEmailError.textContent = "*L'e-mail n'est pas valide"
    } else {
        lgEmailError.textContent = "";
    }
})

lgPassword.addEventListener("input", function(){
    if (lgPassword.value.length < 8) {
        lgPasswordError.textContent = "*Le mot de passe doit comporter au moins 8 caractères."
    } else if (lgPassword.value.length > 20){
        lgPasswordError.textContent = "*Le mot de passe doit comporter moins de 20 caractères."
    } else {
        lgPasswordError.textContent = "";
    }
})

function checkRequiredLg(inputArr2) {
    let isRequiredLg = false
    inputArr2.forEach(function(input){
        if (input.value.trim() === '') {
            showError2(input, `*${getFieldNameLg(input)} Veuillez saisir vos informations dans ce champ`)
            isRequiredLg = true
        } else {
            showSuccess2(input)
        }
    })
    return isRequiredLg
}

function getFieldNameLg(input) {
    return input.id.charAt(0).toUpperCase() + input.id.slice(1)
}

lgForm.addEventListener('submit', function (e){
    const champsVides = checkRequiredLg([lgEmail, lgPassword])
    const emailInvalide = !checkEmail2(lgEmail.value)

    if (champsVides || emailInvalide) {
        e.preventDefault()
        if (emailInvalide) {
            lgEmailError.textContent = "*L'e-mail n'est pas valide"
        }
    }
})
