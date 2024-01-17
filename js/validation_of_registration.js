function unblockreferences(form)
{
    if (form.approval.checked == true 
    && form.email.validity.valid 
    && form.login1.validity.valid 
    && form.phone.validity.valid
    && form.password1.validity.valid 
    && form.password2.validity.valid
    )
    {
        document.getElementById('Register_Person').disabled = false;
       
    }
    else document.getElementById('Register_Person').disabled = true;
}


/*проверка login*/
login1.onblur = function() 
{
    let regexp = /^[A-z][A-z0-9]{3,}$/;
    if (!regexp.test(login1.value)) 
    {
        login1.classList.add('invalid');
        error_login.innerHTML = 'Пожалуйста, введите правильный логин(начинается с буквы, содержит буквы и цифры)'
    }
};

login1.onfocus = function() 
{
    if (this.classList.contains('invalid')) 
    {
        // удаляем индикатор ошибки, т.к. пользователь хочет ввести данные заново
        this.classList.remove('invalid');
        error_login.innerHTML = "";
    }
};

/*проверка email*/
email.onblur = function() 
{
    let regexp = /^([A-z0-9]+([\-\_.]?[A-z0-9]+)*)@([A-z]+\.[A-z]+)$/;
    if (!regexp.test(email.value)) 
    { 
        email.classList.add('invalid');
        error_email.innerHTML = 'Пожалуйста, введите правильный email.';
    }
};

email.onfocus = function() 
{
    if (this.classList.contains('invalid')) 
    {
        // удаляем индикатор ошибки, т.к. пользователь хочет ввести данные заново
        this.classList.remove('invalid');
        error_email.innerHTML = "";
    }
};

/*проверка phone*/
/*phone.onblur = function() 
{
    let regexp = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
    if (!regexp.test(phone.value)) 
    { 
        phone.classList.add('invalid');
        error_phone.innerHTML = 'Пожалуйста, введите правильный телефон.'
    }
};*/

/*phone.onfocus = function() 
{
    if (this.classList.contains('invalid')) 
    {
        // удаляем индикатор ошибки, т.к. пользователь хочет ввести данные заново
        this.classList.remove('invalid');
        error_phone.innerHTML = "";
    }
};
*/
/*проверка пороля*/
password1.onblur = function() 
{
    let regexp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=!])(?!.*\s).{6,}$/;
    if (!regexp.test(password1.value)) 
    { 
        password1.classList.add('invalid');
        error_password1.innerHTML = 'Пароль должен содержать цифры,специальные символы, заглавные и строчные буквы. Не меньше 6 символов'
    }

};
password1.onfocus = function() 
{
    if (this.classList.contains('invalid')) 
    {
        // удаляем индикатор ошибки, т.к. пользователь хочет ввести данные заново
        this.classList.remove('invalid');
        error_password1.innerHTML = "";
    }
};

password2.onblur = function() 
{
    
    if (!password2.value.includes(password1.value)) 
    { 
        password2.classList.add('invalid');
        error_password2.innerHTML = 'Пороли не совпадают'
    }
};

password2.onfocus = function() 
{
    if (this.classList.contains('invalid')) 
    {
        // удаляем индикатор ошибки, т.к. пользователь хочет ввести данные заново
        this.classList.remove('invalid');
        error_password2.innerHTML = "";
    }
};
