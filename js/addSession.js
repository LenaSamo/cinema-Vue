
var app = new Vue({
    el: '#blockAddSession',
    data:{
        //переменные для добавления сеанса
        idFilm: null,
        movie: null,
        film: [],
        
        Wachhall: false,
        Wachprice: false,
        gethalls: [],
        hall: '',
        price: '',
        addHall: '',
        getprices: [],
        addPrice: '',
        date: '',
        format: '',


        //переменные для редактирования или удаления сеанса
        sessons: [],
        idSession: '',
        hallRE: '',
        gethallsRE: [],
        priceRE: '',
        getpricesRE: [],
        dateRE: '',
        formatRE: '',

    },
     watch: {
      // эта функция запускается при любом изменении вопроса
      priceRE: function () {
          console.log(this.priceRE);
      },
      hallRE: function () {
          console.log(this.hallRE);
      },
      formatRE: function () {
          console.log(this.formatRE);
      },
      dateRE: function () {
          console.log(this.dateRE);
      },
      idSession: function () {
          console.log(this.idSession);
      },
    },
    mounted: function(){
        if(JSON.parse(sessionStorage.idFilm) > 0){
            this.idFilm = JSON.parse(sessionStorage.idFilm);
            this.getInfoFilm();
            this.getInfoSessons();
        }
        
        this.getInfoHallPrice();

    },
    
    methods:{
        idRe: function( id){
            this.idSession = id;
            return id;
        },
        dateRe: function( date){
            this.dateRE = date;
            return date;
        },
        formatRe: function(format){
            this.formatRE = format;
            return format;
        },
        priceRe: function(id_price){
            this.priceRE = id_price;
            return id_price;
        },
        hallRe: function(id_hall){
            this.hallRE = id_hall;
            return id_hall;
        },
        dateInput(event) {
            this.dateRE = event.target.value;
        },
        movieFormatInput(event) {
            this.formatRE = event.target.value;
        },
        PriceSelect(event) {
            this.priceRE = event.target.value;
        },
        HallSelect(event) {
            this.hallRE = event.target.value;
        },
        update:  function(idSession){
            const idFilm = JSON.parse(sessionStorage.idFilm);
            const date = document.getElementById('date'+idSession).value;
            const hall = document.getElementById('hallRE'+idSession).value;
            const price = document.getElementById('priceRE'+idSession).value;
            const format = document.getElementById('movieFormat'+idSession).value;
            console.log(idSession );
            console.log(date );
            console.log(hall );
            console.log(price );
            console.log(format );
            if( date != '' && hall != '', price != ''){
                if(/^(2|3)$/i.test(this.formatRE)){
                    format += "D";
                    axios.post("./php/cinema/updateSession.php", {idFilm, date, hall, price, format,idSession})
                    .then(function(response){
                        app.movie = response.data.FilmSession;
                        if(response.data.FilmSession == false){
                            alert('В это время идет фильм(необходимо ставить фильм за 10 минут до или после другого фильма)');
                            app.sessons = response.data.sessons;
                        }
                        else if(response.data.FilmSession == true){
                            alert('Сессия обновлена');
                            app.sessons = response.data.sessons;
                        }
                        else if(response.data.FilmSession == null){
                            alert('Ошибка');
                        }
                    });
                }
                else if(/^(2|3)D$/i.test(this.formatRE)){
                    axios.post("./php/cinema/updateSession.php", {idFilm, date, hall, price, format,idSession})
                    .then(function(response){
                        app.movie = response.data.FilmSession;
                        if(response.data.FilmSession == false){
                            alert('В это время идет фильм(необходимо ставить фильм за 10 минут до или после другого фильма)');
                            app.sessons = response.data.sessons;
                        }
                        else if(response.data.FilmSession == true){
                            alert('Сессия обновлена');
                            app.sessons = response.data.sessons;
                        }
                        else if(response.data.FilmSession == null){
                            alert('Ошибка');
                        }
                    });
                }
                else{
                     alert('Невернный ввод формата');
                }
            }
            else{
                     alert('Необходимо выбрать все поля');
                }
            
            
        },
        delet: function(id){
            const idFilm = JSON.parse(sessionStorage.idFilm);
            axios.post("./php/cinema/deletSession.php", {id, idFilm})
            .then(function(response){

                app.sessons = response.data.sessons;
              });
            
        },
        NewPrice: function(){
            if(/^\d+$/i.test(this.addPrice)){
              const addPrice = this.addPrice;
              axios.post("./php/cinema/getHallPrice.php", {addPrice, 'unput' : 'addPrice'})
              .then(function(response){
                app.getprices = response.data.price;
                
              });
              this.getInfoHallPrice();
            }
            else{
              alert('Введите верно цену');
            }
        },
        getInfoHallPrice: function(){

            axios.post("./php/cinema/getHallPrice.php", {'unput' : ''})
                .then(function(response){
                    app.gethalls = response.data.hall;
                    app.getprices = response.data.price;
                    app.gethallsRE = response.data.hall;
                    app.getpricesRE = response.data.price;
                });
        },
        NewSession: function(){
            const idFilm = Number(JSON.parse(sessionStorage.idFilm));
            const date = this.date;
            const hall = this.hall;
            const price = this.price;
            const format = this.format;
            if(idFilm != null && date != '' && hall != '', price != ''){
                if(/^(2|3)$/i.test(this.format)){
                    format += "D";
                    axios.post("./php/cinema/addSession.php", {idFilm, date, hall, price, format})
                    .then(function(response){
                       app.movie = response.data.FilmSession;
                        if(response.data.FilmSession == false){
                            alert('В это время идет фильм(необходимо ставить фильм за 10 минут до или после другого фильма)');
                        }
                        else if(response.data.FilmSession == true){
                            alert('Сессия добавлена');
                            app.sessons = response.data.sessons;
                        }
                        else if(response.data.FilmSession == null){
                            alert('Ошибка');
                        }
                    });
                }
                else if(/^(2|3)D$/i.test(this.format)){
                    axios.post("./php/cinema/addSession.php", {idFilm,date, hall, price, format})
                    .then(function(response){
                        app.movie = response.data.FilmSession;
                        if(response.data.FilmSession == false){
                            alert('В это время идет фильм(необходимо ставить фильм за 10 минут до или после другого фильма)');
                        }
                        else if(response.data.FilmSession == true){
                            alert('Сессия добавлена');
                            app.sessons = response.data.sessons;
                        }
                        else if(response.data.FilmSession == null){
                            alert('Ошибка');
                        }
                    });
                }
                else{
                     alert('Невернный ввод формата');
                }
            }
            else{
                     alert('Необходимо выбрать все поля');
                }
        },
        // infoAddSession: function(){
        //     if(this.movie == false){
        //         alert('В это время идет фильм(необходимо ставить фильм за 10 минут до или после другого фильма)');
        //     }
        //     else if(this.movie == true){
        //         alert('Сессия добавлена');
        //         this.getInfoSessons();
        //     }
        //     else if(this.movie == null){
        //         alert('Ошибка');
        //     }
        // },
        getInfoFilm: function(){
            const idFilm = Number(JSON.parse(sessionStorage.idFilm));
            axios.post("./php/cinema/cinema.php", {idFilm})
                .then(function(response){
                    app.film = response.data.movie;
                });
        },
        getInfoSessons: function(){
            const idFilm = JSON.parse(sessionStorage.idFilm);
            axios.post("./php/cinema/sessions.php", {idFilm})
                .then(function(response){
                    app.sessons = response.data.sessons;
                });
        },
    }
  });