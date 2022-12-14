<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->

    {{-- Lien font awesome icons --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{asset('../assets/css/smooth_page.css')}}">
    <link rel="stylesheet" href="{{ asset('maquette/style_maquette.css') }}">
    <script src="{{ asset('maquette/javascript.js') }}"></script>
    <link rel="shortcut icon" href="{{  asset('img/logos_all/iconPersonel.webp') }}" type="image/x-icon">
    <title> Personnel.mg </title>
</head>
<style>
    h6 {
        text-align: justify;
        font-size: 1rem;
    }
    h2 {
        color: #801D68;
    }
     .navperso{
            position: sticky;
            top: 5rem;
        }
    /* .row_conditions header{
        position: sticky;
        top: 5rem;
    } */
</style>

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
    <div class="row col-12" style="margin-top: 90px;">
        <div class="col-3">
            <ul class="nav flex-column navperso ps-3 my-5">
                <li class="nav-item">
                    <a class="nav-link text-dark" aria-current="page" href="#politique">Politique de confidentialit??</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#modification">Modification de la politiques</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark " href="#recueil">Recueil d'information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#collecte">Collecte d???information en provenance de site tiers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#utilisation">Utilisation des informations du site web</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link text-dark" href="#balise">Balises Web</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#donn??es">Donn??es d???adresse IP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#information">Comment nous utilisons l???information collect??e</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#capacite">Votre capacit?? ?? choisir l???opt out</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark " href="#divulgation">Divulgation de vos informations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#site_web">Sites web tiers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#mineurs">Mineurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#reproduction">Reproduction de donn??es personnelles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#images">Images, logos, marques et droits d???auteur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#credits">Cr??dits du site</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#comptes">Suspension ou suppression de compte </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link text-dark" href="#responsabilite">Responsabilit??s et garanties du Client</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#comportement">Comportements prohib??s</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#obligation">Obligations et responsabilit?? du A WORLD FOR US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#propriete">Propri??t?? Intellectuelle</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#donnees">Donn??es ?? caract??re personnel</a>
                </li> --}}
            </ul>
        </div>
        <div class="col-8" >
            <span class="float-end">Derni??re mise ?? jour : le 27 Avril 2022 <hr class="my-2"></span></br>
            <h1 class="mt-5">Politique de confidentialit?? de la plateforme <span id="politique" >Personnel.mg</span></h1>
            <div>
                <h2 >Politique de confidentialit??</h2>
                <h6 >Merci de lire cette politique avec attention pour comprendre comment la soci??t?? UPSKILL SARL traite les informations issues de ce site. </h6>
                <h6 id="modification"  >En visitant ou en utilisant ce site web, vous acceptez les termes de cette politique.</h6>
                <h6 > Si vous avez des questions, commentaires ou interrogations concernant cette politique, merci de contacter contact-mg@upskill-sarl.com </h6>
            </div>
            <div>
                <h2 >Modifications de la politique</h2>
                <h6 > Nous nous r??servons le droit de modifier cette politique de confidentialit?? ?? tout moment. </h6>
                <h6 >Toute modification de cette politique de confidentialit??, y compris les informations recueillies
                    et l???utilisation et la divulgation des informations, sera  affich??e sur cette page.<span id="recueil"></span> </h6>
                <h6 >Suite ?? toute modification, nous mettrons ?? jour la date de ?? derni??re mise ?? jour ?? en haut de cette page.</h6>
                <h6 >Assurez-vous de v??rifier p??riodiquement la version la plus r??cente de notre politique de confidentialit??.</h6>
            </div>
            <div>
                <h2 >Recueil d???information</h2>
                <h6 > Lorsque vous visitez notre site web, nous recueillerons des donn??es personnelles ?? partir de votre poste de travail.
                    Ces informations nous permettent de d??terminer comment vous avez trouv?? notre site et nous permettent d???am??liorer les fonctionnalit??s de celui-ci.</h6>
                <h6 >Les informations que vous fournissez peuvent ??tre class??es en deux cat??gories, d??crites plus en d??tail ci-apr??s:</h6>
                <ul class="list-group ps-5">
                    <li>- les informations fournies par l???utilisateur </li>
                    <li>- les informations sur les informations personnelles que vous choisissez de partager</li>
                </ul>
                <h6 >Selon que vous remplissez un formulaire sur notre site, communiquez avec nous par e-mail, par t??l??phone ou autrement,les informations que
                    vous nous fournissez et que nous allons collecter peuvent inclure votre nom, votre adresse email, votre num??ro de t??l??phone, votre adresse email,
                    votre entreprise, votre position, l???adresse de votre entreprise ainsi que le d??tail de votre requ??te. Nous pouvons ??galement collecter des informations
                    suppl??mentaires, telles que des enqu??tes ou des ??v??nements marketing. </h6>
                <h6 id="collecte">Si vous nous fournissez des informations personnelles, il vous appartient de nous informer imm??diatement de tout changement apport?? aux
                    informations que vous avez fournies et mettre ?? jour vos donn??es personnelles en envoyant un courrier ??lectronique ?? contact-mg@upskill-sarl.com</h6 >
            </div>
            <div>
                <h2 >Collecte d???information en provenance de site tiers</h2>
                <h6 > ?? l???occasion, nous pouvons recevoir des informations personnelles vous concernant provenant de sources tierces, y compris de partenaires avec lesquels
                    nous collaborons de temps en temps dans le cadre d???activit??s de marketing communes <span id="utilisation" >et de sources accessibles au public.</span></h6>
                <h6>Nous pouvons ??galement recevoir des donn??es analytiques et publicitaires sur vous concernant votre visite ou sur fa??on dont vous avez trouv?? notre site web.</h6>
            </div>
            <div>
                <h2>Utilisation des informations du site web</h2>
                <h6 style="font-weight: bold" >Navigation et cookies</h6>
                <h6>Nous ne recueillons pas d???informations personnelles telles que votre nom, votre adresse professionnelle, votre num??ro de t??l??phone ou votre adresse
                    ??lectronique lorsque vous naviguez simplement sur notre site.</h6>
                <h6>UPSKILL SARL utilise ?? la fois des cookies de session sur son site, qui sont stock??s dans la m??moire temporaire et non conserv??s apr??s la fermeture du navigateur,
                    et des cookies persistants, qui stockent des informations sur votre disque dur. Ainsi, lorsque vous revenez sur le m??me site Web ?? une date ult??rieure,
                    les informations relatives aux cookies sont toujours pr??sentes.</h6>
                <h6>Celles-ci ne sont lisibles que par les employ??s de UPSKILL SARL et les cookies ne peuvent acc??der, lire ou modifier aucune autre donn??e de votre ordinateur.
                    Ils sont utilis??s pour collecter des informations sur vos choix et pr??f??rences et personnaliser notre site en cons??quence, y compris l???int??gration avec les
                    m??dias sociaux et des publicit??s adapt??es ?? vos besoins.</h6>
                <h6> Par exemple, pour effectuer une analyse statistique du nombre d???utilisateurs et de leurs habitudes d???utilisation afin d???am??liorer la vitesse de chargement
                    des pages.UPSKILL SARL ne vend aucune donn??e collect??e par ces cookies ou issues de vos donn??es personnelles.
                </h6>
                <h6>Nous utilisons ??galement des cookies ?? des fins d???analyse, notamment via Google Analytics, afin de collecter des informations sur votre utilisation de notre site
                    et de nous permettre d???am??liorer l???exp??rience de navigation.</h6>
                <h6 > Par exemple, les cookies d???analyse nous permettent  d???analyser la nature du trafic global, ainsi que les pages les plus visit??es sur notre site, et
                    de d??terminer si notre publicit?? est efficace ou non.
                </h6>
                <h6>Vous devriez pouvoir contr??ler les sp??cifications des cookies via les param??tres de votre navigateur.</h6>
                {{-- <h6 >Les options du navigateur et les instructions d???utilisation correspondantes se trouvent g??n??ralement dans le manuel du navigateur ou dans le
                    <span id="balise" > fichier d???aide.</span></h6> --}}
                <h6 >Si vous refusez, bloquez ou d??sactivez les cookies, cela pourrait limiter la disponibilit?? des services propos??s via le site Web. De plus,
                    certaines parties du site Web peuvent ne pas fonctionner correctement dans certaines circonstances.</h6>
            </div>
            {{--<div>
                <h2>Balises Web</h2>
                <h6>Une balise Web est une image graphique souvent invisible qui est plac??e sur un site Web ou dans un courrier ??lectronique et utilis??e pour surveiller
                    le comportement de l???utilisateur visitant le site Web ou l?????metteur ??? courrier ??lectronique de suivi et marquage de page pour l???analyse Web. Nous pouvons
                    utiliser des balises Web (ou des pixels de suivi) seuls ou conjointement avec des cookies, pour rassembler des informations sur votre utilisation de notre
                    site et sur les interactions avec les courriers ??lectroniques de UPSKILL SARL. Dans la perspective d???am??liorer l???exp??rience de notre site Web et la communication
                    client, les balises Web peuvent ??tre utilis??es par nos analystes marketing dans des messages ??lectroniques ou des lettres d???information pour d??terminer si
                    le message a ??t?? ouvert ou pour nous permettre de compter les utilisateurs ayant visit?? certaines pages, g??n??rer des statistiques sur l???utilisation de notre site.</h6>
                <h6 id="donn??es">Ils ne sont pas utilis??s pour acc??der ?? des informations personnellement identifiables.
                </h6>
                <h6 >Contrairement aux cookies, vous ne pouvez pas refuser les balises Web. Toutefois, si votre navigateur refuse les cookies ou vous invite ?? r??pondre,
                    les balises Web ne pourront pas suivre votre activit??.</h6>
            </div>--}}
            <div>
                <h2>Donn??es d???adresse IP</h2>
                <h6>Nos serveurs collectent automatiquement des donn??es sur votre adresse de protocole Internet lorsque vous nous rendez visite. </h6>
                <h6> Lorsque vous naviguez sur des pages de notre site Web, nos serveurs peuvent enregistrer votre adresse IP et parfois votre nom de domaine.
                    Nos serveurs peuvent ??galement enregistrer la page de renvoi qui vous a li?? ?? nous (par exemple, un autre site Web ou un moteur de recherche);
                    les pages que vous visitez sur ce site Web; le site Web que vous visitez apr??s ce site Web; d???autres informations sur le type de navigateur Web,
                    l???ordinateur, la plate-forme, les logiciels associ??s et les param??tres que vous utilisez; les termes de recherche que vous avez entr??s sur ce site Web
                    ou sur un site Web de r??f??rence.</h6>
                <h6>Nous utilisons ces informations pour l???administration interne du syst??me, pour diagnostiquer les probl??mes de nos serveurs et pour administrer notre site Web.</h6>
                <h6>Ces informations peuvent ??galement ??tre utilis??es pour rassembler des informations d??mographiques g??n??rales, telles que le pays d???origine et le fournisseur
                    de services Internet.</h6>
                <h6>Les informations personnelles (y compris les adresses IP) ne sont pas utilis??es pour faciliter le contact avec des utilisateurs qui n???ont pas fourni leurs coordonn??es. </h6>
                <h6>Votre adresse IP peut ??tre utilis??e pour identifier le clickstream* qui vous a conduit sur notre site. Toutefois, les informations personnelles ne sont
                    <span id="capacite"> partag??es avec aucune soci??t?? de marketing tierce.</span>
                </h6>
                <h6 style="font-style: italic">(*En ??tude du comportement du consommateur internaute, le clickstream repr??sente l???analyse des chemins emprunt??s
                par lui sur un site Internet.)</h6>
            </div>
            <div>
                <h2>Votre capacit?? ?? choisir l???opt out</h2>
                <h6>Nous vous fournissons les informations que vous avez demand??es en nous envoyant un courrier ??lectronique ou en saisissant votre demande sur notre site Web.</h6>
                <h6>Nous pouvons ??galement vous envoyer des informations et des offres de la part de la Soci??t?? et de nos fournisseurs de services tiers. </h6>
                <h6>Vous avez le droit de nous demander de ne pas traiter vos donn??es personnelles ?? des fins de marketing.</h6>
                {{--<h6>Vous pouvez toujours choisir de ne pas recevoir nos courriels marketing en suivant le processus de d??sinscription au bas de chaque courriel que vous recevez
                    de notre part. </h6>--}}
                <h6> pouvez ??galement modifier vos pr??f??rences en ce qui concerne les types de courriels que vous recevez de notre part en nous envoyant un
                    courrier ??lectronique ?? l???adresse contact-mg@upskill-sarl.com.
                </h6>
            </div>
            <div>
                <h2 id="information">Comment nous utilisons l???information collect??e</h2>
                <h6>Nous utilisons les informations que nous recueillons ?? votre sujet conform??ment ?? la pr??sente politique de confidentialit??. Nous ne vendons jamais d???informations
                    personnelles ?? des tiers.</h6>
                <h6>Nous pouvons utiliser vos informations personnelles afin de :</h6>
                <ul class="list-group ps-5">
                    <li>- Vous fournir de l'information (par courrier, par email ou t??l??phone) sur les solutions et les services que vous pourriez demander ou qui, selon nous,
                        pourraient vous int??resser ; comme la promotion, la commercialisation et la communication d'??v??nements, si vous avez accept?? d'??tre contact?? ?? ces fins;</li>
                    <li>- Vous informer des modifications apport??es ?? notre site, ?? notre politique de confidentialit??, ?? nos produits ou services;</li>
                    <li>- Vous permettre de participer ?? des fonctions interactives de notre site Web quand vous le souhaitez;</li>
                    <li>- Am??liorer notre site Web (?? des fins d???administration et de marketing), notamment en ce qui concerne le d??pannage,
                        les tests et la recherche, ainsi que dans le cadre de nos efforts pour prot??ger notre site;
                    </li>
                </ul>
                <h6 >Nos serveurs Web collectent et enregistrent automatiquement les donn??es d???utilisation du Web lorsque vous visitez notre site Web.
                    Ces informations, y compris, comme pr??cis?? plus haut votre adresse IP, le site de r??f??rence, les pages consult??es et la dur??e de la visite,<span  id="divulgation">
                    nous informent de la mani??re dont les visiteurs utilisent et naviguent sur notre site Web.</span>
                </h6>
                <h6>Ces informations sont enregistr??es dans nos bases de donn??es.</h6>
            </div>
            <div>
                <h2>Divulgation de vos informations</h2>
                <h6>Notre politique g??n??rale est de ne divulguer aucune donn??e personnelle ?? un tiers, sauf avec votre consentement pr??alable ou sur une base l??gale.</h6>
                <h6>UPSKILL SARL se conformera ?? tout moment aux r??glementations, lois, ordonnances de la cour ou demandes officielles applicables.</h6>
                <h6>Dans ce cadre, nous pouvons divulguer des informations personnelles pour nous conformer ?? une proc??dure l??gale valide telle qu???un mandat de perquisition,
                    une assignation ?? compara??tre, une autorit?? de surveillance ou une ordonnance du tribunal, si les actions d???un utilisateur enfreignent nos politiques ou
                    pour prot??ger nos droits et la propri??t?? de UPSKILL SARL.</h6>
                <h6>UPSKILL SARL se r??serve donc le droit de divulguer des donn??es ?? caract??re personnel aux autorit??s de r??gulation et de surveillance, ainsi qu????? des fournisseurs
                    de services d???analyse conform??ment ?? la pr??sente d??claration de confidentialit??.</h6>
                <ul class="list-group ps-5">
                    <li>- Nous ne partagerons ces informations avec aucune autre personne, soci??t?? ou organisation, ?? l???exception des tiers qui vous fourniront des produits
                        ou des services, conform??ment ?? votre accord avec UPSKILL SARL et dans la mesure o?? la loi l???exige.</li>
                    <li>- Les informations concernant l???utilisation de nos sites ne seront divulgu??es ?? des tiers que sous forme globale / ou anonyme, de telle sorte que
                        vos informations ne seront pas personnellement identifiables. Ces informations globales / anonymes sont collect??es sur la base de donn??es d???utilisation
                        du<span id="site_web"> Web ou d???informations statistiques que nous avons assembl??es ?? propos de nos utilisateurs.</span>
                    </li>
                </ul>
            </div>
            <div>
                <h2 >Sites web tiers</h2>
                <h6>Notre site Web contient des liens vers des sites Web de tiers qui sont fournis pour votre commodit??.</h6>
                <h6 >UPSKILL SARL n???approuve ni n???est responsable des pratiques de confidentialit??,du contenu ou des services desdits  sites Web. <span id="mineurs"></span></h6>
                <h6 > Nous vous recommandons de consulter les politiques de confidentialit?? et les conditions d???utilisation qui r??gissent ces sites Web lorsque vous les visitez.</h6>
            </div>
            <div>
                <h2 >Mineurs</h2>
                <h6>Ce site est destin?? aux adultes. UPSKILL SARL ne collecte pas sciemment d???informations aupr??s de mineurs de moins de 18 ans. Les jeunes de moins de 18 ans
                    ne doivent pas utiliser ce site Web ni nous<span id="reproduction" > soumettre d???informations. </span></h6>
                <h6 >S???il nous arrive de collecter des donn??es personnelles d???individus de moins de 18 ans, nous supprimerons imm??diatement ces informations personnelles.</h6>
            </div>
            <div>
                <h2 >Reproduction de donn??es personnelles</h2>
                <h6>Des photos et des donn??es personnelles de collaborateurs de UPSKILL SARL ont ??t?? incluses sur ce site Web avec l???autorisation expresse de la personne concern??e.</h6>
                <h6>Les photos et les donn??es personnelles de clients ont ??t?? incluses sur ce site Web avec l???autorisation expresse de la <span id="images">personne concern??e.</span></h6>
                <h6 >En aucun cas, des photos et / ou des donn??es personnelles de collaborateurs ou de clients ne peuvent ??tre reproduites sans l???autorisation ??crite de UPSKILL SARL.
                    Pour obtenir la permission, contactez-nous au contact-mg@upskill-sarl.com.
                </h6>
            </div>
            <div>
                <h2>Images, logos, marques et droits d???auteur</h2>
                <h6>Les images, logos, marques de commerce et droits d???auteur appartiennent ?? leurs propri??taires respectifs et ont ??t?? utilis??s avec l???autorisation expresse de
                    leurs propri??taires. Ils ne doivent pas ??tre copi??s ?? partir de notre site. </h6>
                <h6>Tout le contenu de ce site (image, vid??o, son, texte???) est prot??g?? par les lois en vigueur ?? Madagascar dans le domaine de la propri??t?? intellectuelle
                    et notamment le droit d???auteur, les droits voisins, le droit des marques.</h6>
                <h6 >Tous les droits de reprographie sont r??serv??s, y compris en ce qui concerne les documents t??l??chargeables et les repr??sentations <span id="credits">
                    photographiques ou graphiques.</span></h6>
                <h6 >En l???absence d???autorisation expresse de UPSKILL SARL, il est strictement interdit d???exploiter ces contenus et notamment de les reproduire, les repr??senter,
                    les modifier ou les adapter en tout ou en partie.</h6>
            </div>
            <div>
                <h2>Cr??dits du site</h2>
                <h6 style="font-weight: bold">Objet et base l??gale du traitement</h6>
                <h6>Nous recueillons et utilisons vos informations personnelles lorsque cela est n??cessaire pour la gestion des produits et services que nous vous proposons,
                    ?? vous ou ?? votre organisation, pour la relation commerciale associ??e, ainsi que pour nous conformer ?? nos obligations l??gales.</h6>
                <h6>Nous pouvons ??galement collecter et utiliser vos informations personnelles pour suivre un int??r??t l??gitime afin de cr??er et de g??rer
                    un r??seau de professionnels des ressources humaines/formation, de fournir des informations et des ressources relatives aux formations et de promouvoir
                    nos produits entre professionnels. Nous analyserons vos interactions avec nous pour comprendre votre profil et votre niveau d???int??r??t pour nos produits
                    et services (par exemple, pour d??cider de vous inclure ou non dans une campagne donn??e).</h6>
                <h6>Les informations peuvent ??tre collect??es directement aupr??s de vous, de votre organisation ou d???autres tiers autoris??s.</h6>
                <h6>Lorsqu???un consentement est requis, une demande de consentement vous est fournie.</h6>
                <h6 style="font-weight:bold">Vos droits</h6>
                <h6>Vous pouvez exercer vos droits en tant que personne concern??e (acc??s, rectification, effacement, restriction et objection, ainsi que la portabilit??) en nous
                    contactant via contact-mg@upskill-sarl.com.</h6>
                <h6>Lorsque le traitement est bas?? sur le consentement, vous avez le droit de retirer votre consentement ?? tout moment.<h6>
                <h6 style="font-weight: bold">Revu de vos informations / Nous contacter</h6>
                <h6>Vous pouvez consulter et mettre ?? jour les informations personnelles que nous avons collect??es ?? votre sujet en nous contactant ?? l???adresse contact-mg@upskill-sarl.com.</h6>
                <h6>Pour prot??ger votre vie priv??e et votre s??curit??, nous pouvons prendre des mesures raisonnables pour v??rifier votre identit?? avant de divulguer ces
                    informations aux tiers mentionn??s dans cette politique ou d???y apporter des corrections.</h6>
                <h6>Les droits sp??cifi??s ci-dessus peuvent ??tre refus??s ou limit??s si les int??r??ts, les droits et les libert??s de tierce partie ont pr??s??ance ou si le traitement
                    est n??cessaire pour ??tablir, exercer ou d??fendre des droits l??gaux de UPSKILL SARL</h6>
                <h6 style="font-weight: bold">Prise de d??cision automatis??e</h6>
                <h6>Nous n???utiliserons pas les informations que nous collectons pour prendre des d??cisions automatis??es qui pourraient avoir un effet juridique ou significatif sur vous.</h6>
                <h6>Les informations personnellement identifiables que nous recueillons ?? votre sujet sont stock??es sur des serveurs ?? acc??s restreints g??r??s par nos fournisseurs
                    de services de logiciels. Bien que nous maintenons des garanties raisonnables pour emp??cher tout acc??s non autoris??, pour maintenir la s??curit?? des donn??es
                    et pour utiliser correctement les informations que nous recueillons, nous ne garantissons aucune transmission de donn??es sur Internet.</h6>
            </div>
            <div>
                <h2>Suspension ou suppression de compte </h2>
                <h6>Vous pouvez nous demander de suspendre votre compte ?? tout moment en nous contactant via contact-mg@upskill-sarl.com . La suspension de votre compte
                    n???assigne pas la suppression de votre compte mais l???arr??t de vos activit??s sur notre site : vous ne vous afficherez plus dans les r??sultats de recherche,
                    vous ne pourrez plus interagir avec vos collaborateurs ni les voir, ils ne pourront plus non plus voir votre profil,...</h6>
                <h6>N??anmoins, vous pouvez toujours acc??der ?? votre compte pour voir vos donn??es ainsi que ceux que vous avez partag?? avec vos collaborateurs,
                    et ces derniers auront aussi cet acc??s. Ainsi pour cette raison la suppression de ce dernier ne pourrait pas ??tre possible.</h6>
                <h6>Nous conservons vos donn??es personnelles le cas ??ch??ant pour vous fournir des services et aussi longtemps que cela s???av??re n??cessaire pour
                    les finalit??s d??finies ?? l???origine ou pour toute p??riode plus longue qui pourrait ??tre requise ?? des fins juridiques, d???audit et de conformit??.</h6>
                <h6 >Cela inclut les donn??es que vous ou d???autres personnes nous avez fournies et les donn??es g??n??r??es ou d??duites de votre utilisation de nos services.
                    Toutes les informations conserv??es resteront soumises aux termes de cette politique.
                    Vous avez le droit de r??activer votre compte ?? tout moment en nous contactant via contact-mg@upskill-sarl.com </h6>
            </div>
            <span  id="comptes"></span>
        </div>
        <footer class="footer_container">
            <div class="d-flex justify-content-center pt-3">
                <div class="bordure">&copy; Copyright 2022</div>
                <div class="bordure"><a href="{{url('info_legale')}}" style="color:#801D68 !important" target="_blank">Informations l??gales</a></div>&nbsp;
                <div><a href="{{url('contact')}}" class="bordure" style="color: #801D62;" target="_blank">Contactez-nous</a></div>&nbsp;
                <div class="bordure"><a href="{{url('politique_confidentialites')}}" class="bordure" style="color: #801D62;" target="_blank">Politique de confidentialit??s</a></div>&nbsp;
                <div class="bordure" > <a href="{{route('condition_generale_de_vente')}}" style="color:#801D68 !important" target="_blank"> Condition d'utilisation</a> </div>&nbsp;
                <div class="bordure"> <a href="{{url('tarifs')}}" style="color:#801D68 !important" target="_blank"> Tarifs</a></div>
                <div class="bordure">Cr??dits</div>
                <div> &nbsp; V 1.0.9</div>
            </div>
        </footer>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        if($('.navbar-collapse').hasClass('show')){
            $('.navbar-collapse').addClass('mb-3');
        }
        </script>
    </body>
</html>
