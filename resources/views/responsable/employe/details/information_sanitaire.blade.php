<div class="tab-pane fade" id="detail_sanitaire{{ $stagiaire->id }}" role="tabpanel"aria-labelledby="sanitaire_detail">

    <form action="{{ route('InsertInfo') }}" method="post">
        @csrf
        <div class="card mt-3 p-3 text-secondary">
            <h6 class="mb-3">
                Santé
            </h6>
            <div class="row">
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
                    <button class="btn text-white button-text" type="submit">
                        Sauvegarde
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
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
</script>
