
var app = new Vue({
    el: '#toComeIn_Register',
    data:{
        error: false,
        user: [],
        login: "",
        password: "",
        error_login: '',
        error_passwordform: '',
    },
    mounted: function(){
        // this.getAllCinema();
    },
    watch:{
        login(newName) {
          this.login = newName;
          this.error_login = '';
        },
        password(newpassword) {
            this.password = newpassword;
            this.error_passwordform = '';
          },
      },
    methods:{
        avtorization: function(){
            const login = this.login;
            const password = this.password;
            if(login != ''){
                if(password != ''){
                    axios.post("./php/users/avtorization.php", {login, password})
                    .then(function(response){
                        app.user = response.data.user;
                        app.error = response.data.error;
                        if(response.data.error != false){
                            alert(response.data.error);
                        }
                    });
                    sessionStorage.setItem('user', JSON.stringify(this.user));
                    sessionStorage.setItem('idFilm', JSON.stringify(''));
                    if(this.user.length != 0 ){
                        
                        window.location.href = "http://localhost/vue/main.php";
                    }
                }
                else{
                    this.error_passwordform = "Введите пароль";
                }
            }
            else{
                this.error_login = "Введите логин";
            }
            
            
            
        },
    }
  });