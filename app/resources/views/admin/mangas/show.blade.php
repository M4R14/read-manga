@extends('layouts.admin')

@section('title', 'Manga')

@section('content')
  <section class="content-header">
    <h1>
      Mangas
      {{-- <small>Example 2.0</small> --}}
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Layout</a></li>
      <li class="active">Top Navigation</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-9">
          <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">{{ $manga->name }}</h3>
              </div>
              <div class="box-body">
                <div class="row">
                    <div class="col-md-2">
                      <img src="{{route('admin.mangas.get-image', [ 'name' => $manga->image->name ])}}" >
                    </div>
                    <div class="col-md-10">
                      <p>{{ $manga->abstract }}</p>
                    </div>
                </div>
              </div>
          </div>
          <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Chater</h3>
                <div class="pull-right">
                  <a href="{{ route('admin.manga-chaters.create', [ 'manga_id' => $manga->id ]) }}" class="btn btn-success btn-sm">
                    Add
                  </a>
                </div>
              </div>
              <div class="box-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>ตอน</th>
                        <th>public date</th>
                        <th style="width: 40px">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($chaters as $item)
                        <tr>
                          <td>{{ $item->id }}</td>
                          <td>{{ $item->name }}</td>
                          <td>{{ $item->public_date }}</td>
                          <td>
                            <a class="btn btn-warning" href="{{ route('admin.manga-chaters.edit', [ 'id' => $item->id ]) }}" >edit</a>
                            <form method="POST" action="{{ route('admin.manga-chaters.destroy', [ 'id' => $item->id ]) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <div class="form-group">
                                    <input type="submit" class="btn btn-danger delete-user" value="del">
                                </div>
                            </form>
                          </td>
                        </tr> 
                      @endforeach
                    </tbody>
                  </table>
              </div>
          </div>
      </div>
      <div class="col-md-3">
          <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">{{ $manga->name }}</h3>
              </div>
              <div class="box-body">

              </div>
          </div>
      </div>
    </div>
  </section>
@endsection
