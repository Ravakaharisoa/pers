@extends('layouts.master_page')
@section('title')

@endsection
@section('content')

    <!-- <div class="card col-md-12 p-3 my-4 text-secondary">
                        <button class="btn text-white" onclick="addDocument()" style="background-color:#65d683"> <i class='bx bx-plus'></i> Nouveau document </button>
                        <h6 class='text-primary my-2'>Documents</h6>
                        @csrf
                        <div class="row mt-3" id="documents">
                            <div class="col-md-6 mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="lastName" class="form-label">
                                            CIN
                                        </label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="cin" style="cursor:pointer">
                                            <i class='bx bx-link-alt'></i>
                                            <input id="cin" type="file" style="display:none;"/>
                                        </label>
                                        <a href="#"><u class="text-warning mx-2">cin.pdf</u></a>
                                        <a href="#"><i class='bx bx-download text-success'></i></a>
                                        
                                    </div>  
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="lastName" class="form-label">
                                            Certificat de résidence
                                        </label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="cin" style="cursor:pointer">
                                            <i class='bx bx-link-alt'></i>
                                            <input id="cin" type="file" style="display:none;"/>
                                        </label>
                                        <a href="#"><u class="text-warning mx-2">residence.pdf</u></a>
                                        <a href="#"><i class='bx bx-download text-success'></i></a>
                                        
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md text-md-end">
                                <button type="submit" id="sauvegarde-organisme-social" class="btn btn-primary text-white button-text" disabled>
                                    Sauvegarde
                                </button>
                            </div>
                        </div>
                    </div> -->
    <div class="row " style="height:600px">
        <div class="col-lg-5 col-md-12 mt-0 col-sm-12 bg-danger p-4" style="position:relative;height:250px;top:30%">
            <div class="col-md-9 mt-2 mx-auto">
                <h4 class="text-center text-white">Nouveau document</h4>
                <form id="form_document" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control form-control-sm" id="entreprise_id" name="entreprise_id" value="{{ $entreprise_id}}">
                    <input type="hidden" class="form-control form-control-sm" id="employer_id" name="employer_id" value="{{ $employer_id}}">
                    <div class="form-group row mb-2">
                        <label for="staticEmail" class="col-sm-4 text-white col-form-label">Description</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="description" name="description" >
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="document" class="col-sm-4 text-white col-form-label"><i class='bx bx-link-alt'></i>Document</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control form-control-sm" id="document" name="file" />
                        </div>
                    </div>
                        <button class="btn btn-primary mt-2 float-end" id="Ajouter_doc" type="submit" >Ajouter</button>
                    </div>
                </form>
            </div>
        <div class="col-lg-7 col-md-12 p-3 " >
            <center><h4>Liste des documents</h4></center>
            <div class="row mt-5 bg-secondary" id="documents" style="height:500px;overflow:auto;">
                <div class="col-md-6 mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="lastName" class="form-label">
                                CIN
                            </label>
                        </div>
                        <div class="col-md-8">
                            <label for="cin" style="cursor:pointer">
                                <i class='bx bx-link-alt'></i>
                                <input id="cin" id="cin" type="file" style="display:none;" />
                            </label>
                            <a href="#"><u class="text-warning mx-2">cin.pdf</u></a>
                            <a href="#"><i class='bx bx-download text-success'></i></a>
                            
                        </div>  
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="lastName" class="form-label">
                                Certificat de résidence
                            </label>
                        </div>
                        <div class="col-md-8">
                            <label for="cin" style="cursor:pointer">
                                <i class='bx bx-link-alt'></i>
                                <input id="cin" type="file" style="display:none;"/>
                            </label>
                            <a href="#"><u class="text-warning mx-2">residence.pdf</u></a>
                            <a href="#"><i class='bx bx-download text-success'></i></a>
                            
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>

        

<script>

    //Insertion des documents 
    $(document).ready(function(){
        
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
  
    $('#form_document').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        // $('#file-input-error').text('');

        $.ajax({
            type:'GET',
            url: "{{ route('ajout_document') }}",
            data: ,
            contentType: false,
            processData: false,
            success: (response) => {
                console.log(response);
            },
            error: function(response){
                console.log(response)
            }
       });
    });

        // $("#form_document").submit(function(e){
        //     e.preventDefault();
        //     var formData = new FormData();
        //     alert(formData);
        //     $.ajax({
        //         type: "POST",
        //         url: "{{ route('ajout_document') }}",
        //         data:formData,
        //         processData: false,
        //         contentType: false,
        //         success:function(response){
        //             $('#form_document')[0].reset();
        //             Swal.fire({
        //                 title: 'Tafiditra tsara',
        //                 text: response['success'],
        //                 icon: 'success',
        //                 timer: 2000,d
        //                 showConfirmationButton:false
        //             });
        //         }
              
        //     });
        // });
    })
	function setText(){
       $('#description').val("");
       $('#document').val("");
	}
    function addDocument(){
	var description = $('#description').val();
	var doc =$('#document').val();
        var nouveau ='<div class="col-md-6 mb-3">'+
	   '<div class="row">'+
                        '<div class="col-md-4">'+
                            '<label for="lastName" class="form-label">'+
                                description+
                            '</label>'+
                        '</div>'+
                        '<div class="col-md-8">'+
                            '<label for="'+description+'"cin"  style="cursor:pointer">'+
                                '<i class="bx bx-link-alt" title="Changer"></i>'+
                                '<input id="cin" type="file" style="display:none;"/>'+
                            '</label>'+
                            '<a href="#"><u class="text-warning mx-2">'+doc+'</u></a>'+
                            '<a href="#"><i class="bx bx-download text-success"></i></a>'+
                        '</div> '+ 
				    '</div> '+ 
                    '</div>';
                
        $('#documents').prepend(nouveau); 
	   setText();
    }
</script>
@endsection
