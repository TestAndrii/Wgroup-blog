@extends('layouts.front')
@section('title','Save Post')
@section('content')
		<div class="row">
			<div class="col-md-8 mb-5">
				<h3>Редактирование статьи</h3>
				<div class="table-responsive">

                @if($errors)
                  @foreach($errors->all() as $error)
                    <p class="text-danger">{{$error}}</p>
                  @endforeach
                @endif

                @if(Session::has('success'))
                <p class="text-success">{{session('success')}}</p>
                @endif

                <form method="post" action="{{url('save-post-form')}}" enctype="multipart/form-data">
                  @csrf
                  <table class="table table-bordered">
                      <tr>
                          <th>Заголовок<span class="text-danger">*</span></th>
                          <td>
                              <input type="text" name="title" class="form-control" value="{{$post->title ?? ''}}"/>
                          </td>
                      </tr>
                      <tr>
                          <th>Миниатюра</th>
                          <td>
                              @if(isset($post->thumb))
                              <img src="{{ asset('imgs/thumb').'/'.$post->thumb }}" width="100" />
                              @else
                              <input type="file" name="post_thumb"/>
                              @endif
                          </td>
                      </tr>
                      <tr>
                          <th>Большая картинка</th>
                          <td>
                              @if(isset($post->full_img))
                              <img src="{{ asset('imgs/full').'/'.$post->full_img }}" width="100" />
                              @else
                              <input type="file" name="post_image"/>
                              @endif
                          </td>
                      </tr>
                      <tr>
                          <th>Текст статьи<span class="text-danger">*</span></th>
                          <td>
                            <textarea class="form-control" name="detail">{{$post->detail ?? ''}}</textarea>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">
                              <input type="submit" class="btn btn-primary" />
                          </td>
                      </tr>
                  </table>
                </form>
              </div>
			</div>
		</div>
@endsection('content')
