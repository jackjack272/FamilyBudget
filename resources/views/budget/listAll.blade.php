@section("title",$viewData['title'])
@section('sub_title',$viewData['sub_title'])

@include('partials.header')
<hr>
<br>
<br>
<br>
@auth
<h4>Welcome {{$viewData['welcome_me']}} </h4>
@endauth

<!-- I am the form table -->
<form method="post" action="{{route('budget.add',['id'=>$viewData['current_user'] ])}}">
<p>This for dose not allow for duplicate names, and negative $ values. It will send you back.</p>    
@csrf
<table>
    <thead>
        <tr>
            <td>Who is this budget For?</td>
            <td>What's your expected expence for the month?</td>
            <td>What's your monthly earning for the month?</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
               
                <input type="text" maxlength="30" name="for_who" placeholder="my self" >
            </td>

            <td>
               
                <input type="number" maxlength="30" name="total_outflow" placeholder="1500" >
            </td>

            <td>
                
                <input type="number" maxlength="30" name="total_inflow" placeholder="1200" >
            </td>
        </tr>
   
        @auth
        <tr>
            <td>
                <input type="submit" value="submit">
            </td>
        </tr>
        @endauth

    </tbody>
</table>
</form>


<!-- I am the display table -->
<table>
    @auth
    <thead>
        <tr>
            <td>Budget for </td>
            <td>expected income  </td>
            <td>expected outflow </td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>   
    </thead>

    <?php 
        $expected_income=0;
        $expected_expecnce=0;
    ?>

    @foreach($viewData['list_data'] as $data)
    <tbod>
        
        <?php
            $expected_income+=$data->total_inflow;
            $expected_expecnce+=$data->total_outflow;
        ?>        

        <tr>
            <td>
                <a href="{{route('categories.show',['id'=>$data->id ]) }}">
                    <button  class="button button-primary">
                        {{$data->for_who}}
                    </button>
                </a>
            </td>

            <td>{{$data->total_inflow}}</td>
            <td>{{$data->total_outflow}}</td>
            <td>
                <a href="{{route('budget.updateForm',['id'=>$data->id] )}}">
                    <button  class="button button-primary">
                        edit 
                    </button>
                <a>
            </td>

            <td>
                <a href="{{route('budget.delete',['id'=>$data->id ])}}">
                    <button  class="button button-primary">
                        delete 
                    </button>
                <a>
            </td>
        </tr>
    </tbod>
    @endforeach
    @endauth
</table>

<div>
    Okay! so youre expecing {{$expected_expecnce}} cost with {{$expected_income}} income? <br>
    lets find out how close you are to the money!
    make your budget and click on the 'see budget' tab to get the reality! 
</div>




@include('partials.footer')