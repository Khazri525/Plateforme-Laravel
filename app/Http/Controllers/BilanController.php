<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bilan;

use App\Models\Stagiaire;

use Validator;


class BilanController extends Controller
{

    
    public function store(Request $request, $id)
    {
      $validator = Validator::make($request->all(),[
       // 'bfile'=>'file|mimes:pdf,docx ',
        // 'description'=>'string|max:200 ',
      
     ]);

     if($validator->fails()){
      return response()->json(
          [ 'validation_errors' => $validator->messages() ,
            'status'=>400,
          ]);   
       }

       else{    
         $bilan = new Bilan;
         //$bilan ->description =$request->description;
          
            if($request->hasFile('bfile')){
             $file = $request->file('bfile');
             $filename = $file->getClientOriginalName();
             $extension = $file->getClientOriginalExtension();
             
             $finalName = time(). '_' . $filename ;
             $request->file('bfile')->storeAs('public/Upload/Bilans' , $finalName );
             $bilan->bfile='public/Upload/Bilans/'.$finalName;
             } 

             $insert_bilan_stagiaire= Stagiaire::where('_id', '=', $id)->update(['Bilan' => ['_id' => $id  ,'bfile'=> $bilan->bfile  ] ]);

             $bilan ->save();
            
    

                return response()->json(
                    ['message' => 'Bilan déposé avec succès',
                    'status'=>200,
                    'bilan' =>$bilan ,
       
                    ] );
       
               }


    }

    

}
