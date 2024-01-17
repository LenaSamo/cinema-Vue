password2.onblur = function() 
{
    let regexp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=!])(?!.*\s).{6,}$/;
    if (!regexp.test(password2.value)) 
    { 
        password2.classList.add('invalid');
        error_password2.innerHTML = 'Пароль должен содержать цифры,специальные символы, заглавные и строчные буквы. Не меньше 6 символов'
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
