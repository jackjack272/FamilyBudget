@section('title',$viewData['title'])
@section('sub_title',$viewData['sub_title'])
@include('partials.header')



<form class="offEdge" action="
    {{route
        ('item.update' , 
            ['id'=>$viewData['item_id'], 
            'cat_id'=>$viewData['cat_id'],
            'bud_id'=>$viewData['bud_id'],
            ]
        )
    }}" method="post">

    @csrf
    <table>
        <thead>
            <tr>
                <td>What is the name of the item?</td>
                <td>What is the monthly cost of it?</td>
                <!-- <td>Dose it have yeary interest?</td> -->
                <td>Is it income?</td>
               
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input type="text" name="name"  maxlength="25" value="{{$viewData['item']->name}}" >
                </td>

                <td>
                    <input type="number" name="cost" placeholder="300" value="{{$viewData['item']->monthly_cost}}">
                </td>
<!-- 
                <td>
                    <input type="number" name="interest_rate" value="{{$viewData['item']->yearly_interest}}" >%
                </td> -->

                <td>
                    @if($viewData['item']->is_income==true )
                        <input type="radio" name="income" value=1  checked> Yes<br>
                        <input type="radio" name="income" value=0  >No
                    @else
                        <input type="radio" name="income" value=1  > Yes<br>
                        <input type="radio" name="income" value=0  checked>No
                    @endif
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


@include('partials.footer')