<form action="{{ route('admin.mangas.store') }}" method="POST" >
  @csrf
  <label>Name : <label> <input name="name" required> <br>
  <label>abstract : </label> <textarea name="abstract" required ></textarea>  <br>
  <input name="is_close" type="checkbox" checked>close</input> <br>
  <button type="submit" >ADD</button>
</form>