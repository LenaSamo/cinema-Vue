var app = new Vue({
  el: '#users',
  data:{
    users: [],
    roles: [],
  },

  mounted: function(){
      this.getAllUsers();
  },

  methods:{
    getAllUsers: function(){
      axios.get("./php/index.php")
          .then(function(response){
              app.users = response.data.users;
              app.roles = response.data.roles;
          });
      }
  }
});

var reg = new Vue({
  el: '#reg',
  data: {
    email: '',
    password: '',
    errorEmail: '',
    errorPassword: '',
  },
  watch: {
    // эта функция запускается при любом изменении вопроса
    email: function () {
      this.errorPassword = '';
    },
    password: function () {
      this.errorEmail = '';
    }
  },
  methods: {
    registration: function (email, password) {
      
      if(email != ''){
        if(password != '')
        {
          user = [email, password, 1];
          axios.post("./php/users/createUsers.php", user)
          .then(function(response){
            console.log(response.data);
            
        });
        }
        else{
          this.errorPassword = "Введите пароль";
        }
      }
      else{
        this.errorEmail = "Введите почту";
      }
    }
  }
});