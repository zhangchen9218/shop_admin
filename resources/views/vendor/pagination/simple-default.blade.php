@if ($paginator->hasPages())
    <div class="layui-box layui-laypage layui-laypage-default" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="layui-laypage-prev layui-disabled" aria-disabled="true">
                @lang('pagination.previous')
            </span>
        @else
            <a class="layui-laypage-prev" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                @lang('pagination.previous')
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="layui-laypage-next" href="{{ $paginator->nextPageUrl() }}" rel="next">
                @lang('pagination.next')
            </a>
        @else
            <span class="layui-laypage-next layui-disabled">
                @lang('pagination.next')
            </span>
        @endif
    </div>
@endif
