<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\DossierStage;
use App\Models\Stagiaire;
use Validator;

class DossierStageController extends Controller
{
   

    //ajouter dossier de stage 
    public function ajouterDossier(Request $request , $id)
    {
      
      $validator = Validator::make($request->all(),[
        'name'=> 'string|min:3|max:20',
        'prenom'=> 'string|min:3|max:20',
     /*   'cinfile'=>'file|mimes:pdf,docx ',
       'convfile'=>'file|mimes:pdf,docx ',
       'cvfile'=>'file|mimes:pdf,docx ',
       'lettfile'=>'file|mimes:pdf,docx ', */
       
      
     ]);

     if($validator->fails()){
      return response()->json(
          [ 'validation_errors' => $validator->messages() ,
            'status'=>400,
          ]);   
       }

       else{    
         $dossier = new DossierStage;
      
         
          
            if($request->hasFile('cinfile')){
             $file = $request->file('cinfile');
             $filename = $file->getClientOriginalName();
             $extension = $file->getClientOriginalExtension();
             
             $finalName = time(). '_' . $filename ;
             $request->file('cinfile')->storeAs('public/Upload/DossierStage' , $finalName );
             $dossier->cinfile='public/Upload/DossierStage/'.$finalName;
             } 

             if($request->hasFile('convfile')){
                $file = $request->file('convfile');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                
                $finalName = time(). '_' . $filename ;
                $request->file('convfile')->storeAs('public/Upload/DossierStage' , $finalName );
                $dossier->convfile='public/Upload/DossierStage/'.$finalName;
                } 
            
                if($request->hasFile('cvfile')){
                    $file = $request->file('cvfile');
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    
                    $finalName = time(). '_' . $filename ;
                    $request->file('cvfile')->storeAs('public/Upload/DossierStage' , $finalName );
                    $dossier->cvfile='public/Upload/DossierStage/'.$finalName;
                    } 

                    if($request->hasFile('lettfile')){
                        $file = $request->file('lettfile');
                        $filename = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        
                        $finalName = time(). '_' . $filename ;
                        $request->file('lettfile')->storeAs('public/Upload/DossierStage' , $finalName );
                        $dossier->lettfile='public/Upload/DossierStage/'.$finalName;
                        } 


                   
$insert_dossier_stagiaire= Stagiaire::where('_id', '=', $id)->update(['DossierStage' => ['_id' => $id  ,'cinfile'=> $dossier->cinfile,
'cvfile'=> $dossier->cvfile, 'lettfile'=> $dossier->lettfile ,'convfile'=> $dossier->convfile ] ]);

                  $dossier ->save();
            
    

           
           
                return response()->json(
                    ['message' => 'Dossier déposé avec succès',
                    'status'=>200,
                    'dossier' =>$dossier ,
       
                    ] );
       
               }


    }



     //retourner le dossier
     public function index()
     {
         $dossier = DossierStage::all();
         return response()->json([
             'status' =>200,
             'dossier' => $dossier
         ]);
     }












     //valide dossier
          
 public function valideDoss (Request $request, $id)
 {
 
     /* $validator = Validator::make($request->all(),[
        'nom_dept'=>'required ',
        'nom_chef_dept'=>'required|string|max:20 ',
 
     ]);

     if($validator->fails()){
         return response()->json(
             [ 'validation_errors' => $validator->messages() ,
               'status'=>422,
             ]);   
 
     } */

          $stagiaire = Stagiaire::find($id);
          if($stagiaire){
 
              //$dept->update($request->all());
             //'nom_dept' => $request->nom_dept,
             //'nom_chef_dept'=> $request->nom_chef_dept,
            $stagiaire->dossiervalideSt = 'oui';
            $stagiaire->save();
           
              return response()->json(
                 [    'status'=>200,
                     'message' =>'Dossier Stagiaire est valide ' ,
                   
                 ]);   
          }
          else{
             return response()->json(
                 [    'status'=>404,
                     'message' =>"Dossier d'un Stagiare avec cet ID introuvable" ,
                   
                 ]);   ;
          } 
    
 
    }




    //invalide dossier
          
 public function invalideDoss (Request $request, $id)
 {
 
     /* $validator = Validator::make($request->all(),[
        'nom_dept'=>'required ',
        'nom_chef_dept'=>'required|string|max:20 ',
 
     ]);

     if($validator->fails()){
         return response()->json(
             [ 'validation_errors' => $validator->messages() ,
               'status'=>422,
             ]);   
 
     } */
         
          $stagiaire = Stagiaire::find($id);
          if($stagiaire){
 
              //$dept->update($request->all());
             //'nom_dept' => $request->nom_dept,
             //'nom_chef_dept'=> $request->nom_chef_dept,
            $stagiaire->dossiervalideSt = 'non';
            $stagiaire->save();
         
              return response()->json(
                 [    'status'=>200,
                     'message' =>'Dossier Stagiaire est invalide ' ,
                   
                 ]);   
          }
          else{
             return response()->json(
                 [    'status'=>404,
                     'message' =>"Dossier d'un Stagiare avec cet ID introuvable" ,
                   
                 ]);   ;
          } 
    
 
    }

}
