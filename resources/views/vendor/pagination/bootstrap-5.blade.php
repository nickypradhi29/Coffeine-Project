@if ($paginator->hasPages())
<div style="display:flex;justify-content:center;align-items:center;gap:6px;margin-top:24px;flex-wrap:wrap;padding:0 16px;">

    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span style="padding:8px 16px;border:1px solid #E8D5B7;border-radius:4px;font-size:12px;color:#9B7550;background:#FAF6F0;font-family:sans-serif;">← Prev</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" style="padding:8px 16px;border:1px solid #C47C3E;border-radius:4px;font-size:12px;color:#8B5A2B;background:#FFFDF9;text-decoration:none;font-family:sans-serif;">← Prev</a>
    @endif

    {{-- Page Numbers --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span style="padding:8px 6px;font-size:12px;color:#9B7550;font-family:sans-serif;">...</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span style="padding:8px 14px;border:1px solid #4A2C1A;border-radius:4px;font-size:12px;background:#4A2C1A;color:#FFFDF9;font-family:sans-serif;">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" style="padding:8px 14px;border:1px solid #E8D5B7;border-radius:4px;font-size:12px;color:#8B5A2B;background:#FFFDF9;text-decoration:none;font-family:sans-serif;">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" style="padding:8px 16px;border:1px solid #C47C3E;border-radius:4px;font-size:12px;color:#8B5A2B;background:#FFFDF9;text-decoration:none;font-family:sans-serif;">Next →</a>
    @else
        <span style="padding:8px 16px;border:1px solid #E8D5B7;border-radius:4px;font-size:12px;color:#9B7550;background:#FAF6F0;font-family:sans-serif;">Next →</span>
    @endif

</div>
@endif