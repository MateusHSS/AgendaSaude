$('.dropdown-trigger').dropdown({

    container: document.body,
    hover: true,
    coverTrigger: false

});
$(document).ready(function(){

    $(".modal").modal();

    //VOLTA A HOME AO CLICAR NO X
    $("#fechar").click(function(){
        window.location.replace('../../php/home.php');
    });
});