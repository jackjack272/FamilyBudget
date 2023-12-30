@section('title',$viewData['title'])
@section('sub_title',$viewData['sub_title'])
@include('partials.header')

<div class="centerMe offEdge">
    {{$viewData['content']}}
</div>

<br>
<br>
<br>


    

</form>


@include('partials.footer')