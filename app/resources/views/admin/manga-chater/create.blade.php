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
                  <h3 class="box-title">Quick Example</h3>
                </div>
                <form action="{{ route('admin.manga-chater.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="mangaId" value="{{$manga->id}}" >
                  <div class="box-body">
                      <div class="form-group">
                        <label>Chater:</label>
                        <input class="form-control" type="number" name="number">
                      </div>
                      <div class="form-group">
                        <label >public_date:</label>
                        <div class="row">
                          <div class="col-xs-3">
                            <input class="form-control" type="date" name="public_date[]">
                          </div>
                          <div class="col-xs-2">
                            <input  class="form-control" type="time" name="public_date[]">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                          <table class="table table-bordered">
                              <tbody><tr>
                                <th style="width: 10px">Page:</th>
                                <th></th>
                              </tr>
                              @foreach (range(1, $pageSize) as $number)
                                <tr>
                                  <td class="text-center">{{ $number }}</td>
                                  <td>
                                    <input type="file" name="page[]" accept="image/*" >
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
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