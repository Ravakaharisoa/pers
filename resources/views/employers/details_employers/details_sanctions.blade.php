@extends('layouts.master_page')
@section('title')

@endsection
@section('content')
<div id="sanctions_disc_details">
    <div class="col-md-12">
        <button class="btn  float-end text-white" type="button" style="background:linear-gradient(60deg, #f206ee, #0765f3);" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bx-plus-medical'></i>Sanction</button>
        <ul class="nav nav-tabs mb-3 nav" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation" >
                <button class="nav-link active text-dark" style="background-color:white;"id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Sanctions en cours  <span class="rounded-2 p-1 text-white" style="background:linear-gradient(60deg, #f206ee, #0765f3);">{{count($histo_sanctions)}}</span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark" style="background-color:white;"id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Historique  sanctions  <span class="rounded-2 p-1 text-white" style="background:linear-gradient(60deg, #f206ee, #0765f3);">{{ count($histo_sanctions2)}}</span></button>
            </li>
        </ul>
        <div class="col-md-12 pt-2">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    @if(count($histo_sanctions)>0)
                    <table id="table_encours" class=" table table-hover text-secondary" class="img-circle" style="font-size: .8rem" >
                        <thead class="table-light">
                            <tr>
                                <th>Mesure administrative</th>
                                <th>Mesure disciplinaire</th>
                                <th>Sanctions</th>
                                <th>Durée  (jours)</th>
                                <th>Date début </th>
                                <th>Date fin </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="liste_employes">
                            @foreach ($histo_sanctions  as $h_s)
                                <tr class="p-1 detail_employes" id="{{$h_s->id}}">
                                    <td width="20%">{{$h_s->description}}</td>
                                    <td width="20%">{{$h_s->discipline}}</td>
                                    <td width="20%">{{$h_s->nom_saction}}</td>
                                    <td width="10%" class="text-center">{{$h_s->duree_sanction}}</td>
                                    <td width="12%">{{\Carbon\Carbon::parse($h_s->date_sanction)->translatedFormat("j F Y")}}</td>
                                    <td width="12%">
                                        @php
                                            $diff =$h_s->duree_sanction;
                                            $date_fin = date('Y-m-d', strtotime($h_s->date_sanction.' + '.$diff.' day'));
                                        @endphp
                                        {{\Carbon\Carbon::parse($date_fin)->translatedFormat("j F Y")}}
                                    </td>
                                    <td>
                                        <button class="btn text-danger p-0 m-0" title="Lever" onclick="setIdSanction({{$h_s->id}})" data-bs-toggle="modal" data-bs-target="#Modal_confirmation_sanction"><i class='bx bxs-checkbox-minus text-danger'></i></button>
                                        <button class="btn text-success p-0 m-0" title="Modifier" onclick="updateSanction({{$h_s->id}},'{{$h_s->type}}',{{$h_s->admin_id}},{{$h_s->discipline_id}},{{$h_s->sanction_id}},'{{$h_s->duree_sanction}}','{{$h_s->date_sanction}}')" data-bs-toggle="modal" data-bs-target="#Modal_modifier_sanction"><i class='bx bxs-edit '></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>

                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    @if(count($histo_sanctions2) >0)
                    <table id="example"class="table table-hover text-secondary" class="img-circle" style="font-size: .8rem;" >
                        <thead class="table-light">
                            <tr>
                                <th>Mesure administrative</th>
                                <th>Mesure disciplinaire</th>
                                <th>Sanctions</th>
                                <th>Durée (jours)</th>
                                <th>Date début</th>
                                <th>Date fin</th>
                                <th>Restaurer</th>
                            </tr>
                        </thead>
                        <tbody id="liste_employes">
                            @foreach ($histo_sanctions2  as $h_s)
                            <tr class="p-1 detail_employes" id="{{$h_s->id}}">
                                <td width="20%">{{$h_s->description}}</td>
                                <td width="20%">{{$h_s->discipline}}</td>
                                <td width="20%">{{$h_s->nom_saction}}</td>
                                <td width="10%" class="text-center">{{$h_s->duree_sanction}}</td>
                                <td width="12%">{{\Carbon\Carbon::parse($h_s->date_sanction)->translatedFormat("j F Y")}}</td>
                                <td width="12%">
                                    @php
                                        $diff =$h_s->duree_sanction;
                                        $date_fin = date('Y-m-d', strtotime($h_s->date_sanction.' + '.$diff.' day'));
                                    @endphp
                                    {{\Carbon\Carbon::parse($date_fin)->translatedFormat("j F Y")}}
                                </td>
                                <td  style="width:1%">
                                    @php
                                        $date_now=date('Y-m-d');
                                        $date=$h_s->date_sanction;
                                    @endphp
                                    @if ($date_fin>$date_now)
                                        <a href="{{route('restaurer_sanction',$h_s->id)}}" title="Restaurer" class="btn btn-sm "><i class='bx bxs-checkbox-minus text-danger'></i>
                                    @endif
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une sanction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('new_histo_sanctions')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row col-md-11 m-auto">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" name="employer_id" id="employer_id" value="{{$employer_id}}" >
                                </div>
                                <label>Mesure</label>
                                <div class="mb-3">
                                    <select class="form-control text-secondary " id="mesure" name="mesure">
                                        <option selected>Sélectionnez une mesure</option>
                                        <option value="Mesure disciplinaire">Mesure disciplinaire</option>
                                        <option value="Mesure administrative">Mesure administrative</option>

                                    </select>
                                </div>
                                <div id="mesure_disciplinaire">
                                    <label>Mesure disciplinaire</label>
                                    <div class="mb-3">
                                        <select class="form-control  text-secondary" name="description_disc" id="mesure_disc">
                                            <option selected value="1001">Sélectionnez une mesure disciplinaire</option>
                                            @foreach ($mes_dis as $m_d)
                                            <option value="{{ $m_d->id }}">{{ $m_d->nom_discipline}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div id="mesure_administrative">
                                    <label>Mesure Administrative</label>
                                    <div class="mb-3">
                                        <select class="form-control  text-secondary" name="description_admin" id="mesure_admin">
                                            <option selected value="1001">Sélectionnez une mesure administrative</option>
                                            @foreach ($mes_admin as $m_a)
                                            <option value="{{ $m_a->id }}">{{ $m_a->descriptions}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <label>Sanction</label>
                                <div class="mb-3">
                                    <select class="form-control text-secondary" name="sanction" id="nom_sanction">
                                        <option selected>Sélectionnez une sanction</option>
                                        @foreach ($sanctions as $sanction)
                                        <option value="{{ $sanction->id }}">{{ $sanction->nom_saction }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="date">Date de la sanction</label>
                                    <input type="date" name="date_sanction"  id="date_sanction" class="form-control"  value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="row mb-3">
                                    <label for="date">Durée de la sanction</label>
                                    <div class="col-md-4">
                                        <input type="number" min="1" name="duree_sanction"  id="duree_sanction" class="form-control" >
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control mb-4 " name="unite" id="unite">
                                            <option value="1">jours</option>
                                            <option value="4">semaine</option>
                                            <option value="2">mois</option>
                                            <option value="3">ans</option>
                                        </select>
                                    </div>
                                    </div>
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
<div class="contenu"></div>
<!-- Modal_confirmation -->

<div class="modal text-secondary" id="Modal_confirmation_sanction" tabindex="-1"aria-labelledby="exampleModalLabel" aria-hidden="true" style="border-radius: 30%;">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body mx-2">
                <div class="col-md-12 my-3">
                    <div class="mb-3">Voulez vous lever cette sanction?</div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" >Non</button>
                            <a class="btn  btn-success text-white"id="oui" href="#" > Oui</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal_confirmation_fin -->



<!-- Modal_modifier_sanction_fin -->
<div class="modal fade" id="Modal_modifier_sanction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier la sanction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('modifier_sanction')}}" method="post">
                @csrf
                    <div class="modal-body">
                        <div class="row col-md-11 m-auto">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" name="id2" id="id2" value="#" >
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" name="employer_id2" id="employer_id2" value="{{$employer_id}}" >
                                </div>
                                <label>Mesure</label>
                                <div class="mb-3">
                                    <select class="form-control text-secondary " id="mesure2" name="mesure2">
                                        <option selected>Sélectionnez une mesure</option>
                                        <option value="Mesure disciplinaire">Mesure disciplinaire</option>
                                        <option value="Mesure administrative">Mesure administrative</option>

                                    </select>
                                </div>
                                <div id="mesure_disciplinaire2">
                                    <label>Mesure disciplinaire</label>
                                    <div class="mb-3">
                                        <select class="form-control  text-secondary" name="description_disc2" id="mesure_disc2">
                                            <option selected value="1001">Sélectionnez une mesure disciplinaire</option>
                                            @foreach ($mes_dis as $m_d)
                                            <option value="{{ $m_d->id }}">{{ $m_d->nom_discipline}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            <div id="mesure_administrative2">
                                <label>Mesure Administrative</label>
                                <div class="mb-3">
                                    <select class="form-control  text-secondary" name="description_admin2" id="mesure_admin2">
                                        <option selected value="1001">Sélectionnez une mesure administrative</option>
                                        @foreach ($mes_admin as $m_a)
                                        <option value="{{ $m_a->id }}">{{ $m_a->descriptions}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <label>Sanction</label>
                            <div class="mb-3">
                                <select class="form-control text-secondary" name="sanction2" id="nom_sanction2">
                                    <option selected>Sélectionnez une sanction</option>
                                    @foreach ($sanctions as $sanction)
                                    <option value="{{ $sanction->id }}">{{ $sanction->nom_saction }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date">Date de la sanction</label>
                                <input type="date" name="date_sanction2"  id="date_sanction2" class="form-control"  value="<?php echo date('Y-m-d'); ?>">
                            </div>

                            <div class="row mb-3">
                                <label for="date">Durée de la sanction</label>
                                <div class="col-md-4">
                                    <input type="number" min="1" name="duree_sanction2"  id="duree_sanction2" class="form-control" >
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control mb-4 " name="unite2" id="unite2">
                                        <option value="1">jours</option>
                                        <option value="4">semaine</option>
                                        <option value="2">mois</option>
                                        <option value="3">ans</option>
                                    </select>
                                </div>
                            </div>
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

<!-- Modal_modifier_sanction_fin -->
<script>

$('document').ready(function(){
    $('.btn_racourcis').on('click',function(e){
        var titre = $(this).find('.text_racourcis').text();
        if (titre == "Informations") {
            $("#Informations").attr("href", "{{ route('detail.employe',$employer_id)}}" );
        } else if(titre == "Emploi"){
            $("#Emploi").attr("href", "{{ route('detail.emploi',$employer_id)}}" );
        }
        else if(titre =="Salaire"){
            $("#Salaire").attr("href", "{{ route('detail.salaire',$employer_id)}}" );
        }
        else if(titre == "Sanction"){
            $("#Sanction").attr("href", "{{ route('detail.sanction',$employer_id)}}" );
        }
    })
})

function setIdSanction(idSanction){
// /rendre+materiel/{id}
    $route="/lever+sanction/"
    $('#oui').attr('href',$route+idSanction);

}

function updateSanction(idSanction,type,description,discipline,sanction,duree_sanction,date_sanction){
    //   alert("id: "+idSanction+"| type: "+type+"| admin:"+description+"| discipline:"+discipline+"| sanction:"+sanction+"| duree:"+duree_sanction+"| date:"+date_sanction);
    $('#id2').val(idSanction);
    $('#mesure2').val(type);
    $('#mesure_disc2').val(discipline);
    $('#mesure_admin2').val(description);
    $('#nom_sanction2').val(sanction);
    $('#date_sanction2').val(date_sanction);
    $('#duree_sanction2').val(duree_sanction);
    $('#unite2').val(1);
    $("#mesure_disciplinaire2").hide();

    if(discipline==1001){
        $("#mesure_disciplinaire2").hide("slow");
        $("#mesure_disciplinaire2").val();
        $("#mesure_administrative2").show("slow");
    }
    else if(description==1001){
        $("#mesure_disciplinaire2").show("slow");
        $("#mesure_administrative2").hide("slow");
    }
    else{
        $("#mesure_disciplinaire2").hide();
        $("#mesure_administrative2").hide();
    }
}

$(document).ready(function () {
    $('#example,#table_encours').DataTable({
        dom: '<"top">rt<"bottom"lp><"clear">',
        dom: "<'row'<'col-lg-4 col-md-6 col-sm-12 mb-1 d-flex justify-content-start'f><'col-lg-2 col-md-4 col-sm-12 mb-1 d-flex'l>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-6'p>>",
        pageLength : 7,
        lengthMenu: [[7, 10, 20, -1], [7, 10, 20, 'Tout']],
        "language":{
            "url":"/assets/Json/french.json"
        }
    });
});
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#nom_sanction').on('change',function(){
        var sanction_id = $(this).val();

        $.ajax({
            type:"GET",
            url:"/getDureeSanction/"+sanction_id,
            dataType:"json",
            success:function(response){
                $('#duree_sanction').val(response);
            },
            error:function(){

            }

        });

    });
    });

    $("#mesure_disciplinaire").hide();
    $("#mesure_administrative").hide();

    $('#mesure').on("change",function(){
        var mesure =$(this).val();
        if (mesure=="Mesure disciplinaire") {

            $("#mesure_disciplinaire").show("slow");
            $("#mesure_administrative").hide("slow");

        }
        else if(mesure=="Mesure administrative") {

            $("#mesure_disciplinaire").hide("slow");
            $("#mesure_administrative").show("slow");

        }
        else{
            $("#mesure_disciplinaire").hide();
            $("#mesure_administrative").hide();
        }

    });

    // Modifier_sanction

    $("#mesure_disciplinaire2").hide();
    $("#mesure_administrative2").hide();

    $('#mesure2').on("change",function(){
        var mesure2 =$(this).val();
        if (mesure2=="Mesure disciplinaire") {

            $("#mesure_disciplinaire2").show("slow");
            $("#mesure_admin2").val("1001");
            $("#mesure_administrative2").hide("slow");

        }
        else if(mesure2=="Mesure administrative") {

            $("#mesure_disciplinaire2").hide("slow");
            $("#mesure_disc2").val("1001");
            $("#mesure_administrative2").show("slow");

        }
        else{
            $("#mesure_disciplinaire2").hide();
            $("#mesure_administrative2").hide();
        }

    });
    // fin_modifier_sanction
    $('#nom_sanction').on('change', function(){
    if($('#nom_sanction').val()==10){
        $("#duree_sanction").attr('disabled', true);
        $('#duree_sanction').val==0;
        $("#unite").attr('disabled', true);
    }
    else {
        $("#duree_sanction").attr('disabled', false);
        $("#unite").attr('disabled', false);
    }
})

</script>

@endsection


