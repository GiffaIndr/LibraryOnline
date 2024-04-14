@extends('layout.sidebar')
@section('content2')
@foreach($books as $data)
<div class="d-flex justify-content-center" style="gap: 20px">
<div>
<img src="{{asset('assets/img/' . $data->cover)}}" width="400" height="" alt="">
</div>
<div>
<h1>{{$data->title}}</h1>
<h3>{{$data->writer}}</h3>
<h5>{{$data->release}}</h5>
<h4>{{$data->category}}</h4>
<p>{{$data->synopsis}}</p>
</div>
</div>
@endforeach
@endsection