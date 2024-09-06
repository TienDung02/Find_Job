<div id="main-list" class="padding-right">
    <form action="{{ route('job.meili') }}" method="get" class="list-search">
        <button><i class="fa fa-search"></i></button>
        <input type="search" id="query" name="query" placeholder="job title, keywords or company name" value=""/>
        <div class="clearfix"></div>
    </form>

    <ul class="job-list">
        @if(isset($results) && $results->isNotEmpty())
            @php
                $data_jobs = $results
            @endphp
        @endif
        @foreach($data_jobs as $job)
            <li class=" position-relative ">
                <div class="content d-flex align-items-center {{$job->jobType->name}}">
                    <img  src="{{asset($job->company->company_logo)}}">
                    <div class="job-list-content ms-5">
                        <a href="{{route('job.detail', $job->id)}}" class="cursor-pointer text-decoration-underline">
                            <h4 class="Login-to-view">
                                {{$job->title}}
                            </h4>
                        </a>
                        <div class="job-icons ">
                            <span><i class="fa fa-briefcase"></i> {{$job->company->company_name}}</span>
                            <span><i class="fa fa-map-marker"></i> {{$job->company->province->name}}</span>
                            @if(auth()->check())
                                @if($job->type_salary == 1)
                                    <span><i class="fa fa-money"></i>&nbsp;{{$job->minimum_salary . '$  ' }} <i class="bi bi-arrow-right"></i> {{$job->maximum_salary . '$'}}</span>
                                @elseif($job->type_salary == 2)
                                    <span><i class="fa fa-money"></i>&nbsp;{{$job->salary . '$' }}</span>
                                @else
                                    <span><i class="fa fa-money"></i>&nbsp;Deal</span>
                                @endif
                            @elseif(!auth()->check())
                                <span><a href="{{route('auth.login')}}" class="border-0 cursor-pointer text-decoration-underline Login-to-view"><i class="fa fa-money"></i>Login to view salary</a></span>
                            @endif

                        </div>
                        <span class="mt-2"><i class="bi bi-calendar2-week"></i> {{getDayDifference($job)}} </span>
                        @php
                            $array_tag_id = explode(', ', $job->tag_id);
                        @endphp
                        @foreach($data_tag as $tag)
                            @if (in_array($tag->id, $array_tag_id))
                                <span class='job-tag rounded-pill'>{{$tag->name}}</span>
                            @endif
                        @endforeach
                    </div>
                    <span class="p-2 border text-white position-absolute end-0 me-5 {{$job->jobType->name}}">{{$job->jobType->name}}</span>
                </div>
                <div class="clearfix"></div>
            </li>
        @endforeach
    </ul>
    <div class="clearfix"></div>

    <div class="pagination-container mb-5">
        <div class="paginate " id="pagination-links">
            {{$data_jobs->withQueryString()->appends($_GET)->links('.frontend.component.paginate')}}
        </div>
    </div>
</div>
