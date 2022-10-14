@php $lang = LaravelLocalization::getCurrentLocale(); @endphp
@if ($paginator->hasPages())
<div class="card-footer d-flex align-items-center">
    <ul class="pagination m-0 ms-auto">
        @if ($paginator->onFirstPage())
        @if($lang == 'en')
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <polyline points="15 6 9 12 15 18" />
                </svg>
                {{ __('pagination.previous') }}
            </a>
        </li>
        @else
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <polyline points="9 6 15 12 9 18" />
                </svg>
                {{ __('pagination.previous') }}
            </a>
        </li>
        @endif
        @else
        @if($lang == 'en')
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <polyline points="15 6 9 12 15 18" />
                </svg>
                {{ __('pagination.previous') }}
            </a>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <polyline points="9 6 15 12 9 18" />
                </svg>
                {{ __('pagination.previous') }}
            </a>
        </li>
        @endif
        @endif

        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="page-link disabled" aria-disabled="true"><span>{{ $element }}</span></li>
        @endif
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item active"><a class="page-link">{{ $page }}</a></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        @if ($paginator->hasMorePages())
        @if($lang == 'en')
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                {{ __('pagination.next') }}
                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <polyline points="9 6 15 12 9 18" />
                </svg>
            </a>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                {{ __('pagination.next') }}
                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <polyline points="15 6 9 12 15 18" />
                </svg>
            </a>
        </li>
        @endif
        @else
        @if($lang == 'en')
        <li class="page-item disabled">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                {{ __('pagination.next') }}
                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <polyline points="9 6 15 12 9 18" />
                </svg>
            </a>
        </li>
        @else
        <li class="page-item disabled">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                {{ __('pagination.next') }}
                <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <polyline points="15 6 9 12 15 18" />
                </svg>
            </a>
        </li>
        @endif
        @endif
    </ul>
</div>
@endif