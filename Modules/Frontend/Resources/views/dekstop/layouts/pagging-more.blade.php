@if ($paginator->hasMorePages())
<a href="{{ $paginator->nextPageUrl() }}" id="loadmore"><button class="tosca text-white w-100" style="border: none;padding: .75rem;border-radius: 4px;">LOAD MORE</button></a>
@endif