<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Personnel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/styleGeneral.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/configAll.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/styleGeneral.css')}}">
    <link rel="shortcut icon" href="{{asset('img/logos_all/iconPersonel.webp') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/css/configAll.css')}}">

    <style>
        .modal-backdrop{
            z-index: 1 !important;
        }
    </style>

<!-- @stack('extra-links') -->

</head>
<body>
    @if ($message = Session::get('creation_inter_error'))
        <div class="modal" tabindex="-1">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger ms-2 me-2">
                        <ul>
                            <li>{{ $message }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
        </div>
    @endif

    @include('layouts.sidebar.sidebar')

    <div class="home_content">
        <div class="container-fluid p-0 height-100 bg-light" id="content">
            @include('layouts.navbar.navbar')
            {{-- header --}}
            {{-- content --}}
            <div class="container-fluid content_body px-0 " style="padding-bottom: 1rem; padding-top: 4.5rem;">
                <div class="container-fluid">
                    <div class="row m-2 p-2">
                        @yield('content')
                    </div>
                </div>
            </div>

        </div>
        {{-- footer --}}
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.2/umd/popper.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/colreorder/1.5.6/js/dataTables.colReorder.min.js"></script> --}}
    <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/scroller/2.0.7/js/dataTables.scroller.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{asset('assets/jqueryui/jquery.validate.js')}}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="{{asset('js/admin.js')}}"></script>
    <script type="text/javascript">
        //Pour chaque div de classe randomColor
        $(".randomColor").each(function() {
        //On change la couleur de f ond au hasard
            $(this).css("background-color", '#'+(Math.random()*0xFFFFFF<<0).toString(16).slice(-6));
        });

        toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
        $('.module_redirect').on('click', function (e) {
            localStorage.setItem('ActiveTabMod', '#publies');
        });





        $('.prevent_affichage').on('click', function(e){
            e.stopPropagation();
        });

        $('.prevent_affichage2').on('click', function(e){
            e.stopPropagation();
        });


    $(".nav .nav_linke").on("click", function(e){
        localStorage.setItem('indiceSidebar', this);
        $('a.active').removeClass('active');
    });

    $(".btn_racourcis a").on("click", function(e){
        localStorage.setItem('indiceSidebar', this);
        $('a.active').removeClass('active');
    });

    $("a.vous").on("click", function(e){
        localStorage.setItem('indiceSidebar', 'vous');
    });

    $("a.teste").on("click", function(e){
        localStorage.setItem('indiceSidebar', $(".nav").find("#accueil").get()[0].href);
    });

    $(".btn_creer li").on("click", function(e){
        if(''==this.id)localStorage.removeItem('indiceSidebar');
        else if (!$(".nav").find("."+this.id)) {
            localStorage.removeItem('indiceSidebar');
        }
        else if (this.id=="parametre") {
            localStorage.setItem('indiceSidebar', 'parametre');
        }
        else if($(".btn_racourcis").find("."+this.id).get()[0]){
            localStorage.setItem('indiceSidebar', $(".btn_racourcis").find("."+this.id).get()[0].href);
        }
        else if($(".nav").find("."+this.id).get()[0]){
            localStorage.setItem('indiceSidebar', $(".nav").find("."+this.id).get()[0].href);
        }
        else localStorage.removeItem('indiceSidebar');
    });

    $(".deconnexion").on("click", function(e){
        localStorage.clear();
    });

    if(!(localStorage.getItem('indiceSidebar')))localStorage.setItem('indiceSidebar', document.getElementById("accueil").href);

    let Tabactive = localStorage.getItem('indiceSidebar');
    if(Tabactive=="parametre")$('.btn_creer.parametre').addClass('active');
    else if(Tabactive=="vous")$('.btn_vous ').addClass('active');
    else if(Tabactive){
        ($('.nav_list a[href="' + Tabactive + '"]').closest('a')).addClass('active');
        ($('.btn_racourcis a[href="' + Tabactive + '"]').closest('div')).addClass('active');
    }
</script>

@stack('extra-js')

</body>

</html>
