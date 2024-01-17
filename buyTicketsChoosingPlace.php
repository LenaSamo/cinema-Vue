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
    <div id="blockBuyTickets" v-if="getID() >= 1">
        <div class="modal" v-if="showModal" >
            <div class="modal-wrapper">
                <div class="modal-container">
                    <h3 slot="header">{{ textModal }}</h3>
                    <button class="modal-button" v-on:click="() => showModal = !showModal ">&#10006;</button>
                </div>
            </div>
        </div>
        <div class="infoFilm">
            <h1>{{ film['title_movie'] }} <sup>{{ film['ageLimit'] }}+</sup></h1>
            <p>{{ session['movieFormat'] }} &bull; {{ session['title_hall'] }} зал &bull; {{ session['price'] }} руб. &bull; 
                <input type="datetime-local" :value="session['datetime']" readOnly>
            </p>
            
            <button class="ext" onclick="history.back();" >	&#10006;</button>
            <div class="circles">
                <button  class="circle" id="circle1"></button><p>Занято</p>
                
                <button  class="circle" id="circle2"></button><p>Выбрано</p>
                
            </div>
        </div>
        
        <div class="blockHall">
            <p id="Win">Экран</p>
            <div class="circleRowLeft">
                <div v-for="i, row in +session['row number']">
                    <button  class="circle" >{{ i }}</button><br>
                </div>
                
            </div>
            <div class="mainBlock">
                <div v-for="i, row  in +session['row number']">
                    <button :key="i" 
                        v-for="j, column in +session['number of seats in a row']" 
                        v-on:click="choosingPlace(i, j)" 
                        v-bind:class="[ selectRowColume.includes(i + ' ' + j) ? 'circleSelected' : '', 'circle']" :key="j">
                        {{ j }}
                    </button>
                </div>
            </div>
            <div class="circleRowRight">
                <div v-for="i, row in +session['row number']">
                    <button  class="circle" >{{ i }}</button><br>
                </div>
                
            </div>
            
        </div>
        <div class="blockSelectePlaces">
            <p>Выбранно мест - {{ selectRowColume.length }}</p>
            <p>Итог - {{ session['price'] * selectRowColume.length }} руб.</p>
            <button  class="next" v-on:click="nexTicketBuy()" >Далее</button>
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