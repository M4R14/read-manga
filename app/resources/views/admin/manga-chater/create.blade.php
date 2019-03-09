@extends('layouts.admin')

@section('title', 'Manga')

@section('content')
<form action="{{ route('admin.manga-chater.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="mangaId" value="{{$manga->id}}" >
  <hr>
  <label>Chater:</label> <input type="number" name="number"> <br>
  <label>public_date:</label> <input type="date" name="public_date[]"><input type="time" name="public_date[]"> <br>
  <h5>Page:</h5>
  <ol>
    @foreach (range(1, $pageSize) as $number)
      <li><input type="file" name="page[]" accept="image/*" ></li>
    @endforeach
  </ol>
  <button type="submit" >SAVE</button>
</form>
@endsection