@extends('layouts.front')
@section('title','Home Page')
@section('content')
		<div class="row">
			<div class="col-12">
				<div class="row mb-5">
					@if(count($posts)>0)
						@foreach($posts as $post)
						<div class="col-md-4">
							<div class="card">
							  <a href="{{url('detail/'.Str::slug($post->title).'/'.$post->id)}}"><img src="{{asset('imgs/thumb/'.$post->thumb)}}" class="card-img-top" alt="{{$post->title}}" /></a>
							  <div class="card-body">
							    <h5 class="card-title"><a href="{{url('detail/'.Str::slug($post->title).'/'.$post->id)}}">{{$post->title}}</a></h5>
							  </div>
							</div>
						</div>
						@endforeach
					@else
					<p class="alert alert-danger">Нет доступных статей</p>
					@endif
				</div>
				<!-- Pagination -->
				{{$posts->links()}}
			</div>
		</div>
@endsection('content')
