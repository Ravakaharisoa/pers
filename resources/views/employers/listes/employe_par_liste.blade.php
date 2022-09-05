<div class="col-md-12 my-3">
    <div class="fixedTop pt-2">
        <table class="table table-hover text-secondary w-100 " id="liste_employes" style="font-size: .8rem;">
            <thead class="table-light">
                <tr>
                    <th style="width: 5%;" class="table-head font-weight-light align-middle">ID</th>
                    <th style="width: 2%;"></th>
                    <th style="width: 28%;" scope="col" class="table-head font-weight-light align-middle">Employé</th>
                    <th style="width: 25%;" scope="col" class="table-head font-weight-light align-middle">Contacts</th>
                    <th style="width: 20%;" scope="col" class="table-head font-weight-light align-middle"><span class="d-block">Département</span><span>Service</span></th>
                    <th style="width: 5%;" scope="col" class="table-head font-weight-light align-middle ">Status</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($employers as $employer)
                    <tr href="{{ route('detail.employe', $employer->id) }}" id="table-emp">
                        <td>
                            {{$employer->matricule}}
                        </td>
                        <td>
                            @if ($employer->photos)
                                <img src="{{ asset('images/employes/'.$employer->photos) }}" alt="" style="width: 45px; height: 45px;" class="rounded-circle empNew">
                            @else
                                <img src="{{asset('images/formateurs/homme.png')}}" alt="image employe" class="mb-2" style="width: 45px; height: 45px;border-radius:100%;">

                            @endif
                        </td>
                        <td>
                            <span>{{$employer->nom_stagiaire}} {{$employer->prenom_stagiaire}}</span>
                            <span class="text-secondary d-block">
                                @if ($employer->fonction_stagiaire)
                                    {{ $employer->fonction_stagiaire }}
                                @else
                                    ----
                                @endif
                            </span>
                        </td>
                        <td>
                            <span>{{$employer->mail_stagiaire}}</span>
                            <span class="text-secondary d-block">
                                @if ($employer->telephone_stagiaire)
                                    {{ $employer->telephone_stagiaire }}
                                @else
                                    ----
                                @endif
                            </span>
                        </td>
                        <td>
                            @if ($employer->nom_departement && $employer->nom_service)
                                <span class="text-secondary">
                                    @if ($employer->nom_departement)
                                        {{ $employer->nom_departement }}
                                        @endif
                                </span>
                                <span class="text-secondary d-block">
                                    @if ($employer->nom_service)
                                        {{ $employer->nom_service }}
                                    @endif
                                </span>
                            @else
                                <span>Non catégorie</span>
                            @endif
                        </td>
                        <td class="text-white text-center">
                            @if ($employer->activiter == 1)
                                <span style="border-radius:100%;color: #16B84E;font-size:.5rem;"><i class='bx bxs-circle'></i></span>
                            @else
                                <span style="border-radius:100%;color:rgb(188, 192, 189);font-size:.5rem;"><i class='bx bxs-circle'></i></span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
     $(document).ready(function(){
            listeEmployers();
            function listeEmployers(){
                $('.liste_employes').DataTable({
                    processing: true,
                    language: {
                        url :'/assets/json/french.json'
                    },
                });
            }
            $('table #table-emp').on('click', function(){
                window.location = $(this).attr('href');
                return false;
            });
     });
</script>
