var app = new Vue({
    el: '#profile',
    data:{
        user: [],
        error: '',
        login: '',
        email: '',
        error_login: '',
        error_email: '',
        showModal: false,
        textModal: '',
        passwordShowModal: false,
        Oldpassword: '',
        Newpassword: '',
        error_password: '',
    },
    watch:{
        Newpassword: function () {
          this.error_password = '';
        },
        Oldpassword: function () {
          this.error_password = '';
        },
        login: function () {
          this.error_login = '';
        },
        email: function () {
            this.error_email = '';
        },
    },
    mounted: function(){
        this.user = JSON.parse(sessionStorage.user);
        console.log(this.user);
        this.getUser();
    },
    methods:{
        RePassword: function(){
            if(this.Oldpassword != '' && this.Newpassword != ''){
                if(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=!])(?!.*\s).{6,}$/.test(this.Newpassword)){
                    const user = this.user;
                    const Oldpassword = this.Oldpassword;
                    const Newpassword = this.Newpassword;
                    axios.post("./php/users/getUser.php", {user, Oldpassword, Newpassword, 'info': 'RePassword'})
                    .then(function(response){
                        app.error = response.data.error;
                        if(app.error == 'NotOldPass'){
                            app.error_password = response.data.text;
                        }
                        else if (app.error == 'edited'){
                            app.passwordShowModal = false;
                            app.showModal = true;
                            app.textModal = response.data.text;
                            app.getUser();
                        }
                    });  
                }
                else this.error_password = 'Неверно введен новый пароль';

            }
            else{
                this.error_password = 'Введите пароли';
            }
        },
        loginRE: function () {
            const user = this.user;
            const login = this.login;
            if (this.login == '') 
            { 
                this.error_login = 'Необходимо ввести логин';
            }
            else{
                axios.post("./php/users/getUser.php", {user, login, 'info': 'login'})
                .then(function(response){
                    app.user = response.data.user;
                    app.error = response.data.error;
                    sessionStorage.setItem('user', JSON.stringify(app.user));
                    if(app.error == 'notEdited'){
                        app.error_login = response.data.text;
                    }
                    else if (app.error == 'edited'){
                        app.showModal = true;
                        app.textModal = response.data.text;
                        app.getUser();
                    }
                });
            }
            
        },
        emailRE: function () {
            const user = this.user;
            const email = this.email;
            const login = this.login;
            if (!/^([A-z0-9]+([\-\_.]?[A-z0-9]+)*)@([A-z]+\.[A-z]+)$/.test(this.email)) 
            { 
                this.error_email = 'Невернный ввод почты';
            }
            else{
               axios.post("./php/users/getUser.php", {user, email, login, 'info': 'email'})
                .then(function(response){
                    app.user = response.data.user;
                    app.error = response.data.error;
                    sessionStorage.setItem('user', JSON.stringify(app.user));
                    if(app.error == 'notEdited'){
                        app.error_login = response.data.text;
                    }
                    else if (app.error == 'edited'){
                        app.showModal = true;
                        app.textModal = response.data.text;
                        app.getUser();
                    }
                }); 
            }
            
            
        },
        getUser: function () {
            const user = this.user;
            axios.post("./php/users/getUser.php", {user, 'info': 'get'})
            .then(function(response){
                app.login = response.data.login;
                app.email = response.data.email;
            });
        },
        //функция выхода
        clickOut: function () {
            const user = this.user;
            axios.post("./php/users/outUser.php", {user})
            .then(function(response){
                app.error = response.data.error;
            });
            if(this.error == false){
                this.user = [];
                sessionStorage.setItem('user', JSON.stringify(this.user));
            }
            window.location.href = "http://localhost/vue/main.php";
        }
    }
  });


