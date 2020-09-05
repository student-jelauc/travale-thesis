@if (count($breadcrumbs))

    <h1 class="h4 mb-0 text-gray-800">
    @foreach ($breadcrumbs as $breadcrumb)

        @if ($breadcrumb->url && !$loop->last)
            <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
        @else
            {{ $breadcrumb->title }}
        @endif

        @if (!$loop->last)
            <i class="fas fa-angle-right mr-1 ml-1 mt-1 text-gray-400"></i>
        @endif

    @endforeach
    </h1>

@endif
