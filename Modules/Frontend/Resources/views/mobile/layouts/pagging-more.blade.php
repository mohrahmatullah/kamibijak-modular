@if ($paginator->hasMorePages())
    <center><a href="{{ $paginator->nextPageUrl() }}" class="btn-load text-tosca py-2 px-4 mb-2 d-inline-block text-uppercase" id="loadmore" style="border: 1px solid #14A3B2;border-radius: 4px;">View more</a></center>
@endif