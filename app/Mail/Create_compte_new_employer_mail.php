<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Employer;
use App\User;

class Create_compte_new_employer_mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_resp,$nom_etp,$nom_resp,$prenom_resp,$email_employer,$nom_employe,$prenom_employe,$fonction_employe)
    {
        $this->email_resp =$email_resp;
        $this->nom_etp = $nom_etp;
        $this->nom_resp = $nom_resp;
        $this->prenom_resp =$prenom_resp;
        $this->nom_employe = $nom_employe;
        $this->prenom_employe= $prenom_employe;
        $this->email_employer = $email_employer;
        $this->fonction_employe = $fonction_employe;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email_resp)
            ->subject('Création de Nouveau Compte sur formation.mg')
            ->view('save_compte_employer.nouveau_compte_employer')
            ->with([
                'nom_etp' => $this->nom_etp,
                'nom_resp' => $this->nom_resp,
                'prenom_resp' => $this->prenom_resp,
                'nom_employer' => $this->nom_employe,
                'fonction_user' =>$this->fonction_employe,
                'email_employer' => $this->email_employer
            ]);
    }
}
