<div class="sidebar active">
    <ul class="nav nav_list mb-5" id="menu">
        @can('isReferent')
        <li>
            <a href="{{route('dashboard')}}" class="nav_linke" id="accueil">
                <i class="bx bxs-dashboard"></i>
                <span class="links_name">Accueil</span>
            </a>
        </li>
        @endcan
        @canany(['isReferent','isManager'])
            <li>
                <a href="{{route('employe.liste')}}" class="nav_linke" id="employes">
                    <i class='bx bx-group'></i>
                    <span class="links_name">Employés</span>
                </a>
            </li>
        @endcanany






    </ul>

</div>
