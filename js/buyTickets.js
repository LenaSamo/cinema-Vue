
var app = new Vue({
    el: '#blockBuyTickets',
    data:{
        film: [],
        session: [],
        idFilm: '',
        idSession: '',
        selectRowColume: [],
        showModal: false,
    },
    mounted: function(){
        this.getCinema();
        this.getPlace();
    },
    watch:{
        
    },
    methods:{
        buttonDelPlace(index){
            if(this.selectRowColume.length > 1){
                this.selectRowColume.splice(index, 1);
            }
            else{
                app.showModal = true;
                app.textModal = 'Нельзя удалить единственное выбранное место';
            }
        },
        outputStrPlace(str){
            if(str != null){
                let mas = str.split(' ');
                return "Ряд " + mas[0] + ", Место " + mas[1];
            }
        },
        nexTicketBuy(){
            const selectRowColume = this.selectRowColume;
            if(selectRowColume.length != 0){
                sessionStorage.setItem('selectRowColume', JSON.stringify(selectRowColume));
                window.location.href = `http://localhost/vue/buyTicket.php?id_film=${this.idFilm}&id_session=${this.idSession}`;
            }
            else{
                app.showModal = true;
                app.textModal = 'Необходимо выбрать хотя бы одно место';
            }
        },
        choosingPlace(row, colume){
            console.log(row + " " + colume);
            const str = `${row} ${colume}`;
            let bool = false;
            if(this.selectRowColume.length != 0){
              for (let index = 0; index < this.selectRowColume.length; index++) {
                if(this.selectRowColume[index] == str){
                  bool = true;
                }
              }
            }
            if(bool == false){
              this.selectRowColume.push(...[str]);
            }
            else{
                let index = this.selectRowColume.indexOf(str);
                this.selectRowColume.splice(index, 1);
            }
            console.log(this.selectRowColume.includes(row + ' ' + colume));
            
        },
        getCinema: function(){
            const idFilm = this.idFilm;
            const idSession = this.idSession;
            if (idFilm != null && idSession != null) {
                axios.post("./php/cinema/session.php", {idSession, idFilm})
                .then(function(response){
                    app.session = response.data.session[0];
                    app.film = response.data.movie[0];

                    sessionStorage.setItem('idFilm', JSON.stringify(response.data.idFilm));
                });
            }
            
        },
        getID: function(){
            const urlParams = new URLSearchParams(window.location.search);
            this.idFilm = urlParams.get("id_film");
            this.idSession = urlParams.get("id_session");
            return this.idFilm;
        },
        getPlace: function(){
            this.selectRowColume = JSON.parse(sessionStorage.selectRowColume);
            
        },
    }
  });