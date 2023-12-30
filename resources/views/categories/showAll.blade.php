@section('title',$viewData['title'])

@section('sub_title',$viewData['sub_title'])
@include('partials.header')



<form  class="moveCenter"  action="{{ route('budget.show', [ 'id'=>$viewData['budget_id'] ] ) }}" method="GET">
    @csrf           
   <input type="submit" value="show me people in the budget" role="button">
</form>


<div class="container u-full-width offEdge">
    <div clas="row">
        <div class="one-third column">
            <h5>How I budget</h5>
            <ol>
                <li>Needs
                    <ul>
                        <li>Housing</li>
                        <li>Food</li>
                        <li>Education</li>
                    </ul>
                </li>
                <li>Wants
                        <ul>
                            <li>Jacket</li>
                            <li>....</li>
                        </ul>
                </li>

                <li>Do i get charged? or do i transfer?</li>
            </ol>   
            
        </div>
  
        <div class="one-third column">
            <form method="post" action="{{ route('categories.add',['id'=>$viewData['budget_id']] )   }}">
                @csrf
                <table>
                    <tr>    
                        <td>
                            <label name="name">What is the name of the category?</label>
                            <input name="name" type="text" maxlength="40" placeholder="Home">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label name="theme">What is the level of this item?</label>
                            @foreach($viewData['needs'] as $level)
                                <input type="radio" value="{{$level}}" name="theme">{{$level}}<br>    
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
        </div>
    
        <div class="one-third column">
            <h5>But, Budget how you see fit</h5>
                <p>It took me 3 paychecks to fine tune by budget where i was within $5. <br> <br>
                    So dont give up on it, come back and tinker with it. <br>  <br>
                    With most banks you can set post dated transactions that move money on specified days.<br>
                    I recomend that you set it to the days you get paid so the money is moved automatically 
                    so you can become an 
                    <a href="https://youtu.be/QLo0GQmCaIw?t=555" target="_blank"><i>automatic millionare.</i></a> 
                </p> 
        </div>

    </div>
</div>


<table class="offEdge">
    <thead>
        <tr>
            <td>category name</td>
            <td>category priority level</td>
            <td>category cost</td>
            <td>category income</td>
            <td>category features</td>
        </tr>
    </thead>

    <tbody>
        @foreach($viewData['categories'] as $cat)
        <tr>
            <td>
                <a href="{{route('item.show',['id'=>$cat->id ,'bud_id'=>$viewData['budget_id']] )}}">
                    <button  class="button button-primary">
                        {{$cat->name}}
                    </button>
                </a>            
            </td>
            <td>{{$cat->theme}}</td>
            <td>${{$cat->cost}}</td>
            <td>${{$cat->income}}</td>

            <td>
                <a href="{{route('categories.updateForm',['id'=>$cat->id] )}}">
                    <button  class="button button-primary">
                        edit
                    </button>
                </a><br>

           
                <a href="{{route('categories.delete',['id'=>$cat->id ])}}">
                    <button  class="button button-primary">
                        delete 
                    </button>
                </a>

            </td>
        </tr>

        @endforeach
    </tbody>
</table>

@include('partials.footer')