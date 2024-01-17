<header class="header" id="header">
    <h1 class="h1"><a href="main.php">Кинотеатр</a></h1>
    <ul class="menuA">
        <li v-if="user['idRole'] == 2"><a href="allFilm.php">Все фильмы</a></li>
        <li><a href="schedule.php">Расписание</a></li>
        <li><a href="news.php">Новости</a></li>
        <li><a href="refund.php">Возврат билетов</a></li>
        <li><a href="aboutus.php">О нас</a></li>
        <li v-if="user.length == 0"><a href="autorization.php">Вход</a></li>
        <li v-else><a href="profile.php">Профиль</a></li>
    </ul>
</header>

<script src="./js/header.js"></script>