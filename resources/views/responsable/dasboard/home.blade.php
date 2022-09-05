@extends('layouts.master_page')
@section('title')
<div class="text_header text-secondary">Acceuil</div>
@endsection
@section('content')
@if(count($employers)>1)

<!-- Employé>1 -->

<h6>Tableau de bord</h6>
<div class="container">
    <div class="row mb-3">
        <div class="col-md-4 ">
            <div class="card border-0 shadow p-3 mb-5 bg-white rounded ">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-title">Employés</div>
                        <i class='bx bxs-user text-dark'></i>
                    </div>
                    <div class="text-primary">
                        {{count($employers)}}
                    </div>
                    <div class="text-primary">
                       Homme : {{$homme[0]->nbr}} | Femme : {{$femme[0]->nbr}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="card border-0 shadow p-3 mb-5 bg-white rounded"">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-title">Contrat</div>
                        <i class='bx bxs-spreadsheet bx-md text-dark'></i>
                    </div>
                    <div class="text-primary">
                        {{count($fin_contrat)}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="card border-0 shadow p-3 mb-5 bg-white rounded"">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-title">Employés</div>
                        <div class="text-secondary">ic</div>
                    </div>
                    <div class="text-primary">
                       Homme
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-md-6">
                <div class=" border-0 shadow p-3 mb-5 bg-white rounded">
                    <input type="hidden" value="{{$string}}" id="type_departement"/>
                    <input type="hidden" value="{{$valeur}}" id="nbre_departement"/>
                    <canvas id="employe_par_departement" style="width:100%;max-width:600px"></canvas>
                    <!-- <h6 class="text-secondary">Contrat qui prendront fin dans les 2 semaines à venir</h6>
                        <table class="table "  >
                            <thead class="table-light">
                                    <tr>
                                    <th>Nom</th>
                                    <th>Type de contrat</th>
                                    <th>Fin dans </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($fin_contrat as $fc)
                                <tr>
                                    <td>{{$fc->employer_id}}</td>
                                    <td>{{$fc->type_contrat_id}}</td>
                                    <td><?php
                                    /*$date_now=new DateTime($date_now[0]->dt);
                                    $date_fin=new DateTime($fc->date_fin);
                                    $interval=$date_fin->diff($date_now);
                                    $type2=gettype($date_fin);
                                    $type3=gettype($date_now);
                                    echo $interval->format('%d jours');*/?></td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table> -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow p-3 mb-5 bg-white rounded"">

                    <input type="hidden" value="{{$str}}" id="type_contrat"/>
                    <input type="hidden" value="{{$value}}" id="nbre_contrat"/>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                </div>
            </div>
        </div>

    </div></p>
@else
<!-- 0 employé -->
<div class="card border-0 m-auto" style="width:40rem;">
    <div class="card-body text-center">
            <div class="card-title m-auto col-sm-4 ">
                <img class="img-fluid" src="{{asset('img/3d-hello.png')}}">
            </div>
            <p class="card-text text-secondary">Vous n'avez pas encore d'employé, pourquoi pas en  <a href="{{ route('employe.liste')}}" class="text-primary" onclick="setLocal()"><i class='bx bxs-plus  text-light'></i><u>ajouter</u></a></p>

    </div>
</div>


@endif

<!-- Chart JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
    function setLocal(){
        localStorage.setItem('indiceEmp','#nouveau_employe');
    }
    // ChartJs
var type=$('#type_contrat').val();


 var xValues = type.split(",");
 xValues.pop();

 var nombre = $('#nbre_contrat').val();
 var yValues =nombre.split(",");
 yValues.pop();

 // Générer une couleur au hasard
 function generateRandomColor(){
     let maxVal = 0xFFFFFF; // 16777215
     let randomNumber = Math.random() * maxVal;
    colors=["#D65DB1","#845EC2","#53008F","#9B89B3","#C493FF","#64418F","#5C1D57","#FF70F3","#8F2286"];
    var randColor=colors[Math.floor(Math.random() * colors.length)];
    return randColor
    //  let maxVal = 0xD7A1F9;// 16777215
    //  let minVal = 0x51087E;
    //  let randomNumber = Math.random()*(maxVal-minVal+1)+minVal;
    //  randomNumber = Math.floor(randomNumber);
    //  randomNumber = randomNumber.toString(16);
    //  let randColor = randomNumber.padStart(6, 0);
    //  return `#${randColor.toUpperCase()}`
 }
 function generateRandomColor2(){
     let maxVal = 0xD7A1F9;// 16777215
     let minVal = 0x51087E;
     let randomNumber = Math.random()*(maxVal-minVal+1)+minVal;
     randomNumber = Math.floor(randomNumber);
     randomNumber = randomNumber.toString(16);
     let randColor = randomNumber.padStart(6, 0);
     return `#${randColor.toUpperCase()}`
 }
 var barColors = [];
if(xValues.length<=8){
    for(var i=0;i<xValues.length;i++){
        var couleur=generateRandomColor();
        while(barColors.indexOf(couleur)!==-1){
            couleur=generateRandomColor();

        }
        barColors.push(couleur);
        }
}
else{
    for(var i=0;i<xValues.length;i++){
        barColors.push(generateRandomColor2());
    }
}



// while(true){
//         var color=generateRandomColor();
//         if (barColors.indexOf(color)!=-1){
//             barColors.push(color);
//             break;
//         }
//     }
var type_departement=$("#type_departement").val();
var nbre_departement=$("#nbre_departement").val();
console.log(type_departement +" "+ nbre_departement);

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Répartition des contrats"
    }
  }
});

//employés par département

var xValues_emp_depart = type_departement.split(",");
var yValues_emp_depart = nbre_departement.split(",");


new Chart("employe_par_departement", {
  type: "bar",
  data: {
    labels: xValues_emp_depart,
    datasets: [{
      backgroundColor: barColors,
      data: yValues_emp_depart
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Répartitions des employés par département"
    }
  }
});
//fin employés par département
</script>

@endsection
