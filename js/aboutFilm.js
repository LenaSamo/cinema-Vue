
var app = new Vue({
    el: '#blockAboutFilm',
    data:{
        user: [],
        idFilm: null,
        movie: [],
        title: '',
        rentalStartDate: '',
        rentalEndDate: '',
        yearOfRelease: '',
        timing: '',
        description: '',
        rental_company: '',
        addRC: false,
        getRental_company: [],
        addrental_company: '',
        addС: false,
        country: '',
        addcountry: '',
        getСountry: '',
        textModal: '',
        showModal: false,
        photos: [],
        idPhotos: 0,
        directors: [],
        actors: [],
        genres: [],
        seacheGenre: '',
        sessions: [],
        date: new Date(),
        isActive1: true,
        isActive2: false,
        isActive3: false,
        isActive4: false,
        indexActive: 0,
    },
    mounted: function(){
        this.getCinema();
        this.getCinemaSessions();
        this.user = JSON.parse(sessionStorage.user);
        console.log(this.user);
        this.getInfo();
    },
    watch: {
        title: function () {
            console.log(this.title);
        },
        priceRE: function () {
            console.log(this.priceRE);
        },
    },
    methods:{
        countryRE: function(id){
            this.country = id;
            return id;
        },
        countrySelect(event) {
            this.country = event.target.value;
        },
        rental_companyRE: function(id){
            this.rental_company = id;
            return id;
        },
        rental_companySelect(event) {
            this.rental_company = event.target.value;
        },
        //получение информации
        getInfo: function(){
            axios.get("./php/cinema/get.php")
            .then(function(response){
                app.getRental_company = response.data.getRental_company;
                app.getСountry = response.data.getСontry;
            });
          },
          //добавление новой страны
          Newcontry: function(){
            if(/^[А-я]+$/i.test(this.addcountry)){
                const addcontry = this.addcountry;
                axios.post("./php/cinema/inputGenComCon.php", {addcontry, 'unput' : 'addcontry'})
                .then(function(response){
                    app.getСountry = response.data.getСontry;
                    if(response.data.error == 'edited'){
                        app.showModal = true;
                        app.textModal = response.data.text;
                    }
                    else if(response.data.error == 'notedited'){
                        app.showModal = true;
                        app.textModal = response.data.text;
                    }
                });
    
            }
            else{
                app.showModal = true;
                app.textModal = 'Введите верно название страны';
            }
          },
          //изменение поля страны
          countryREBut: function(){
            const country = this.country;
            const idFilm = this.idFilm;
                axios.post("./php/cinema/REOneFilm.php", {country, idFilm, 're': 'country'})
                .then(function(response){
                    if(response.data.error == 'edited'){
                        app.showModal = true;
                        app.textModal = response.data.text;
                    }
                    
                    
                });
                
             
        },
        //изменение поля описания
        descriptionRE: function(){
            const description = this.description;
            const idFilm = this.idFilm;
            if (description != '') {
                
                axios.post("./php/cinema/REOneFilm.php", {description, idFilm, 're': 'description'})
                .then(function(response){
                    if(response.data.error == 'edited'){
                        app.showModal = true;
                        app.textModal = response.data.text;
                    }
                    
                    
                });
                
                
            }
            else{
                this.showModal = true;
                this.textModal = 'Необходимо ввести описание';
            }
        },
          //изменение поля хронометража 
        titleRE: function(){
            const title = this.title;
            const idFilm = this.idFilm;
            if (title != '') {
                
                axios.post("./php/cinema/REOneFilm.php", {title, idFilm, 're': 'title'})
                .then(function(response){
                    if(response.data.error == 'edited'){
                        app.showModal = true;
                        app.textModal = response.data.text;
                    }
                    
                    
                });
                
                
            }
            else{
                this.showModal = true;
                this.textModal = 'Необходимо ввести название фильма';
            }
        },
        //изменение даты начала проката
        rentalStartDateRE: function(){
            const rentalStartDate = this.rentalStartDate;
            const idFilm = this.idFilm;
            if (rentalStartDate != null) {
                axios.post("./php/cinema/REOneFilm.php", {rentalStartDate, idFilm, 're': 'rentalStartDate'})
                .then(function(response){
                    if(response.data.error == 'edited'){
                        app.showModal = true;
                        app.textModal = response.data.text;
                    }
                    
                    
                });
            }
        },
        //изменение даты конца проката
        rentalEndDateRE: function(){
            const rentalEndDate = this.rentalEndDate;
            const idFilm = this.idFilm;
            if (rentalEndDate != null) {
                axios.post("./php/cinema/REOneFilm.php", {rentalEndDate, idFilm, 're': 'rentalEndDate'})
                .then(function(response){
                    if(response.data.error == 'edited'){
                        app.showModal = true;
                        app.textModal = response.data.text;
                    }
                    
                    
                });
            }
        },
        //изменение года релиза
        yearOfReleaseRE: function(){
            const yearOfRelease = this.yearOfRelease;
            const idFilm = this.idFilm;
            if (yearOfRelease != '') {
                if(/^(19|20)\d{2}$/.test(yearOfRelease)){
                    axios.post("./php/cinema/REOneFilm.php", {yearOfRelease, idFilm, 're': 'yearOfRelease'})
                    .then(function(response){
                        if(response.data.error == 'edited'){
                            app.showModal = true;
                            app.textModal = response.data.text;
                        }
                        
                        
                    });
                }
                else{
                    this.showModal = true;
                    this.textModal = 'Неверный ввод года';
                }
                
            }
            else{
                this.showModal = true;
                this.textModal = 'Необходимо ввести год релиза';
            }
        },
        //изменение поля хронометража 
        timingRE: function(){
            const timing = this.timing;
            const idFilm = this.idFilm;
            if (timing != '') {
                if(/^\d+$/.test(timing)){
                    axios.post("./php/cinema/REOneFilm.php", {timing, idFilm, 're': 'timing'})
                    .then(function(response){
                        if(response.data.error == 'edited'){
                            app.showModal = true;
                            app.textModal = response.data.text;
                        }
                        
                        
                    });
                }
                else{
                    this.showModal = true;
                    this.textModal = 'Неверный ввод хронометража';
                }
                
            }
            else{
                this.showModal = true;
                this.textModal = 'Необходимо ввести хронометраж';
            }
        },
        //изменение поля компании прокатчика
        rental_companyREBut: function(){
            const rental_company = this.rental_company;
            const idFilm = this.idFilm;
           
                
                    axios.post("./php/cinema/REOneFilm.php", {rental_company, idFilm, 're': 'rental_company'})
                    .then(function(response){
                        if(response.data.error == 'edited'){
                            app.showModal = true;
                            app.textModal = response.data.text;
                        }
                        
                        
                    });
               
            
        },
        //добавление компании прокатчика
        Newrental_company: function(){
            if(/^[0-9]*[A-я]+\s*[0-9]*[A-я]*$/i.test(this.addrental_company)){
              const addrental_company = this.addrental_company;
              axios.post("./php/cinema/inputGenComCon.php", {addrental_company, 'unput' : 'addrental_company'})
              .then(function(response){
                app.getRental_company = response.data.getRental_company;
                if(response.data.error == 'edited'){
                    app.showModal = true;
                    app.textModal = response.data.text;
                }
                else if(response.data.error == 'notedited'){
                    app.showModal = true;
                    app.textModal = response.data.text;
                }
              });
    
            }
            else{
                this.showModal = true;
                this.textModal = 'Введите верно название компании прокатчика';
            }
          },
        clickAddSession: function(){
            
            window.location.href = "http://localhost/vue/addSession.php";
        },
        clickButton: function (indexNew) {
            if(this.indexActive == 0){
                this.isActive1 = !this.isActive1;
            }
            else if(this.indexActive == 1){
                this.isActive2 = !this.isActive2;
            }
            else if(this.indexActive == 2){
                this.isActive3 = !this.isActive3;
            }
            else if(this.indexActive == 3){
                this.isActive4 = !this.isActive4;
            }

            if(indexNew == 0){
                this.isActive1 = !this.isActive1;
            }
            else if(indexNew == 1){
                this.isActive2 = !this.isActive2;
            }
            else if(indexNew == 2){
                this.isActive3 = !this.isActive3;
            }
            else if(indexNew == 3){
                this.isActive4 = !this.isActive4;
            }

            this.indexActive = indexNew;
            this.getCinemaSessions();
        },
        clickCarousel: function(napravlenue, mas){
            //направление влево
            if (napravlenue == 0) {
                if (mas.length - 1 >= this.idPhotos && this.idPhotos >= 1) {
                    this.idPhotos = this.idPhotos - 1;
                }
                else if(this.idPhotos == 0){
                    this.idPhotos = mas.length - 1;
                }
            }
            //направление вправо
            if (napravlenue == 1) {
                if (this.idPhotos >= 0 && mas.length - 1 > this.idPhotos ) {
                    this.idPhotos = this.idPhotos + 1;
                }
                else if(this.idPhotos == mas.length - 1){
                    this.idPhotos = 0;
                }
            }
            console.log(this.idPhotos);
        },
        dateNew: function (value) {
            let date = new Date(this.date);
            date.setDate(date.getDate() + value);
            date = this.formatDate2(date);
            if (value == 0) {
                return "Сегодня - " + date;
            }
            if (value == 1){
                return "Завтра - " + date;
            }
            return date;
        },
        formatDate2: d => d.toLocaleString('ru-RU').replace(',', '').slice(0, -9),
        formatDate1: d => d.toLocaleString('ru-RU').replace(',', '').slice(0, -3),
        formatDate3: d => d.toLocaleString('ru-RU').replace(',', '').slice(10, -3),
        getID: function(){
            const urlParams = new URLSearchParams(window.location.search);
            this.idFilm = urlParams.get("id");
            return this.idFilm;
        },
        getCinema: function(){
            const idFilm = this.idFilm;
            if (idFilm != null) {
                axios.post("./php/cinema/cinema.php", {idFilm})
                .then(function(response){
                    app.title = response.data.movie[0]['title_movie'];
                    app.rentalStartDate = response.data.movie[0]['rental start date'];
                    app.rentalEndDate = response.data.movie[0]['rental end date'];
                    app.yearOfRelease = response.data.movie[0]['year of release'];
                    app.timing = response.data.movie[0]['timing'];
                    app.description = response.data.movie[0]['description'];
                    app.movie = response.data.movie;


                    app.photos = response.data.photos;
                    app.directors = response.data.directors;
                    app.actors = response.data.actors;
                    app.genres = response.data.genres;
                    sessionStorage.setItem('idFilm', JSON.stringify(response.data.idFilm));
                });
            }
            
        },
        getCinemaSessions: function(){
            const idFilm = this.idFilm;
            const indexActive = this.indexActive;
            axios.post("./php/cinema/filmSessions.php", {indexActive, idFilm})
            .then(function(response){
                app.sessions = response.data.sessions;
            });
        },
        photo: function(mas){
            return "img/"+mas[this.idPhotos]['photo'];
        },
        genre: function(mas){
            let genreMas = mas[0].genre;
            for (let index = 1; index < mas.length; index++) {
                genreMas += ", " + mas[index].genre;
                
            }
            return genreMas;
        },
        director: function(mas){
            let directorsMas = mas[0].name_director;
            for (let index = 1; index < mas.length; index++) {
                directorsMas += ", " + mas[index].name_director;
                
            }
            return directorsMas;
        },
        actor: function(mas){
            let directorsMas = mas[0].name_actor;
            for (let index = 1; index < mas.length; index++) {
                directorsMas += ", " + mas[index].name_actor;
                
            }
            return directorsMas;
        },
        goBuyTickets: function(id_film, id_session){
            window.location.href = `http://localhost/vue/buyTicketsChoosingPlace.php?id_film=${id_film}&id_session=${id_session}`;
        },
    }
  });
  