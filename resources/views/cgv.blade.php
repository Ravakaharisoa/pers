

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    {{-- Lien font awesome icons --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{asset('../assets/css/smooth_page.css')}}">
    <link rel="stylesheet" href="{{ asset('maquette/style_maquette.css') }}">
    <script src="{{ asset('maquette/javascript.js') }}"></script>
    <link rel="shortcut icon" href="{{  asset('img/logos_all/iconPersonel.webp') }}" type="image/x-icon">
    <style>
        h6{
            text-align: justify;
        }
        .navperso{
            position: sticky;
            top: 5rem;
        }
    </style>
    <title> Personnel.mg </title>
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top text-secondary shadow-lg">
            <div class="container-fluid">
                <div class="left_menu ms-2">
                    <a style=" text-decoration: none;" href="{{ route('accueil_perso') }}">
                        <p class="titre_text m-0 p-0" style="color: black;">
                        <img class="img-fluid" src="{{ asset('img/logos_all/iconPersonel.webp') }}" width="40px" height="40px"> Personnel.mg</p>
                    </a>
                </div>
                <div class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-angle-down"></i>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-lg-0 text-secondary">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Fonctionnalit??s
                        </a>
                        <ul class="dropdown-menu shadow-lg" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item mt-2" href="{{url('moderne')}}" target="_blank"><i class="far fa-mouse-pointer center" style="color:rgb(107, 204, 148); padding: 8px 10px; border-radius: 100%; font-size: 13px; background-color: rgb(198,246,213); "></i> &nbsp; Moderne, flexible et s??curus??</a></li>
                            <li><a class="dropdown-item mt-2" href="{{url('gestiond')}}" target="_blank"><i class="fad fa-file-alt" style="color:rgb(70, 151, 150); padding: 8px 10px; border-radius: 100%; font-size: 13px; background-color: rgb(178,245,234); "></i> &nbsp; Gestion documentaire</a></li>
                            <li><a class="dropdown-item mt-2" href="{{url('gestionf')}}" target="_blank"><i class="fad fa-euro-sign" style="color:rgb(76,81,191); padding: 8px 11px; border-radius: 100%; font-size: 13px; background-color: rgb(195,218,254); "></i> &nbsp; Gestion financi??re</a></li>
                            <li><a class="dropdown-item mt-2" href="{{url('gestiona')}}" target="_blank"><i class="fad fa-calendar-check" style="color:rgb(186, 79, 141); padding: 8px 10px; border-radius: 100%; font-size: 13px; background-color: rgb(254,252,191); "></i>&nbsp; Gestion administrative</a></li>
                            <li><a class="dropdown-item mt-2" href="{{url('gestionc')}}" target="_blank"><i class="far fa-users" style="color:rgb(43,108,176); padding: 8px 7px; border-radius: 100%; font-size: 13px; background-color: rgb(190,227,248); "></i>&nbsp; Gestion commerciale</a></li>
                            <li><a class="dropdown-item mt-2" href="{{url('qualite')}}" target="_blank"><i class="fad fa-clipboard" style="color:rgb(192,86,33); padding: 8px 10px; border-radius: 100%; font-size: 13px; background-color: rgb(254,235,200); "></i>&nbsp;&nbsp; Qualit??</a></li>
                            <li><a class="dropdown-item mt-2" href="{{url('communication')}}" target="_blank"><i class="fad fa-comments-alt" style="color:rgb(200,58,58); padding: 8px 8px; border-radius: 100%; font-size: 13px; background-color: rgb(254,235,200); "></i>&nbsp;&nbsp;Communication</a></li>
                            <li><a class="dropdown-item mt-2" href="{{url('elearning')}}" target="_blank"><i class="fad fa-laptop" style="color:rgb(183,121,31); padding: 8px 7px; border-radius: 100%; font-size: 13px; background-color: rgb(254,252,191); "></i>&nbsp;&nbsp;E-learning</a></li>
                            <li><a class="dropdown-item mt-2" href="{{url('fonctionnalitea')}}" target="_blank"><i class="fad fa-search" style="color:rgb(100, 60, 194); padding: 8px 9px; border-radius: 100%; font-size: 13px; background-color: rgb(233,216,253); "></i>&nbsp;&nbsp;Fonctionnalit??s avanc??es</a></li>
                    </ul>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{url('tarifs')}}" target="_blank">Tarifs</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">?? propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('contact')}}"  target="_blank">Contactez-nous</a>
                    </li>
                </ul>
                <div class="d-flex" id="btn">
                        <li class="nav-item">
                            <a style="color:rgb(75, 75, 75); text-decoration: none" href="{{ route('sign-in') }}" >Se connecter </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" style="color:rgb(79, 79, 79);text-decoration: none; padding: 10px 5px; border: 1px solid #7535DC; border-radius: 35px; font-size: 13px;" >Voir une d??mo</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('create-compte')}}" style="color:white; text-decoration: none; padding: 10px 5px; border: 1px solid #7535DC; border-radius: 35px; font-size: 13px; background-color: #7b42d6; ">Cr??er un compte</a>
                        </li>
                </div>
                </div>
            </div>
        </nav>
        <div class="row col-12" style="margin-top: 70px;">
        <div class="col-3">
            <ul class="nav flex-column navperso ps-3" >
                <li class="nav-item">
                  <a class="nav-link text-dark" aria-current="page" href="#access">Acc??s aux Services</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark" href="#inscription">Inscription</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark" href="#usage">Usage strictement personnel, Comptes administrateurs et utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#duree">Dur??e de l???abonnement, d??sinscription</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-dark" href="#description">Description des Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#condition">Conditions financi??res</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link text-dark" href="#responsabilite">Responsabilit??s et garanties du Client
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#comportement">Comportements prohib??s</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#obligation">Obligations et responsabilit?? du Personnel.mg</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#propriete">Propri??t?? Intellectuelle
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#donnees">Donn??es ?? caract??re personnel</a>
                </li> --}}

            </ul>
        </div>
        <div class="col-8 mb-3">
            <span class="float-end">Derni??re mise ?? jour : le 27 Avril 2022 <hr class="my-2"></span><br>
            <div id = "access" class="mt-2"></div>
            <h1>Conditions g??n??rales de la plateforme </h1>
            <div>
                <h2>Acc??s aux Services</h2>
                1. Capacit?? juridique
                <h6>Les services sont accessibles ?? toute personne morale agissant par l???interm??diaire d???une personne physique disposant de
                    la capacit?? juridique pour contracter au nom et pour le compte de la personne morale.</h6>
                2. Services destin??s exclusivement aux professionnels.
                <h6>Les Services s???adressent exclusivement aux professionnels entendus comme toutes personnes physiques ou morales exer??ant une activit??
                    r??mun??r??e de fa??on non occasionnelle dans tous les secteurs li??s ?? la Paie ou ?? la gestion de comp??tences. </h6>
                3. Commande des Services et acceptation des conditions g??n??rales
                <h6 id="inscription" class="mt-3">La validation du devis par le client, toute commande de service ou toute souscription d???abonnement n??cessite son
                    inscription sur le site, et l???acceptation pleine et enti??re des dispositions des pr??sentes conditions g??n??rales.
                    Toute adh??sion sous r??serve est consid??r??e comme nulle et non avenue.</h6>
            </div>
            <div>
                <h2>Inscription</h2>
                <h6>1. L???acc??s aux services n??cessite que le client s???inscrive sur le site, lui-m??me ou par le biais d???un administrateur qu???il aura d??sign??,
                    en remplissant le formulaire pr??vu ?? cet effet.</h6>
                <h6>2. Le client, ou l???administrateur, doit fournir l???ensemble des inPaies marqu??es comme obligatoires, notamment son nom, pr??nom, adresse
                    email professionnel et mot de passe. Il reconna??t et accepte que l???adresse email renseign??e sur le formulaire d???inscription constitue son
                    identifiant de connexion.</h6>
                <h6>Toute inscription incompl??te ne sera pas valid??e. </h6>
                <h6>L???inscription entra??ne :</h6>
                <ul class="list-group ps-3">
                    <li>- l???ouverture d???un compte au nom du client , lui donnant acc??s ?? un espace personnel qui lui permet de g??rer son utilisation des services
                    sous une forme et selon les moyens techniques que UPSKILL SARL juge les plus appropri??s pour rendre lesdits services.</li>
                    <li>- la r??ception de tout mail envoy?? par l?????quipe de la plateforme, que ce soit ?? titre informatif ou publicitaire.</li>
                </ul>
                <h6>Le client garantit que toutes les inPaies qu???il donne dans le formulaire d???inscription sont exactes, ?? jour et sinc??res et
                    ne sont entach??es d???aucun caract??re trompeur.</h6>
                <h6>Il s???engage ?? mettre ?? jour ces inPaies dans son espace personnel en cas de modifications, afin qu???elles correspondent toujours aux crit??res
                    susvis??s.</h6>
                <h6 id="usage" class="mt-3"> Le client est inform?? et accepte que les inPaies saisies aux fins de cr??ation ou de mise ?? jour de son compte, par lui ou par
                     le biais de l???administrateur, vaillent preuve de son identit??. Les inPaies saisies par le client l???engagent d??s leur validation.</h6>
            </div>
            <div>
                <h2>Usage strictement personnel, comptes administrateurs et utilisateurs</h2>
                <h6>Une fois son inscription valid??e, le client, ou l???administrateur qu???il aura d??sign??, dispose de la facult?? de cr??er plusieurs comptes utilisateurs
                    via son espace personnel, donnant acc??s aux services.</h6>
                <h6> Il appartient au client ou ?? l???administrateur de s??lectionner les utilisateurs ayant acc??s ?? l???application ou aux services, dans la limite du
                    nombre maximum pr??vu dans l???abonnement du client, de d??terminer la nature des acc??s qui leur sont donn??s, ainsi que les donn??es et inPaies
                    auxquelles ils ont acc??s.</h6>
                <h6>L???utilisateur et/ou l???administrateur peuvent acc??der ?? tout moment au compte du client par le biais de leur propre espace personnel, apr??s s?????tre
                    identifi??s ?? l???aide de leur identifiant de connexion ainsi que de leur mot de passe.</h6>
                <h6>L???utilisateur et l???administrateur s???engagent ?? utiliser personnellement les services et ?? ne permettre ?? aucun tiers de les utiliser ??
                     leur place ou pour leur compte, sauf ?? en supporter l???enti??re responsabilit??.</h6>
                <h6>Ils sont pareillement responsables du maintien de la confidentialit?? de leur identifiant et mot de passe, et reconnaissent express??ment que
                    toute utilisation des services depuis leur compte sera r??put??e avoir ??t?? effectu??e par eux.  Ils doivent communiquer imm??diatement avec UPSKILL SARL
                    s'ils s'aper??oivent que leur compte a ??t?? utilis?? ?? leur insu. Ils reconnaissent ?? UPSKILL SARL le droit de prendre toutes mesures appropri??es en
                    pareil cas.
                </h6>
                <h6 id="duree" class="mt-3">Le client est responsable de l???utilisation des services par l???administrateur et les utilisateurs. Toute utilisation des services avec
                    l???identifiant et le mot de passe d???un compte administrateur et/ou utilisateur est r??put??e effectu??e par le client.</h6>
            </div>
            <div>
                <h2>Dur??e de l???abonnement, d??sinscription</h2>
                <h6>1.L???utilisation de l???application et l???ensemble des services pr??vus aux pr??sentes sont souscrits par le client sous la forme d???un
                    abonnement mensuel ou annuel, dont les dates de d??but et fin sont indiqu??es dans l???email de confirmation de son inscription.
                     Cet abonnement se renouvellera ensuite automatiquement pour une p??riode de m??me dur??e, sauf d??nonciation par l???une ou l???autre des parties
                     adress??e ?? l???autre partie par tout moyen ??crit 15 (quinze) jours avant l???expiration de la p??riode en cours.</h6>
                <h6 id="description" class="mt-3">2. Tout abonnement aux services est souscrit pour une dur??e ind??termin??e. Toutefois, il est impossible de supprimer un
                    compte parce qu'il s'agit d'un site collaboratif. Par contre, le client peut suspendre son compte et y acc??der d??s qu'il entre son nom
                    d'utilisateur et son mot de passe.</h6>
            </div>
            <div>
                <h2>Description des services</h2>
                <h6>1. Licence(s) d???utilisation de l???application</h6>
                <h6 style="margin-left: 10px">1.1 Objet de la licence</h6>
                <h6>UPSKILL SARL  conc??de au client une licence non exclusive, personnelle et non transmissible d???utilisation de son application, dans sa version
                    existante ?? la date des pr??sentes et dans toutes ??ventuelles versions ?? venir, aux seules fins de la fourniture des services.</h6>
                <h6>L???acc??s ?? l???application est fourni : </h6>
                <ul class="list-group ps-3">
                    <li>- gratuitement en ce qui concerne les trois premiers mois (essai) ;</li>
                    <li>- moyennant un abonnement payant les mois suivant l'essai.</li>
                </ul>
                <h6>Cette licence est consentie pour le monde entier et pour la dur??e de l???abonnement souscrit.</h6>
                <h6>Il est interdit au client d???en c??der ou d???en transf??rer le b??n??fice ?? un tiers, quel qu???il soit.</h6>
                <h6 style="margin-left: 10px">1.2 H??bergement</h6>
                <h6>Le client n???autorise aucune utilisation des donn??es collect??es par le biais de l???application par UPSKILL SARL  ou par un tiers, qui ne serait pas
                    rendue n??cessaire par l???ex??cution du contrat, sans son autorisation explicite et ??crite.</h6>
                <h6>UPSKILL SARL s???engage ?? mettre en ??uvre l???ensemble des moyens techniques conformes ?? l?????tat de l???art n??cessaire pour assurer la s??curit?? et
                     l???acc??s ?? l???application et aux services, portant sur la protection et la surveillance des infrastructures, le contr??le de l???acc??s physique
                     et/ou immat??riel auxdites infrastructure, ainsi que sur la mise en ??uvre des mesures de d??tection, de pr??vention et de r??cup??ration pour
                     prot??ger ses serveurs d???actes malveillants.</h6>
                <h6>Eu ??gard ?? la complexit?? d???internet, l???in??galit?? des capacit??s des diff??rents sous-r??seaux, l???afflux ?? certaines heures des clients de l???application,
                     aux diff??rents goulots d?????tranglement sur lesquels UPSKILL SARL  n???a aucune ma??trise, la responsabilit?? de UPSKILL SARL  sera limit??e au
                     fonctionnement de ses propres serveurs, dont les limites ext??rieures sont constitu??es par les points de raccordement.</h6>
                <h6>UPSKILL SARL  ne saurait ??tre tenue pour responsable (i) de l???indisponibilit?? des serveurs du client ou de ceux de son syst??me d???exploitation,
                    (ii) des vitesses d???acc??s ?? ses serveurs, (iii) des ralentissements externes ?? ses serveurs, et (iv) des mauvaises transmissions dues ?? une
                     d??faillance ou ?? un dysfonctionnement de ses r??seaux.</h6>
                <h6 style="margin-left: 10px">1.3 Maintenance ??volutive</h6>
                <h6>UPSKILL SARL s???engage ?? faire b??n??ficier le client des ??volutions et mises ?? jour de son application, dont la nature et la fr??quence seront
                    laiss??es ?? la libre appr??ciation de UPSKILL SARL .</h6>
                <h6>UPSKILL SARL se r??serve la possibilit?? de limiter ou de suspendre l???acc??s ?? l???application pendant les op??rations de maintenance.
                    Elle informera le client au pr??alable par tout moyen utile de la r??alisation de ces op??rations.</h6>
                <h6 style="margin-left: 10px">1.4 Support technique</h6>
                <h6>En dehors des dysfonctionnements et pour toute question li??e ?? la simple utilisation des services, UPSKILL SARL offre au client un support
                     technique consistant en une assistance et un conseil.</h6>
                <h6>Le support technique est aussi accessible ?? l???adresse email contact-mg@upskill-sarl.com.</h6>
                <h6 style="margin-left: 10px">1.5 Autres Services</h6>
                <h6>UPSKILL SARL se r??serve le droit de proposer tous autres services ou abonnement qu???elle jugera utile, sous une forme et selon les fonctionnalit??s
                    et moyens techniques qu???elle estimera les plus appropri??s pour rendre lesdits services. Aucune prestation suppl??mentaire n???aura lieu sans que le
                     client n???en ait accept?? le prix et les conditions de mise en ??uvre de fa??on expresse, pr??alable et par ??crit.</h6>
            </div>
            <div>
                <h2>Conditions financi??res</h2>
                <h6>1. Prix des services </h6>
                <h6>En contrepartie de la r??alisation des services, le client s???engage ?? payer ?? UPSKILL SARL le prix de l???abonnement choisi, tel qu???indiqu?? sur
                    le site et pr??alablement ?? son inscription mensuelle ou annuelle, par virement bancaire.</h6>
                <h6>2. Facturation </h6>
                <h6>Les services font l???objet de factures ponctuelles ou mensuelles communiqu??es au client par email et ?? chaque nouvelle souscription de service ou
                    d???abonnement.</h6>
                <h6 id="condition" class="mt-3">3. R??vision du Prix </h6>
                <h6>Le Prix a ??t?? calcul?? en fonction de l???abonnement choisi par le client et des options ??ventuellement souscrites. Si l???un de ces param??tres venait
                     ?? ??voluer en cours de contrat, le prix des services serait recalcul?? en cons??quence.</h6>
                <h6>4. Retards et d??fauts de paiement</h6>
                <h6>De convention expresse entre les parties, tout retard de paiement de tout ou partie d???une somme due ?? son ??ch??ance au titre de l???ex??cution des
                    services entra??nera automatiquement et sans mise en demeure pr??alable : la suspension imm??diate des services jusqu???au complet paiement de
                    l???int??gralit?? des sommes dues.</h6>
            </div>
        </div>
        <footer class="footer_container">
            <div class="d-flex justify-content-center pt-3">
                <div class="bordure">&copy; Copyright 2022</div>
                <div class="bordure"><a href="{{url('info_legale')}}" style="color:#801D68 !important" target="_blank">InPaies l??gales</a></div>&nbsp;
                <div><a href="{{url('contact')}}" class="bordure" style="color: #801D62;" target="_blank">Contactez-nous</a></div>&nbsp;
                <div class="bordure"><a href="{{url('politique_confidentialites')}}" class="bordure" style="color: #801D62;" target="_blank">Politique de confidentialit??s</a></div>&nbsp;
                <div class="bordure" > <a href="{{route('condition_generale_de_vente')}}" style="color:#801D68 !important" target="_blank"> Condition d'utilisation</a> </div>&nbsp;
                <div class="bordure"> <a href="{{url('tarifs')}}" style="color:#801D68 !important" target="_blank"> Tarifs</a></div>
                <div class="bordure">Cr??dits</div>
                <div> &nbsp; V 1.0.9</div>
            </div>
        </footer>
    </div>
</body>
</html>
