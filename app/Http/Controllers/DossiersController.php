<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employer;
use App\Models\DocumentEmployer;

class DossiersController extends Controller
{
    public function getDetailDossier(){
        $user_id = Auth::user()->id;
        $etp_id = Employer::where('user_id', $user_id)->where('prioriter', 1)->value('entreprise_id');
        $employer_id = Employer::where('user_id', $user_id)->where('entreprise_id', $etp_id)->value('id');
        $data=[
            "employer_id"=>$employer_id,
            "entreprise_id"=>$etp_id
        ];
        return view('responsable.dossier.detail_dossier')->with($data);
    }
    public function InsertDocument(Request $request){
        // $document = new DocumentEmployer();
        
        // $tay =  $request->file;
        // $description = $request->description;
        // $entreprise_id = $request->entreprise_id;
        // $employer_id = $request->employer_id;
        $fileName = $request->entreprise_id;  
         
        // $request->file->move(public_path('files'), 'teste');
        // DB::insert('insert into pers_document (description,entreprise_id,nom_fichiers,employer_id) value(?,?,?,?)');
        // DocumentEmployer::create([
        //                 'nom_fichiers' => 'teste',
        //                 'description' => 'fjgksdfjg',
        //                 'entreprise_id' => 'fdgsfdgf',
        //                 'employer_id' => 'sfdgsfgdg',
        //                 ]);
        
        return response()->json($fileName);
        // dd($req->all());
        // if($req->hasFile('document')){
        //     $doc =$req->file('document');
        //     $docName =time().'.'.$doc->getClientoriginalExtension();

        //     $document->entreprise_id=$req->entreprise_id;
        //     $document->employer_id=$req->employer_id;
        //     $document->description =$req->description;
        //     $document->nom_fichiers = $docName;
        //     $ajoutDoc =$document->save();
        //    if( $ajoutDoc){
        //     $destinationPath = public_path('/documents/employers');
        //     $req->document->move($destinationPath, $docName);
        //    }
        //     return response()->json(['success'=>"Document enregistré avec succès"]);
        // }
        // else{
        //     return back();
        // }
    }
}
