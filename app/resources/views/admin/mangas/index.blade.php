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
        <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Found {{ $mangas->total() }} row(s).</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table class="table table-bordered">
                  <thead>
                      <tr>
                        {{-- <th>#</th> --}}
                        <th>Manga</th>
                        <th>is_close</th>
                        <th class="text-center">
                          <a class="btn btn-success"  href="{{ route('admin.mangas.create') }}">add</a>
                        </th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($mangas as $key => $item)
                      <tr>
                        <td>
                          <div class="row">
                            <div class="col-md-2">
                                <img src="{{ route('admin.mangas.get-image', [ 'name' => $item->image->name ]) }}">
                            </div>
                            <div class="col-md-10">
                                <h4>
                                  <small>#{{ $item->id }}</small> Name: 
                                  <a href="{{ route('admin.mangas.show', [ 'id' => $item->id ]) }}">{{ $item->name }}</a>
                                </h4>
                                <p>Abstract: {{ $item->abstract }}</p>
                                <small>created at: {{ $item->created_at }}</small>
                            </div>
                          </div>
                        </td>
                        <td class="text-center">
                          <div class="checkbox">
                            <label>
                              <input name="is_close" type="checkbox" @if($item->is_close == 1) checked @endif>
                            </label>
                          </div>
                        </td>
                        <td class="text-center">
                          <a class="btn btn-warning" href="{{ route('admin.mangas.edit', [ 'id' => $item->id ]) }}" >edit</a>
                          <form method="POST" action="{{ route('admin.mangas.destroy', [ 'id' => $item->id ]) }}">
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
              <!-- /.box-body -->
              @include('layouts.pagination', [ 
                'data' => $mangas,
                'next_page' => function ($page) {
                  return route('admin.mangas.index', [ 'page' => $page ]);
                }
              ])
            </div>
        </div>
    </div>
  </section>
@endsection
