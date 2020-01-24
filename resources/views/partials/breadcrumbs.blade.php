@if (count($breadcrumbs))

    @foreach ($breadcrumbs as $breadcrumb)

        @if ($breadcrumb->url && !$loop->last)
            <h1 class="h3 mb-0 text-gray-800"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></h1>
        @else
            <h1 class="h3 mb-0 text-gray-800">{{ $breadcrumb->title }}</h1>
        @endif

        @if (!$loop->last)
            <i class="fas fa-caret-square-right mr-2 ml-2"></i>
        @endif

    @endforeach

@endif
