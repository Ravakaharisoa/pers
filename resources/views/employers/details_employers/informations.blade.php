
@extends('layouts.master_page')
@section('title')

@endsection
@section('content')
@include('sweetalert::alert')

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>

<link rel="stylesheet" href="{{ asset('assets/css/personnels/details.css') }}">
<div class="col-md-12 my-2 m-3 p-2" style="border-radius: 15px;" role="tab-panel" >
    <ul class="nav nav-tabs mx-2 pt-3 navigation_module" id="myTab">
        <li class="nav-item">
            <a href="#pers_details{{$stagiaire->id}}" data-toggle="tab" class="nav-link">Informations générals</a>
        </li>
        <li class="nav-item">
            <a href="#autre_informations{{$stagiaire->id}}" data-toggle="tab" class="nav-link">Autres informations</a>
        </li>
        <li class="nav-item">
            <a href="#detail_pers_charge{{$stagiaire->id}}" data-toggle="tab" class="nav-link">Personnes à charges</a>
        </li>
        <li class="nav-item">
            <a href="#pers_contact_urgence{{$stagiaire->id}}" data-toggle="tab" class="nav-link">Contact d'urgence</a>
        </li>
        <li class="nav-item">
            <a href="#pers_materiels{{$stagiaire->id}}" data-toggle="tab" class="nav-link">Matériels utilisés</a>
        </li>
    </ul>
    <div class="col-md-12 my-2" style="border-radius: 15px;" role="tab-panel">
        <div class="tab-content" id="tabContent">
            <div class="tab-pane fade show active" id="pers_details{{$stagiaire->id}}">
                <form action="{{ route('update_employe', $stagiaire->id) }}" method="POST" enctype="multipart/form-data">
                    <div class="card p-3 my-4 mx-2 text-secondary">
                        @csrf
                        <div class='d-flex justify-content-between'>
                            <h6 class='text-primary'>Informations Personnels</h6>
                            <label for="updateFile{{ $stagiaire->id }}" style="cursor:pointer">
                                @if ($stagiaire->photos)
                                    <img src="{{ asset('images/employes/'.$stagiaire->photos) }}" alt="{{ $stagiaire->nom_stagiaire }}" 
                                    width='100px' class='img img-fluid rounded-circle emp_image' id="img{{ $stagiaire->id }}"/>
                                    <input id='updateFile{{ $stagiaire->id }}' type="file" name='image'
                                    accept="image/png, image/jpg, image/jpeg" class='d-none'
                                    />
                                @else
                                    <img src="{{asset('images/formateurs/homme.png')}}" alt="image employe" alt="{{ $stagiaire->nom_stagiaire }}" 
                                    width='100px' class='img img-fluid rounded-circle' id="img{{ $stagiaire->id }}"/>
                                    <input id='updateFile{{ $stagiaire->id }}' type="file" name='image'
                                    accept="image/png, image/jpg, image/jpeg" class='d-none'
                                    />
                                @endif
                            </label>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label label_form-1">
                                        Nom *
                                    </label>
                                    <input type="text" id="idFirstName" name="nom_stagiaire"
                                    class="form-control text-secondary input_form border-bottom p-0 pb-2"
                                    value="{{$stagiaire->nom_stagiaire}}" onChange="enableSauvegardeDetailPers()" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="lastName" class="form-label label_form-1">
                                        Prénom
                                    </label>
                                    <input type="text" id="idLastName" name="prenom_stagiaire"
                                    class="form-control text-secondary input_form border-bottom p-0 pb-2"
                                    value="{{$stagiaire->prenom_stagiaire}}" onChange="enableSauvegardeDetailPers()"
                                    >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="emp" class="form-label label_form-1">
                                        Matricule *
                                    </label>
                                    <input type="text" id="idEmp" name="matricule" class="form-control
                                    text-secondary input_form border-bottom p-1"
                                    value="{{$stagiaire->matricule}}" readonly="readonly" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="genre" class="form-label label_form-1">
                                        Le genre *
                                    </label>
                                    <select class="form-control input_form my-2 p-0 text-secondary border-bottom"
                                    name="genre_id" onChange="enableSauvegardeDetailPers()" required>
                                        @foreach ($genres as $genre)
                                            @if ($genre->id == $stagiaire->genre_id)
                                            <option value="{{ $genre->id }}" selected>{{ $genre->genre }}</option>
                                            @else
                                                <option value="{{ $genre->id }}">{{ $genre->genre }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="naissance" class="form-label label_form-1">
                                        Date de naissance *
                                    </label>
                                    <input type="date" name="date_naissance" class="form-control input_form
                                    text-secondary border-bottom p-0 pb-2"
                                    value="{{ $stagiaire->date_naissance }}" onChange="enableSauvegardeDetailPers()" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label label_form-1 mb-3">Numéro du CIN *</label>
                                    <input type="text" class="form-control input_form text-secondary border-bottom p-0"
                                    name="numCin" value="{{$stagiaire->cin}}" onChange="enableSauvegardeDetailPers()" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label label_form-1 mb-3">Numéro du permis</label>
                                    @if ($identite->num_permis != null)
                                        <input type="text" id="num-permis{{$stagiaire->id}}" class="form-control input_form text-secondary border-bottom p-0"
                                    name="numPermis" value="{{$identite->num_permis}}" onChange="enableSauvegardeDetailPers()" onKeyUp="mainInfo(this.value)"/>
                                    @else
                                        <input type="text" id="num-permis{{$stagiaire->id}}" class="form-control input_form text-secondary border-bottom p-0"
                                        name="numPermis" value="" onChange="enableSauvegardeDetailPers()" onKeyUp="mainInfo(this.value)"/>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-4" id="permisCateg{{$stagiaire->id}}">
                                <div class="mb-3">
                                    <label class="form-label label_form-1 mb-0">Catégories de permis</label><br>
                                    @foreach ($all_categ_permis as $permis)
                                        <input type="checkbox" name="categorie[{{ $permis->id }}]"
                                        id="check{{ $permis->id }}" style="border: 5px;" onChange="enableSauvegardeDetailPers()">
                                        @foreach ($emp_all_permis as $isHave)
                                            @if ($isHave->permis_id == $permis->id)
                                                <script>
                                                    document.getElementById("check" + {{ $permis->id }}).checked = true;
                                                </script>
                                            @endif
                                        @endforeach
                                        <span style="font-size: 14px;" class="me-2">
                                            {{ $permis->categorie }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            <script>
                                if ($('#num-permis{{$stagiaire->id}}').val()) {
                                    $('#permisCateg{{$stagiaire->id}}').removeClass('collapse');
                                }
                                else {
                                    $('#permisCateg{{$stagiaire->id}}').addClass('collapse');
                                }
                            </script>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label label_form-1 mb-3">Passeport</label>
                                    <input type="text" class="form-control input_form text-secondary border-bottom p-0"
                                    name="passport" value="{{$identite->passport}}" onChange="enableSauvegardeDetailPers()">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <p>* champ obligatoire</p>
                            </div>
                            <div class="col-md-4 offset-md-4 text-md-end">
                                <button type="submit" class="btn text-white button-text"
                                id="sauvegarde-detail-pers{{ $stagiaire->id }}" disabled>
                                    Sauvegarde
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <form action="{{ route('update_contact', $stagiaire->id) }}" method="post">
                    <div class="card my-4 mx-2 p-3 text-secondary">
                        <h6 class='text-primary'>Coordonnées</h6>
                        @csrf
                        <div class="row my-3">
                            <div class="col-md-4 mb-3">
                                <label for="nationalite" class="form-label label_form-1">
                                    Nationalité *
                                </label>
                                <select class="form-control border-bottom input_form my-2 p-0 text-secondary"
                                    name="nationalite" onChange="enableSauvegardeDetailContact()" required>
                                    @foreach($nationalites as $nationalite)
                                        @if ($nationalite->id == $stagiaire->nationalite_id)
                                            <option value="{{ $nationalite->id }}" selected>{{ $nationalite->nationalite }}</option>
                                        @else
                                            <option value="{{ $nationalite->id }}">{{ $nationalite->nationalite }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="region" class="form-label label_form-1">
                                    Région *
                                </label>
                                <input type="text" name="region" id="idRegion" class="form-control text-secondary input_form border-bottom p-0 pb-2"
                                    value="{{$contact->region}}" onChange="enableSauvegardeDetailContact()" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="ville" class="form-label label_form-1">
                                    Ville
                                </label>
                                <input type="text" name="ville" id="idVille" class="form-control text-secondary input_form border-bottom p-0 pb-2"
                                value="{{$contact->ville}}" onChange="enableSauvegardeDetailContact()"
                                >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                    <label for="quartier" class="form-label label_form-1">
                                        Quartier
                                    </label>
                                    <input type="text" name="quartier" id="idQuartier" class="form-control text-secondary input_form border-bottom p-0 pb-2"
                                    value="{{$contact->quartier}}" onChange="enableSauvegardeDetailContact()"
                                    >
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="postal" class="form-label label_form-1">
                                    Code postale
                                </label>
                                <input type="text" name="code_postal" id="idPostal" class="form-control input_form
                                text-secondary border-bottom p-0 pb-2" value="{{ $contact->code_postal }}"
                                onChange="enableSauvegardeDetailContact()">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="postal" class="form-label label_form-1">
                                    Lot
                                </label>
                                <input type="text" name="lot" id="idPostal" class="form-control input_form
                                text-secondary border-bottom p-0 pb-2" value="{{ $contact->lot }}"
                                onChange="enableSauvegardeDetailContact()">
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-4 mb-3">
                                <label for="Etat" class="form-label label_form-1">
                                    Etat civil *
                                </label>
                                <select class="form-control input_form my-2 p-0 text-secondary border-bottom"
                                    name="status_matri_id" id="marital_status{{ $stagiaire->id }}"
                                    onChange="condition_status()" required>
                                    @foreach($statutMatris as $statutMatri)
                                        @if ($statutMatri->id ==  $stagiaire->status_matri_id)
                                            <option value="{{ $statutMatri->id }}" selected>{{ $statutMatri->status }}</option>
                                        @else
                                            <option value="{{ $statutMatri->id }}">{{ $statutMatri->status }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4" id="date_mariage{{ $stagiaire->id }}">
                                <label for="date_mariage" class="form-label label_form-1">Date mariage</label>
                                <input type="date" class="form-control text-secondary input_form border-bottom p-0 pb-2"
                                name="date_mariage" id="date_mariage{{ $stagiaire->id }}" value="{{ $date_mariage }}"
                                onChange="enableSauvegardeDetailContact()">
                                <script>
                                    if ({{ $stagiaire->status_matri_id }}==2)
                                        $('input[id="date_mariage{{ $stagiaire->id }}"]').attr('required', 'required');
                                    else
                                        $('input[id="date_mariage{{ $stagiaire->id }}"]').removeAttr('required');
                                </script>
                            </div>
                            <div class="col-md-4 mb-3" id="tel{{$stagiaire->id}}">
                                <label for="phone" class="form-label label_form-1">
                                    Téléphone
                                </label>
                                <input type="tel" name="tel" id="idPhone" class="form-control text-secondary input_form border-bottom p-0 pb-2"
                                value="{{$contact->telephone_stagiaire}}" onChange="enableSauvegardeDetailContact()"
                                >
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="email" class="form-label label_form-1">
                                    Email *
                                </label>
                                <input type="email" name="email" id="idEmail" class="form-control text-secondary input_form border-bottom p-0 pb-2"
                                value="{{$contact->mail_stagiaire}}" onChange="enableSauvegardeDetailContact()"
                                required>
                            </div>
                            <script>
                                if ($('#marital_status{{$stagiaire->id}}').val()==2) {
                                    $('#date_mariage{{$stagiaire->id}}').removeClass('collapse');
                                    $('#tel{{$stagiaire->id}}').addClass('ms-1');
                                }
                                else {
                                    $('#date_mariage{{$stagiaire->id}}').addClass('collapse');
                                    $('#tel{{$stagiaire->id}}').removeClass('ms-1');
                                }
                            </script>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <p>* champ obligatoire</p>
                            </div>
                            <div class="col-md-4 offset-md-4 text-md-end">
                                <button type="submit" id="sauvegarde-detail-contact{{$stagiaire->id}}" class="btn text-white button-text" disabled>
                                    Sauvegarde
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade show" id="autre_informations{{$stagiaire->id}}">
                <form action="{{ route('update_organisme_sociale', $stagiaire->id) }}" method="POST">
                    <div class="card col-md-12 p-3 my-4 mx-2 text-secondary">
                        <h6 class='text-primary'>Organismes sociales</h6>
                        @csrf
                        <div class="row my-3">
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="lastName" class="form-label label_form-1">
                                        Cnaps
                                    </label>
                                    <input type="text" id="idLastName{{$stagiaire->id}}" name="num_cnaps"
                                    class="form-control text-secondary input_form border-bottom p-0"
                                    value="{{$identite->num_cnaps}}" onChange="enableSauvegardeOrganismeSocial()"
                                    >
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label label_form-1">
                                        Ostie
                                    </label>
                                    <input type="text" id="idFirstName{{$stagiaire->id}}"
                                    name="num_ostie" class="form-control text-secondary input_form border-bottom p-0"
                                    value="{{$identite->num_ostie}}" onChange="enableSauvegardeOrganismeSocial()"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md text-md-end">
                                <button type="submit" id="sauvegarde-organisme-social{{$stagiaire->id}}" class="btn text-white button-text" disabled>
                                    Sauvegarde
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <form action="{{ route('InsertInfo') }}" method="post">
                    @csrf
                    <div class="card mt-3 p-3 text-secondary">
                        <h6 class='text-primary'>
                            Informations sanitaires
                        </h6>
                        <div class="row my-3">
                            <div class="col-md-6">
                                <label for="Nationalité" class="form-label label_form-1">
                                    Allergie *
                                </label>
                                <div class="row col-md-6 mx-2">
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="non"
                                            value=1>
                                        <label class="form-check-label" for="inlineRadio1">Non</label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" type="radio" id="oui" name="inlineRadioOptions"
                                            value="2">
                                        <label class="form-check-label" for="inlineRadio2">Oui</label>
                                    </div>
                                </div>
                                <div class="mb-3" id="ListTypeAllergie">
                                    {{-- <label for="" class="form-label">Autre</label> --}}
                                    <select class="form-control" name="autre1" id="select0">
                                        {{-- @foreach ($id as $e)
                                            <option value="{{ $e->id }}">{{ $e->nom }}</option>
                                        @endforeach --}}
                                        <option value="1">Allergie</option>
                                        <option value="autre">Autre</option>
                                    </select>
                                </div>
                                <div class="form-floating mb-3" id="AutretypeAllergie">
                                    <input type="number" class="form-control" name="typeAllergie" id="typeAllergie"
                                        placeholder="Entrez votre type allergie">
                                    <label for="floatingLabel">Entrez votre type allergie</label>
                                </div>
                                <label for="Nationalité" class="form-label label_form-1 mt-3">
                                    Groupe sanguin
                                </label>
                                <div class="row mx-2">
                                    <div class="form-check radio-form mt-2">
                                        <input class="form-check-input" type="radio" name="RadioOptions" id="Antigene_A"
                                            value="1">
                                        <label class="form-check-label" for="inlineRadio1">Antigène A</label>
                                    </div>
                                    <div class="form-check radio-form">
                                        <input class="form-check-input" type="radio" name="RadioOptions" id="Antigene_B"
                                            value="2">
                                        <label class="form-check-label" for="inlineRadio2">Antigène B</label>
                                    </div>
                                    <div class="form-check radio-form">
                                        <input class="form-check-input" type="radio" name="RadioOptions" id="Globule_R"
                                            value="3">
                                        <label class="form-check-label" for="inlineRadio1">Globule rouge</label>
                                    </div>
                                    <div class="form-check radio-form">
                                        <input class="form-check-input" type="radio" name="RadioOptions" id="Antigene_AB"
                                            value="4">
                                        <label class="form-check-label" for="inlineRadio2">Type AB</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 col-md-6">
                                    <label for="Nationalité" class="form-label label_form-1">
                                        intolérance
                                    </label>
                                    <select class="form-control input_form mb-4 p-0 text-secondary border-bottom" id="select1"
                                        name="intolérance">
                                        <option selected class="option">--Selectionner--</option>
                                        <option value="1">intolérance-1</option>
                                        <option value="2">intolérance-2</option>
                                        <option value="3">
                                            Autres
                                        </option>
                                    </select>
                                    <div class="form-floating mb-3" id="typeintolerance">
                                        <input type="text" class="form-control" name="typeintolerance"
                                            placeholder="Entrez votre type intolérance">
                                        <label for="floatingLabel">Entrez votre type intolérance</label>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="Nationalité" class="form-label label_form-1">
                                        maladie chronique
                                    </label>
                                    <select class="form-control input_form mb-4 p-0 border-bottom text-secondary" id="select2"
                                        name="maladie_chronique">

                                        <option selected class="option">--Selectionner--</option>
                                        <option value="1">maladie-chronique-1</option>
                                        <option value="2">maladie-chronique-2</option>
                                        <option value="3">Autres</option>
                                    </select>
                                    <div class="form-floating mb-3" id="maladiechronique">
                                        <input type="text" class="form-control" name="typeintolerance"
                                            placeholder="Entrez votre type intolérance">
                                        <label for="floatingLabel">Entrez votre type maladie chronique</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <p>* champ obligatoire</p>
                            </div>
                            <div class="col-md-4 offset-md-4 text-md-end">
                                <button class="btn text-white button-text" type="submit" disabled>
                                    Sauvegarde
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade show m-2" id="detail_pers_charge{{$stagiaire->id}}">
                <div class="col-md-12">
                    <button class="btn float-end text-white" type="button"
                        style="background:#33cc00;" data-bs-toggle="modal" data-bs-target="#Modal_Pers_a_charge">
                        <i class='bx bx-plus-medical' style="fill: white;"></i>
                    </button>
                    @if(count($pers_a_charges))
                        <div class="table-responsive pt-2">
                            <table class="table table-hover text-secondary" class="img-circle" style="font-size: .8rem;" >
                                <thead >
                                    <tr>
                                        <th><span>Nom</span></th>
                                        <th><span>Prénom</span></th>
                                        <th><span>Age</span></th>
                                        <th><span>Relation</span></th>
                                        <th><span>Date de création</span></th>
                                        <th><span>Date de modification</span></th>
                                        <th><span>Contact d'urgence</span></th>
                                        <th><span>Action</span></th>
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach($pers_a_charges as $pers_a_charge)
                                        <tr class='my-5'>
                                            <td>
                                                {{ $pers_a_charge->nom }}
                                            </td>
                                            <td>
                                                {{ $pers_a_charge->prenom }}
                                            </td>
                                            <td>
                                                {{ date("Y") - $pers_a_charge->year }} ans
                                            </td>
                                            <td>
                                                @foreach($pers_relations as $relation)
                                                    @if ($relation->id == $pers_a_charge->relation_id)
                                                        {{ $relation->relation }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                {{ $pers_a_charge->created_at }}
                                            </td>
                                            <td>
                                                {{ $pers_a_charge->updated_at }}
                                            </td>
                                            <td>
                                                <input type="checkbox" name="input_contact_urgence"
                                                id="check-contact-urgence{{ $pers_a_charge->id  }}"
                                                onClick="persInfo({{$stagiaire->id}},'{{$pers_a_charge->nom}}','{{$pers_a_charge->prenom}}',
                                                {{$pers_a_charge->relation_id}},{{$pers_a_charge->id}})"/>
                                                <script>
                                                    if ({{$pers_a_charge->contact_urgence}})
                                                    document.getElementById('check-contact-urgence'
                                                    + {{ $pers_a_charge->id  }}).checked = true;
                                                    isCheck = document.getElementById('check-contact-urgence' + {{ $pers_a_charge->id  }}).checked;
                                                    $('#check-contact-urgence' + {{ $pers_a_charge->id  }}).attr('data-bs-toggle', 'modal');
                                                    if (isCheck) {
                                                        $('#check-contact-urgence' + {{ $pers_a_charge->id  }}).attr('data-bs-target', '#Modal_en_tant_que_suppr_contact_urgence');
                                                    }
                                                    else {
                                                        $('#check-contact-urgence' + {{ $pers_a_charge->id  }}).attr('data-bs-target', '#Modal_Pers_a_charge_contact_urgence');
                                                    }
                                                    if ({{date("Y") - $pers_a_charge->year}}<16)
                                                        $('#check-contact-urgence{{ $pers_a_charge->id  }}').attr('disabled', true);
                                                </script>
                                            </td>
                                            <td>
                                                <a class="edit" title="Modifier" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#Modal_Pers_a_charge"
                                                    onClick="editPersACharge({{ $pers_a_charge->id }}, '{{ $pers_a_charge->nom }}', '{{ $pers_a_charge->prenom }}',
                                                    '{{ $pers_a_charge->date_naissance }}', '{{ $pers_a_charge->relation_id }}', {{ $pers_a_charge->contact_urgence }})">
                                                    <i class="material-icons">&#xE254;</i>
                                                </a>
                                                <a class="delete" title="Supprimer" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#Modal_suppr_pers_a_charges"
                                                    onClick="deletePersACharge({{ $pers_a_charge->id }})">
                                                    <i class="material-icons">&#xE872;</i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <div class="modal text-secondary" id="Modal_Pers_a_charge" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true" style="border-radius: 30%;">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel">Ajouter une personne à charge</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close" onClick="removeSetPersACharge()"></button>
                        </div>
                        <form action="{{ route('add_persCharge') }}" method="POST">
                            @csrf
                            <div class="modal-body mx-2">
                                <input type="hidden" name="idPers" id="id-pers-a-charge{{$stagiaire->id}}" value="">
                                <input type="hidden" name="employer_id" value="{{$stagiaire->id}}">
                                <input type="hidden" name="contact_urgence" id="contact-urgence-pers-a-charge{{$stagiaire->id}}" value=0>
                                <div class="mb-3">
                                    <label for="firstName" class="form-label label_form-2">
                                        Nom *
                                    </label>
                                    <input type="text" name="nom" id="name-pers-a-charge{{$stagiaire->id}}" class="form-control
                                    input_form border-bottom p-0 pb-2" required>
                                </div>
                                <div class="mb-3">
                                    <label for="firstName" class="form-label label_form-2">
                                        Prénom
                                    </label>
                                    <input type="text" name="prenom" id="last-name-pers-a-charge{{$stagiaire->id}}" class="form-control
                                    input_form border-bottom p-0 pb-2">
                                </div>
                                <div class="mb-3">
                                    <label for="naissance" class="form-label label_form-2">
                                        Date de naissance *
                                    </label>
                                    <input type="date" name="date_naissance" id="dtn-pers-a-charge{{$stagiaire->id}}" class="form-control
                                    input_form border-bottom p-0 pb-2" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Etat" class="form-label label_form-2">
                                        Relation *
                                    </label>
                                    <select class="form-select input_form p-0 pb-2 border-bottom text-secondary"
                                    name="relation_id" id="relation-pers-a-charge{{$stagiaire->id}}" required>
                                        <option value="">--Selectionner--</option>
                                        @foreach($pers_relations as $statut)
                                            @if ($statut->relation=="Enfants" || $statut->relation=="Petits enfants")
                                                <option value="{{ $statut->id }}">{{ $statut->relation }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="row col-md-12">
                                    <p class="text-start col-md-2" style="font-size: 11px;">* Requis</p>
                                    <div class="col-md-10 text-end">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                        onClick="removeSetPersACharge()">Annuler</button>
                                        <button type="submit" class="btn text-white" style="background:#16B84E;">Enregistrer</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal text-secondary" id="Modal_Pers_a_charge_contact_urgence" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                style="border-radius: 30%;">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel">
                                Ajouter en tant que contact urgence
                            </h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close" onClick="onOffCheck()"></button>
                        </div>
                        <form action="{{ route('refresh_contactUrgence') }}" method="POST">
                        @csrf
                        <div class="modal-body mx-2">
                            <input type="hidden" name="employer_id" value="{{$stagiaire->id}}">
                            <input type="hidden" name="nom" id="name-p-contact-urgence{{$stagiaire->id}}">
                            <input type="hidden" name="prenom" id="last-name-p-contact-urgence{{$stagiaire->id}}">
                            <input type="hidden" name="relation_id" id="idRelation{{$stagiaire->id}}">
                            <input type="hidden" name="pers_a_charge_id" id="idPers{{$stagiaire->id}}">
                            <input type="hidden" name="input_contact_urgence" id="isCheck{{$stagiaire->id}}" value="on">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                            <label for="pFixe" class="form-label label_form-2">
                                                Télephone fixe
                                            </label>
                                            <input type="tel" name="tel_fixe" id="idPFixe" class="form-control
                                            input_form border-bottom p-0 pb-2">
                                        </div>
                                        <div class="mb-3">
                                            <label for="mobile" class="form-label label_form-2">
                                                Télephone mobile
                                            </label>
                                            <input type="tel" name="tel_mobile" id="idMobile" class="form-control
                                            input_form border-bottom p-0 pb-2" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pTravail" class="form-label label_form-2">
                                                Télephone travail
                                            </label>
                                            <input type="tel" name="tel_travail" id="idPTravail" class="form-control
                                            input_form border-bottom p-0 pb-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="row col-md-12">
                                    <p class="text-start col-md-2" style="font-size: 11px;">* Requis</p>
                                    <div class="col-md-10 text-end">
                                        <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal" onClick="onOffCheck()">Annuler</button>
                                        <button type="submit" class="btn text-white" style="background:#16B84E;">Enregistrer</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal text-secondary" id="Modal_en_tant_que_suppr_contact_urgence" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="border-radius: 30%;">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('refresh_contactUrgence') }}" method="POST">
                            @csrf
                            <div class="modal-body mx-2">
                                <input type="hidden" name="pers_a_charge_id" id="idP{{$stagiaire->id}}">
                                <input type="hidden" name="input_contact_urgence" id="isCheck{{$stagiaire->id}}" value="off">
                                <div class="col-md-12 my-3">
                                    <div class="mb-3">
                                        Voulez vous supprimer en tant que contact urgence?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal" onClick="onOffCheck()">Non</button>
                                            <button type="submit" class="btn text-white ms-2" style="background:#16B84E;">Oui</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal text-secondary" id="Modal_suppr_pers_a_charges" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="border-radius: 30%;">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('delete_persCharge') }}" method="POST">
                            @csrf
                            <div class="modal-body mx-2">
                                <input type="hidden" name="pers_a_charge_id"
                                id="id-pers-a-charge-suppr{{$stagiaire->id}}">
                                <div class="col-md-12 my-3">
                                    <div class="mb-3">
                                        Voulez vous supprimer?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Non</button>
                                            <button type="submit" class="btn text-white ms-2" style="background:#16B84E;">Oui</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show m-2" id="pers_contact_urgence{{$stagiaire->id}}" >
                <div class="col-md-12">
                    <button class="btn float-end text-white" type="button"
                        style="background:#33cc00;" data-bs-toggle="modal" data-bs-target="#Modal_contact_urgence">
                        <i class='bx bx-plus-medical' style="fill: white;"></i>
                    </button>
                    @if (count($contact_urgences))
                        <div class="table-responsive pt-2">
                            <table class="table table-hover text-secondary" class="img-circle" style="font-size: .8rem;" >
                                <thead >
                                    <tr>
                                        <th><span>Nom</span></th>
                                        <th><span>Prénom</span></th>
                                        <th><span>Relation</span></th>
                                        <th><span>Téléphone fixe</span></th>
                                        <th><span>Téléphone mobile</span></th>
                                        <th><span>Téléphone travail</span></th>
                                        <th><span>Action</span></th>
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach($contact_urgences as $contact_urgence)
                                        <tr class='my-5'>
                                            <td>
                                                {{ $contact_urgence->nom }}
                                            </td>
                                            <td>
                                                {{ $contact_urgence->prenom }}
                                            </td>
                                            <td>
                                                @foreach($pers_relations as $relation)
                                                    @if ($relation->id == $contact_urgence->relation_id)
                                                        {{ $relation->relation }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                {{ $contact_urgence->tel_fixe }}
                                            </td>
                                            <td>
                                                {{ $contact_urgence->tel_mobile }}
                                            </td>
                                            <td>
                                                {{ $contact_urgence->tel_travail }}
                                            </td>
                                            <td>
                                                <a class="edit" title="Modifier" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#Modal_contact_urgence"
                                                    onClick="editContactUrgence({{ $contact_urgence->id }}, '{{ $contact_urgence->nom }}',
                                                    '{{ $contact_urgence->prenom }}', '{{ $contact_urgence->relation_id }}',
                                                    '{{ $contact_urgence->tel_fixe }}', '{{ $contact_urgence->tel_mobile }}',
                                                    '{{ $contact_urgence->tel_travail }}', {{ $contact_urgence->pers_a_charge_id }})">
                                                    <i class="material-icons">&#xE254;</i>
                                                </a>
                                                <a class="delete" title="Supprimer" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#Modal_suppr_contact_urgence"
                                                    onClick="deleteContactUrgence({{ $contact_urgence->id }}, {{ $contact_urgence->pers_a_charge_id }})">
                                                    <i class="material-icons">&#xE872;</i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <div class="modal text-secondary" id="Modal_contact_urgence" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="border-radius: 30%;">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="row">
                            <div id='listpcharge{{ $stagiaire->id }}'>
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel">
                                        Liste des personnes à charges
                                    </h6>
                                </div>
                                <table class="table table-hover text-secondary" style="font-size: .8rem; scroll-behavior: auto;">
                                    <thead>
                                        <tr>
                                            <th><span>Nom</span></th>
                                            <th><span>Prénom</span></th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <?php $liste = 0 ?>
                                        @foreach($pers_a_charges as $pers_a_charge)
                                            @if (date("Y") - $pers_a_charge->year >= 16)
                                                <?php $liste++ ?>
                                                <tr class='my-5' onClick="setContactUrgence({{ $pers_a_charge->id }}, '{{ $pers_a_charge->nom }}',
                                                '{{ $pers_a_charge->prenom }}', {{ $pers_a_charge->relation_id }})">
                                                    <td>
                                                        {{ $pers_a_charge->nom }}
                                                    </td>
                                                    <td>
                                                        {{ $pers_a_charge->prenom }}
                                                    </td>
                                                <tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div id='ctlistpcharge{{ $stagiaire->id }}'>
                                <div class="modal-header">
                                    <h6 class="" id="modal_text_contact"
                                    onClick="removeSetContactUrgence()">Ajouter un contact d'urgence</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close" onClick="removeSetContactUrgence()"></button>
                                </div>
                                <form action="{{ route('refresh_contactUrgence') }}" method="POST">
                                    @csrf
                                    <div class="modal-body mx-2">
                                        <input type="hidden" name="contact_urgence_id"
                                        id="id_contact_urgence{{$stagiaire->id}}" value="">
                                        <input type="hidden" name="suppr_pers_a_charge_id" id="id-suppr-pers-a-charge{{$stagiaire->id}}" disabled>
                                        <input type="hidden" name="employer_id" value="{{$stagiaire->id}}">
                                        <input type="hidden" name="contact_pers_a_charge_id" id="id-pers-contact-urgence{{$stagiaire->id}}">
                                        <input type="hidden" name="input_contact_urgence" value='add'/>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstName" class="form-label label_form-2">
                                                    Nom *
                                                </label>
                                                <input type="text" name="nom" id="idFirstNameContactUrgence{{$stagiaire->id}}" class="form-control
                                                input_form border-bottom p-0 pb-2" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="firstName" class="form-label label_form-2">
                                                    Prénom
                                                </label>
                                                <input type="text" name="prenom" id="idLastNameContactUrgence{{$stagiaire->id}}" class="form-control
                                                input_form border-bottom p-0 pb-2">
                                            </div>
                                            <div class="mb-3">
                                                <label for="Etat" class="form-label label_form-2">
                                                    Relation *
                                                </label>
                                                <select class="form-select input_form p-0 pb-2 border-bottom text-secondary"
                                                name="relation_id" id="relationIdContactUrgence{{$stagiaire->id}}" required>
                                                    <option value="">--Selectionner--</option>
                                                    @foreach($pers_relations as $statut)
                                                        <option value="{{ $statut->id }}">{{ $statut->relation }}</option>
                                                    @endforeach
                                                    <option value="" disabled>Autres</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                    <label for="pFixe" class="form-label label_form-2">
                                                        Télephone fixe
                                                    </label>
                                                    <input type="tel" name="tel_fixe" id="cu_tel_fixe{{$stagiaire->id}}" class="form-control
                                                    input_form border-bottom p-0 pb-2">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="mobile" class="form-label label_form-2">
                                                        Télephone mobile
                                                    </label>
                                                    <input type="tel" name="tel_mobile" id="cu_tel_mobile{{$stagiaire->id}}" class="form-control
                                                    input_form border-bottom p-0 pb-2"required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="pTravail" class="form-label label_form-2">
                                                        Télephone travail
                                                    </label>
                                                    <input type="tel" name="tel_travail" id="cu_tel_travail{{$stagiaire->id}}" class="form-control
                                                    input_form border-bottom p-0 pb-2">
                                                </div>

                                                <input type="hidden" name="pers_a_charge_id" id="idPers" class="form-control
                                                input_form border-bottom p-0 pb-2" value="">

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="row col-md-12">
                                                <p class="text-start col-md-2" style="font-size: 11px;">* Requis</p>
                                                <div class="col-md-10 text-end">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onClick="removeSetContactUrgence()">Annuler</button>
                                                    <button type="submit" class="btn text-white" style="background:#16B84E;"
                                                    onClick="enableSauvegardeContactUrgence()">Enregistrer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal text-secondary" id="Modal_suppr_contact_urgence" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="border-radius: 30%;">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('delete_contactUrgence') }}" method="POST">
                            @csrf
                            <div class="modal-body mx-2">
                                <input type="hidden" name="contact_urgence_id"
                                id="id-contact-urgence-suppr{{$stagiaire->id}}">
                                <input type="hidden" name="cu_pers_a_charge_id"
                                id="id-cu-pers-a-charge-suppr{{$stagiaire->id}}">
                                <div class="col-md-12 my-3">
                                    <div class="mb-3">
                                        Voulez vous supprimer?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Non</button>
                                            <button type="submit" class="btn text-white ms-2" style="background:#16B84E;">Oui</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show m-1 mt-4" id="pers_materiels{{$stagiaire->id}}">
                <div class="col-md-12">
                    <button class="btn float-end text-white" type="button" style="background:#33cc00;" data-bs-toggle="modal" data-bs-target="#add_Mat">
                        <i class='bx bx-plus-medical' style="fill: white;"></i>
                    </button>
                </div>
                <div class="table-responsive">
                    @if(count($materiels) >0)
                    <table class="table table-hover text-secondary" id="table_materiels" class="img-circle" style="font-size: .8rem;" >
                        <thead>
                            <tr>
                                <th><span>Code</span></th>
                                <th><span>Description</span></th>
                                <th><span>Numéro de série</span></th>
                                <th><span>Date</span></th>
                                <th><span>Statut</span></th>
                            </tr>
                        </thead>
                        <tbody id="liste_employes">
                            @foreach ($materiels  as $m)
                                <tr class="p-1 detail_employes" id="{{$m->id}}">
                                    <td>{{$m->code}}</td>
                                    <td><img src="{{asset('img/materiels/'.$m->lien_image)}}" width='30'/> {{$m->description}} </td>
                                    <td>{{$m->num_serie}}</td>
                                    <td>{{$m->date}}</td>
                                    <td>
                                        @if ($m->date_fin)
                                            <i class='bx bxs-circle  text-success' style="font-size:10px" title="rendu"></i>
                                        @else
                                            <a href="#">
                                                <i class='bx bxs-checkbox-minus text-danger' title="Rendre"
                                                    onclick="setIdMateriel({{$m->id}})" data-bs-toggle="modal" data-bs-target="#Modal_confirmation_date_fin"
                                                ></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                </div>
                <div class="modal fade" id="add_Mat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content text-secondary">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel">Ajouter un matériel</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('ajout_materiel')}}" method="post">
                            @csrf
                                <div class="modal-body">
                                    <div class="row col-md-12">
                                        <div class="mb-3">
                                            <input type="hidden" class="form-control" name="employer_id" id="employer_id" value="{{$employer_id}}" >
                                            <label>Matériel</label>
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-control input_form p-0 text-secondary" name="materiel" id="materiel" required>
                                                <option selected value="">--Sélectionner le matériel--</option>
                                                @foreach($type_materiels as $t_m)
                                                <option value="{{$t_m->id}}">{{$t_m->description}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    <div class="mb-3">
                                        <label for="date">Numéro de série</label>
                                        <input type="text" name="num_serie"  id="num_serie"
                                        class="form-control input_form border-bottom p-0 pb-2" required>
                                    </div>
                                    <div class="mb-5">
                                        <label for="date">Date de récupération</label>
                                        <input type="date" name="date_recup"  id="date_recup" class="form-control input_form p-0 pb-2 border-bottom text-secondary" value="<?php echo date('Y-m-d'); ?>"  >
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn text-white" style="background:#16B84E;">Enregistrer</button>
                            </div>
                            </form>
                       </div>
                    </div>
                </div>
            </div>

            <!-- Modal_confirmation -->
            <div class="modal text-secondary" id="Modal_confirmation_date_fin" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true"
                style="border-radius: 30%;"
                >
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body mx-2">
                            <div class="col-md-12 my-3">
                                <div class="mb-3">
                                    Voulez vous confirmer?
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal" >Non</button>
                                        <a class="btn  btn-success text-white"id="confirmMat" href="#">
                                            Oui
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal_confirmation_fin -->
        </div>
    </div>
</div>

<script>

function setIdMateriel(idMat){
    $route="rendre+materiel/";
    $('#confirmMat').attr('href',$route+idMat);
    console.log($('#confirmMat').attr('href'));;
    $('#oui').attr('href',$route+idMat);;
}

// Datatable materiels
$(document).ready(function () {
    if ({{ $liste }}) {
        $('#listpcharge{{ $stagiaire->id }}').removeClass('d-none');
        $('#listpcharge{{ $stagiaire->id }}').addClass('col-md-4');
        $('#ctlistpcharge{{ $stagiaire->id }}').removeClass('col-md-12');
        $('#ctlistpcharge{{ $stagiaire->id }}').addClass('col-md-8');
    } else {
        $('#listpcharge{{ $stagiaire->id }}').addClass('d-none');
        $('#listpcharge{{ $stagiaire->id }}').removeClass('col-md-4');
        $('#ctlistpcharge{{ $stagiaire->id }}').addClass('col-md-12');
        $('#ctlistpcharge{{ $stagiaire->id }}').removeClass('col-md-8');
    }
    $('#table_materiels').DataTable({
        'bSort': false,
        dom: '<"top">rt<"bottom"lp><"clear">',
        dom: "<'row'<'col-lg-4 col-md-6 col-sm-12 mb-2 d-flex " +
        "justify-content-start'l><'col-md-3 d-flex justify-content-start'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-6'p>>",
        pageLength : 7,
        lengthMenu: [[7, 10, 20, -1], [7, 10, 20, 'Tout']],
        "language": {
            "url":"/assets/Json/french.json"
        }
    });
    $('.btn_racourcis').on('click',function(e){
        var titre = $(this).find('.text_racourcis').text();
        if (titre == "Informations") {
            $("#Informations").attr("href", "{{ route('detail.employe',$employer_id)}}" );
        } else if(titre== "Emploi"){
            $("#Emploi").attr("href", "{{ route('detail.emploi',$employer_id)}}" );
        }
        else if(titre =="Salaire"){
            $("#Salaire").attr("href", "{{ route('detail.salaire',$employer_id)}}" );
        }
        else if(titre == "Sanction"){
            $("#Sanction").attr("href", "{{ route('detail.sanction',$employer_id)}}" );
        }
    });
});
// fin datatable materiels

    let idP;
    let isCheck;
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let lien = ($(e.target).attr('href'));
        localStorage.setItem('indicecfp', lien);
    });
    let tabActive = localStorage.getItem('indicecfp');
    if (tabActive)   {
        $('#myTab a[href="' + tabActive + '"]').tab('show');
        $('#myTab a[href="' + tabActive + '"]').addClass('active');
    }
    function mainInfo(id) {
        if (id.length!=0) {
            $('#permisCateg{{$stagiaire->id}}').removeClass('collapse');
        }
        if (id.length==0) {
            $('#permisCateg{{$stagiaire->id}}').addClass('collapse');
        }
    }
    function persInfo(idEmp, nomPers, prenomPers, relationIdPers, idPers) {
        idP = idPers;
        isCheck = document.getElementById('check-contact-urgence' + idPers).checked;
        if (isCheck) {
            $('#check-contact-urgence' + idPers).attr('data-bs-target', '#Modal_Pers_a_charge_contact_urgence');
            $('#idPers' + idEmp).val(idPers);
            $('#name-p-contact-urgence' + idEmp).val(nomPers);
            $('#last-name-p-contact-urgence' + idEmp).val(prenomPers);
            $('#idRelation' + idEmp).val(relationIdPers);
        }
        else {
            $('#check-contact-urgence' + idPers).attr('data-bs-target', '#Modal_en_tant_que_suppr_contact_urgence');
            $('#idP' + idEmp).val(idPers);
        }
    }
    function onOffCheck() {
        if (!isCheck)
            document.getElementById('check-contact-urgence' + idP).checked = true;
        else
            document.getElementById('check-contact-urgence' + idP).checked = false;
    }
    function condition_status() {
        $('#sauvegarde-detail-contact{{$stagiaire->id}}').attr('disabled', false);
        if ($('#marital_status{{$stagiaire->id}}').val()==2) {
            $('#date_mariage{{$stagiaire->id}}').removeClass('collapse');
            $('input[id="date_mariage{{ $stagiaire->id }}"]').attr('required', 'required');
            $('#tel{{$stagiaire->id}}').addClass('ms-1');
        }
        else {
            $('#date_mariage{{$stagiaire->id}}').addClass('collapse');
            $('input[id="date_mariage{{ $stagiaire->id }}"]').removeAttr('required');
            $('#tel{{$stagiaire->id}}').removeClass('ms-1');
        }
    }
    function editPersACharge(id, nom, prenom, dtn, rId, cu) {
        $('#id-pers-a-charge{{$stagiaire->id}}').val(id);
        $('#contact-urgence-pers-a-charge{{$stagiaire->id}}').val(cu);
        $('#name-pers-a-charge{{$stagiaire->id}}').val(nom);
        $('#last-name-pers-a-charge{{$stagiaire->id}}').val(prenom);
        $('#dtn-pers-a-charge{{$stagiaire->id}}').val(dtn);
        $('#relation-pers-a-charge{{$stagiaire->id}}').val(rId);
    }
    function deletePersACharge(id) {
        $('#id-pers-a-charge-suppr{{$stagiaire->id}}').val(id);
    }
    function removeSetPersACharge() {
        $('#id-pers-a-charge{{$stagiaire->id}}').val("");
        $('#contact-urgence-pers-a-charge{{$stagiaire->id}}').val(0);
        $('#name-pers-a-charge{{$stagiaire->id}}').val("");
        $('#last-name-pers-a-charge{{$stagiaire->id}}').val("");
        $('#dtn-pers-a-charge{{$stagiaire->id}}').val("");
        $('#relation-pers-a-charge{{$stagiaire->id}}').val("");
    }
    function setContactUrgence(idPers, nomPers, prenomPers, idRelation) {
        $('#id-pers-contact-urgence{{$stagiaire->id}}').val(idPers);
        $('#idFirstNameContactUrgence{{$stagiaire->id}}').val(nomPers);
        $('#idLastNameContactUrgence{{$stagiaire->id}}').val(prenomPers);
        $('#relationIdContactUrgence{{$stagiaire->id}}').val(idRelation);
        $('#idFirstNameContactUrgence{{$stagiaire->id}}').prop('readOnly', true);
        $('#idLastNameContactUrgence{{$stagiaire->id}}').prop('readOnly', true);
        $('#relationIdContactUrgence{{$stagiaire->id}}').attr("disabled", true);
    }
    function editContactUrgence(id, nom, prenom, rId, tel_fixe, tel_mobile, tel_travail, pers_a_charge_id=null) {
        $('#id_contact_urgence{{$stagiaire->id}}').val(id);
        $('#idFirstNameContactUrgence{{$stagiaire->id}}').val(nom);
        $('#idLastNameContactUrgence{{$stagiaire->id}}').val(prenom);
        $('#relationIdContactUrgence{{$stagiaire->id}}').val(rId);
        $('#cu_tel_fixe{{$stagiaire->id}}').val(tel_fixe);
        $('#cu_tel_mobile{{$stagiaire->id}}').val(tel_mobile);
        $('#cu_tel_travail{{$stagiaire->id}}').val(tel_travail);
        $('#id-pers-contact-urgence{{$stagiaire->id}}').val(pers_a_charge_id);
        $('#id-suppr-pers-a-charge{{$stagiaire->id}}').attr("disabled", false);
        if (pers_a_charge_id!=null) {
            $('#id-suppr-pers-a-charge{{$stagiaire->id}}').val(pers_a_charge_id);
            $('#idFirstNameContactUrgence{{$stagiaire->id}}').prop('readOnly', true);
            $('#idLastNameContactUrgence{{$stagiaire->id}}').prop('readOnly', true);
            $('#relationIdContactUrgence{{$stagiaire->id}}').attr("disabled", true);
        }
        else {
            $('#idFirstNameContactUrgence{{$stagiaire->id}}').prop('readOnly', false);
            $('#idLastNameContactUrgence{{$stagiaire->id}}').prop('readOnly', false);
            $('#relationIdContactUrgence{{$stagiaire->id}}').attr("disabled", false);
        }
    }
    function deleteContactUrgence(id, id_pers_a_charge=null) {
        $('#id-contact-urgence-suppr{{$stagiaire->id}}').val(id);
        $('#id-cu-pers-a-charge-suppr{{$stagiaire->id}}').val(id_pers_a_charge);
    }
    function removeSetContactUrgence() {
        $('#id_contact_urgence{{$stagiaire->id}}').val("");
        $('#id-pers-contact-urgence{{$stagiaire->id}}').val("");
        $('#id-suppr-pers-a-charge{{$stagiaire->id}}').val("");
        $('#contact_pers_a_charge_id{{$stagiaire->id}}').val("");
        $('#idFirstNameContactUrgence{{$stagiaire->id}}').val("");
        $('#idLastNameContactUrgence{{$stagiaire->id}}').val("");
        $('#relationIdContactUrgence{{$stagiaire->id}}').val("");
        $('#cu_tel_fixe{{$stagiaire->id}}').val("");
        $('#cu_tel_mobile{{$stagiaire->id}}').val("");
        $('#cu_tel_travail{{$stagiaire->id}}').val("");
        enableSauvegardeContactUrgence();
    }
    function enableSauvegardeContactUrgence() {
        $('#idFirstNameContactUrgence{{$stagiaire->id}}').prop('readOnly', false);
        $('#idLastNameContactUrgence{{$stagiaire->id}}').prop('readOnly', false);
        $('#relationIdContactUrgence{{$stagiaire->id}}').attr("disabled", false);
    }
    function enableSauvegardeDetailPers() {
        $('#sauvegarde-detail-pers{{ $stagiaire->id }}').attr('disabled', false);
    }
    function enableSauvegardeOrganismeSocial() {
        $('#sauvegarde-organisme-social{{ $stagiaire->id }}').attr('disabled', false);
    }
    function enableSauvegardeDetailContact() {
        $('#sauvegarde-detail-contact{{$stagiaire->id}}').attr('disabled', false);
    }

    $("#AutretypeAllergie").hide();
    $("#typeintolerance").hide();
    $("#maladiechronique").hide("slow");
    $("#ListTypeAllergie").hide();
    $("#oui").click(function() {
        $("#ListTypeAllergie").show("slow");
    });
    $("#non").click(function() {
        $("#ListTypeAllergie").hide("slow");
        $("#AutretypeAllergie").hide();
    });

    // $("#autre1").click(function() {
    //     $("#typeintolerance").show("slow");
    // });

    function displayVals() {
        var singleValues0 = $("#select0").val();
        var singleValues = $("#select1").val();
        var singleValues2 = $("#select2").val();
        // var multipleValues = $("#multiple").val() || [];
        // When using jQuery 3:
        // var multipleValues = $( "#multiple" ).val();
        if (singleValues0 == "autre") {
            $("#AutretypeAllergie").show("slow");
        } else {
            $("#AutretypeAllergie").hide("slow");
        }
        if (singleValues == "3") {
            $("#typeintolerance").show("slow");
        } else {
            $("#typeintolerance").hide("slow");
        }
        if (singleValues2 == "3") {
            $("#maladiechronique").show("slow");
        } else {
            $("#maladiechronique").hide("slow");
        }
    }

    $("select").change(displayVals);

    $('#updateFile{{ $stagiaire->id }}').on('change', (e) => {
        enableSauvegardeDetailPers();
        let that = e.currentTarget
        if (that.files && that.files[0]) {
            $(that).next('.custom-file-label').html(that.files[0].name)
            let reader = new FileReader()
            reader.onload = (e) => {
                $('#img{{ $stagiaire->id }}').attr('src', e.target.result)
            }
            reader.readAsDataURL(that.files[0])
        }
    });
</script>

@endsection

