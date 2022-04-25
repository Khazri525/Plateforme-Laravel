<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Question;
use App\Models\Reponse;

use Illuminate\Support\Facades\Validator;
use App\Models\Stagiaire;
use App\Models\Test;

class QuestionController extends Controller
{
    public function index() //pour la création de l'examen
    {   $questions = Question::all()->slice(0,5); // slice 5 for test after change to random 20
        return response()->json([
            'questions' => $questions->map(function($item, $key) {
                $rep = $item->getReponses;
                return $item->toArray();
            })
        ]);
    }


    public function show($id)
    {   
        $question = Question::find($id);
        if($question){

            return   response()->json([
            'question' => $question,
            'status'=>200,
            ]);
       
           }else{
            return response()->json(
                [ 'validation_errors' => 'question non trouvée' , //$validator->messages()
                  'status'=>404,
                ]);   
            
           }
        
       }


       public function allquestion() 
       {  
           $question = Question::all();
           return response()->json([
               'status' => 200,
               'questions' => $question
   
           ]);
       }


       public function sum(){
        $req = Question::all();
        $req = $req->pluck('time');
        return $req->sum();
    }


    public function random(){
        $req = Question::all();
        $req = $req->random(2);
       
        $sum = $req->pluck('time');
        return response()->json([ 
            'question' => $req,
            
            'full Time' => $sum->sum(),
            
        ]);
    }



    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'question'=> 'required',
            'niveau'=> 'required',
            'duree'=> 'required',
            'points'=> 'required',
                     ]);
        if($validator->fails()) {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else {

       $question = Question::create([
       'question'=>$request['question'],
       'niveau'=>$request['niveau'],
       'duree'=>$request['duree'],
       'points'=>$request['points'],
       'etat'=>'active',
       'repA'=>$request['repA'],
       'repB'=>$request['repB'],
       'repC'=>$request['repC'],
       'repD'=>$request['repD'],
       'repcorrecte?'=>$request['repcorrecte']
       ]);
        $test=Test::where('titre',$request['titre'] ,'departement',$request['departement'])->push([
            'questions'=>[$question->id , $question->question , $question->niveau ,$question->duree, $question->points]
            
        ]);
      
        return response()->json([
            'status'=>200,
            'test'=>$test,
            'message'=>'question est ajouté avec succès',
        ]);
      
        
        
    }
    }



    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'question'=> 'required',
            'niveau'=> 'required',
            'duree'=> 'required',
            'points'=> 'required',
            'etat'=> 'required',
            'repA'=> 'string|image|mimes:jpeg,png,jpg|max:2048',
            'repB'=> 'string|image|mimes:jpeg,png,jpg|max:2048',
            'repc'=> 'string|image|mimes:jpeg,png,jpg|max:2048',
            'repD'=> 'string|image|mimes:jpeg,png,jpg|max:2048',
            'repcorrecte'
        ]);
        if($validator->fails()){
            return response()->json(
                [ 'validation_errors' => $validator->messages() ,
                  'status'=>422,
                ]);   
    
        }
        else{
             $question = Question::find($id);
             if($question){
                 $question->question = $request->question;
                 $question->niveau = $request->niveau;
                 $question->duree = $request->duree;
                 $question->points=$request->points;
                 $question->etat = $request->etat; 
         
                $question->save();

                 return response()->json(
                    [    'status'=>200,
                        'message' =>'question updated successfully' ,
                      
                    ]);   
             }
             else{
                return response()->json(
                    [    'status'=>404,
                        'message' =>'question non trouvé' ,
                      
                    ]);   ;
             } 
        }
    
    
       
    }  



    public function destroy($id)
    {
        return Question::destroy($id);
    }


    public function search($question)
    {
        return Question::where('question', 'like', '%'.$question.'%')->get();
    }








}
