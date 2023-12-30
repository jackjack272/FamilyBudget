<?php

namespace App\Http\Controllers;

use App\Models\budget;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class budgetController extends Controller
{
    private $needLevel=['NEEDS','WANTS','CREDIT_CARD',"MISALANIOUS"];

    public function showTotalsOnNeeds(){
    
        $levels=[]; //it sucks that im hard coding but this is my 3rd 12 hour day so mentally ready to be done 
        // saying 'break time soon' is loosing its charm
        // this is not including time spent on version 1.0 of this which was a garbage fire.  

        // cost of the needs based on category 
        foreach($this->needLevel as $level){
            //join cat, budget, where its for this 1  user. 
            $exp=Db::table('categories')
                ->join('budgets',"budgets.id",'=','categories.budget_id')
                ->where('budgets.user_id',Auth::id() ) // for this hose hold
                ->where('theme',$level) // find the the price of the themes
                ->sum('cost');
            
            $income=Db::table('categories')
                ->join('budgets',"budgets.id",'=','categories.budget_id')
                ->where('budgets.user_id',Auth::id() ) // for this hose hold
                ->where('theme',$level) // find the the price of the themes
                ->sum('income');
        
            // get the top 3 heaviest per category. 
            $heavyItems=DB::table('categories')
                ->join('items','items.category_id','=','categories.id')
                ->where('items.is_income',0) // not income
                ->where('items.monthly_cost', '>',0) 
                ->where('categories.theme',$level)
                
                ->select('items.monthly_cost','items.name')
                

                ->orderBy('items.monthly_cost','Desc')
                ->limit(3)
                ->get();    

            $levels[]=[$level,$exp,$income,$heavyItems];
        }
        // foreach($levels as $item){
        //     foreach($item[3] as $b){
        //         echo $b->monthly_cost;
        //         echo $b->name;
        //     }
        // }
        

        $viewData=[
            'title'=> 'Cost of Living',
            'sub_title'=>'House hold spending based on categories. ',
            "levels"=>$levels
        ];       
             
        return view('budget/totals')->with('viewData',$viewData);
    }

    public function show(){
        
        $viewData=[
            'title'=>'Budgeting works',
            'sub_title'=>"Sighn up to try it out!",
            'list_data'=>[],
            'current_user'=>1,
        ];
        
        if(auth::id() !=null ){ //#1 is going to be the demo user
            $budgetForUser=DB::table('budgets')
                ->where('user_id',auth::id() )
                ->get(); //select all columns

            $name=Db::table('users') ->where('id',auth::id()) ->select('name')->get();
            

            $viewData=[
                'title'=>'Budgeting works',
                'sub_title'=>"Fill in the form to Proceed",
                'list_data'=>$budgetForUser,
                'welcome_me'=>$name[0]->name,
                'current_user'=> Auth::id(),
            ];      
        }  

        return view('budget/listAll')->with('viewData',$viewData);
    }

    public function create(Request $data, $id){ // i am user id 
        //budget::validate($data); // its crashing the prograp desite having right syntax
            //documentation sais it works with request so no sure why its broken 
            //the syntax works for categories and items...

        // validate unique budget name 
        foreach(['for_who', 'total_outflow', 'total_inflow'] as $check ){
            $valid=$data->input($check);

            if($valid== null){
                return back();
            }
            if($check =='for_who'){
                $sameName=Db::table('budgets')
                    ->where('user_id',Auth::id())
                    ->where('for_who',$data->input('for_who'))
                    ->get();
                
                // i know its bad for preformance but sucks to suck
                try{
                    if ($sameName[0]->for_who) return back();
                }catch(Exception $e){   
                    // there was no name found thus we make a new one 
                }
            }
        }
        
        $newBudget=new budget();
        
        $newBudget->for_who=$data->input('for_who');
        $newBudget->total_inflow=$data->input('total_inflow');
        $newBudget->total_outflow=$data->input('total_outflow');
        
        $newBudget->user_id=$id;      
        $newBudget->save();      

        
        return back();

    }

    public function delete($id){
        budget::destroy($id);
        return back();
    }

    public function giveUpdateForm($id){
        $bud=budget::findOrFail($id);
        $viewData=[
            'title'=>'Update Budget Expectations for '.$bud->for_who,
            'sub_title'=>"tinker to your harts content",
            'bud'=>$bud,
        ];

        return view('budget/updateForm')->with('viewData',$viewData);           
    }

    public function update(request $data, $id){
        // $data->validate([
        //     "for_who"=>"require|unique",
        //     "expected_inc"=>"require|numeric|gt:0",
        //     "expected_exp"=>"require|numeric|gt:0",
        // ]); // want to leave this in here to show that i tried to use it but it dosent connect properly 

       

        // validate unique budget name 
        foreach(['for_who', 'expected_exp', 'expected_inc'] as $check ){
            $valid=$data->input($check);

            if($valid== null){
                echo $valid;
                
                return back();
            }   // this one is allowed to have the same name as something in the db
        }
        $ub=budget::findOrFail($id);
       
        $ub->for_who=$data->input('for_who');
        $ub->total_inflow=$data->input('expected_exp');
        $ub->total_outflow=$data->input('expected_inc');
        
        $ub->save();

        return redirect()->route('budget.show');
    }
}