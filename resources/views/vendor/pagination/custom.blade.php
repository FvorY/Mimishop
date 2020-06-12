@if ($paginator->hasPages())
<div class="pro-pagination-style text-center mt-30" style="color: red;">
    <ul>
        @if ($paginator->onFirstPage())
        <li><a class="prev" disabled href="#" aria-disabled="true" aria-label="@lang('pagination.previous')"><i class="sli sli-arrow-left"></i></a></li>
        @else

          @if (isset($_GET['search']))
            <li><a class="prev" href="{{ $paginator->previousPageUrl() }}&search={{$_GET['search']}}" rel="prev" aria-label="@lang('pagination.previous')"><i class="sli sli-arrow-left"></i></a></li>
          @else
            <li><a class="prev" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="sli sli-arrow-left"></i></a></li>
          @endif

        @endif
        @foreach ($elements as $element)
          @if (is_string($element))
            <li><a disabled href="#">{{ $element }}</a></li>
          @endif
          @if (is_array($element))
              @foreach ($element as $page => $url)
                  @if ($page == $paginator->currentPage())
                      <li><a class="active" href="#">{{ $page }}</a></li>
                  @else
                    @if (isset($_GET['search']))
                      <li><a href="{{ $url }}&search={{$_GET['search']}}">{{ $page }}</a></li>
                    @else
                      <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                  @endif
              @endforeach
          @endif
        @endforeach
        @if ($paginator->hasMorePages())
          @if (isset($_GET['search']))
            <li><a class="next" href="{{ $paginator->nextPageUrl() }}&search={{$_GET['search']}}" rel="next" aria-label="@lang('pagination.next')"><i class="sli sli-arrow-right"></i></a></li>
          @else
            <li><a class="next" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="sli sli-arrow-right"></i></a></li>
          @endif
        @else
        <li><a class="next" disabled aria-disabled="true" aria-label="@lang('pagination.next')"><i class="sli sli-arrow-right"></i></a></li>
        @endif
    </ul>
</div>
@endif
