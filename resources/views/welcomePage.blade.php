@section('title',$viewData['title'] )
@section('sub_title',$viewData['sub_title'])

@include('partials.header')


<div class="offEdge">
    {!!$viewData['content']!!}
    <br>
    <img src="{{asset('img/'.$viewData['image']) }}" alt="{{$viewData['imgAlt']}}">
</div>
@include('partials.footer')
