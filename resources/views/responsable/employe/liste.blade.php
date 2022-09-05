@extends('layouts.master_page')
@section('title')
<p class="text_header">employés</p>
@endsection
@section('content')

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>

<link rel="stylesheet" href="{{asset('assets/css/liste_employe.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/inputControlAccueilIndex.css')}}">

<style type="text/css">

    table tbody #table-emp {
        cursor : pointer;
    }

    button,
    value {
        font-size: 30px;
    }

    .font_text strong,
    .font_text li,
    .font_text h3,
    .font_text h4,
    .font_text p {
        font-size: 12px;
    }

    .font_text h5,
    .font_text h6 {
        font-size: 10px;
    }

    .form_colab input {
        height: 30px;
        border: none;
        text-align: center
    }

    .form_colab input:focus {
        border: none;
        outline: none;
        box-shadow: none;
    }

    .form_colab span {
        height: 30px;
    }

    .form_colab input::placeholder {
        font-size: 12px
    }

    /* .form_colab button {
        height: 30px;
        padding: 0;
        padding-left: 5px;
        padding-right: 5px;
        font-size: 13px;
    } */

    .nav_bar_list:hover {
        background-color: transparent;
    }

    .nav_bar_list .nav-item:hover {
        border-bottom: 2px solid black;
    }

    h6,
    p {
        font-size: 80%;
    }

    .navigation_module .nav-link {
        color: #637381;
        padding: 5px;
        cursor: pointer;
        font-size: 0.900rem;
        transition: all 200ms;
        margin-right: 1rem;
        text-transform: uppercase;
        padding-top: 10px;
        border: none;
    }

    .nav-item .nav-link.active {
        border-bottom: 3px solid #7635dc !important;
        border: none;
        color: #7635dc
    }

    .nav-tabs .nav-link:hover {
        background-color: rgb(245, 243, 243);
        transform: scale(1.1);
        border: none;
    }

    .nav-tabs .nav-item a {
        text-decoration: none;
        text-decoration-line: none;
    }

    td {
        padding: 0 !important;
        height: 30px !important;
    }

</style>
<?php
    $nbStg=30;
