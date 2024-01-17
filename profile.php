<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Профиль</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet'  href='./css/main.css'>
    <link rel='stylesheet'  href='./css/profile.css'>
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

    <div class="profile" id="profile">
        <h1>Ваш профиль</h1>
        <div class="info">
            <div class="block">
                <label for="login">Логин:</label><br>
                <input  type="text" name="login" id="login"  required
                v-model="login">
                <button class="butRE" v-on:click="loginRE()">&#9998;</button>
                <br>
                <p class="error" id="error_login" >{{ error_login }}</p><br>
            </div>
            <div class="block">
                <label for="email">Почта:</label><br>
                <input  type="text" name="email" id="email"  required
                v-model="email">
                <button class="butRE" v-on:click="emailRE()">&#9998;</button>
                <br>
                <p class="error" id="error_email" >{{ error_email }}</p><br>
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

        <div class="modal" v-if="passwordShowModal">
            <div class="modal-wrapper">
                <div class="modal-containerPassword">
                    <h3 slot="header">Смена пароля</h3>
                    <button class="modal-button" v-on:click="() => passwordShowModal = !passwordShowModal ">&#10006;</button>
                    <div class="passBlock">
                        <label for="Oldpassword">Старый пароль:</label><br>
                        <input  type="password" name="Oldpassword" id="Oldpassword"  required
                        v-model="Oldpassword"><br>

                        <label for="Newpassword">Новый пароль:</label><br>
                        <input type="password" name="Newpassword" id="Newpassword" required
                        v-model="Newpassword"><br>
                        
                        <p class="error" id="error_password" >{{ error_password }}</p><br>
                        <button class="butPass" v-on:click="RePassword()"  name="RePassword" >Сменить</button>
                    </div>
                </div>
            </div>
        </div>
        <button class="button" v-on:click="() => passwordShowModal = !passwordShowModal">Сменить пароль</button>
        <button class="button" v-on:click="clickOut()">Выйти</button>
    </div>
    <script src='./js/profile.js'></script>
</body>
</html>