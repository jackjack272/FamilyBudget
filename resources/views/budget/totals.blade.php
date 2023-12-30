@section('title', $viewData['title'])
@section('title', $viewData['title'])
@include('partials.header')

<table class="offEdge">

    <?php
        $actual_income=0;
        $actual_expense=0;
    ?>
    
    <tr> <!--category costs -->
        <b>Category Cost & Top 3 Cost Items</b>
        @foreach($viewData['levels'] as $item)
            <td>
                {{$item[0]}} are costing:<br>
                expenses: ${{$item[1]}} -<br>
                income: ${{$item[2]}}<br>
                ---------------------<br>
                costs me: ${{$item[1]-$item[2]}}
            </td>

            <?php
                $actual_expense+=$item[1];
                $actual_income+=$item[2];
            ?>
        @endforeach
    </tr>

    <tr> <!--heaviest items -->
       @foreach($viewData['levels'] as $item)
        <td>
            {{$item[0]}}<br>
            
            @foreach($item[3] as $heavy)
               ${{$heavy->monthly_cost}} - {{$heavy->name}} <br>
            @endforeach
        </td>
       @endforeach
    </tr>

    <tr> <!--misalanious -->
        <td>
            Out of pocket cost: <br>
            ${{$actual_expense - $actual_income }}
        </td>
    </tr>

    <tr><!--misalanious -->
    
        <td>
            Are the items above addressable?<br>
            Could you bargin hunt?
        </td>
    </tr>

  

</table>

I would reccomend that you save ${{$actual_income*.04}} per payperiod. <br>
If not now, lickly not tommorow, so on and so forth for a year or two... right? <br>
there will always be a next expense, a next want, a next ...
<br><br>

If you choose to split this on 2 pay checks youll need to save only  ${{$actual_expense/2}}.

 



@include('partials.footer')