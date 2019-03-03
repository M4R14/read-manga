<table>
  @foreach ($chaters as $item)
    <tr>
      <td>
        <a href="#" >{{ $item->name }}</a>
      </td>
      <td>{{ $item->created_at }}</td>
    </tr>
  @endforeach
</table>