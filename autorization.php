<!DOCTYPE html>
<html>
<head>
	<title>Авторизация</title>
	<meta charset = 'utf-8'>
	<link rel="stylesheet" type="text/css" href="css/formCss.css">
	<link rel='stylesheet'  href='./css/main.css'>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body >
<?php
        include("php/connection.php");
        include("header.php");
    ?>
    <div  class="toComeIn_Register" id="toComeIn_Register" name="toComeInForm">
        <div class="toComeIn" name="toComeInForm" id="ClasstoComeIn">
            <h2>Войти</h2>
            <label for="login">Логин:</label><br>
            <input  type="text" name="login" id="login" placeholder="Логин" required
            v-model="login"><br>
            <p class="error" id="error_login" >{{ error_login }}</p><br>

            <label for="password">Пароль:</label><br>
            <input type="password" name="password" id="password" placeholder="Пароль" required
            v-model="password"><br>
            <p class="error" id="error_passwordform" >{{ error_passwordform }}</p><br>
            
            <div class="error" id="error_avt"></div><br>
            <!-- <input class="button" type="submit" name="toComeIn_Person" value="Войти"> -->
            <button class="button" v-on:click="avtorization()"  name="toComeIn_Person" >Войти</button>
            <a href = "registration.php">Зарегистрироваться</a><br>

            <!-- <div class="uLogin" id="uLogin" data-ulogin="display=panel;theme=classic;fields=first_name,
            last_name;providers=vkontakte,odnoklassniki,mailru,facebook;hidden=other;
            redirect_uri=http%3A%2F%2F;mobilebuttons=0;">
            </div>   -->
        </div>  
    </div>


    <script src="//ulogin.ru/js/ulogin.js"></script> 
	<script src="./js/avtorization.js"></script>	
	<!-- <script src="./js/validation_of_registration.js"></script>	 -->
</body>
</html>