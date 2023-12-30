

@section("title",$viewData['title'])

@section('sub_title',$viewData['sub_title'])
@include('partials.header')

<hr>
<br>
<br>
<br>

<form class="offEdge" method="post" action="{{route('budget.update',['id'=>$viewData['bud']->id ])}}"> <!-- // i am the budget ID -->
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
                <label name="for_who"></label>
                <input type="text" maxlength="30" name="for_who" value="{{$viewData['bud']->for_who }}" >
            </td>

            <td>
                <label name="for_who"></label>
                <input type="number" maxlength="30" name="expected_exp" value="{{$viewData['bud']->total_inflow }}" >
            </td>

            <td>
                <label name="for_who"></label>
                <input type="number" maxlength="30" name="expected_inc" value="{{$viewData['bud']->total_outflow }}">
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