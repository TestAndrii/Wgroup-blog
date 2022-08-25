@extends('layouts.front')
@section('title','Manage Posts')
@section('content')
		<div class="row">
			<div class="col-12">
				<h3 class="mb-4">Управление статьями</h3>
				<div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Заголовок</th>
                            <th>Картинка</th>
                            <th>Изображение</th>
                            <th colspan="3" class="text-center">Статус / действия</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($data as $post)
                          <tr>
                            <td>{{$post->id}}</td>
                            <td>
                                <a href="{{url('edit-post-form/'.$post->id)}}">{{$post->title}}</a>
                            </td>
                            <td>
                                <img src="{{ asset('imgs/thumb').'/'.$post->thumb }}" width="100" />
                            </td>
                            <td>
                                <img src="{{ asset('imgs/full').'/'.$post->full_img }}" width="100" />
                            </td>
                              <td>
                                  <h5 class="card-title">
                                      @if(Auth::id() == App\Models\User::ADMIN_USER_ID)
                                      <a href="{{url('detail/'.Str::slug($post->title).'/'.$post->id)}}">
                                          <button type="button" class="btn btn-light">
                                              Добавить Комментарии
                                          </button>
                                      </a>
                                      @endif
                                  </h5>
                              </td>
                            <td>
                                @if(Auth::id() == 1)
                                <a href="{{url('moderator-post/'.$post->id)}}">
                                @endif

                                @if($post->moderator)
                                <button type="button" class="btn btn-success">Одобрено / Опубликовано</button>
                                @else
                                <button type="button" class="btn btn-primary">В работе</button>
                                @endif

                                @if(Auth::id() == 1)
                                </a>
                                @endif
                            </td>
                              <td>
                                      <a href="{{url('delete-post/'.$post->id)}}">
                                          <button type="button" class="btn btn-danger">
                                              Удалить
                                          </button>
                                      </a>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection('content')
