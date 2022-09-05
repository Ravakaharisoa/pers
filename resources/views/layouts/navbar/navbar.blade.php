@include('sweetalert::alert')

<header class="header row align-items-center g-0" id="header">
    <div class="col-3 d-flex flex-row padding_logo">
        <span><img src="{{ asset('img/logos_all/iconPersonel.webp') }}" alt=""
                class="img-fluid menu_logo me-3"></span>
        @yield('title')
    </div>
    <div class="col-5 align-items-center justify-content-start d-flex flex-row ">
        <div class="row">
            <div class="searchBoxMod d-flex flex-row py-2">
                <div class="btn_racourcis me-4 ">
                    <a href="{{ route('detail_employe') }}" id="Informations" class="text-center" role="button">
                        <span class="d-flex flex-column">
                            <i class='bx bxs-user-detail mb-2 mt-1'></i>
                            <span class="text_racourcis">Informations</span>
                        </span>
                    </a>
                </div>
                <div class="btn_racourcis me-4">
                    <a href="{{ route('details_emploi') }}" id="Emploi" class="text-center" role="button">
                        <span class="d-flex flex-column">
                            <i class='bx bx-briefcase-alt-2 mb-2 mt-1'></i>
                            <span class="text_racourcis">Emploi</span>
                        </span>
                    </a>
                </div>
                @canany(['isReferent','isManager'])
                <div class="btn_racourcis me-4">
                    <a href="{{ route('details_salaire') }}" id="Salaire" class="text-center" role="button">
                        <span class="d-flex flex-column">
                            <i class='bx bx-money mb-2 mt-1'></i>
                            <span class="text_racourcis">Salaire</span>
                        </span>
                    </a>
                </div>
                @endcanany
                <div class="btn_racourcis me-4">

                    <a href="{{ route('details_sanctions') }}" id="Sanction" class="text-center" role="button">

                        <span class="d-flex flex-column">
                            <i class='bx bx-line-chart mb-2 mt-1'></i>
                            <span class="text_racourcis">Sanction</span>
                        </span>
                    </a>
                </div>

                <div class="btn_racourcis me-4">

                    <a href="{{route('details_dossiers')}}" id="Sanction" class="text-center" role="button">

                        <span class="d-flex flex-column">
                            <i class='bx bxs-folder-open mb-2 mt-1'></i>
                            <span class="text_racourcis">Dossiers</span>
                        </span>
                    </a>
                </div>


            </div>
        </div>
    </div>

    <div class="col-4 header-right align-items-end d-flex flex-row">
        <div class="col-4 d-flex flex-row justify-content-center apprendCreer pb-3">

        </div>
        <div class="col-8">
            <div class="row justify-content-end">
                <div class="col-12 text-end icones_header">
                    @can("isReferent")
                    <a class="dropdown-toggle p-1" id="menu_parametre" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bx-cog icon_creer_admin'></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="menu_parametre">
                        {{-- <li><a class="dropdown-item" href="#">Nouveau statut d'emploi</a></li>
                        <li><a class="dropdown-item" href="#">Nouvelle catégorie d'emploi</a></li>
                        <li><a class="dropdown-item" href="#">Nouvelle saction</a></li> --}}
                        <li><a class="dropdown-item" href="#" data-bs-toggle='modal'
                                data-bs-target='#Prime-modal'>Prime et Indemnité</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle='modal'
                                data-bs-target='#Av-nat-modal'>Avantage en nature</a></li>
                    </ul>

                    <!-- Modal Prime et Indemnité -->
                    <div class="modal text-secondary" id="Prime-modal" data-bs-backdrop="static" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="border-radius: 30%;">
                        <div class="modal-dialog modal-md modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel">
                                        Prime et indemnité
                                    </h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('add_prime') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="text" name="d_prime_et_indemnite"
                                            class="form-control
                                        input_form border-bottom p-0 pb-2"
                                            placeholder="désignation" required>
                                        <div class="modal-footer">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn text-white ms-2"
                                                    style="background:#16B84E;">Enregistrer</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Fin modal prime et indemnité -->

                    <!-- Modal Avantage en nature -->
                    <div class="modal text-secondary" id="Av-nat-modal" data-bs-backdrop="static" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="border-radius: 30%;">
                        <div class="modal-dialog modal-md modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel">
                                        Avantage en nature
                                    </h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('add_av_nat') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="text" name="d_avantage_en_nature"
                                            class="form-control
                                        input_form border-bottom p-0 pb-2"
                                            placeholder="désignation" required>
                                        <div class="modal-footer">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn text-white ms-2"
                                                    style="background:#16B84E;">Enregistrer</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endcan
                    <!-- Fin modal Avantage en nature -->

                    <a class="dropdown-toggle p-1" id="dropdownMenuSuite" data-bs-toggle="dropdown"
                        aria-expanded="false" aria-haspopup="true"><i
                            class='bx bx-grid-alt bx-burst-hover icon_creer_admin'></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuSuite">
                        <div class="card card_suite">
                            <div class="card-body py-3">
                                <div class="row">
                                    <div class="col-4 logo_suite">
                                        <a href=""
                                            class="text-center justify-content-center d-flex flex-column"><i
                                                class='bx bxs-user-circle icone_compte '></i><span
                                                class="mt-1">compte</span></a>

                                    </div>
                                    <div class="col-4 px-0 logo_suite">
                                        <a href="#"
                                            class="text-center justify-content-center d-flex flex-column"><img
                                                src="{{ asset('img/logos_all/iconFormation.webp') }}"
                                                alt="logo formation" width="35px" height="35px"
                                                class="img-responsive mb-2"><span>formation</span></a>
                                    </div>
                                    <div class="col-4 px-0 logo_suite">
                                        <a href="#"
                                            class="text-center justify-content-center d-flex flex-column"><img
                                                src="{{ asset('img/logos_all/iconPaie.webp') }}" alt="logo formation"
                                                width="35px" height="35px"
                                                class="img-responsive mb-2"><span>paie</span></a>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-4 px-0 logo_suite">
                                        <a href="#"
                                            class="text-center justify-content-center d-flex flex-column"><img
                                                src="{{ asset('img/logos_all/iconConge.webp') }}" alt="logo formation"
                                                width="35px" height="35px"
                                                class="img-responsive mb-2"><span>congé</span></a>
                                    </div>
                                    <div class="col-4 px-0 logo_suite">
                                        <a href="#"
                                            class="text-center justify-content-center d-flex flex-column"><img
                                                src="{{ asset('img/logos_all/iconPersonel.webp') }}"
                                                alt="logo formation" width="35px" height="35px"
                                                class="img-responsive mb-2"><span>personel</span></a>
                                    </div>
                                    <div class="col-4 px-0 logo_suite">
                                        <a href="http://127.0.0.1:8001/" target="_blank"
                                            class="text-center justify-content-center d-flex flex-column"><img
                                                src="{{ asset('img/logos_all/iconRecrutement.webp') }}"
                                                alt="logo formation" width="35px" height="35px"
                                                class="img-responsive mb-2"><span>recrutement</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="dropdown-toggle p-1" id="dropdownMenuProfil" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <i  class='bx bx-user-circle icon_creer_admin'></i>
                    </a>
                    <div class="dropdown-menu p-0" aria-labelledby="dropdownMenuProfil">
                        <div class="card card_profile pt-3">
                            <div class="card-title">
                                <div class="row px-3 mt-2">
                                    <div class="col-7">
                                        <span class="titre_card_profil"><img src="{{asset('img/logos_all/iconPersonel.webp')}}" alt="logo_mini" title="logo personnels.mg" width="30px" height="30px">Personnels.mg</span>
                                    </div>
                                    <div class="col-5 text-center">
                                        <div class="logout">
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></a>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class=" text-center">Se Déconnecter</a>
                                            <form action="{{ route('logout') }}" id="logout-form" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="row ps-4">
                                    <div class="col-2 ps-4">
                                        <span>
                                            <div style="display: grid; place-content: center">
                                                <div class='randomColor photo_users' style="color:white; font-size: 20px; border: none; border-radius: 100%; height: 65px; width: 65px ; display: grid; place-content: center">
                                                </div>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="col-10 ps-4">
                                        <h6 class="mb-0 ">{{Auth::user()->name}}</h6>
                                        <h6 class="mb-0 text-muted text_mail">{{Auth::user()->email}}</h6>
                                        <p id="nom_etp" class="mt-2"></p>
                                    </div>
                                </div>
                                <div class="row role_liste mt-2">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" value="{{Auth::user()->id}}" id="id_user" hidden>
                                                <span class="text-muted p-0 test_font">Connécté En Tant Que :</span>
                                            </div>
                                            <div class="col p-0">
                                                <ul id="liste_role" class="d-flex flex-column"></ul>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="d-flex flex-row py-0 justify-content-center">
                                                <a href="{{url('politique_confidentialite')}}" target="_blank">
                                                    <p class="m-0 test_font2">Politique De Confidentialité</p>
                                                </a>
                                                &nbsp;-&nbsp;
                                                <a href="{{route('condition_generale_de_vente')}}" target="_blank">
                                                    <p class="m-0 test_font2">Conditions d'utilisation</p>
                                                </a>
                                            </div>
                                            <div class="d-flex flex-row py-0 justify-content-center">
                                                <a href="{{url('contacts')}}" target="_blank">
                                                    <p class="m-0 test_font2">Contactez-nous</p>
                                                </a>
                                                &nbsp;-&nbsp;
                                                <a href="{{url('info_legale')}}" target="_blank">
                                                    <p class="m-0 test_font2">Information Légales</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</header>
