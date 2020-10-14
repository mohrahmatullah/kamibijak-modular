<!-- Pagination -->
<div class="row justify-content-center">
  <div class="col-10 text-center">
    @if (isset($paginator) && $paginator->lastPage() > 1)
    <ul class="list-unstyled d-inline-block">
      <?php
        $interval = isset($interval) ? abs(intval($interval)) : 3 ;
        $from = $paginator->currentPage() - $interval;
        if($from < 1){
            $from = 1;
        }

        $to = $paginator->currentPage() + $interval;
        if($to > $paginator->lastPage()){
            $to = $paginator->lastPage();
        }
      ?>
      <!-- first/previous -->
      @if($paginator->currentPage() > 1)
        <li class="float-left"><a href="{{ $paginator->url($paginator->currentPage() - 1) }}" class="px-2 text-black text-uppercase">Prev</a></li>
        <!-- <li>
            <a href="{{ $paginator->url(1) }}" aria-label="First">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li> -->
      @endif

      <!-- links -->
      @for($i = $from; $i <= $to; $i++)
          <?php 
          $isCurrentPage = $paginator->currentPage() == $i;
          ?>
          <li class="{{ $isCurrentPage ? 'active' : '' }} float-left"><a href="{{ !$isCurrentPage ? $paginator->url($i) : '#' }}" class="px-2 text-black">{{ $i }}</a></li>
      @endfor

      <!-- next/last -->
      @if($paginator->currentPage() < $paginator->lastPage())      
      <li class="{{ $paginator->url($paginator->currentPage() + 1) }} float-left"><a href="{{ $paginator->url($paginator->currentPage() + 1) }}" class="px-2 text-black text-uppercase">Next</a></li>

          <!-- <li>
              <a href="{{ $paginator->url($paginator->lastpage()) }}" aria-label="Last">
                  <span aria-hidden="true">&raquo;</span>
              </a>
          </li> -->
      @endif
    </ul>
    @endif
  </div>
</div>
<!-- /Pagination -->