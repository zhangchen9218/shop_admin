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

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="layui-laypage-spr" aria-disabled="true">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="layui-laypage-curr" aria-current="page"><em class="layui-laypage-em" style="background-color:#1E9FFF;"></em><em>{{ $page }}</em></span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

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
