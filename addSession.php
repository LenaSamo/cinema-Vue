<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Добавить сеансы к фильму</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet'  href='./css/main.css'>
    <link rel='stylesheet'  href='./css/addSession.css'>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
    <?php
        include("php/connection.php");
        include("header.php");
    ?>

    <div class="blockAddSession" id="blockAddSession">
        <div  v-if="idFilm == null">
            <h2>Фильм не выбран</h2>
        </div>
        <div v-else>
            <h2>Добавление сеанса для фильма "{{ film[0]['title_movie']}}"</h2>
            <table>
                <tbody>
                  <tr>
                    <th>Дата и время</th>
                    <th>Зал</th>
                    <th>Цена</th>
                    <th>Формат</th>
                  </tr>
                  <tr >
                    <td>
                        <input  type="datetime-local" name="date" id="date"  required
                        v-model="date">
                    </td>
                    <td>
                        <select name="hall" id="hall"  v-model="hall">
                            <option  v-for="hall in gethalls" :value="hall['id']"  >{{hall['title_hall']}}</option>
                        </select>
                        <!-- <button class="addHall" v-on:click="() => Wachhall = !Wachhall">+</button><br>
                        <input  type="text" name="addHall" id="addHall"  required 
                                placeholder="Добавление зала..."
                                v-model="addHall" v-if="Wachhall == true">
                        <button class="addHall" v-on:click="NewHall()" v-if="Wachhall == true">Добавить</button> -->
                    </td>
                    <td>
                        <select name="price" id="price"  v-model="price">
                            <option v-for="price in getprices" :value="price['id']" >{{price['price']}}</option>
                        </select>
                        <button class="addPrice" v-on:click="() => Wachprice = !Wachprice">+</button><br>
                        <input type="text" name="addPrice" id="addPrice"  required 
                        placeholder="Добавление цены..."
                        v-model="addPrice" v-if="Wachprice == true">
                        <button class="addFilm" v-on:click="NewPrice()" v-if="Wachprice == true">Добавить</button>
                    </td>
                    <td>
                        <input  type="text" name="format" id="format"  required
                        v-model="format">
                    </td>
                    <td>
                        <button class="addFilm" v-on:click="NewSession()" >Добавить</button>
                    </td>
                  </tr>


                  <tr v-for="sesson in sessons">
                    <td>
                        <input  type="hidden" name="id" id="id"  
                        :value="idRe( sesson['id'])">
                        <input  type="datetime-local" name="date" :id="'date'+sesson['id']"  @input="dateInput($event)"
                        :value="dateRe(sesson['datetime'])">
                    </td>
                   <td>
                        <select name="hallRE" :id="'hallRE'+sesson['id']" v-on:click="HallSelect($event)" >
                            <option  :value="hallRe(sesson['id_hall'])" selected  >{{sesson['title_hall']}}</option>
                            <option  v-for="hall in gethallsRE" 
                                :value="hall['id']"  >{{hall['title_hall']}}</option>
                        </select>
                    </td>
                    <td>
                        <select name="priceRE" :id="'priceRE'+sesson['id']" v-on:click="PriceSelect($event)" >
                            <option  :value="priceRe(sesson['id_price'])" selected  >{{sesson['price']}}</option>
                            <option v-for="price in getpricesRE" 
                                :value="price['id']" >{{price['price']}}</option>
                        </select>
                    </td>
                    <td>
                        <input  type="text" name="movieFormat" @input="movieFormatInput($event)"
                         :id="'movieFormat'+sesson['id']" :value="formatRe(sesson['movieFormat'])">
                    </td>
                    <td>
                        <input class="registration" type="submit" value="Обновить" 
                        v-on:click="update(sesson['id'])">
                        <input class="registration" type="submit" value="Удалить" v-on:click="delet(sesson['id'])">
                    </td>
                  </tr>
                </tbody>
            </table>
        </div>
        

        
    </div>
    <script src='./js/addSession.js'></script>
</body>
</html>