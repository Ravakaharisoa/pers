$(document).ready(function() {
    var down = false;
    var down2 = false;
    var down3 = false;
    var down4 = false;

    $("#bell").mousedown(function(e) {
        var color = $(this).text();
        if (down) {
            $("#box_notif").css("height", "0px");
            $("#box_notif").css("opacity", "0");
            $("#box_notif").css("display", "none");

            down = false;
        } else {
            $("#box_notif").css("height", "auto");
            $("#box_notif").css("opacity", "1");
            $("#box_notif").css("display", "block");
            down = true;
        }
    });
    $("#envelope").mousedown(function(e) {
        var color = $(this).text();
        if (down2) {
            $("#box_message").css("height", "0px");
            $("#box_message").css("opacity", "0");
            $("#box_message").css("display", "none");
            down2 = false;
        } else {
            $("#box_message").css("height", "auto");
            $("#box_message").css("opacity", "1");
            $("#box_message").css("display", "block");
            down2 = true;
        }
    });
    $(".header_img").mousedown(function(e) {
        var color = $(this).text();
        if (down3) {
            $("#box_profil").css("height", "0px");
            $("#box_profil").css("opacity", "0");
            $("#box_profil").css("display", "none");
            down3 = false;
        } else {
            $("#box_profil").css("height", "auto");
            $("#box_profil").css("opacity", "1");
            $("#box_profil").css("display", "block");
            down3 = true;
        }
    });
    $(".header_etp_cfp").mousedown(function(e) {
        var color = $(this).text();
        if (down4) {
            $("#box_etp_cfp").css("height", "0px");
            $("#box_etp_cfp").css("opacity", "0");
            $("#box_etp_cfp").css("display", "none");
            down4 = false;
        } else {
            $("#box_etp_cfp").css("height", "auto");
            $("#box_etp_cfp").css("opacity", "1");
            $("#box_etp_cfp").css("display", "block");
            down4 = true;
        }
    });

});


$(document).ready(function() {
    var id_user = document.getElementById('id_user').value;
    $.ajax({
        url: "/affichage_role"
        , type: 'get'
        ,data: {
            id_user: id_user
        }
        , success: function(response) {
            var userData = response;
            for (var $i = 0; $i < userData.length; $i++) {
                if(userData[$i].role_id == 3 || userData[$i].role_id == 2 || userData[$i].role_id == 5  || userData[$i].role_id == 4){
                    if(userData[$i].activiter == true){
                        document.getElementById('liste_role').innerHTML += '<li> <span class="active_role me-2"><i class="bx bxs-circle"></i></span>'+ userData[$i].role_description+' </li>';
                    } else {
                        document.getElementById('liste_role').innerHTML += '<li> <a href="/change_role_user/'+ userData[$i].user_id+'/'+userData[$i].role_id+'">'+ userData[$i].role_description+'</a> </li>';
                    }
                } else {
                    document.getElementById('liste_role').innerHTML += '<li>'+ userData[$i].role_description+'</li>';

                }
            }
        }
        , error: function(error) {
            console.log(error);
        }
    });
});



let sidebar = document.querySelector(".sidebar");
//let affichertuto = document.querySelector(".apprendre");
let afficherinfos = document.querySelector(".infos");
let afficherfiltre = document.querySelector(".filtrer");
let menu = document.querySelector(".bx-menu");

    function afficherInfos() {
        afficherinfos.classList.toggle("afficher");
    }

function clickSidebar() {
    sidebar.classList.toggle("active");
}

function afficherFiltre() {
    afficherfiltre.classList.toggle("afficher");
}

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("ul li a").click(function() {
        $("li a").removeClass("active");
        $(this).addClass("active");

        var titre = $(this).find('.links_name').text();
        if(titre =="Acceuil"){
            $('.text_header').empty().append(titre);
        }else if(titre == "Employés"){
            $('.text_header').empty().append("Liste d'employés");
        }

        // $.post('/employe.liste',{titre:titre},function(data){
        //     $('.contenu').empty().append(data);
        // });

    });
    

    // affiche_detail_pers();

    // function affiche_detail_pers() {
    //     $('.btn_racourcis').on('click',function(){
    //         var titre = $(this).find('.text_racourcis').text();
    //         $('.btn_racourcis').removeClass('active');
    //         if ($('.'+titre).data('clicked',true)) {
    //             $(this).addClass('active');
    //         } else {
    //             $(this).removeClass('active');
    //         }
    //         $('.text_header').empty().append(titre);
    //         $.post('/employe',{titre:titre},function(data){
    //             $('#emploies_details').hide();
    //             $('.contenu').empty().append(data);
    //         });
    //     });
    // }

    // $('.detail_employes').on('click',function(){
    //     var employer_id = $(this).attr('id');
    //     var titre = "Dossiers";
    //     $.post('/employe',{titre:titre,employer_id:employer_id},function(data){
    //         $('#emploies_details').hide();
    //         $('.contenu').empty().append(data);
    //     });
    // });


});


