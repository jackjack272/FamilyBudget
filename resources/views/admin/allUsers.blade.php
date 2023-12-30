@section('title',$viewData['title'])
@section('sub_title',$viewData['sub_title'])
@include('partials.header')


<h4 class="moveCenter">Make an admin form</h4>
<br>
    <div class="moveCenter" name="makeAdmin">
        <form  action="{{route('admin.add') }}" method="post" >

            @csrf
            <label for="name">Give Them a Name </label>
            <input name="name" type="text" placeholder="bob"><br>

            <label for="name">email</label>
            <input name="email" type="email" placeholder="bob@mail.com"><br>
            
            <label for="name">Pain text password</label>
            <input name="password" type="text" placeholder="bob123"><br>

            <input type="submit" value="submit">
        </form>
    </div>
</div>

<div >
<label class="offEdge" for="all users">All users</label>
<table class="offEdge"  name="user">
    <thead>
        <tr>
            <td>name</td>
            <td>email</td>
            <td>is Admin</td>
            <td>is timed out</td>
            <td>time out expies this month</td>
           
        </tr>
    </thead>
    <tbody>
        @foreach($viewData['users'] as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->is_admin}}</td>
                

                <td>{{$user->is_timed_out}}</td>
                @if($user->time_out_expire !=0)
                    <td>{{$user->time_out_expire}}th </td>
                
                @else
                    <td>{{$user->time_out_expire}}</td>
                @endif

            </tr>
            <tr>
                @if($user->is_admin==true)
                <td>
                    <a href="{{route('admin.takeAdmin',['id'=>$user->id]) }}">
                        <button>
                            take admin
                        </button>
                </td>
                @else

                <td>
                    <a href="{{route('admin.giveAdmin', ['id'=>$user->id ])}}">
                        <button>
                            give admin
                        </button>
                    </a>
                </td>
                @endif

                <td>
                    <a href="{{route('admin.time_out',['id'=>$user->id])}}">
                        <button>
                            give 3day time out
                        </button>
                    </a>                    
                </td>

                <td>
                    <a href="{{route('admin.remove_time_out' ,['id'=>$user->id]) }}">
                        <button>
                            lift ban
                        </button>
                    </a>                    
                </td>

                <td>
                    <a href="{{route('admin.delete', ['id'=> $user->id]) }}">
                        <button>
                            delete
                        </button>
                    </a>
                </td>
            </tr>
            <tr><td> </td></tr>

        @endforeach
    </tbody>
</table>



<div>
    <br>
    <br>
    <br>
</div>


@include('partials.footer')