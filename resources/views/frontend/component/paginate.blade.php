<?php
$link_limit = 7; // maximum number of links
?>
@if ($paginator->lastPage() > 1)
    <ul class="pagination1 position-relative mb-0">



{{--        <ul class="pagination2 pagination-sm m-0  text-center" >--}}
            <li class="position-absolute start-0 ">
                <a class="ps-5 pe-5 page-link {{ ($paginator->currentPage() == 1) ? ' disabled ' : '' }}" href="{{ $paginator->url(1)}}" aria-label="Prev">
                    First
                </a>
            </li>
            <li class="page-item">
                <a class="page-link {{ ($paginator->currentPage() == 1) ? ' disabled ' : '' }}" href="{{ $paginator->url($paginator->currentPage()-1)}}" aria-label="Prev">
                    <i class="bi bi-caret-left-fill"></i>
                </a>
            </li>
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                    <?php
                    $half_total_links = floor($link_limit / 2);
                    $from = $paginator->currentPage() - $half_total_links;
                    $to = $paginator->currentPage() + $half_total_links;
                    if ($paginator->currentPage() < $half_total_links) {
                        $to += $half_total_links - $paginator->currentPage();
                    }
                    if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                        $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                    }
                    ?>
                @if ($from < $i && $i < $to)
                    <li class="page-item">
                        <a class="page-link {{ ($paginator->currentPage() == $i) ? 'current-page' : '' }}"  href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor
            <li>
                <a class="page-link {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}" href="{{ $paginator->url($paginator->currentPage()+1) }}" aria-label="Next">
                    <i class="bi bi-caret-right-fill"></i>
                </a>
            </li>
            <li class="position-absolute end-0 ">
                <a class="ps-5 pe-5 page-link {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}" href="{{ $paginator->url($paginator->lastPage()) }}" aria-label="Next">
                    Last
                </a>
            </li>
    </ul>




@endif

