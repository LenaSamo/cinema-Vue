
var app = new Vue({
    el: '#blockAddFilm',
    data:{
      date: new Date(),
      idFilm: null,
      error: '',
      file: '',
      title_movie: '',
      year_of_release: '',
      timing: '',
      rental_company: '',
      rental_start_date: '',
      rental_end_date: '',
      ageLimit: '',
      genre: '',
      contry: '',
      description: '',
      inputgenre: '',
      Searcegenre: '',
      genres: [],
      inputDirectors: '',
      inputActors: '',
      SearceDirectors: '',
      SearceActors: '',
      directors: [],
      actors: [],
      // getGenres: [],
      getСontry: [],
      getRental_company: [],
      // addgenre: '',
      // addG: false,
      addcontry: '',
      addC: false,
      addrental_company: '',
      addRC: false,
      error_year_of_release: "",
    },
    watch: {
      // эта функция запускается при любом изменении вопроса
      
      title_movie: function () {
          console.log(this.title_movie);
      },
      year_of_release: function () {
        if(!(/^(19|20)\d{2}$/i.test(this.year_of_release))){
          this.error_year_of_release = "Введите верно год";
          
        }
      },
      inputgenre: function () {
        const inputgenre = this.inputgenre;
        if(inputgenre != ""){
          axios.post("./php/cinema/inputDirANDAct.php", {inputgenre, 'unput' : 'genres'})
          .then(function(response){
              app.Searcegenre = response.data.genres;
          });
        }
        else{
          this.Searcegenre = [];
        }
      },
      inputDirectors: function () {
        const inputDirectors = this.inputDirectors;
        if(inputDirectors != ""){
          axios.post("./php/cinema/inputDirANDAct.php", {inputDirectors, 'unput' : 'directors'})
          .then(function(response){
              app.SearceDirectors = response.data.directors;
          });
        }
        else{
          this.SearceDirectors = [];
        }
      },
      inputActors: function () {
        const inputActors = this.inputActors;
        if(inputActors != ""){
          axios.post("./php/cinema/inputDirANDAct.php", {inputActors, 'unput' : 'actors'})
          .then(function(response){
              app.SearceActors = response.data.actors;
          });
        }
        else{
          this.SearceActors = [];
        }
      },
    },
    mounted: function(){
      this.getInfo();
    },
    methods:{
      Newrental_company: function(){
        if(/^[0-9]*[A-я]+\s*[0-9]*[A-я]*$/i.test(this.addrental_company)){
          const addrental_company = this.addrental_company;
          axios.post("./php/cinema/inputGenComCon.php", {addrental_company, 'unput' : 'addrental_company'})
          .then(function(response){
            app.getRental_company = response.data.getRental_company;
            
          });

        }
        else{
          alert('Введите верно название компании прокатчика');
        }
      },
      Newcontry: function(){
        if(/^[А-я]+$/i.test(this.addcontry)){
          const addcontry = this.addcontry;
          axios.post("./php/cinema/inputGenComCon.php", {addcontry, 'unput' : 'addcontry'})
          .then(function(response){
            app.getСontry = response.data.getСontry;
            
          });

        }
        else{
          alert('Введите верно название страны');
        }
      },
      // Newgenre: function(){
      //   if(/^[А-я]+$/i.test(this.addgenre)){
      //     const addgenre = this.addgenre;
      //     axios.post("./php/cinema/inputGenComCon.php", {addgenre, 'unput' : 'addgenre'})
      //     .then(function(response){
      //       app.getGenres = response.data.getGenres;
            
      //     });

      //   }
      //   else{
      //     alert('Введите верно название жанра');
      //   }
      // },
      deletActor: function(id){
        if(this.actors.length != 0){
          for (let index = 0; index < this.actors.length; index++) {
            if(this.actors[index][1] == id){
              this.actors.splice(index, 1);
            }
          }
        }
      },

      Newgenre: function(){
        if(/^[А-я]+\s*[А-я]*$/i.test(this.inputgenre)){
          const inputgenre = this.inputgenre;
          axios.post("./php/cinema/inputDirANDAct.php", {inputgenre, 'unput' : 'inputgenre'})
          .then(function(response){
            app.Searcegenre = response.data.genres;
          });
        }
        else{
          alert('Введите верно название жанра');
        }
      },
      deletgenre: function(id){
        if(this.genres.length != 0){
          for (let index = 0; index < this.genres.length; index++) {
            if(this.genres[index][1] == id){
              this.genres.splice(index, 1);
            }
          }
        }
      },
      addgenre: function(title, id){
        const mas = [title, id];
        let bool = false;
        if(this.genres.length != 0){
          for (let index = 0; index < this.genres.length; index++) {
            if(this.genres[index][1] == id){
              bool = true;
            }
          }
        }
        if(bool == false){
          this.genres.push(...[mas]);
        }
      },


      addActor: function(title, id){
        const mas = [title, id];
        let bool = false;
        if(this.actors.length != 0){
          for (let index = 0; index < this.actors.length; index++) {
            if(this.actors[index][1] == id){
              bool = true;
            }
          }
        }
        if(bool == false){
          this.actors.push(...[mas]);
        }
      },
      NewActor: function(){
        if(/^[А-я]+\s[А-я]+$/i.test(this.inputActors)){
          const inputActors = this.inputActors;
          axios.post("./php/cinema/inputDirANDAct.php", {inputActors, 'unput' : 'inputActors'})
          .then(function(response){
            app.SearceActors = response.data.actors;
          });
        }
        else{
          alert('Введите верно имя и фамилию актера для добавления');
        }
      },
      NewDirectors: function(){
        if(/^[А-я]+\s[А-я]+$/i.test(this.inputDirectors)){
          const inputDirectors = this.inputDirectors;
          axios.post("./php/cinema/inputDirANDAct.php", {inputDirectors, 'unput' : 'inputDirectors'})
          .then(function(response){
            app.SearceDirectors = response.data.directors;
          });
        }
        else{
          alert('Введите верно имя и фамилию режиссера для добавления');
        }
      },
      deletDicretors: function(id){
        if(this.directors.length != 0){
          for (let index = 0; index < this.directors.length; index++) {
            if(this.directors[index][1] == id){
              this.directors.splice(index, 1);
            }
          }
        }
      },
      addDicretors: function(title, id){
        const mas = [title, id];
        let bool = false;
        if(this.directors.length != 0){
          for (let index = 0; index < this.directors.length; index++) {
            if(this.directors[index][1] == id){
              bool = true;
            }
          }
        }
        if(bool == false){
          this.directors.push(...[mas]);
        }
      },
      getInfo: function(){
        axios.get("./php/cinema/get.php")
        .then(function(response){
            app.getGenres = response.data.getGenres;
            app.getСontry = response.data.getСontry;
            app.getRental_company = response.data.getRental_company;
        });
      },
      addFilm: function(){
        if(
          (/^(19|20)\d{2}$/i.test(this.year_of_release))
          && (/^[0-9]+$/i.test(this.timing))
          && (/^\d{2}$/i.test(this.ageLimit))
          && (new Date(this.rental_start_date) >= new Date())
          && (new Date(this.rental_end_date) > new Date(this.rental_start_date))
          && (this.title_movie != '') && (this.description != '')
          && (this.genres != [])
          && (this.contry != '')
          && (this.rental_company != '')
          && (this.photo != '')
          && (this.directors != [])
          && (this.actors != [])
          )
          {
            
            // const title_movie = this.title_movie;
            // const year_of_release = this.year_of_release;
            // const timing = this.timing;
            // const rental_start_date = this.rental_start_date; 
            // const rental_end_date = this.rental_end_date;
            // const ageLimit = this.ageLimit; 
            // const genre = this.genre; 
            // const contry = this.contry; 
            // const rental_company = this.rental_company;
            // const description = this.description; 
            // const directors = this.directors;
            // const actors = this.actors;
            // axios.post("./php/cinema/addFilm.php", 
            // {
            //    title_movie, year_of_release, timing, 
            //   rental_start_date, rental_end_date, 
            //   ageLimit, genre, contry, description, 
            //   directors, actors, rental_company, 
              
            // }
            // )
            // .then(function(response){
            //   app.error = response.data.id;
              
            // });
            this.file = this.$refs.file.files[0];
            let formData = new FormData();
            let rawData = {
                title_movie: this.title_movie,
                 year_of_release: this.year_of_release,
                 timing: this.timing,
                 rental_start_date: this.rental_start_date,
                 rental_end_date: this.rental_end_date,
                 ageLimit: this.ageLimit,
                 genres: this.genres,
                 contry: this.contry, 
                 rental_company: this.rental_company,
                 description: this.description,
                 directors: this.directors,
                 actors: this.actors,
              }
              rawData = JSON.stringify(rawData);

            formData.append('file', this.file);
            formData.append('data', rawData);
            axios.post("./php/cinema/addFilm.php", formData,
            {
              headers: {
                'Content-Type': 'multipart/form-data'
              }
            }
            )
            .then(function(response){
                app.error = response.data.id;
                app.idFilm = response.data.id;
                sessionStorage.setItem('idFilm', JSON.stringify(response.data.id));
                window.location.href = "http://localhost/vue/addSession.php";
            });
            if(this.error == false && this.idFilm != null){
              alert('Фильм успешно добавлен');
            }
            
        }
        else{
          alert('Введите всю информацию');
        }
        
      }
    }
  });