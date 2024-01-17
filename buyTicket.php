<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Главная страница</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet'  href='./css/main.css'>
    <link rel='stylesheet'  href='./css/buyTickets.css'>
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
    <div id="blockBuyTickets" v-if="getID() >= 1  && selectRowColume.length != 0">
        <div class="infoFilm">
            <h1>{{ film['title_movie'] }} <sup>{{ film['ageLimit'] }}+</sup></h1>
            <p>{{ session['movieFormat'] }} &bull; {{ session['title_hall'] }} зал &bull; 
                <input type="datetime-local" :value="session['datetime']" readOnly>
            </p>
            
            <button class="ext" onclick="history.back();" >	&#10006;</button>
        </div>
        <div class="blockBuy">
            <div class="places">
                <div class="place" v-for=" strPlace, index in selectRowColume" >
                    <p>{{ outputStrPlace(strPlace) }}</p>
                    <p>{{ session['price'] }} руб.</p>
                    <button v-on:click="buttonDelPlace(index)">&#10006;</button>
                </div>
            </div>
            <p>Итог - {{ session['price'] * selectRowColume.length }} руб.</p>
        </div>


        <div class="modal" v-if="showModal" >
            <div class="modal-wrapper">
                <div class="modal-container">
                    <h3 slot="header">{{ textModal }}</h3>
                    <button class="modal-button" v-on:click="() => showModal = !showModal ">&#10006;</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src='./js/buyTickets.js'></script>


    <div id="footer">
    </div>
    <?php
    ?>
    
        
    </script>
</body>
</html>