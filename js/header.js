
var app = new Vue({
    el: '#header',
    data:{
        user: [],
        id: [],
    },
    mounted: function(){
        this.user = JSON.parse(sessionStorage.user);
        console.log(this.user);
    },
    methods:{

    }
  });




// document.write('\
//     <header class="header">\
//         <h1 class="h1"><a href="main.php">Кинотеатр</a></h1>\
//         <ul class="menuA">\
//             <li><a href="schedule.html">Расписание</a></li>\
//             <li><a href="news.html">Новости</a></li>\
//             <li><a href="refund.html">Возврат билетов</a></li>\
//             <li><a href="aboutus.html">О нас</a></li>\
//             <li><a href="autorization.php">Вход</a></li>\
//         </ul>\
//     </header>\
// ');