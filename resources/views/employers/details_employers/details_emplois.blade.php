@extends('layouts.master_page')
@section('title')

@endsection
@section('content')
<style>
    .form-control{
        font-size: .9rem;
    }
</style>
<div class="col-md-12 my-2 m-3 p-2" style="border-radius: 20px;">
    <div class="mx-3" >
        <ul class="nav nav-tabs mx-4 pt-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <span class="nav-link active" id="detail_emploi" data-bs-toggle="pill" data-bs-target="#emploi_details" type="button" role="tab" aria-controls="emploi_details" aria-selected="true">Détail d'emploi</span>
            </li>
            <li class="nav-item" role="presentation">
                <span class="nav-link" id="historique_emploi" data-bs-toggle="pill" data-bs-target="#histo_emploi" type="button" role="tab" aria-controls="histo_emploi" aria-selected="false">Historique d'emploi</span>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active text-secondary" id="emploi_details" role="tabpanel" aria-labelledby="detail_emploi">
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
                        <div class="form-check form-switch" id="detail_contrat">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
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
                            <input class="form-check-input" type="checkbox" id="demissionEmploye" checked>
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
        </div>


        <div class="tab-pane fade" id="histo_emploi" role="tabpanel" aria-labelledby="historique_emploi">
                <div class="col-md-12 text-end">
                    <button class="btn text-white" type="button" style="background:#16B84E;" data-bs-toggle="modal" data-bs-target="#ajoutDetailEmplois">Nouvelle historique d'emploi</button>
                </div>
                @if (count($histo_emplois)>0)
                    <div class="table-responsive mt-2 p-2">
                        <table class="table table-hover text-secondary" style="font-size: .9rem;">
                            <thead >
                                <tr>
                                    <th>Evenement</th>
                                    <th>À compter de</th>
                                    <th>Changé de</th>
                                    <th>Changé en</th>
                                </tr>
                            </thead>
                            <tbody >
                                @foreach ($histo_emplois as $histo_emploi)
                                <tr>
                                    <td>{{$histo_emploi->evenement}}</td>
                                    <td>{{\Carbon\Carbon::parse($histo_emploi->date_changement_fonction)->translatedFormat("l j F Y")}}</td>
                                    <td>{{$histo_emploi->ancien_fonction}}</td>
                                    <td>{{$histo_emploi->new_fonct}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ajoutDetailEmplois" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Détail d'emploi- Confirmer les changements</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_ajoutNewHistoEmploi">
                @csrf
                <div class="modal-body">
                    <div class="col-md-11 m-auto text-secondary" style="font-size: .8rem;">
                        <input type="hidden" name="id" id="employer_id" value="{{$employer_id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Evénement *:</label>
                                    <select class="form-control text-secondary" name="evenement" id="evenement_emploi">
                                        <option selected disabled>--- Sélectionnez ---</option>
                                        @foreach ($events as $event)
                                            <option value="{{$event->id}}"><span>{{$event->description}}</span></option>
                                        @endforeach
                                        {{-- <option value="autre">Autre</option> --}}
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Dernière fonction:</label>
                                    <input type="text" class="form-control text-secondary" id="ancien_fonct" value="{{$old_fonct->fonction_stagiaire}}" disabled>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Statut d'emploi:</label>
                                    <input type="hidden" name="ancien_statut" id="ancien_statut" value="{{$old_fonct->statut_emploi_id}}">
                                    <input type="text" class="form-control text-secondary" value="{{$old_fonct->statut_emploi_stagiaire}}" disabled>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Catégorie d'emploi:</label>
                                    <input type="hidden" name="ancien_catg" id="ancien_catg" value="{{$old_fonct->categorie_emploi_id}}">
                                    <input type="text" class="form-control text-secondary" value="{{$old_fonct->categorie_emploi_stagiaire}}" disabled>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Groupe d'emploi:</label>
                                    <input type="hidden" name="ancien_groupe" id="ancien_groupe" value="{{$old_fonct->groupe_emploi_id}}">
                                    <input type="text" class="form-control text-secondary" value="{{$old_fonct->groupe_emploi}}" disabled>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Service:</label>
                                    <input type="hidden" name="ancien_service" id="ancien_service" value="{{$old_fonct->service_id}}">
                                    <input type="text" class="form-control text-secondary" value="{{$old_fonct->nom_service}}" disabled>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Département:</label>
                                    <input type="hidden" name="ancien_dept" id="ancien_dept" value="{{$old_fonct->departement_entreprises_id}}">
                                    <input type="text" class="form-control text-secondary" value="{{$old_fonct->nom_departement}}" disabled>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Branche:</label>
                                    <input type="hidden" name="ancien_branche" id="ancien_branche" value="{{$old_fonct->branche_id}}">
                                    <input type="text" class="form-control text-secondary" value="{{$old_fonct->nom_branche}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Changement à partir de *:</label>
                                    <input type="date" id="date_changement" class="form-control text-center text-secondary">
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Changé à*:</label>
                                    <select class="form-control text-secondary" name="fonction_id" id="fonction_id">
                                        <option selected disabled>--- Sélectionnez ---</option>
                                        @foreach ($fonctions as $fonction)
                                            <option value="{{$fonction->id}}"><span>{{$fonction->nom_fonction}}</span></option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Changé à*:</label>
                                    <select class="form-control text-secondary" name="statut_emploi_id" id="statut_emploi_id">
                                        <option selected disabled>--- Sélectionnez ---</option>
                                            @foreach ($statut_emplois as $statut_emploi)
                                                <option value="{{$statut_emploi->id}}">{{$statut_emploi->statut_emploi}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Changé à*:</label>
                                    <select class="form-control text-secondary" name="catg_emploi_id" id="catg_emploi_id">
                                        <option selected disabled>--- Sélectionnez ---</option>
                                            @foreach ($catg_emplois as $catg_emploi)
                                                <option value="{{$catg_emploi->id}}">{{$catg_emploi->categorie_emploi}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Changé à*:</label>
                                    <select class="form-control text-secondary" name="groupe_emploi_id" id="groupe_emploi_id">
                                        <option selected disabled>--- Sélectionnez ---</option>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Changé à*:</label>
                                    <select class="form-control text-secondary" name="service_id" id="service_id">
                                        <option selected disabled>--- Sélectionnez ---</option>
                                            @foreach ($services as $service)
                                                <option value="{{$service->id}}"><span>{{$service->nom_service}}</span></option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Changé à*:</label>
                                    <select class="form-control text-secondary" name="dept_id" id="dept_id">
                                        <option selected disabled>--- Sélectionnez ---</option>
                                            @foreach ($departements as $dept)
                                                <option value="{{$dept->id}}">{{$dept->nom_departement}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Changé à*:</label>
                                    <select class="form-control text-secondary" name="branche_id" id="branche_id">
                                        <option selected disabled>--- Sélectionnez ---</option>
                                            @foreach ($branches as $branche)
                                                <option value="{{$branche->id}}"><span>{{$branche->nom_branche}}</span></option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn text-white" id="ajoutNewHistoEmploi" style="background:#16B84E;">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <script>
        $('#fiche_contrat').hide();
        $('input[type="checkbox"]').attr("checked", false);

        $('#flexSwitchCheckChecked').on('click',function(){
            var inputCheck = $(this).attr("checked",true);
            if(inputCheck){
                $('#fiche_contrat').toggle();
            }
        });

        $('#fiche_demission').hide();
        $('#demissionEmploye').on('click',function(){
            var inputCheck = $(this).attr("checked",true);
            if(inputCheck){
                $('#fiche_demission').toggle();
            }
        });


        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#catg_emploi_id').on('change',function(){
                var categ_id = $(this).val();
                $('#groupe_emploi_id').empty();
                if (categ_id == 36) {
                    $.ajax({
                        type:"GET",
                        dataType: 'json',
                        url:"/getGroupeEmploi/"+categ_id,
                        success:function(response){
                            var data = response['groupes'];
                            $.each(data,function(key,value){
                                $('#groupe_emploi_id').append("<option value="+value.id+">"+value.groupe_emploi+"</option>");
                            });
                        }
                    });
                } else {
                    $.ajax({
                        type:"GET",
                        dataType: 'json',
                        url:"/getGroupeEmploi/"+categ_id,
                        success:function(response){
                            var data = response['groupe'];
                            $.each(data,function(key,value){
                                $('#groupe_emploi_id').append("<option value="+value.groupe_emploi_id+">"+value.groupe_emploi+"</option>");
                            });
                        }
                    });
                }
            });

            $('#ajoutNewHistoEmploi').on('click',function(){
                var employer_id = $("#employer_id").val();
                var evenement_emploi = $("#evenement_emploi").val();
                var ancien_fonct = $("#ancien_fonct").val();
                var ancien_statut = $("#ancien_statut").val();
                var ancien_catg = $("#ancien_catg").val();
                var ancien_groupe = $('#ancien_groupe').val();
                var ancien_service = $('#ancien_service').val();
                var ancien_dept = $("#ancien_dept").val();
                var ancien_branche = $("#ancien_branche").val();
                var date_changement = $('#date_changement').val();
                var fonction_id = $('#fonction_id').val();
                var statut_emploi_id = $('#statut_emploi_id').val();
                var catg_emploi_id = $('#catg_emploi_id').val();
                var groupe_emploi_id = $('#groupe_emploi_id').val();
                var service_id = $('#service_id').val();
                var dept_id = $('#dept_id').val();
                var branche_id =$('#branche_id').val();


                if (evenement_emploi== "" || date_changement== "" ) {
                    alert();

                }else{
                    $.post('/ajout_historique_emploi',{employer_id:employer_id,evenement_emploi:evenement_emploi,
                           ancien_fonct:ancien_fonct,ancien_statut:ancien_statut,ancien_catg:ancien_catg,ancien_groupe:ancien_groupe,
                            ancien_dept:ancien_dept,ancien_branche:ancien_branche,date_changement:date_changement,
                            fonction_id:fonction_id,statut_emploi_id:statut_emploi_id,catg_emploi_id:catg_emploi_id,service_id:service_id,
                            groupe_emploi_id:groupe_emploi_id,dept_id:dept_id,branche_id:branche_id},function(){
                        $('#form_ajoutNewHistoEmploi')[0].reset();
                        $('#ajoutDetailEmplois').modal('hide');
                        location.reload();
                    });
                }
            });


            $('#form_contrat').on('submit',function(){
                $.validator.addMethod('filesize', function (value, element, param) {
                    return this.optional(element) || (element.files[0].size <= param)
                }, 'File size must be less than {0}');
                jQuery(function ($) {
                    "use strict";
                    $("#form_contrat").validate({
                        rules: {
                            debut_contrat:{
                                required:true,
                                date:true
                            },
                            type_contrat:{
                                required:true,
                            },
                            description: {
                                required: true,
                            },
                            date_perm: {
                                date: true
                            },
                            contrat_file: {
                                required: true,
                                filesize : 2457600
                            }
                        },
                        messages: {
                            debut_contrat: {
                                required: "Veuillez entrer la date d'adhésion !",
                                date:"Veuillez entrer une date correcte !"
                            },
                            type_contrat: "Veuillez entrer le type du contrat",
                            description: "Veuillez entrer la description du contrat",
                            date_perm: {
                                date:"Veuillez entrer une date correcte !"
                            },
                            contrat_file: {
                                required:"Veuillez ajouter une pièce jointe !",
                                filesize :"Taille maximum 300 KB!"
                            }
                        },
                        submitHandler: function(form){
                            form.submit();
                        }
                    });
                });
            });

            // $('#form_demission').on('submit',function(){
            //     $.validator.addMethod('filesize', function (value, element, param) {
            //         return this.optional(element) || (element.files[0].size <= param)
            //     }, 'File size must be less than {0}');
            //     jQuery(function ($) {
            //         "use strict";
            //         $("#form_demission").validate({
            //             rules: {
            //                 date_demission:{
            //                     required:true,
            //                     date:true
            //                 },
            //                 num_contrat:"",
            //                 lettre_dem: {
            //                     required: true,
            //                     filesize : 2457600
            //                 }
            //             },
            //             messages: {
            //                 date_demission: {
            //                     required: "Veuillez entrer la date d'adhésion !",
            //                     date:"Veuillez entrer une date correcte !"
            //                 },
            //                 num_contrat:"",
            //                 lettre_dem: {
            //                     required:"Veuillez ajouter une pièce jointe !",
            //                     filesize :"Taille maximum 300 KB!"
            //                 }
            //             },
            //             submitHandler: function(form){
            //                 form.submit();
            //             }
            //         });
            //     });
            // });
        $(document).ready(function(){
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
        });
    </script>
@endsection
