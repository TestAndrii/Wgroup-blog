@extends('layouts.front')
@section('title','Save Post')
@section('content')
		<div class="row">
			<div class="col-md-8 mb-5">
				<h3>Добавление статьи</h3>
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
                              <input type="text" name="title" class="form-control"/>
                          </td>
                      </tr>
                      <tr>
                          <th>Миниатюра</th>
                          <td>
                              <input type="file" name="post_thumb"/>
                          </td>
                      </tr>
                      <tr>
                          <th>Большая картинка</th>
                          <td>
                              <input type="file" name="post_image"/>
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
