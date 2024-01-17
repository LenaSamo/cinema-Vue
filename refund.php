<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Возврат билетов</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet'  href='./css/main.css'>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="import" href="/header.html">
</head>
<body>
<?php
        include("php/connection.php");
        include("header.php");
    ?>
    <div class="blockUpcomingSessions">
        <h2>Возврат билетов</h2>
        <p>
                Для возврата купленных билетов на сайте, воспользуйтесь функцией 
            автовозврата. В правом верхнем углу открываем “Профиль” и нажать 
            кнопку возврата на нужном билете.<br>
            Для возврата купленных билетов на кассе, производится только у кассы 
            кинотеатра. Подойдите на кассу с купленными билетами до начала 
            сеанса для заполнения заявления о возврате. Если билеты 
            оплачивались банковской картой — деньги вернутся на неё же.
        </p>
    </div>
    
</body>