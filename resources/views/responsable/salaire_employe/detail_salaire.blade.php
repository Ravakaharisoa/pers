@extends('layouts.master_page')
@section('title')
@endsection
@section('content')
    <div class="col-md-12 my-2 m-3 p-2" style="border-radius: 20px;">
        <ul class="nav nav-pills mx-4 pt-4 " id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <span class="nav-link active" id="compensation" data-bs-toggle="pill" data-bs-target="#compensation_salaire"
                    type="button" role="tab" aria-controls="compensation_salaire"
                    aria-selected="true">Compensation</span>
            </li>
            <li class="nav-item" role="presentation">
                <span class="nav-link" id="historique_salaire" data-bs-toggle="pill" data-bs-target="#histo_salaire"
                    type="button" role="tab" aria-controls="histo_salaire" aria-selected="false">Historique du
                    salaire</span>
            </li>
            <li class="nav-item" role="presentation">
                <span class="nav-link" id="idemnite_prime" data-bs-toggle="pill" data-bs-target="#prime_idemnite" type="button" role="tab" aria-controls="prime_idemnite" aria-selected="true">Nouvelles Avantages</span>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="compensation_salaire" role="tabpanel" aria-labelledby="compensation">
                <form action="#">
                    <div class="row text-secondary">
                        <div class="col-md-5">
                            <div class="m-4 p-4 justify-content-between card_salaire">
                                <span>Salaire de base</span>
                                <span class="float-end">
                                    @if ($anc_salaire == null)
                                        ---
                                    @else
                                        {{ number_format($anc_salaire->montant, '0', ',', ' ') }}
                                        @foreach ($devises as $devise)
                                            @if ($devise->id == $anc_salaire->devise_id)
                                                {{ $devise->devise }}
                                            @endif
                                        @endforeach
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="m-4 p-4 justify-content-between card_salaire">
                                <span>Total à payer
                                    <span class="float-end">120 000</span>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row mx-3">
                        <div class="col-md-12 text-secondary card_salaire pb-2 mb-3">
                            <div class="row m-2 p-2">
                                <div class="mb-3 col-md-3">
                                    <div class="form-group mt-2">
                                        <label for="">Niveau de rémunération</label>
                                        <select name="" id="" class="form-control text-secondary mt-2">
                                            <option value="">-- Séléctionner --</option>
                                        </select>
                                    </div>
                                    {{-- <div class="form-group mt-2">
                                        <label for="">Commentaire</label>
                                        <textarea name="" id="" cols="30" rows="5" class="form-control text-secondary mt-2"></textarea>
                                    </div> --}}
                                </div>
                                <div class="mb-3 col-md-3">
                                    <div class="form-group mt-2">
                                        <label for="">Devise</label>
                                        <select name="devise" id="" class="form-control text-secondary mt-2">
                                            <option value="">-- Séléctionner --</option>
                                            @foreach ($devises as $devise)
                                                <option value="{{ $devise->id }}">{{ $devise->description }}
                                                    ({{ $devise->devise }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <div class="form-group mt-2">
                                        <label for="">Le minimum</label>
                                        <input type="number" name="" id=""
                                            class="form-control text-secondary mt-2" value="" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <div class="form-group mt-2">
                                        <label for="">Le maximum</label>
                                        <input type="number" name="" id=""
                                            class="form-control text-secondary mt-2" value="" disabled>
                                    </div>
                                </div>
                            </div>
                            @if (count($avantage_natures) > 0)
                                <div class="row m-3 p-3 bg-white" style="border-radius: 20px;">
                                    <div class="row col-md-12 justify-content-between">
                                        <div class="col-md-5"><span>Avantages en nature</span></div>
                                        <div class="col-md-4 text-end"><span>Montant</span></div>
                                    </div>
                                    <hr>
                                    @php
                                        $somme_avantage = 0;
                                    @endphp
                                    @foreach ($avantage_natures as $avantage_nature)
                                        <div class="row col-md-12 justify-content-between m-0 mb-3">
                                            <div class="col-md-5">
                                                <span>{{ $avantage_nature->designation }}</span>
                                            </div>
                                            <div class="col-md-3 text-end">

                                            </div>
                                            <div class="col-md-4 text-end m-0">
                                                <div class="col-md-4 float-end">
                                                    {{ number_format($avantage_nature->montant, 2, '.', ' ') }}
                                                    {{ $avantage_nature->devise }}
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $somme_avantage += $avantage_nature->montant;
                                            $devises_avantage = $avantage_nature->devise;
                                        @endphp
                                    @endforeach

                                    <hr class="my-2">
                                    <div class="row col-md-12 justify-content-between p-2 m-1"
                                        style="border-radius: 20px;background:#F5F5F6;">
                                        <div class="col-md-6 d-flex">
                                            <i class='bx bx-caret-down bx-sm'></i>
                                            <span class="">Valeur avantage en nature</span>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <span>{{ number_format($somme_avantage, 2, '.', ' ') }} {{ $devises_avantage }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (count($primes_employe) > 0)
                                <div class="row m-3 p-3 bg-white" style="border-radius: 20px;">
                                    <div class="row col-md-12 justify-content-between">
                                        <div class="col-md-5"><span>Prime et indemnité</span></div>
                                        <div class="col-md-3"><span>Pourcentage</span></div>
                                        <div class="col-md-4 text-end"><span>Montant</span></div>
                                    </div>
                                    <hr>
                                    @php
                                        $somme_prime = 0;
                                    @endphp
                                    @foreach ($primes_employe as $prime_employe)
                                        <div class="row col-md-12 justify-content-between m-0 mb-3">
                                            <div class="col-md-5">
                                                <span>{{ $prime_employe->nom_prime }}</span>
                                            </div>
                                            <div class="col-md-3 text-end">

                                            </div>
                                            <div class="col-md-4 text-end m-0">
                                                <div class="col-md-4 float-end">
                                                    {{ number_format($prime_employe->montant, 2, '.', ' ') }}
                                                    {{ $prime_employe->devise }}
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $somme_prime += $prime_employe->montant;
                                            $devise = $prime_employe->devise;
                                        @endphp
                                    @endforeach
                                    <hr class="my-2">
                                    <div class="row col-md-12 justify-content-between p-2 m-1"
                                        style="border-radius: 20px;background:#F5F5F6;">
                                        <div class="col-md-6 d-flex">
                                            <i class='bx bx-caret-down bx-sm'></i>
                                            <span class="">Valeur total de prime</span>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <span>{{ number_format($somme_prime, 2, '.', ' ') }}
                                                {{ $devise }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row m-3 p-3 bg-white" style="border-radius: 20px;">
                                <div class="row col-md-12 justify-content-between">
                                    <div class="col-md-6"><span>Déduction</span></div>
                                    <div class="col-md-6 text-end"><span>Montant</span></div>
                                </div>
                                <hr>
                                <div class="row col-md-12 justify-content-between m-0 mb-3">
                                    <div class="col-md-5">
                                        <span></span>
                                    </div>
                                    <div class="col-md-3 text-end">
                                        <div class="col-md-4">
                                            <input type="number" name="" id=""
                                                class="form-control text-secondary text-end" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-end m-0">
                                        <div class="col-md-4 float-end">

                                        </div>
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class="row col-md-12 justify-content-between p-2 m-1"
                                    style="border-radius: 20px;background:#F5F5F6;">
                                    <div class="col-md-6 d-flex">
                                        <i class='bx bx-caret-down bx-sm'></i>
                                        <span class="">Le total des déductions</span>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <span>{{ number_format('1200000', 2, '.', '') }}</span>
                                    </div>
                                </div>
                                <div class="row text-end">
                                    <button type="submit" class="btn"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="histo_salaire" role="tabpanel" aria-labelledby="historique_salaire">
                <div class="col-md-12 text-end">
                    <button class="btn text-white" type="button" style="background:#16B84E;" data-bs-toggle="modal"
                        data-bs-target="#ajoutDetailSalaire">Ajouter historique du salaire</button>
                </div>
                @if($salaires!= null)
                <div class="table-responsive">
                    <table class="table table-hover text-secondary">
                        <thead style="font-size: .9rem;">
                            <tr>
                                <th>Evenement</th>
                                <th>Description</th>
                                <th>À compter de</th>
                                <th>Changé de</th>
                                <th>Changé en</th>
                                <th style="width:12%;">Variation</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($salaires as $salaire)
                                    <tr>
                                        <td>{{ $salaire->evenement }}</td>
                                        <td>{{ $salaire->description }}</td>
                                        <td>{{ \Carbon\Carbon::parse($salaire->date_modification)->translatedFormat('j F Y') }}
                                        </td>
                                        <td>
                                            @if ($salaire->ancien_montant == 0)
                                                ---
                                            @else
                                                {{ number_format($salaire->ancien_montant, 0, '.', ' ') }}
                                                {{ $salaire->devise }}
                                            @endif
                                        </td>
                                        <td>{{ number_format($salaire->nouveau_montant, 0, '.', ' ') }}
                                            {{ $salaire->devise }}</td>
                                        <td with="15%">
                                            @if ($salaire->valeur_pourcent)
                                                {{ $salaire->valeur_pourcent }} %
                                            @else
                                                ---
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
            <div class="tab-pane fade" id="prime_idemnite" role="tabpanel" aria-labelledby="idemnite_prime">
                <div class="row col-md-10 m-auto mt-2 p-3 m-2">
                    <div class="col-md-5">
                        <h5 class="text-secondary">Primes et Indemnités pour l'employé</h5>
                        <hr class="my-4 col-md-8">
                        <form id="form_prime" class="my-3">
                            @csrf
                            <div class="form-group mb-3 col-md-8 text-secondary" id="prime_indemnite">

                                <input type="hidden" name="employer_id" id="employers_id" value="{{ $employer_id }}"
                                    class="form-control text-secondary mt-2">
                            </div>
                            <div class="form-group mb-3 col-md-8 text-secondary" id="prime_indemnite">
                                <label for="">Prime et indemnité</label>
                                <select id="primes" class="form-control text-secondary mt-2" name="prime" required>
                                    <option value="null" selected> ---Séléctionnez ---</option>
                                    @foreach ($primes as $prime)
                                        <option value="{{ $prime->id }}">{{ $prime->designation }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group mb-3 col-md-8 text-secondary">
                                <label for="">Montant</label>
                                <input type="number" name="montant_prime" id="montant_prime"
                                    class="text-secondary form-control" required>
                            </div>
                            <div class="form-group mb-3 col-md-8 text-secondary">
                                <label for="">Devise</label>
                                <select id="devise_prime" name="devise_prime" class="form-control text-secondary mt-2 "
                                    required>
                                    <option value="null" selected> ---Séléctionnez ---</option>
                                    @foreach ($devises as $devise)
                                        <option value="{{ $devise->id }}">{{ $devise->devise }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3 col-md-8 text-end">
                                <button class="btn btn_enregistrer"
                                    id="btn_ajout_prime"type="submit">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5">
                        <h5 class="text-secondary">Avantages en nature pour l'employé</h5>
                        <hr class="my-4 col-md-8">
                        <form id="form_avantage" class="my-3">
                            @csrf
                            <input type="hidden" name="employer_id_avantage" value="{{ $employer_id }}"
                                id="employer_id_Avantage">
                            <div class="form-group mb-3 col-md-8 text-secondary">
                                <label for="">Avantage en nature</label>
                                <select id="primes_Avantage" class="form-control text-secondary mt-2"
                                    name="Avantage_en_nature" required>
                                    <option value="null" selected> --- Séléctionnez ---</option>
                                    @foreach ($avantages as $avantage)
                                        <option value="{{  $avantage->id }}">{{  $avantage->designation }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3 col-md-8 text-secondary">
                                <label for="">Montant</label>
                                <input type="number" name="Montant" id="Montant_Avantage"
                                    class="text-secondary form-control" required>
                            </div>
                            <div class="form-group mb-3 col-md-8 text-secondary">
                                <label for="">Devise</label>
                                <select id="Devise_Avantage" name="Devise_Avantage"
                                    class="form-control text-secondary mt-2 " required>
                                    <option value="null" selected> ---Séléctionnez ---</option>
                                    @foreach ($devises as $devise)
                                        <option value="{{ $devise->id }}">{{ $devise->devise }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3 col-md-8 text-end">
                                <button class="btn btn_enregistrer" type="submit"
                                    id="form_btn_avantage">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="ajoutDetailSalaire" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Salaire de base- Confirmer les changements</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_ajoutNewHistory">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-10 m-auto text-secondary">
                            <input type="hidden" name="id" id="employer_id" value="{{ $employer_id }}">
                            <div class="mb-3" id="evt">
                                <label class="form-label">Evénement *:</label>
                                <select class="form-control text-secondary" name="evenement" id="evenements">
                                    <option selected disabled>--- Sélectionnez ---</option>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}"><span>{{ $event->description }}</span>
                                        </option>
                                    @endforeach
                                    {{-- <option value="autre">Autre</option> --}}
                                </select>
                            </div>
                            {{-- <div class="mb-3" id="autreEvent">
                            <label class="form-label">Evénement *:</label>
                            <input type="text" name="autre_event" id="autre_event" class="form-control">
                        </div> --}}
                            <div class="mb-3">
                                <label class="form-label">Changement à partir de *:</label>
                                <input type="date" id="date_changement"
                                    class="form-control text-center text-secondary">
                            </div>
                            <div class="mb-3">
                                <label for="">Description :</label>
                                <input type="text" name="descr_change" id="descr_change"
                                    class="form-control text-secondary">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Dernier salaire:</label>
                                @if ($anc_salaire == null)
                                    <input type="number" id="old_montant"class="form-control text-secondary" disabled>
                                @else
                                    <input type="number" id="old_montant"class="form-control text-secondary"
                                        value="{{ $anc_salaire->montant }}" disabled>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Changé à*:</label>
                                <input type="number" id="new_montant" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Devise *:</label>
                                <select class="form-control text-secondary" id="devise_id">
                                    <option selected disabled>--- Sélectionnez ---</option>
                                    @foreach ($devises as $devise)
                                        <option value="{{ $devise->id }}">{{ $devise->description }}
                                            ({{ $devise->devise }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn text-white" id="ajoutNewHistory"
                            style="background:#16B84E;">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#ajoutNewHistory').on('click', function() {
                var employer_id = $("#employer_id").val();
                var evenement = $("#evenements").val();
                var descr_change = $('#descr_change').val();
                var date_changement = $("#date_changement").val();
                var devise_id = $("#devise_id").val();
                var old_montant = $("#old_montant").val();
                var new_montant = $("#new_montant").val();

                if (evenement == "" || date_changement == "" || devise_id == "" || new_montant == "" ||
                    descr_change == "") {
                    const Toast = Swal.mixin({
                        toast: true,
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    Toast.fire({
                        icon: 'error',
                        title: 'Tous les champs doivent être remplis!'
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        data: {
                            employer_id: employer_id,
                            evenement: evenement,
                            date_changement: date_changement,
                            devise_id: devise_id,
                            old_montant: old_montant,
                            new_montant: new_montant,
                            descr_change: descr_change
                        },
                        url: "/ajout_historique_salaire",
                        success: function(response) {
                            $('#form_ajoutNewHistory')[0].reset();
                            $('#ajoutDetailSalaire').modal('hide');
                            location.reload();
                        }
                    });
                }

            });

            $("#autre_indemnite").hide();
            $("#primes").on("change", function() {
                var primes = $(this).val();
                if (primes == 5) {
                    $("#autre_indemnite").show();
                    $("#prime_indemnite").hide();
                } else {
                    $("#autre_indemnite").hide();

                }
            });
            $("#autre_avantage_en_nature").hide();
            $("#Avantage_en_nature").on("change", function() {
                var Avantage_en_nature = $(this).val();
                if (Avantage_en_nature == 4) {
                    $("#autre_avantage_en_nature").show();
                    $("#Avantage_en_nature").hide();
                } else {
                    $("#autre_Avantage_en_nature").hide();

                }
            });
            $("#form_prime").submit(function(event) {
                event.preventDefault();
                var employer_id = $('#employers_id').val();
                var montant_prime = $('#montant_prime').val();
                var devise_prime = $('#devise_prime').val();
                var primes = $('#primes').val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('insertprime_indemnite') }}",
                    data: {
                        employer_id: employer_id,
                        montant_prime: montant_prime,
                        devise_prime: devise_prime,
                        primes: primes
                    },
                    success: function(response) {
                        $('#form_prime')[0].reset();
                        Swal.fire({
                            title: 'Génial!',
                            text: response['success'],
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            });
            $("#form_avantage").submit(function(event) {
                event.preventDefault();
                var employer_id_Avantage = $('#employer_id_Avantage').val();
                var primes_Avantage = $('#primes_Avantage').val();
                var Montant_Avantage = $('#Montant_Avantage').val();
                var Devise_Avantage = $('#Devise_Avantage').val();
                // console.log(employer_id_Avantage, primes_Avantage, Montant_Avantage, Devise_Avantage);

                $.ajax({
                    type: "POST",
                    url: "{{ route('insertAvantageEnNature') }}",
                    data: {
                        employer_id_Avantage: employer_id_Avantage,
                        Avantage_en_nature: primes_Avantage,
                        montant: Montant_Avantage,
                        devise: Devise_Avantage
                    },
                    success: function(response) {
                        $('#form_avantage')[0].reset();
                        Swal.fire({
                            title: 'Génial!',
                            text: response['success'],
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            });
        });
    </script>

@endsection
