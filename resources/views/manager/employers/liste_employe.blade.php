@extends('layouts.master_page')
@section('title')
    <div class="text_header text-secondary">Liste d'employés</div>
@endsection
@section('content')
    <div id="emploies_details">
        <div class="col-md-12">
            <div class="fixedTop pt-2 m-2">
                <table class="table table-hover text-secondary liste_employes w-100 "style="font-size: .8rem;">
                    <thead>
                        <tr>
                            <th class="id table-head font-weight-light align-middle text-center">ID</th>
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Employé</th>
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Contacts</th>
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">
                                <span class="d-block">Département</span>
                                <span>Service</span>
                            </th>
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Référent</th>
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Status</th>
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Actions</th>
                        </tr>
                    </thead>
                    </thead>
                    <tbody >

                    </tbody>
                </table>
            </div>
        </div>

        {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter nouveau employé</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="">
                        @csrf
                        <div class="modal-body">
                            <div class="row col-md-11 m-auto">
                                <div class="col-md-3 text-center">
                                    <img src="{{asset('img/userDefault.png')}}" id="myImage"  alt="" style="border-radius:100%;">
                                    <!-- <input type="file" id="newImage" class="form-control" onchange="changeImage()"/>                                   -->

                                </div>
                                <!-- <script>
                                    function changeImage(){
                                        var image = document.getElementById('myImage');
                                        var newimage = document.getElementById('newImage').value;
                                        image.src=newimage;
                                    }

                                </script> -->


                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="nom_employe" id="nom_employe"
                                            placeholder="Nom d'employé" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="prenom_employe" id="prenom_employe"
                                            placeholder="Prénom d'employé" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="matricule_employe" id="matricule_employe"
                                            class="form-control" placeholder="Matricule d'employé" required>
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-control" name="branche" required>
                                            <option selected>Sélectionnez une branche</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
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
        </div> --}}
    </div>
    <script>
        $(document).ready(function(){
            listeEmployers();
            function listeEmployers(){
                $('.liste_employes').DataTable({
                    processing: true,
                    serverSide: true,
                    language: {
                        url :'/assets/json/french.json'
                    },
                    // "ajax": "/getListeEmployer",
                    // "columns": [
                    //     {data: 'id', name: 'ID'},
                    //     {data: 'Id_Jeux', name: 'Id_Jeux'},
                    //     {data: 'Groupe_Page', name: 'Groupe_Page'},
                    //     {data: 'Type', name: 'Type'},
                    //     {data: 'debut', name: 'debut', orderable: false},
                    //     {data: 'fin', name: 'fin', orderable: false},
                    //     {data: 'info', name: 'info', orderable: false, searchable: false},

                    // ]
                });
            }
        });
    </script>
@endsection
