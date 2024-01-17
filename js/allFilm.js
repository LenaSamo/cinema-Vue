
var app = new Vue({
    el: '#blockallFilm',
    data:{
        movies: [],
    },
    watch:{
        movies: function () {
          console.log(this.movies[0][10][0]['photo']);
      },
    },
    mounted: function(){
        this.getCinema();
    },
    methods:{
        
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
        getCinema: function(){
             axios.post("./php/cinema/allCinemaAllMovie.php", {'unput' : ''})
                .then(function(response){
                    app.movies = response.data.cinema;
                });
        },
    }
  });
  