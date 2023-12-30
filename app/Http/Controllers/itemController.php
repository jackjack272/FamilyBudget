<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\item;
use Illuminate\Support\Facades\Db;


class itemController extends Controller
{
    
    public function show($category_id, $bud_id){
        $catName=Db::table('categories')
            ->where('id',$category_id)
            ->select('name')
            ->get();
        $catName= "What're the items pretaining to ".$catName[0]->name."?";


        $items= DB::table('items')
            ->where('category_id',$category_id)
            ->get();

        $viewData=[
            'title'=>"show me the items",
            'sub_title'=>$catName,
            'items'=>$items,      
            'cat_id'=>$category_id,     
            'bud_id'=>$bud_id,     
        ];
        
        return view('item/showItems')->with('viewData',$viewData);
    }

    public function create(Request $data,$category_id){
        item::validate($data);
        
        $nI=new item();

        $nI->name= $data->input('name');
        $nI->monthly_cost= $data->input('cost');

        if($data->input('interest_rate') !=null ){
            $nI->yearly_interest= $data->input('interest_rate');
        }

        if( $data->input('income')==1){
            $nI->is_income = true;
        }else{
            $nI->is_income = false;
        }

        $nI->category_id=$category_id;
        
        $nI->save();       
        return back();
    }

    public function delete($item_id){
        item::destroy($item_id);
        return back();
    }

    public function giveUpdateForm($item_id,$category_id,$bud_id){

        $item=item::findOrFail($item_id);

        $viewData=[
            'title'=>"Edit form Item",
            'sub_title'=>"Edit ".$item->name ,
            'item'=>$item,
            'item_id'=>$item_id,
            'cat_id'=>$category_id,
            'bud_id'=>$bud_id,
        ];
        return view('item/editItem')->with("viewData",$viewData);
    }

    public function update(Request $data, $item_id, $category_id, $bud_id){
        item::updateValidate($data); 

        $item=item::findOrFail($item_id);
        
        $item->name= $data->input('name');
        $item->monthly_cost= $data->input('cost');
        //$item->yearly_interest= $data->input('interest_rate');
        
        
        if($data->input('income') ==1 ){
            $item->is_income= true;
        }else{
            $item->is_income= false;
        }

        $item->save();
       
        return redirect()->route('item.show',['id'=>$category_id,'bud_id'=>$bud_id]);
    }
}
