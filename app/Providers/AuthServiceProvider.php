<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isReferentSimple',function($users_roles){
            $rqt = DB::select('select * from role_users where user_id = ? and prioriter = false and activiter= true', [Auth::id()]);
            if ($rqt !=null) {
                if ($rqt[0]->role_id == 2) {
                    return "referentSimple";
                }
            }
        });

        Gate::define('isReferent',function($users_roles){
            $rqt = DB::select('select * from role_users where user_id = ? and prioriter = true and activiter =true', [Auth::id()]);
            if ($rqt != null) {
                for ($i=0; $i < count($rqt); $i++) {
                    if ($rqt[$i]->role_id == 2) {
                       return "referentPrincipale";
                    }
                }
            }
        });

        Gate::define('isManager',function($users_roles){
            $rqt =  DB::select('select * from role_users where  user_id = ?  and activiter=true', [Auth::id()]);
            if($rqt!=null){
                for ($i=0; $i < count($rqt); $i++) {
                    if( $rqt[$i]->role_id == 5)
                        return "manager";
                }
            }
        });

        Gate::define('isStagiaire',function($users_roles){
            $rqt =  DB::select('select * from role_users where  user_id = ? and activiter=true', [Auth::id()]);
            if($rqt!=null){
                for ($i=0; $i < count($rqt); $i++) {
                    if( $rqt[$i]->role_id == 3)
                        return "stagiaire";
                }
            }
        });




    }
}
