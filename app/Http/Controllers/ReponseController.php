<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reponse;
use Illuminate\Support\Facades\Validator;

class ReponseController extends Controller
{
    public function index() 
    {  
        $reponse = Reponse::all();
        return response()->json([
            'status' => 200,
            'reponses' => $reponse

        ]);
    }



    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            
            //'repimage'=> 'required|image|mimes:jpeg,png,jpg|max:2048',
            'reptext'=> 'required',
            'repcorrecte'=> 'required',
            
                     ]);
        if($validator->fails()) {
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages(),
            ]);
        }
        else {
        $reponse=new Reponse;
         
        $reponse->reptext= $request->input('reptext');
         $reponse->repcorrecte = $request->input('repcorrecte');
         

         if($request->hasfile('repimage')) {
             $file= $request->file('repimage');
             $extension = $file->getClientOriginalExtension();

             $filename = time() . '.' .$extension;
             $file->move('uploads/images/',$filename);
             $reponse->repimage = 'Upload/images/'.$filename;
         }
     
        $reponse->save();
        return response()->json([
            'status'=>200,
            'message'=>'réponse est ajouté avec succès',
        ]);
        
    }
    }



   /*  public function show($id)
    {
        return Reponse::find($id);
    }
 */


public function show($id)
{   
    $reponse = Reponse::find($id);
    if($reponse){

        return   response()->json([
        'reponse' => $reponse,
        'status'=>200,
        ]);
   
       }else{
        return response()->json(
            [ 'validation_errors' => 'reponse non trouvée' , //$validator->messages()
              'status'=>404,
            ]);   
        
       }
    
   }



   
    /* public function update(Request $request, $id)
    {
        $reponse = Reponse::find($id);
        $reponse->update($request->all());
        return $reponse ;
    } */

    
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
           //'repimage'=> 'required|image|mimes:jpeg,png,jpg|max:2048',
           'reptext'=> 'required',
           'repcorrecte'=> 'required',
        ]);
        if($validator->fails()){
            return response()->json(
                [ 'validation_errors' => $validator->messages() ,
                  'status'=>422,
                ]);   
    
        }
        else{
             $reponse = Reponse::find($id);
             if($reponse){
                 $reponse->reptext = $request->reptext;
                 $reponse->repcorrecte = $request->repcorrecte;
                 $reponse->repimage = $request->repimage;
         
                 $reponse->save();

                 return response()->json(
                    [    'status'=>200,
                        'message' =>'reponse updated successfully' ,
                      
                    ]);   
             }
             else{
                return response()->json(
                    [    'status'=>404,
                        'message' =>'reponse non trouvé' ,
                      
                    ]);   ;
             } 
        }
    
    
       
    } 
    public function destroy($id)
    {
        return Reponse::destroy($id);
    }








}
