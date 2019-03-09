@extends('layouts.admin')

@section('title', 'Manga')

@section('content')
<form action="{{ route('admin.manga-chater.update', [ 'id' => $data->id ]) }}" method="POST" enctype="multipart/form-data">
  @csrf
  <hr>
  <ol>
    @foreach ($data->images as $key => $number)
      <li>{{$key}}</li>
    @endforeach
  </ol>
</form>
<table class="table table-bordered">
    <thead>
        <tr>
          <th>#</th>
          <th>image</th>
          <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data->images as $key => $item)
          <tr>
            <td>{{ $key + 1 }}</td>
              <td>
                {{$item->image->name}} <br>
                <img src="{{ route('admin.manga.get-image', [ 'name' => $item->image->name ]) }}">
              </td>
              <td>
                [del]
              </td>
          </tr>
        @endforeach
    </tbody>
</table>
@endsection