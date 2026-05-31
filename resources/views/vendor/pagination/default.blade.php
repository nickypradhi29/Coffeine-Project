@if ($paginator->hasPages())
<div style="display:flex;justify-content:center;gap:6px;margin-top:20px;flex-wrap:wrap">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span style="padding:7px 16px;border:1px solid #E8D5B7;border-radius:4px;font-size:12px;color:#9B7550;background:#FAF6F0">← Prev</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" style="padding:7px 16px;border:1px solid #C47C3E;border-radius:4px;font-size:12px;color:#8B5A2B;background:#FFFDF9;text-decoration:none">← Prev</a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span style="padding:7px 10px;font-size:12px;color:#9B7550">{{ $element }}</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span style="padding:7px 14px;border:1px solid #4A2C1A;border-radius:4px;font-size:12px;background:#4A2C1A;color:#FFFDF9">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" style="padding:7px 14px;border:1px solid #E8D5B7;border-radius:4px;font-size:12px;color:#8B5A2B;background:#FFFDF9;text-decoration:none">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" style="padding:7px 16px;border:1px solid #C47C3E;border-radius:4px;font-size:12px;color:#8B5A2B;background:#FFFDF9;text-decoration:none">Next →</a>
    @else
        <span style="padding:7px 16px;border:1px solid #E8D5B7;border-radius:4px;font-size:12px;color:#9B7550;background:#FAF6F0">Next →</span>
    @endif
</div>
@endif