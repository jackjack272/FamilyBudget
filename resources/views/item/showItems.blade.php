@section('title',$viewData['title'])
@section('sub_title',$viewData['sub_title'])
@include('partials.header')

<form id="UpALayer" action="{{route('categories.show',['id'=>$viewData['bud_id']])}}" 
method="GET">
@csrf           
   <input class="moveCenter" type="submit" value="send me to categories" role="button">
</form>


<form class="offEdge" action="{{route('item.add' , [ 'id'=>$viewData['cat_id'] ] )}}" method="post">
    @csrf
    <table>
        <thead>
            <tr>
                <td>What is the name of the item?</td>
                <td>What is the monthly cost of it?</td>
                <!-- <td>Dose it have yeary interest?(defaults to 0 )</td> -->
                <td>Is it income?</td>
               
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input type="text" name="name"  maxlength="25" placeholder="Cheese" >
                </td>

                <td>
                    <input type="number" name="cost" placeholder="300">
                </td>

                <!-- <td>
                    <input type="number" name="interest_rate" placeholder="3">%
                </td> -->

                <td>
                    <input type="radio" name="income" value=1  placeholder="Cheese" > Yes<br>
                    <input type="radio" name="income" value=0  placeholder="Cheese" >No
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="submit">
                </td>
            </tr>
        </tbody>
    </table>
</form>


<label class="offEdge"  for="exp">Income</label>
<table class="offEdge"  name="exp">
    <tr>
        <td>Name of the Item</td>
        <td>Monthly Cost </td>
        <!-- <td>Item's interest rate</td> -->
        <td>Its Income</td>
    </tr>

    @foreach($viewData['items'] as $item)
        @if($item->is_income==1)
        <tr>
            <td>{{$item->name}}</td>
            <td>${{$item->monthly_cost}}</td>
            <!-- <td>{{$item->yearly_interest}}%</td> -->
            <td>thickens wallet :)</td>
            
            
            <td>
                <a href="{{route('item.updateForm',
                        [ 'id'=>$item->id ,
                        'cat_id'=>$viewData['cat_id'],
                        'bud_id'=>$viewData['bud_id'] 

                        ]) }}">
                    <button  class="button button-primary">
                    edit 
                    </button>
                <a>
            </td>

            <td>
                <a href="{{route('item.delete',['id'=>$item->id ] )}}">
                <button  class="button button-primary">
                    delete 
                </button>
                <a>
            </td>
            
        </tr>
        @endif
    @endforeach
</table>

<label class="offEdge"  for="exp">Expenses</label>
<table class="offEdge"  name="exp" class="floatRight"> 
    <tr>
        <td>Name of the Item</td>
        <td>Monthly Cost </td>
        <!-- <td>Item's interest rate</td> -->
        <td>Its Income</td>
    </tr>

    @foreach($viewData['items'] as $item)
        @if($item->is_income==0)
        <tr>
            <td>{{$item->name}}</td>
            <td>${{$item->monthly_cost}}</td>
            <!-- <td>{{$item->yearly_interest}}%</td> -->
            <td>It drains wallet :(</td>

            <td>
                <a href="{{route('item.updateForm',
                        [ 'id'=>$item->id ,
                        'cat_id'=>$viewData['cat_id'],
                        'bud_id'=>$viewData['bud_id'] 
                        
                        ]) }}">
                    <button class="button button-primary">
                        edit 
                    </button>
                <a>
            </td>

            <td>
                <a href="{{route('item.delete',['id'=>$item->id ] ) }}">
                <button  class="button button-primary">
                    delete 
                </button>
                <a>
            </td>
        </tr>
        @endif
    @endforeach
</table>

@include('partials.footer')