<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class categoriesController extends Controller
{
    private $needLevel=['NEEDS','WANTS','CREDIT_CARD',"MISALANIOUS"];

    public function show($budget_id){

        $catsInBudget=Db::table('categories')
            ->where('budget_id',$budget_id)
            ->select('id')
            ->get();

        $inidItems=[];
        
        for($i=0; $i<count($catsInBudget); $i++  ){
            foreach([0,1] as $is_income){ // is it income? 0;false 1;true
                $cat_cost=DB::table('categories')
                ->where('categories.id',$catsInBudget[$i]->id)
                ->join('items','categories.id','=','items.category_id')
                ->where('items.is_income',$is_income )
                ->sum('items.monthly_cost');
                
                $cat=category::findOrFail($catsInBudget[$i]->id);

                // place into this categories [$i] exp or income
                 if($is_income==0){
                    $cat->cost=$cat_cost;
                 }else{
                    $cat->income=$cat_cost;                   
                 }
                 $cat->save();
            }
            $inidItems[]=$cat;
        }    

        $viewData=[
            'title'=>"categories",
            'sub_title'=>"Break Life Into Its Categories",
            'needs'=>$this->needLevel,
            'categories'=>$inidItems,
            'budget_id'=>$budget_id, 
       ];
        return view('categories/showAll')->with('viewData',$viewData);
    }

    public function create(Request $data, $budget_id){
        // category::validate($data); // items work but this dosent idk why
        
        // not allowed the same name 
        $name= Db::table('categories')
            ->where("budget_id",$budget_id)
            ->where('name',$data->input('name'))
            ->get();

        if(!empty($name[0]) ){
            return back();
        }

        foreach(['name','theme'] as $name){
            if($data->input($name) ==null ) {
                return back();
            }
        }

        $nCat=new category();

        $nCat->name  =$data->input('name');
        $nCat->theme =$data->input('theme');
        $nCat->budget_id =($budget_id);
        $nCat->save();

        return back();
    }

    public function delete($item_id){
        category::destroy($item_id);
        return back();
    }

    public function giveUpdateForm($id){
        $c=category::findOrFail($id);
        $viewData=[
            'title'=>'Update Values For '.$c->name,
            'needs'=>$this->needLevel,
            'cat'=>$c,
            'budget_id'=>$c->budget_id,
        ];

        return view('categories/updateForm')->with('viewData',$viewData);
    }

    public function update(request $data, $id){
        //category::validate($data);
        
        $c=category::findOrFail($id);

        // not allowed the same name 
         $name= Db::table('categories')
            ->where("budget_id",$c->budget_id)
            ->where('name',$data->input('name'))
            ->get();
        
        if(!empty($name[0]) ){
            return back();
        }

        foreach(['name','theme'] as $name){
            if($data->input($name) ==null ) {
                return back();
            }
        }

    
        $c->name=$data->input('name');
        $c->theme=$data->input('theme');
        $c->save();

        return redirect()->route('categories.show',['id'=> $data->input('budget_id')]);
    }

}