<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Добавить фильм</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet'  href='./css/main.css'>
    <link rel='stylesheet'  href='./css/addFilm.css'>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
    <?php
        include("php/connection.php");
        include("header.php");
    ?>
    <div class="blockAddFilm" id="blockAddFilm">
        <h2>Добавление фильма</h2>

        <label for="file">Добавить фото:</label><br>
        <input type="file" id="file" name="file" ref="file" v-model="file"/><br>

        <label for="title_movie">Название фильма:</label><br>
        <input  type="text" name="title_movie" id="title_movie"  required
        v-model="title_movie"><br>
        <div class="error" id="error_login"></div><br>

        <label for="year_of_release">Год релиза:</label><br>
        <input type="text" name="year_of_release" id="year_of_release"  required
        v-model="year_of_release"><br>
        <p class="error" id="error_year_of_release" v-model="error_year_of_release"></p><br>

        <label for="timing">Хронометраж:</label><br>
        <input type="text" name="timing" id="timing"  required
        v-model="timing"><br>
        <div class="error" id="error_passwordform"></div><br>

        <label for="ageLimit">Возрастное огрничение:</label><br>
        <input type="text" name="ageLimit" id="ageLimit" required
        v-model="ageLimit"><br>
        <div class="error" id="error_passwordform"></div><br>

        <label for="rental_start_date">Дата начала проката:</label><br>
        <input type="date" name="rental_start_date" id="rental_start_date" required
        v-model="rental_start_date" ><br>
        <div class="error" id="error_passwordform"></div><br>

        <label for="rental_end_date">Дата конца проката:</label><br>
        <input type="date" name="rental_end_date" id="rental_end_date" required
        v-model="rental_end_date"><br>
        <div class="error" id="error_passwordform"></div><br>

        <!-- <label for="genre">Жанр:</label><br>
        <select name="genre" id="genre" v-model="genre">
            <option v-for="genre in getGenres" :value="genre['id']" >{{genre['genre']}}</option>
        </select>
        <button class="addFilm" v-on:click="() => addG = !addG">+</button><br>
        <input type="text" name="addgenre" id="addgenre"  required 
        placeholder="Добавление жанра..."
        v-model="addgenre" v-if="addG == true">
        <button class="addFilm" v-on:click="Newgenre()" v-if="addG == true">Добавить</button>
        <div class="error" id="error_passwordform"></div><br> -->

        <label for="contry">Страна:</label><br>
        <select name="contry" id="contry" v-model="contry">
            <option v-for="contry in getСontry" :value="contry['id']">{{contry['country']}}</option>
        </select>
        <button class="addFilm" v-on:click="() => addC = !addC">+</button><br>
        <input type="text" name="addcontry" id="addcontry"  required 
        placeholder="Добавление страны..."
        v-model="addcontry" v-if="addC == true">
        <button class="addFilm" v-on:click="Newcontry()" v-if="addC == true">Добавить</button>
        <div class="error" id="error_passwordform"></div><br>

        <label for="rental_company">Компания прокатчик:</label><br>
        <select name="rental_company" id="rental_company" v-model="rental_company">
        <option v-for="Rental_company in getRental_company" 
                :value="Rental_company['id_rental company']" >
            {{Rental_company['rental company']}}
        </option>
        </select>
        <button class="addFilm" v-on:click="() => addRC = !addRC">+</button><br>
        <input type="text" name="addrental_company" id="addrental_company"  required 
        placeholder="Добавление компании прокатчика..."
        v-model="addrental_company" v-if="addRC == true">
        <button class="addFilm" v-on:click="Newrental_company()" v-if="addRC == true">Добавить</button>
        <div class="error" id="error_passwordform"></div><br>

         <label for="genre">Жанры:</label><br>
        <input type="text" name="genre" id="genre"  required 
        placeholder="Поиск или добавление..."
        v-model="inputgenre">
        <button class="addFilm" v-on:click="Newgenre()">Добавить</button>
        <ul id="Searcegenre">
            <li v-if="Searcegenre.length == 0">Ничего не найденно</li>
            <li v-else v-for="Searcegenre in Searcegenre">
                <button  v-on:click="addgenre(Searcegenre['genre'], 
                                    Searcegenre['id'] )">
                    {{ Searcegenre['genre'] }}
                </button>
            </li>
        </ul>
        <ul>
            <li v-for="genre in genres">
                {{ genre[0] }}
                <button  v-on:click="deletgenre(genre[1])">
                    -
                </button>
            </li>
        </ul>
        <div class="error" id="error_passwordform"></div><br>

        <label for="directors">Режиссеры:</label><br>
        <input type="text" name="directors" id="directors"  required 
        placeholder="Поиск или добавление..."
        v-model="inputDirectors">
        <button class="addFilm" v-on:click="NewDirectors()">Добавить</button>
        <ul id="SearceDirectors">
            <li v-if="SearceDirectors.length == 0">Ничего не найденно</li>
            <li v-else v-for="SearceDirector in SearceDirectors">
                <button  v-on:click="addDicretors(SearceDirector['name_director'], 
                                    SearceDirector['id'] )">
                    {{ SearceDirector['name_director'] }}
                </button>
            </li>
        </ul>
        <ul>
            <li v-for="director in directors">
                {{ director[0] }}
                <button  v-on:click="deletDicretors(director[1])">
                    -
                </button>
            </li>
        </ul>
        <div class="error" id="error_passwordform"></div><br>

        <label for="actors">Главные актеры:</label><br>
        <input type="text" name="actors" id="actors"  required
        placeholder="Поиск или добавление..."
        v-model="inputActors">
        <button class="addFilm" v-on:click="NewActor()">Добавить</button>
        <ul id="SearceActors">
            <li v-if="SearceActors.length == 0">Ничего не найденно</li>
            <li v-else v-for="SearceActor in SearceActors">
                <button  v-on:click="addActor(SearceActor['name_actor'], 
                    SearceActor['id'] )">
                    {{ SearceActor['name_actor'] }}
                </button>
            </li>
        </ul>
        <ul>
            <li v-for="actor in actors">
                {{ actor[0] }}
                <button  v-on:click="deletActor(actor[1])">
                    -
                </button>
            </li>
        </ul>
        <div class="error" id="error_passwordform"></div><br>


        <label for="description">Описание:</label><br>
        <textarea name="description" id="description" v-model="description"></textarea><br>
        <div class="error" id="error_passwordform"></div><br>

        <button class="addFilm" v-on:click="addFilm()">
            Добавить фильм
        </button>
        
    </div>
    <script src='./js/addFilm.js'></script>
</body>
</html>