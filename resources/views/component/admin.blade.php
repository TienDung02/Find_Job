<?php
// config
$link_limit = 7; // maximum number of links
?>
@if ($paginator->lastPage() > 1)
    <ul class="pagination1 mb-0">
        <li >
            <a id="paginate-pre" class="{{ ($paginator->currentPage() == 1) ? ' disabled page-item' : '' }}" href="{{ $paginator->url(1) }}" aria-label="Prev">
                <i class="fa fa-arrow-left"></i> First
            </a>
        </li>
        <li >
            <a id="paginate-next" class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled page-item' : '' }}" href="{{ $paginator->url($paginator->lastPage()) }}" aria-label="Prev">
                <i class="fa fa-arrow-left"></i> Last
            </a>
        </li>
    </ul>



    <ul class="pagination2 pagination-sm m-0  text-center" >
        <li>
            <a class="page-link {{ ($paginator->currentPage() == 1) ? ' disabled page-item' : '' }}" href="{{ $paginator->url(1)}}" aria-label="Prev">
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
                    <a class="page-link {{ ($paginator->currentPage() == $i) ? ' active' : '' }}"  href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endif
        @endfor
        <li>
            <a class="page-link page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}" href="{{ $paginator->url($paginator->currentPage()+1) }}" aria-label="Next">
                <i class="bi bi-caret-right-fill"></i>
            </a>
        </li>
    </ul>
@endif
{{--
@if ($paginator->lastPage() > 1)
    <nav aria-label="Page navigation example">
        <ul class="pagination" style="justify-content: flex-end;">
            <li class="{{ ($paginator->currentPage() == 1) ? ' disabled page-item' : 'page-item' }}">
                <a class="page-link" href="{{ $paginator->url($paginator->currentPage()-1) }}" aria-label="Previous">
                    {{ __("Prev") }}
                </a>
            </li>
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}" aria-label="Next">
                    {{ __("Next") }}
                </a>
            </li>
        </ul>
    </nav>
@endif--}}
