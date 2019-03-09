@extends('layouts.admin')

@section('title', 'Manga')

@section('content')
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Quick Example</h3>
        </div>
        <form action="{{ route('admin.manga.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="box-body">
            <div class="form-group">
                <label>Name : </label>
                <input name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Abstract : </label>
                <textarea name="abstract" rows="5" class="form-control" required ></textarea> 
            </div>
            <div class="form-group">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="is_close" checked> Close
                  </label>
                </div>
            </div>
            <div class="form-group">
              <label for="exampleInputFile">File input</label>
              <input name="image" type="file" id="exampleInputFile" accept="image/*">
              {{-- <p class="help-block">Example block-level help text here.</p> --}}
            </div>
          </div>
          <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection