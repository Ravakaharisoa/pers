<div class="col-md-12">
    <div class="mt-4 row section_filtre py-4">
        <div class="col-4 mx-4">
            <span>Que cherchez-vous ?</span>
            <form action="">
                <div class="form-row">
                    <div class="form-group unput_search">
                        <input type="search" placeholder="Recherche..." id="recherche_lettre">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-4">
            <span>Département</span>
            <form action="">
                <div class="form-row">
                    <div class="form-group">
                        <select name="departement" id="departement" class="form-control input_selected text-secondary">
                            <option selected>--- Choisissez un département ---</option>
                            @foreach ($departements as $departement)
                                <option value="{{ $departement->id }}">{{ $departement->nom_departement }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-3">
            <span>Lieu</span>
            <form action="">
                <div class="form-row">
                    <div class="form-group">
                        <select name="branche" id="branche" class="form-control text-secondary">
                            <option selected>--- Séléctionnez une branche ---</option>
                            @foreach ($branches as $branche)
                            <option value="{{ $branche->id }}">{{ $branche->nom_branche }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
        {{-- <div class="col-1">
            <span class="btn_annuler btn_annuler_filtre">Annuler</span>
        </div> --}}
        <div class="row"></div>
    </div>
    <div class="row mt-4 section_filtre py-4 justify-content-center">
        <div class="col-12 d-flex flex-row px-5">
            @foreach ($test as $initial)
                <span id="{{ $initial->test_init }}" class='alpha_filtre'>{{ $initial->test_init }}</span>
            @endforeach
            {{-- @php
                $alphas = range('a', 'z');
                foreach($alphas as $letter)
                {
                    echo "<span class='alpha_filtre '>".$letter."</span>";
                }
            @endphp --}}
        </div>
        <div class="row mt-4 justify-content-center">
            @foreach($employers as $employe)
            <div class="card card_emp p-0">
                <a href="{{ route('detail.employe',$employe->id) }}">
                <div class="card-body">
                    <h5 class="card-title d-flex flex-row justify-content-between">
                        <form action=""><input type="checkbox" name="" id=""></form>
                        <span>
                            <span class="statut_emp">Active</span>
                            <i class='bx bx-dots-vertical-rounded icon_emp_action'></i>
                        </span>
                    </h5>
                    <div class="header_content text-center">
                        @if ($employe->photos)
                            <img src="{{ asset('images/employes/'.$employe->photos) }}" alt="image employe" class="emp_image mb-2">
                        @else
                        <img src="{{asset('images/formateurs/homme.png')}}" alt="image employe" class="emp_image mb-2">

                        @endif
                        <p class="nom_emp m-0">{{$employe->nom_stagiaire}} {{$employe->prenom_stagiaire}}</p>
                        <p class="fonct_emp text-muted text-xs">{{ $employe->matricule }}</p>
                        <div class="row mb-4">
                            <div class="col-12 justify-content-center d-flex flex-row">
                                <i class='bx bx-star icon_info_emp me-3'></i>
                                <i class='bx bx-envelope icon_info_emp me-3'></i>
                                <i class='bx bx-phone icon_info_emp' ></i>
                            </div>
                        </div>
                        <div class="details_emp">
                            <div class="row">
                                <div class="col-6 text-start">
                                    <p class="m-0 text-muted text-xs">{{ $employe->nom_departement }}</p>
                                    {{-- <p class="text-muted mb-1"></p> --}}
                                </div>
                                <div class="col-6 text-end">
                                    <p class="m-0 text-muted text-xs">{{ $employe->nom_service }}</p>
                                    {{-- <p class="text-muted mb-1">1/08/19</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="row float-right">
            <div style="margin-left: 90% !important;">

            </div>
        </div>
    </div>
</div>
