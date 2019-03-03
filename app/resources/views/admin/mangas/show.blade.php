<table>
  @foreach ($chaters as $item)
    <tr>
      <td>
        <a href="#" >{{ $item->name }}</a>
        <a href="#" >{{ asset('AdminLTE-2.4.9/dist/js/adminlte.js') }}</a>
      </td>
      <td>{{ $item->created_at }}</td>
    </tr>
  @endforeach
</table>