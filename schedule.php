<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Расписание</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet'  href='./css/main.css'>
    <link rel='stylesheet'  href='./css/schedule.css'>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body>
<?php
        include("php/connection.php");
        include("header.php");
    ?>
    <div class="blockMainSchedule" id="blockMainSchedule">
        <h2>Расписание</h2>
        <div v-if="user['idRole'] == 2">
            <button class="addFilm"
                    v-on:click="clickAddFilm()">
                Добавить фильм
            </button>
            <button class="addFilm"
                    v-on:click="clickAllFilm()">
                Все фильмы
            </button>
        </div>
        <div class="blockButton" >
            <button id="date1" 
                    v-on:click="clickButton(0)"
                    v-bind:class=" [isActive1 ? 'activeButton' : '', 'button']">
                {{ dateNew(0) }}
            </button>
            <button id="date2" 
                    v-on:click="clickButton(1)"
                    v-bind:class="[isActive2 ? 'activeButton' : '', 'button']">
                {{ dateNew(1) }}
            </button>
            <button id="date3" 
                    v-on:click="clickButton(2)"
                    v-bind:class="[isActive3 ? 'activeButton' : '', 'button']">
                {{ dateNew(2) }}
            </button>
            <button id="date4" 
                    v-on:click="clickButton(3)"
                    v-bind:class="[isActive4 ? 'activeButton' : '', 'button']">
                {{ dateNew(3) }}
            </button>
        </div>
        
        <div class="schedule" v-if="movies.length == 0">
            <p>Нет сеансов</p>
            
        </div>
        <div class="schedule" id="schedule" v-for="movie in movies" v-else>
            <img :src="photo(movie['11'])" alt="фото"/>
            <div class="discreption">
                <h3><a :href="'aboutfilm.php?id=' + movie.id">{{ movie.title_movie }}</a><sup>{{ movie.ageLimit }}+</sup></h3>
                <div class="genres" >
                   <p> {{ genresAll(movie['10'])}} </p> 
                </div>
                <p>{{ movie.timing }} мин.</p>
                <div class="sessions" >
                    <div class="sessionTime" v-for="sessions in movie['9']" v-on:click="goBuyTickets(movie.id, sessions.id)">
                        <p class="hall">{{ sessions.title_hall }} зал</p>
                        <p class="format">{{ sessions.movieFormat }}</p>
                        <p class="price">{{ sessions.price }}р</p>
                        <p class="time">{{ formatDate3(sessions.datetime) }} </p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <script src='./js/scheduleJS.js'></script>
</body>
</html>