?>
    <div class="" role="tabpanel">

        <ul class="nav nav-tabs navigation_module" id="mytab">
           <li class="nav-item">
                <a href="#all" class="nav-link" data-toggle="tab">Tous</a>
            </li>
           <li class="nav-item">
                <a href="#nouveau_employe" class="nav-link" data-toggle="tab">Nouveau Employé</a>
            </li>
            <li class="nav-item">
                <a href="#importer_employer" class="nav-link" data-toggle="tab">Importer Employé</a>
            </li>
            <li class="nav-item">
                <a href="#demissionner" class="nav-link" data-toggle="tab">Démissionnée(s)</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane show fade active px-3" id="all">
                <div class="row mt-2 text-end">
                    <div class="col-md-11"></div>
                    <div class="col-md-1 d-flex justify-content-between" >
                        <a class="btn btn-light text-secondary me-3" href="#" id="employer_liste"><i class='bx bx-list-ul bx-sm'></i></a>
                        <a class="btn btn-light text-secondary" href="#" id="employer_grille"><i class='bx bx-grid-alt bx-sm'></i></a>
                    </div>
                </div>
                <div class="container_employers">
                    <div class="col-md-12 my-3">
                        <div class="fixedTop pt-2">
                            <table class="table table-hover text-secondary w-100 " id="liste_employes" style="font-size: .8rem;">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 5%;" class="table-head font-weight-light align-middle">ID</th>
                                        <th style="width: 2%;"></th>
                                        <th style="width: 28%;" scope="col" class="table-head font-weight-light align-middle">Employé</th>
                                        <th style="width: 25%;" scope="col" class="table-head font-weight-light align-middle">Contacts</th>
                                        <th style="width: 20%;" scope="col" class="table-head font-weight-light align-middle"><span class="d-block">Département</span><span>Service</span></th>
                                        <th style="width: 5%;" scope="col" class="table-head font-weight-light align-middle ">Status</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach ($employers as $employer)
                                        <tr href="{{ route('detail.employe', $employer->id) }}" id="table-emp">
                                            <td>
                                                {{$employer->matricule}}
                                            </td>
                                            <td>
                                                @if ($employer->photos)
                                                    <img src="{{ asset('images/employes/'.$employer->photos) }}" alt="" style="width: 45px; height: 45px;" class="rounded-circle empNew">
                                                @else
                                                    <img src="{{asset('images/formateurs/homme.png')}}" alt="image employe" class="mb-2" style="width: 45px; height: 45px;border-radius:100%;">

                                                @endif
                                            </td>
                                            <td>
                                                <span>{{$employer->nom_stagiaire}} {{$employer->prenom_stagiaire}}</span>
                                                <span class="text-secondary d-block">
                                                    @if ($employer->fonction_stagiaire)
                                                        {{ $employer->fonction_stagiaire }}
                                                    @else
                                                        ----
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <span>{{$employer->mail_stagiaire}}</span>
                                                <span class="text-secondary d-block">
                                                    @if ($employer->telephone_stagiaire)
                                                        {{ $employer->telephone_stagiaire }}
                                                    @else
                                                        ----
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                @if ($employer->nom_departement && $employer->nom_service)
                                                    <span class="text-secondary">
                                                        @if ($employer->nom_departement)
                                                            {{ $employer->nom_departement }}
                                                         @endif
                                                    </span>
                                                    <span class="text-secondary d-block">
                                                        @if ($employer->nom_service)
                                                            {{ $employer->nom_service }}
                                                        @endif
                                                    </span>
                                                @else
                                                    <span>Non catégorie</span>
                                                @endif
                                            </td>
                                            <td class="text-white text-center">
                                                @if ($employer->activiter == 1)
                                                    <span style="border-radius:100%;color: #16B84E;font-size:.5rem;"><i class='bx bxs-circle'></i></span>
                                                @else
                                                    <span style="border-radius:100%;color:rgb(188, 192, 189);font-size:.5rem;"><i class='bx bxs-circle'></i></span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane show fade" id="nouveau_employe">
                {{-- @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif --}}
                <form id="formInsertEmployer" method="post" action="{{route('employeur.store')}}" enctype="multipart/form-data"  autocomplete="off">

                    @csrf
                    <div class="row mt-4">
                        <div class="col-md-4  text-end">
                            <label class="mt-2">Matricule<strong style="color:#ff0000;">*</strong></label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text"  name="matricule_emp" class="form-control input w-50" id="matricule_emp" placeholder="Matricule" />
                                <span id="matriculeError" class="error" style="color:#ff0000;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-md-4 text-end">
                            <label for="nom" class="mt-2">Nom<strong style="color:#ff0000;">*</strong></label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" name="nom_emp" class="form-control input w-50" id="nom_emp" required placeholder="Nom" />
                                <span id="nomError" class="error" style="color:#ff0000;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-md-4 text-end">
                            <label for="prenom" class="mt-2">Prénom</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" name="prenom_emp" class="form-control input w-50" id="prenom_emp" required placeholder="Prénom" />
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-md-4 text-end">
                            <label for="cin" class="mt-2">CIN<strong style="color:#ff0000;">*</strong></label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" name="cin_emp" class="form-control input w-50" id="cin_emp" required placeholder="Carte d'Identité Nationale" />
                                <span id="cinError" class="error" style="color:#ff0000;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-md-4 text-end">
                            <label for="phone" class="mt-2">Téléphone<strong style="color:#ff0000;">*</strong></label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" min=6  name="telephone_emp" class="form-control input w-50" id="telephone_emp" required placeholder="Télephone" />
                                <span id="phoneError" class="error" style="color:#ff0000;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-md-4 text-end">
                            <label for="mail" class="mt-2">Email<strong style="color:#ff0000;">*</strong></label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="email"  name="email_emp" class="form-control input w-50" id="email_emp" required placeholder="E-mail" />
                                <span id="emailError" class="error" style="color:#ff0000;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-md-4 text-end">
                            <label for="fonction" class="mt-2">Fonction<strong style="color:#ff0000;">*</strong></label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <select name="fonction_emp" class="form-control input w-50" id="fonction_emp" required>
                                    <option selected>--- Séléctionner ---</option>
                                    @foreach ($fonctions as $fonction)
                                        <option value="{{ $fonction->id }}">{{ $fonction->nom_fonction }}</option>
                                    @endforeach
                                </select>
                               <span id="fonctionError" class="error" style="color:#ff0000;"></span>
                            </div>
                        </div>
                    </div>

                    <div class=" text-center mt-3">
                        <button type="submit" class="btn btn-lg btn_enregistrer" id="saver_stg"><i class="bx bx-check me-1"></i> Enregistrer</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane show fade" id="importer_employer">
                <div class="row mt-1 justify-content-center  export_excel" align="center">
                    <div class="col text-muted text-align-center pt-2">
                        <h6>Comment ajouter plusieurs stagiaires d'une seule coup?</h6>
                        <p>Tout d'abord, vous devrez avoir un fichier excel des listes des stagiaires avec des exception comportant seulement ses colonnes requis pour les informations minimum:</p>
                        <p>1°):<span> Maximum {{ $nbStg }} personne(s) </span></p>
                        <p>2°):Les champs neccéssaire: <span> "Matricule" , "Nom", "Prénom", "CIN", "email"</span></p>
                        <p>3°): Faire <span>copier coller </span> les données en sélectionnants la prémière ligne "Matricule N°1" ou utiliser la racourcie CRTL+A et CRTL+C (pour copier) et CRTL+V pour coller</p>
                    </div>
                    {{-- <div class="col-md-4"></div> --}}
                </div>

                <div class="row mt-2 justify-content-center">

                    <div class="col jusitfy-content-center">
                        <form name="formInsert" id="formInsert" action="{{route('save_multi_stagiaire_exproter_excel')}}" method="POST" enctype="multipart/form-data" class="form_insert_formateur form_colab  needs-validation" novalidate>
                            @csrf
                            @if(Session::has('success'))
                            <div class="alert alert-success">
                                <strong>{{Session::get('success')}}</strong>
                            </div>

                            @endif
                            @if(Session::has('error'))
                            <div class="alert alert-danger">
                                {{Session::get('error')}}
                            </div>
                            @endif

                            <div class="form-group mb-2" align="center">
                                <button type="submit" class="btn btn_creer" id="saver_multi_stg">sauvegarder</button>
                            </div>

                            <table id="example" class="table table-bordered">
                                <thead style="background-color: #6e717339">
                                    <tr align="center">
                                        <th>Matricule <span style="color: red">*</span> </th>
                                        <th>Nom <span style="color: red">*</span> </th>
                                        <th>Prénom</th>
                                        <th>CIN <span style="color: red">*</span> </th>
                                        <th>E-mail <span style="color: red">*</span> </th>
                                    </tr>
                                </thead>
                                <tbody id="newRowMontant">

                                    @for($i = 1; $i <= $nbStg; $i++) <tr align="center">
                                        <td>
                                            <input  autocomplete="off" class="form-control mx-0 " id="matricule_{{$i}}" type="text" name="matricule_[]">
                                            <p class="m-0" style="color: red" name="matricule_err_[]" id="matricule_err_[]"></p>
                                        </td>
                                        <td>
                                            <input autocomplete="off" class="form-control" id="nom_" type="text" name="nom_[]" required>
                                            <p class="m-0" style="color: red" name="nom_err_[]" id="nom_err_[]"></p>
                                        </td>
                                        <td>
                                            <input autocomplete="off" class="form-control" id="inlineFormInput" type="text" name="prenom_[]">
                                        </td>
                                        <td>
                                            <input autocomplete="off" class="form-control" id="cin_[]" type="text" name="cin_[]" required>
                                            <p class="m-0" style="color: red" name="cin_err_[]" id="cin_err_[]"></p>
                                        </td>
                                        <td>
                                            <input autocomplete="off" class="form-control" type="email" id="email_{{$i}}" name="email_[]" required>
                                            <p class="m-0" name="email_err_[]" style="color: red" id="email_err_[]"></p>
                                        </td>
                                        </tr>
                                        @endfor

                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
           </div>
           <div class="tab-pane show fade" id="demissionner">
                <div class="container_employer">
                    <div class="col-md-12 my-3">
                        <div class="fixedTop pt-2">
                            @if (count($employer_demissions) >0)
                            <table class="table table-hover text-secondary w-100 " id="liste_employes" style="font-size: .8rem;">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 5%;" class="table-head font-weight-light align-middle">ID</th>
                                        <th style="width: 2%;"></th>
                                        <th style="width: 28%;" scope="col" class="table-head font-weight-light align-middle">Employé</th>
                                        <th style="width: 23%;" scope="col" class="table-head font-weight-light align-middle">Contacts</th>
                                        <th style="width: 20%;" scope="col" class="table-head font-weight-light align-middle"><span class="d-block">Département</span><span>Service</span></th>
                                        <th style="width: 5%;" scope="col" class="table-head font-weight-light align-middle text-center ">Status</th>
                                        <th style="width:7%;" scope="col" class="table-head font-weight-light align-middle ">Date de démission</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach ($employer_demissions as$demission)
                                        <tr>
                                            <td>
                                                {{$demission->matricule}}
                                            </td>
                                            <td>
                                                @if ($demission->photos)
                                                    <img src="{{ asset('images/employes/'.$demission->photos) }}" alt="" style="width: 45px; height: 45px;" class="rounded-circle empNew">
                                                @else
                                                    <img src="{{asset('images/formateurs/homme.png')}}" alt="image employe" class="mb-2" style="width: 45px; height: 45px;border-radius:100%;">

                                                @endif
                                            </td>
                                            <td>
                                                <span>{{$demission->nom_stagiaire}} {{$demission->prenom_stagiaire}}</span>
                                                <span class="text-secondary d-block">
                                                    @if ($demission->fonction_stagiaire)
                                                        {{ $demission->fonction_stagiaire }}
                                                    @else
                                                        ----
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <span>{{$demission->mail_stagiaire}}</span>
                                                <span class="text-secondary d-block">
                                                    @if ($demission->telephone_stagiaire)
                                                        {{ $demission->telephone_stagiaire }}
                                                    @else
                                                        ----
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                @if ($demission->nom_departement && $demission->nom_service)
                                                    <span class="text-secondary">
                                                        @if ($demission->nom_departement)
                                                            {{ $demission->nom_departement }}
                                                        @endif
                                                    </span>
                                                    <span class="text-secondary d-block">
                                                        @if ($demission->nom_service)
                                                            {{ $demission->nom_service }}
                                                        @endif
                                                    </span>
                                                @else
                                                    <span>Non catégorie</span>
                                                @endif
                                            </td>
                                            <td class="text-white text-center">
                                                @if ($demission->activiter == 1)
                                                    <span style="border-radius:100%;color: #16B84E;font-size:.5rem;"><i class='bx bxs-circle'></i></span>
                                                @else
                                                    <span style="border-radius:100%;color:rgb(188, 192, 189);font-size:.5rem;"><i class='bx bxs-circle'></i></span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="text-secondary">
                                                    {{ \Carbon\Carbon::parse($demission->date_demission)->translatedFormat("l j F Y") }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
           </div>
       </div>
    </div>
    <script>
        // LocalStorage
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            let lien = ($(e.target).attr('href'));
            localStorage.setItem('indiceEmp', lien);
        });
        let tabActive = localStorage.getItem('indiceEmp');
        if (tabActive)   {
            $('#mytab a[href="' + tabActive + '"]').tab('show');
            $('#mytab a[href="' + tabActive + '"]').addClass('active');
        }
        // LocalStorage

        $(document).ready(function(){
            $('table #table-emp').on('click', function(){
                window.location = $(this).attr('href');
                return false;
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // $('#formInsertEmployer').on('submit',function(e){
            //     e.preventDefault();

            //     $('#matriculeError').text('');
            //     $('#nomError').text('');
            //     $('#cinError').text('');
            //     $('#phoneError').text('');
            //     $('#emailError').text('');
            //     $('#fonctionError').text('');

            //     var matricule_emp= $('#matricule_emp').val();
            //     var nom_emp= $('#nom_emp').val();
            //     var prenom_emp= $('#prenom_emp').val();
            //     var cin_emp= $('#cin_emp').val();
            //     var phone_emp= $('#phone_emp').val();
            //     var email_emp= $('#email_emp').val();
            //     var fonction_emp= $('#fonction_emp').val();

            //     $.ajax({
            //         url:"{{route('employeur.store')}}",
            //         type:"post",
            //         dataType:"json",
            //         data:{
            //             matricule_emp:matricule_emp,
            //             nom_emp:nom_emp,
            //             prenom_emp:prenom_emp,
            //             cin_emp:cin_emp,
            //             phone_emp:phone_emp,
            //             email_emp:email_emp,
            //             fonction_emp:fonction_emp
            //         },
            //         success:function(response){
            //             console.log(response['success']);
            //         },
            //         error: function(response) {
            //             console.log(response);
            //             // $('#matriculeError').text(response.responseJSON.errors.matricule_emp);
            //             // $('#nomError').text(response.responseJSON.errors.nom_emp);
            //             // $('#cinError').text(response.responseJSON.errors.cin_emp);
            //             // $('#phoneError').text(response.responseJSON.errors.phone_emp);
            //             // $('#emailError').text(response.responseJSON.errors.email_emp);
            //             // $('#fonctionError').text(response.responseJSON.errors.fonction_emp);
            //         }
            //     });

            // });

            listeEmployers();
            function listeEmployers(){
                $('#liste_employes').DataTable({
                    processing: true,
                    language: {
                        url :'/assets/json/french.json'
                    },
                });
            }

            $('#employer_liste').on('click',function() {
                $.get("/liste_employer_list",function(data){
                    $('.container_employers').empty().append(data);
                    afficheDepartement();
                    afficheBranche();
                });
            });
            $('#employer_grille').on('click',function() {
                $.get("/liste_employer_grille",function(data){
                    $('.container_employers').empty().append(data);
                    afficheDepartement();
                    afficheBranche();
                });
            });
            afficheDepartement();
            function afficheDepartement(){
                $('#departement').on('change',function(){
                    var dept_id = $(this).val();
                    $.get("/recherche_departement/"+dept_id,function(data){
                        $('.container_employers').empty().append(data);
                    });

                });
            }
            afficheBranche();
            function afficheBranche() {
                $('#branche').on('change',function(){
                    var branche_id = $(this).val();
                    $.get("/recherche_branche/"+branche_id,function(data){
                        $('.container_employers').empty().append(data);
                    });

                });
            }
            afficheRechercheNom();
            function afficheRechercheNom() {
                $('#recherche_lettre').on('click',function(e){
                    // var valeur = $(this).val();
                    alert($(this).val());
                });
            }

            $('td input').bind('paste', null, function(e) {
                $txt = $(this);
                setTimeout(function() {

                    var values = $txt.val().split(/\s+/);
                    // var values = $txt.val().split(/\t+/);
                    var currentRowIndex = $txt.parent().parent().index();
                    var currentColIndex = $txt.parent().index();

                    var totalRows = $('#example tbody tr').length;
                    var totalCols = $('#example thead th').length;

                    var count = 0;

                    for (var j = currentRowIndex; j < totalRows; j++) {
                        for (var i = currentColIndex; i < totalCols; i++) {

                            var value = values[count];

                            var inp = $('#example tbody tr').eq(j).find('td').eq(i).find('input');

                            count += 1;
                            inp.val(value);
                        }
                    }
                }, 0);
            });

            function verifyDuplicate(table, error) {
                var arryTab = [];
                var test = 0;
                for (var i = 0; i < table.length; i += 1) {
                    if (table[i].value != null && table[i].value != "" && table[i].value.length > 0) {
                        arryTab[i] = table[i].value;
                        test += 1;
                    }
                }
                for (var i = 0; i < arryTab.length; i += 1) {
                    for (var j = i + 1; j < arryTab.length; j += 1) {
                        if (arryTab[i] == arryTab[j] && arryTab[j] != null && arryTab[i] != null) {
                            error[i].innerHTML = "donnée dupliqué";
                            error[j].innerHTML = "donnée dupliqué";
                            $('#saver_multi_stg').prop('disabled', true);
                        }
                    }
                }
            }


            function verify_email(mail_val) {
                var str = mail_val.split('');
                var result = false;
                for (var i = 0; i < str.length; i += 1) {
                    if (str[i] == '@') {
                        result = true;

                    } else {
                        result = false;
                    }
                }
                return result;
            }


            $(function() {
                $("input[name='cin_[]']").on('input', function(e) {
                    $(this).val($(this).val().replace(/[^0-9]/g, ''));
                });
            });

            $('#saver_multi_stg').prop('disabled', true);
            $('#formInsert input').keyup(function() {
                $('#saver_multi_stg').prop('disabled', false);

                var nom_err = document.getElementsByName("nom_err_[]");
                var matricule_err = document.getElementsByName("matricule_err_[]");
                var email_err = document.getElementsByName("email_err_[]");
                var cin_err = document.getElementsByName("cin_err_[]");

                var nom = document.getElementsByName("nom_[]");
                var matricule = document.getElementsByName("matricule_[]");
                var email = document.getElementsByName("email_[]");
                var cin = document.getElementsByName("cin_[]");

                for (let i = 0; i < matricule.length; i += 1) {
                    var matricule_val = matricule[i].value;


                    if (matricule[i].value != null) {

                        if (matricule[i].value != "" && matricule[i].value.length < 1 && email[i].value != "") {
                            matricule_err[i].innerHTML = 'matricule invalid';
                        } else {
                            matricule_err[i].innerHTML = '';
                            verifyDuplicate(matricule, matricule_err);
                        }


                        $.ajax({
                            url: "{{route('employes.export.verify_matricule_stg')}}"
                            , type: 'get'
                            , data: {
                                valiny: matricule_val
                            }
                            , success: function(response) {
                                var userData = response;
                                if (userData.length > 0) {
                                    matricule_err[i].innerHTML = 'matricule existe déjà';
                                    $('#saver_multi_stg').prop('disabled', true);
                                }
                            }
                            , error: function(error) {
                                console.log(error);
                            }
                        });

                        /*==============*/
                        if (matricule[i].value.length > 0) {
                            if (matricule[i].value != null && matricule[i].value != "") {
                                if (nom[i].value.length < 1) {
                                    nom_err[i].innerHTML = 'Nom ne doit pas être null';
                                    $('#saver_multi_stg').prop('disabled', true);
                                }
                            }
                        } else {
                            nom_err[i].innerHTML = '';

                        }

                        /*=============*/
                        if (email[i].value != null) {
                            var email_val = email[i].value;
                            if (matricule[i].value.length > 0) {
                                if (matricule[i].value != null && matricule[i].value != "") {
                                    if (email[i].value.indexOf('@') == -1) {
                                        email_err[i].innerHTML = 'E-mail invalid';
                                        $('#saver_multi_stg').prop('disabled', true);
                                    } else {
                                        email_err[i].innerHTML = '';
                                        verifyDuplicate(email, email_err);
                                    }
                                }
                            } else {
                                email_err[i].innerHTML = '';

                            }

                            $.ajax({
                                url: "{{route('employes.export.verify_email_stg')}}"
                                , type: 'get'
                                , data: {
                                    valiny: email_val
                                }
                                , success: function(response) {
                                    var userData = response;
                                    if (userData.length > 0) {
                                        email_err[i].innerHTML = 'E-mail existe déjà';
                                        $('#saver_multi_stg').prop('disabled', true);
                                    }
                                }
                                , error: function(error) {
                                    console.log(error);
                                }
                            });

                        }
                        /*=============*/
                        if (cin[i].value != null) {
                            var cin_val = cin[i].value;
                            if (matricule[i].value.length > 0) {
                                if (matricule[i].value != null && matricule[i].value != "") {
                                    if (cin[i].value.length < 5) {
                                        cin_err[i].innerHTML = 'CIN invalid';
                                        $('#saver_multi_stg').prop('disabled', true);
                                    } else {
                                        cin_err[i].innerHTML = '';
                                        verifyDuplicate(cin, cin_err);
                                    }
                                }
                            } else {
                                cin_err[i].innerHTML = '';
                            }

                            /*=== verify duplication ===========*/

                            $.ajax({
                                url: "{{route('employes.export.verify_cin_stg')}}"
                                , type: 'get'
                                , data: {
                                    valiny: cin[i].value
                                }
                                , success: function(response) {
                                    var userData = response;
                                    if (response.error != null) {
                                        cin_err[i].innerHTML = response.error;
                                        $('#saver_multi_stg').prop('disabled', true);
                                    }
                                    /*  if (userData.length > 0) {
                                        cin_err[i].innerHTML = "CIN existe déjà";
                                        $('#saver_multi_stg').prop('disabled', true);
                                    } */
                                }
                                , error: function(error) {
                                    console.log(error);
                                }
                            });

                        }
                    }



                }
            });
        });
    </script>
 @endsection
