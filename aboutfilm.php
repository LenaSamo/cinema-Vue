<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Расписание</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet'  href='./css/main.css'>
    <link rel='stylesheet'  href='./css/aboutFilm.css'>
    <link rel='stylesheet'  href='./css/modal.css'>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body>
<?php
        include("php/connection.php");
        include("header.php");
    ?>
    <div id="blockAboutFilm" v-if="getID() >= 1">
        <div class="modal" v-if="showModal" >
            <div class="modal-wrapper">
                <div class="modal-container">
                    <h3 slot="header">{{ textModal }}</h3>
                    <button class="modal-button" v-on:click="() => showModal = !showModal ">&#10006;</button>
                </div>
            </div>
        </div>
        <button class="ext" onclick="history.back();" >	&#10006;</button>
        <h1 v-if="user['idRole'] == 2"> 
            <input  type="text" name="title" id="title"  required
                v-model="title">
            <button class="butRE" v-on:click="titleRE()">&#9998;</button>
        </h1>
        <h1 v-else> {{ movie['0']['title_movie'] }} </h1>

        <div class="wrap">
            <div class="b-carousel js-carousel">
                <button v-on:click="clickCarousel(0, photos)" class="b-carousel__prev js-carousel__prev" v-if="photos.length > 1">&#9668;</button>
                <button v-on:click="clickCarousel(1, photos)" class="b-carousel__next js-carousel__next" v-if="photos.length > 1">&#9658;</button>
                <div class="b-carousel__wrap js-carousel__wrap">
                    <div  class="b-carousel__item" >
                        <img :src="photo(photos)" alt="photo(photoMas)" class="b-carousel__img">
                    </div>
                </div>
            </div>
        </div>
    
        <div v-bind:class=" [user['idRole'] == 2 ? 'blockInfoRE' : '', 'blockInfo']" >
            <p>Начало проката</p>
            <input v-else type="date" name="rentalStartDate" id="rentalStartDate"  readOnly
                v-model="rentalStartDate">

            <input v-if="user['idRole'] == 2" type="date" name="rentalStartDate" id="rentalStartDate" 
                v-model="rentalStartDate">
            <button v-if="user['idRole'] == 2" class="butRE" v-on:click="rentalStartDateRE()">&#9998;</button>
        </div>

        <div v-bind:class=" [user['idRole'] == 2 ? 'blockInfoRE' : '', 'blockInfo']" >
            <p>Конец проката</p>
            <input v-else type="date" name="rentalEndDate" id="rentalEndDate"  readOnly
                v-model="rentalEndDate">

            <input v-if="user['idRole'] == 2"  type="date" name="rentalEndDate" id="rentalEndDate" 
                v-model="rentalEndDate">
            <button v-if="user['idRole'] == 2" class="butRE" v-on:click="rentalEndDateRE()">&#9998;</button>
        </div>


        <div v-bind:class=" [user['idRole'] == 2 ? 'blockInfoRE' : '', 'blockInfo']">
            <p>Жанр</p>
            <p v-else>{{ genre(genres) }}</p>

            <div v-if="user['idRole'] == 2" >
                <input type="text" name="seacheGenre" id="seacheGenre" 
                    v-model="seacheGenre"><br><br>
                    <div v-for="genre in genres">
                        <input type="checkbox" :name="'delGenre'+genre['id']" :id="'delGenre'+genre['id']" v-on:click="yearOfReleaseRE()">
                        <label :for="'delGenre'+genre['id']"  >{{genre['genre']}}</label>
                    </div>
                
            </div>
            
            <button v-if="user['idRole'] == 2" class="butRE" v-on:click="yearOfReleaseRE()">&#9998;</button>
        </div>

        <div v-bind:class=" [user['idRole'] == 2 ? 'blockInfoRE' : '', 'blockInfo']">
            <p>Год релиза</p>
            <p v-else>{{ movie['0']['year of release'] }}</p>

            <input v-if="user['idRole'] == 2" type="text" name="yearOfRelease" id="yearOfRelease" 
                v-model="yearOfRelease">
            <button v-if="user['idRole'] == 2" class="butRE" v-on:click="yearOfReleaseRE()">&#9998;</button>
        </div>

        <div v-bind:class=" [user['idRole'] == 2 ? 'blockInfoRE' : '', 'blockInfo']">
            <p>Компания прокатчик</p>
            <p v-else>{{ movie['0']['rental company'] }}</p>

            <div>
                <select v-if="user['idRole'] == 2" name="rental_company" id="rental_company" v-on:click="rental_companySelect($event)" >
                    <option  :value="rental_companyRE(movie[0]['id_rental company'])" selected  >{{movie[0]['rental company']}}</option>
                    <option  v-for="Rental_company in getRental_company"  
                                :value="Rental_company['id_rental company']" >{{Rental_company['rental company']}}</option>
                </select>
                <button v-if="user['idRole'] == 2" class="butRE" v-on:click="() => addRC = !addRC">+</button><br>
                <input v-if="user['idRole'] == 2 && addRC == true" type="text" name="addrental_company" id="addrental_company"  required 
                    placeholder="Добавление компании прокатчика..."
                    v-model="addrental_company">
                <button v-if="user['idRole'] == 2 && addRC == true" class="addFilm" v-on:click="Newrental_company()" v-if="">Добавить</button>    
            </div>
            <button v-if="user['idRole'] == 2" class="butRE" v-on:click="rental_companyREBut()">&#9998;</button>
        </div>
        <div v-bind:class=" [user['idRole'] == 2 ? 'blockInfoRE' : '', 'blockInfo']">
            <p>Страна</p>
            <p v-else>{{ movie['0'].country }}</p>

            <div>
                <select v-if="user['idRole'] == 2" name="country" id="country" v-on:click="countrySelect($event)" >
                    <option  :value="countryRE(movie['0'].country)" selected  >{{movie['0'].country}}</option>
                    <option  v-for="country in getСountry"  
                                :value="country['id']" >{{country['country']}}</option>
                </select>
                <button v-if="user['idRole'] == 2" class="butRE" v-on:click="() => addС = !addС">+</button><br>
                <input v-if="user['idRole'] == 2 && addС == true" type="text" name="addcountry" id="addcountry"  required 
                    placeholder="Добавление компании прокатчика..."
                    v-model="addcountry">
                <button v-if="user['idRole'] == 2 && addС == true" class="addFilm" v-on:click="Newcontry()" v-if="">Добавить</button>    
            </div>
            <button v-if="user['idRole'] == 2" class="butRE" v-on:click="countryREBut()">&#9998;</button>
        </div>

        <div class="blockInfo">
            <p>Режиссер</p>
            <p>{{ director(directors) }}</p>
        </div>
        <div class="blockInfo">
            <p>В ролях</p>
            <p>{{ actor(actors) }}</p>
        </div>

        
        <div v-bind:class=" [user['idRole'] == 2 ? 'blockInfoRE' : '', 'blockInfo']">
            <p>Хронометраж</p>
            <p v-else>{{ movie['0'].timing }} минут</p>

            <input v-if="user['idRole'] == 2" type="text" name="timing" id="timing" 
                v-model="timing">
            <button v-if="user['idRole'] == 2" class="butRE" v-on:click="timingRE()">&#9998;</button>
        </div>


        <div v-bind:class=" [user['idRole'] == 2 ? 'blockInfoRE' : '', 'blockInfo']">
            <p>Описание</p>
            <p v-else>{{ movie['0'].description }}</p>

            <textarea v-if="user['idRole'] == 2" name="description" id="description" v-model="description"></textarea>
            <button v-if="user['idRole'] == 2" class="butRE" v-on:click="descriptionRE()">&#9998;</button>
        </div>



        <div v-if="user['idRole'] == 2">
            <button class="addFilm"
                    v-on:click="clickAddSession()">
                Добавить сеансы
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
        <div class="sessions" v-if="sessions.length == 0">
            <p id="net">Нет сеансов</p>
        </div>
        <div class="sessions" v-else>
            
            <div class="sessionTime" v-for="session in sessions" v-on:click="goBuyTickets(movie[0].id, session.id)">
                <p class="hall">{{ session.title_hall }} зал</p>
                <p class="format">{{ session.movieFormat }}</p>
                <p class="price">{{ session.price }}р</p>
                <p class="time">{{ formatDate3(session.datetime) }}</p>
            </div>
        </div>

    </div>
    <div id="footer">
    </div>
    <script src='./js/aboutFilm.js'></script>
</body>
</html>