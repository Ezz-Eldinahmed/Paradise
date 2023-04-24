<div>
    <!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
    <div class="d-flex justify-content-center p-2">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="{{ $tweets->previousPageUrl() }}">Previous</a></li>
                @for ($page = 1; $page <= $tweets->lastPage(); $page++)
                    @if ($page == $tweets->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{ $tweets->url($page) }}">{{ $page }}</a></li>
                    @endif
                    @endfor
                    <li class="page-item"><a class="page-link" href="{{ $tweets->nextPageUrl() }}">Next</a></li>
            </ul>
        </nav>
    </div>
</div>