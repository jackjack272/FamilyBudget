<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;
use App\Models\User;
use Carbon\Carbon;

class adminController extends Controller
{
 
    public function show(){
        
        $viewData=[
            'title'=>"all users",
            'sub_title'=>"Do what you think needs to be done!",
            'users'=> DB::table('users')->orderBy('is_admin','desc')->get(),
        ];

        return view('admin.allUsers')->with('viewData',$viewData);
    }

    public function delete($id){
        // echo $id."<br>"; 
        // echo user::findOrFail($id)->name;
        // return view('test');

        User::destroy($id);
        return redirect()->route('admin.all_users');
    }

    public function editUser($id){
        $user=user::findOrFail($id);
        $viewData=[
            'title'=>'change the user',

        ];

        return view('admin.editUserForm')->with('user',$user);
    }

    public function makeAdmin(request $data){
        user::validate($data);

        $newUser=new user();
        $newUser->name= $data->input('name');
        $newUser->email= $data->input('email');
        $newUser->password=bcrypt( $data->input('password'));
        $newUser->is_admin=true;
        
        $newUser->save();
        return  back();
    }

    public function takeAdmin($id){
        $user=user::findOrFail($id);
        $user->is_admin=false;
        $user->save();

        return redirect()->route('admin.all_users'); // can take own admin away
    }

    public function giveAdmin($id){
        $user=user::findOrFail($id);
        $user->is_admin=true;
        $user->save();

        return back();
    }    
    
    public function time_out( $id){
        $now=Carbon::now()->toArray();
        $currentTime=$now['day']+3; // 3 day cool off period


        $user=User::findOrFail($id);
        $user->is_timed_out=true;
        $user->time_out_expire=$currentTime;
        $user->save();

        return back();
    }

    public function takeOff_time_out($id){
        $now=Carbon::now()->toArray();
        $currentTime=$now['day']-1; // -1 since 5>5 fails thus ban stay

        $user=User::findOrFail($id);
        $user->is_timed_out=false;
        $user->time_out_expire=$currentTime;
        $user->save();

        return back();
    }

}
