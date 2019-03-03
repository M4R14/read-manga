<div class="box-footer clearfix">
  <ul class="pagination pagination-sm no-margin pull-right">
    <li><a href="{{ $data->nextPageUrl() }}">«</a></li>
    @if($data->currentPage() == 1) 
      @foreach (range($data->currentPage(), $data->currentPage() + 3) as $page_number)
        <li @if($data->currentPage() == $page_number) class="active" @endif>
          <a href="{{ $next_page($page_number) }}">{{$page_number}}</a>
        </li>
        <?php 
          if($page_number >= $data->lastPage()) {
            break;
          }
        ?>
      @endforeach
      @if($page_number < $data->lastPage())
        <li><a href="#">...</a></li>
        <li>
          <a href="{{ $next_page($data->lastPage()) }}">{{ $data->lastPage() }}</a>
        </li>
      @endif
    @elseif($data->currentPage() > 1 && $data->currentPage() < $data->lastPage())
      @if($data->currentPage() > 2)
        <li><a href="{{ $next_page(1) }}">1</a></li>
      @endif
      @if($data->currentPage() - 1 > 1)
        <li><a href="#">...</a></li>
      @endif
      @foreach ([
        $data->currentPage() - 1,
        $data->currentPage(),
        $data->currentPage() + 1,
      ] as $page_number)
          <li @if($data->currentPage() == $page_number) class="active" @endif>
            <a href="{{ $next_page($page_number) }}">{{ $page_number }}</a>
          </li>
      @endforeach
      @if($page_number + 1 < $data->lastPage())
        <li><a href="#">...</a></li>
      @endif
      @if($page_number < $data->lastPage())
        <li><a href="{{ $next_page($data->lastPage()) }}">{{ $data->lastPage() }}</a></li>
      @endif
    @elseif($data->currentPage() == $data->lastPage())
      @if($data->lastPage() - 2 > 1)
        <li><a href="{{ $next_page(1) }}">1</a></li>
      @endif
      @if($data->lastPage() - 2 > 1)
        <li><a href="#">...</a></li>
      @endif
      @foreach ([
        $data->lastPage() - 2,
        $data->lastPage() - 1,
        $data->lastPage(),
      ] as $page_number)
        @if($page_number >= 1)
          <li @if($data->currentPage() == $page_number) class="active" @endif>
            <a href="{{ $next_page($page_number) }}">{{ $page_number }}</a>
          </li>
        @endif
      @endforeach
    @endif
    <li><a href="{{ $next_page($data->lastPage()) }}">»</a></li>
  </ul>
</div>
@section('script')
  <script>
      $('.delete-user').click(function(e){
          e.preventDefault() // Don't post the form, unless confirmed
          if (confirm('Are you sure?')) {
              // Post the form
              $(e.target).closest('form').submit() // Post the surrounding form
          }
      });
  </script>
@endsection