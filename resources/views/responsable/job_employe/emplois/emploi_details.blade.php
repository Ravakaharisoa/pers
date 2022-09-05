<div class="row m-2 p-1">
    <div class="col-md-8 mx-1">
        <div class="row col-md-11 m-1 p-3 card_salaire">
            <div class="col-md-7">
                <h6 class="fw-bold">{{$old_fonct->fonction_stagiaire}}</h6>
                <span class="fs-6">Date d'entrée initiale :
                    @if($contrat)
                        {{\Carbon\Carbon::parse($contrat->date_embauche)->translatedFormat("l j F Y")}}
                    @else
                        ---
                    @endif
                </span>
            </div>
            <div class="col-md-5 text-end">
                <h6 class="fw-bold">
                    {{$old_fonct->nom_departement}}
                </h6>
                <span class="mt-2">{{$old_fonct->nom_service}}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 mx-1">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
           <i class='bx bxs-check-circle bx-md'></i> {{ session('success') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
    </div>
</div>
<div class="row m-2 p-2 fw-bold" style="font-size: .8rem;">
    <div class="row col-md-12">
        <div class="col-md-4">
            <div class="form-group m-2 mb-3">
                <label for="">Date d'adhésion</label>
                @if ($contrat)
                    <input type="date" name="date_adhesion" class="form-control text-secondary form-control-lg mt-2" value="{{$contrat->date_embauche}}"  disabled>
                @else
                    <input type="date" name="date_adhesion" class="form-control text-secondary form-control-lg mt-2" value=""  disabled>
                @endif

            </div>
        </div>
        <div class="col-md-4 ">
           <div class="form-group m-2 mb-3">
            <label for="">Date de fin de probation</label>
            @if ($contrat)
                <input type="date" name="date_fin_probation" class="form-control text-secondary form-control-lg mt-2" value="{{$contrat->date_fin}}" disabled>
            @else
            <input type="date" name="date_fin_probation" class="form-control text-secondary form-control-lg mt-2" value="" disabled>
            @endif

           </div>
        </div>
        <div class="col-md-4 ">
            <div class="form-group m-2 mb-3">
                <label for="">Date de permanence</label>
                @if ($contrat)
                    <input type="date" id="" class="form-control text-secondary form-control-lg mt-2" value="{{ $contrat->date_permanence }}" disabled>
                @else
                    <input type="date" id="" class="form-control text-secondary form-control-lg mt-2" disabled>
                @endif

            </div>
        </div>
    </div>
    <div class="row col-md-12">
        <div class="col-md-4">
            <div class="form-group m-2 mb-3">
                <label for="">Departement</label>
                <input type="text" class="form-control text-secondary form-control-lg mt-2" value="{{$old_fonct->nom_departement}}" disabled>
            </div>
        </div>
        <div class="col-md-4 ">
           <div class="form-group m-2 mb-3">
                <label for="">Service</label>
                <input type="text" class="form-control text-secondary form-control-lg mt-2" value="{{$old_fonct->nom_service}}" disabled>
           </div>
        </div>
        <div class="col-md-4 ">
            <div class="form-group m-2 mb-3">
                <label for="">Branche</label>
                <input type="text" class="form-control text-secondary form-control-lg mt-2" value="{{$old_fonct->nom_branche}}" disabled>
            </div>
        </div>
    </div>
    <div class="row col-md-12">
        <div class="col-md-4">
            <div class="form-group m-2 mb-3">
                <label for="">Statut d'emploi</label>
                <input type="text" class="form-control text-secondary form-control-lg mt-2" value="{{$old_fonct->statut_emploi_stagiaire}}" disabled>
            </div>
            <div class="form-group m-2 mb-3">
                <label for="">Groupe d'emploi</label>
                <input type="text" class="form-control text-secondary form-control-lg mt-2" value="{{$old_fonct->groupe_emploi}}" disabled>
            </div>
        </div>
        <div class="col-md-4 ">
           <div class="form-group m-2 mb-3">
                <label for="">Titre d'emploi</label>
                <input type="text" class="form-control text-secondary form-control-lg mt-2" value="{{$old_fonct->fonction_stagiaire}}" disabled>
           </div>
           <div class="form-group m-2 mb-3">
            <label for="">Ancienté </label>
            @if ($contrat)
                @php
                    $date_embauche = \Carbon\Carbon::createFromDate($contrat->date_embauche);
                    $now = \Carbon\Carbon::now();
                    $anciente = $date_embauche->diffInDays($now);
                @endphp
                <input type="text" class="form-control text-secondary form-control-lg mt-2" value="{{$anciente}} jours" disabled>
            @else
                <input type="text" class="form-control text-secondary form-control-lg mt-2" value="" disabled>
            @endif


       </div>
        </div>
        <div class="col-md-4 ">
            <div class="form-group m-2 mb-3">
                <label for="">catégorie d'emploi</label>
                <input type="text" class="form-control text-secondary form-control-lg mt-2" value="{{$old_fonct->categorie_emploi_stagiaire}}" disabled>
            </div>
        </div>
    </div>

    <hr class="my-3">
</div>

<div class="row m-2 p-1" style="font-size: .8rem;">
    <div class="row col-md-12">
        <div class="col-md-4 d-flex">
            <div class="flex-grow-1">
                <span class="fst-italic">Inclure les détails du contrat de travail</span>
            </div>
            <div class="form-check form-switch" id=detail_contrat">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
            </div>
        </div>
    </div>
    <form action="{{route('noveau_contrat')}}" id="form_contrat" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row" id="fiche_contrat">
            <div class="row col-md-12">
                <input type="hidden" name="employer_id" id="employe_id" value="{{$employer_id}}">
                <div class="col-md-4">
                    <div class="form-group m-2 mb-3 ">
                        <label for="debut_contrat">Date de début du contrat</label>
                        <input type="date" name="debut_contrat" id="debut_contrat" class="form-control text-secondary form-control-lg mt-2">
                    </div>
                    <div class="form-group m-2 mb-3">
                        <label for="type_contrat">Type de contrat</label>
                        <select name="type_contrat" id="type_contrat" class="form-control text-secondary form-control-lg mt-2">
                            <option selected>-- Sélectionnez --</option>
                            @foreach ($types_contrat as $type_contrat)
                                <option value="{{$type_contrat->id}}">{{$type_contrat->type_contrat}} ({{$type_contrat->reference}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group m-2 mb-3">
                        <label for="fin_contrat">Date de fin du contrat</label>
                        <input type="date" class="form-control text-secondary form-control-lg mt-2" id="fin_contrat" name="fin_contrat">
                    </div>
                    <div class="form-group m-2 mb-3">
                        <label for="description">Description</label>
                        <input type="text" class="form-control text-secondary form-control-lg mt-2" id="description" name="description">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group m-2 mb-3">
                        <label for="date_perm">Date de permanence</label>
                        <input type="date" class="form-control text-secondary form-control-lg mt-2" id="date_perm" name="date_perm">
                    </div>
                    <div class="form-group m-2 mb-3">
                        <label for="contrat_file">Détails du contrat(300 kb taille max )</label>
                        <input type="file" name="contrat_file" id="contrat_file" class="form-control text-secondary form-control-lg mt-2"  accept="image/*,application/pdf">
                    </div>
                </div>

            </div>
            <div class="text-end my-2">
                <button type="submit" class="btn text-white col-md-1" style="background:#16B84E;">Sauvegarder</button>
            </div>
        </div>
    </form>
    <hr class="my-3">
    <div class="col-md-12">
        @if ($contrat)
        <h6>Pièce jointe du contrat</h6>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Fichier</th>
                        <th>Ajouter le</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $contrat->description }}</td>
                        <td><a href="{{ asset('contrats/employers/'.$contrat->nom_fichier) }}">{{ $contrat->nom_fichier }}</a></td>
                        <td>{{\Carbon\Carbon::parse($contrat->created_at)->translatedFormat("j F Y")}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endif

    </div>
</div>

<div class="row m-2 p-1 my-2" style="font-size: .8rem;">
    <div class="row col-md-12">
        <div class="col-md-4 d-flex">
            <div class="flex-grow-1">
                <span class="fst-italic">Inclure la démission d'un employé</span>
            </div>
            <div class="form-check form-switch" id="detail_demission">
                <input class="form-check-input" type="checkbox" id="demissionEmploye" >
            </div>
        </div>
    </div>
    <hr class="my-2">
    <form action="{{ route('mettre_demission') }}" method="post" id="form_demission" enctype="multipart/form-data">
        @csrf
        <div class="row" id="fiche_demission">
            <div class="row col-md-12">
                <input type="hidden" name="employer_id" id="employe_id" value="{{$employer_id}}">
                <div class="col-md-4">
                    <div class="form-group m-2 mb-3 ">
                        <label for="date_demission">Date de démission</label>
                        <input type="date" name="date_demission" id="date_demission" class="form-control text-secondary form-control-lg mt-2">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group m-2 mb-3">
                        <label for="num_contrat">Numéro du contrat </label>
                        @if ($contrat)
                            <input type="hidden" name="num_contrat" id="num_contrat" value="{{$contrat->id}}">
                            <input type="text"  value="{{$contrat->id}}" class="form-control text-secondary form-control-lg mt-2" disabled>
                        @endif

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group m-2 mb-3">
                        <label for="lettre_dem">Lettre de démission(300 kb taille max )</label>
                        <input type="file" name="lettre_dem" id="lettre_dem" class="form-control text-secondary form-control-lg mt-2"  accept="image/*,application/pdf">
                    </div>
                </div>

            </div>
            <div class="text-end my-2">
                <button type="submit" class="btn text-white col-md-1" style="background:#16B84E;">Sauvegarder</button>
            </div>
            <hr class="my-3">
        </div>
    </form>

    <div class="col-md-12">
        @if ($demission)
            <h6>Détail du démission</h6>
            <div class="table-responsive">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date de demission</th>
                            <th>Fichier</th>
                            <th>Ajouter le</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{\Carbon\Carbon::parse($demission->date_demission)->translatedFormat("j F Y")}}</td>
                            <td><a href="{{ asset('demissions/employers/'.$demission->nom_fichier) }}">{{ $demission->nom_fichier }}</a></td>
                            <td>{{\Carbon\Carbon::parse($demission->created_at)->translatedFormat("j F Y")}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
