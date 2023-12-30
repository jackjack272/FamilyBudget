@section('title',$viewData['title'])
@include('partials.header')


<form class="offEdge" method="post" action="{{ route('categories.update',['id'=>$viewData['cat']->id] ) }}">
    <input name="budget_id" value="{{$viewData['budget_id']}}" hidden>


    @csrf
    <table>
        <tr>    
            <td>
                <label name="name">What is the name of the category?</label>
                <input name="name" type="text" maxlength="40" value="{{$viewData['cat']->name }}">
            </td>
        </tr>

        <tr>
            <td>
                <label name="theme">What is the level of this item?</label>
                @foreach($viewData['needs'] as $level)
                    @if($level ==$viewData['cat']->theme)
                        <input type="radio" value="{{$level}}" name="theme" checked>{{$level}}<br>  
                    @else
                        <input type="radio" value="{{$level}}" name="theme" >{{$level}}<br>

                    @endif
                @endforeach

            </td>   
        </tr>
    
        <tr>
            <td>
                <input type="submit" value="submit">
            </td>       
        </tr>

    </table>
</form>




@include('partials.footer')