<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Все фильмы</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet'  href='./css/main.css'>
    <link rel='stylesheet'  href='./css/allFilm.css'>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body>
    <?php
        include("php/connection.php");
        include("header.php");
    ?>
    <div class="blockallFilm" id="blockallFilm">
        <h2>Все фильмы</h2>
        <button class="addFilm"
                v-on:click="clickAddFilm()">
            Добавить фильм
        </button>
        <div class="allFilm" v-if="movies.length == 0" >
            <p>Нет фильмов</p>
        </div>
        <div class="allFilm" id="allFilm" v-for="movie in movies" v-else>
            <img :src="photo(movie['10'])" alt="фото"/>
            <div class="discreption">
                <h3><a :href="'aboutfilm.php?id=' + movie.id">{{ movie.title_movie }}</a><sup>{{ movie.ageLimit }}+</sup></h3>
                <div class="genres" >
                   <p> {{ genresAll(movie[9]) }} </p> 
                </div>
                <p>{{ movie.timing }} мин.</p>
            </div>
    </div>

    <div id="footer">
    </div>
    <script src='./js/allFilm.js'></script>
</body>