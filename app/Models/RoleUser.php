<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class RoleUser extends Model
{
    use HasFactory;

    public function update_role_user($user_id, $role_id)
    {
        $tab_role_user = DB::select('select * from role_users where user_id=? and role_id!=?',[$user_id,$role_id]);
        DB::beginTransaction();
        try {
            $query = DB::update("update role_users SET activiter=true WHERE user_id=? AND role_id=?", [$user_id, $role_id]);
            for ($i = 0; $i < count($tab_role_user); $i += 1) {
                DB::update("update role_users SET activiter=false WHERE user_id=? AND role_id=?", [$user_id, $tab_role_user[$i]->role_id]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
        // return redirect()->route('logout');
        return redirect()->route('dasboard');
    }
}
