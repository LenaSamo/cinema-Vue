
var app = new Vue({
    el: '#blockMainSchedule',
    data:{
        user: [],
        date: new Date(),
        movies: [],
        dateTime: [],
        isActive1: true,
        isActive2: false,
        isActive3: false,
        isActive4: false,
        indexActive: 0,
    },
    mounted: function(){
        this.getAllCinema();
        this.user = JSON.parse(sessionStorage.user);
        console.log(this.user);
    },
    methods:{
        goBuyTickets: function(id_film, id_session){
            window.location.href = `http://localhost/vue/buyTicketsChoosingPlace.php?id_film=${id_film}&id_session=${id_session}`;
        },
        clickAllFilm: function(){
            sessionStorage.setItem('idFilm', JSON.stringify(''));
            window.location.href = "http://localhost/vue/allFilm.php";
        },
        clickAddFilm: function(){
            window.location.href = "http://localhost/vue/addFilm.php";
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
            this.getAllCinema();
            
        },
        formatDate2: d => d.toLocaleString('ru-RU').replace(',', '').slice(0, -9),
        formatDate1: d => d.toLocaleString('ru-RU').replace(',', '').slice(0, -3),
        formatDate3: d => d.toLocaleString('ru-RU').replace(',', '').slice(10, -3),
        getAllCinema: function(){
            const indexActive = this.indexActive;
            axios.post("./php/cinema/allCinema.php", {indexActive})
            .then(function(response){
                app.movies = response.data.movies;
                app.dateTime = response.data.dateTime;
            });
        },
        genresAll: function(mas){
            let newMas = mas[0]['genre'];
            for (let index = 1; index < mas.length; index++) {
                newMas += ", " + mas[index]["genre"];
                
            }
            return newMas;
        },
        photo: function(mas){
            
            return "img/"+mas[0]['photo'];
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
    }
  });