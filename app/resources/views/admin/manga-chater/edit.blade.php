@extends('layouts.admin')

@section('title', 'Manga')

@section('content')
<section class="content-header">
  <h1>
      Mangas
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
                  <h3 class="box-title">เพิ่ม page</h3>
                </div>
                <form
                  method="POST"
                  enctype="multipart/form-data"
                  action="{{ route('admin.manga-chater-image.store', [ 'chater' => $data->id ]) }}"
                >
                  @csrf
                  <div class="box-body">
                    <div class="row" >
                      <div class="col-xs-6" >
                        <label class="">Upload</label>
                        <input type="file" name="image">
                      </div>
                      <div class="col-xs-6" >
                        <label class="">Page Number</label>
                        <input
                          class="form-control"
                          type="number"
                          name="number"
                          value="{{ $data->images->count() + 1 }}"
                        >
                      </div>
                    </div>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                  </div>
                </form>
            </div>
            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Quick Example</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>#</th>
                              <th colspan="">
                              </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->images as $key => $item)
                              <tr>
                                <td>{{ $key + 1 }}</td>
                                  <td>
                                    {{$item->image->name}} <br>
                                    <img src="{{ route('admin.manga-chater-image.show', [ 'id' => $item->id ]) }}">
                                  </td>
                                  <td>
                                    [move]
                                  </td>
                                  <td>
                                    [del]
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
                  <h3 class="box-title">Quick Example</h3>
                </div>
                <form action="{{ route('admin.manga-chater.update', [ 'id' => $data->id ]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    <div class="box-body">
                      <div class="form-group">
                        <label>Chater:</label>
                        <input
                          class="form-control"
                          type="number"
                          name="name"
                          value="{{ $data->name }}"
                        >
                      </div>
                      <div class="form-group">
                        <label >public_date:</label>
                          <input
                            class="form-control"
                            type="date"
                            name="public_date[]"
                            value="{{ \Carbon\Carbon::parse($data->public_date)->format('Y-m-d') }}"
                          >
                          <input
                            class="form-control"
                            type="time"
                            name="public_date[]"
                            value="{{ \Carbon\Carbon::parse($data->public_date)->format('H:s') }}"
                          >
                      </div>
                    </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection