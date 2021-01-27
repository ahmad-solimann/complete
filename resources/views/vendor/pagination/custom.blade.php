<style type="text/css">
    .my-active span{
        background-color: #0c0c0c !important;
        color: white !important;
        border-color: #0c0c0c !important;
    }
    a{
        text-decoration: none;

    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarText">
    @if ($paginator->hasPages())
        <ul class="navbar-nav mr-auto">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled nav-item"><span class="nav-link">← Previous</span></li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a></li>
            @endif


            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled nav-item"><span class="nav-link">{{ $element }}</span></li>
                @endif


                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active my-active nav-item"><span class="nav-link">{{ $page }}</span></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach


            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="nav-item"><a class="nav-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a></li>
            @else
                <li class="disabled nav-item"><span class="nav-link">Next →</span></li>
            @endif
        </ul>
    @endif
    </div>
</nav>