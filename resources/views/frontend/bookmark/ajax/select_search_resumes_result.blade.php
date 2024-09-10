<div id="main-list" class="padding-right">

    <form action="#" method="get" class="list-search">
        <button><i class="fa fa-search"></i></button>
        <input type="text" placeholder="Search freelancer services (e.g. logo design)" value=""/>
        <div class="clearfix"></div>
    </form>
    <ul class="resumes-list">
        @foreach($data_resumes as $resume)

            <li>
                <div class="content ">
                    <img src="{{$resume->photo ? asset($resume->photo) : asset('storage/uploads/user_black.png')}}" alt="">
                    <div class="resumes-list-content">
                        <a href="{{route('resume.detail', $resume->id)}}" class="cursor-pointer text-decoration-underline">
                            <h4 class="Login-to-view">
                                {{$resume->full_name}}
                            </h4>
                        </a>
                        <h5 class="text-decoration-none">{{$resume->professional_title}}</h5>

                        <div class="mt-3">
                            <span><i class="fa fa-map-marker"></i>{{$resume->province_id ? $resume->province->name : ''}}</span>
                            @if($resume->type_salary == 1)
                                <span><i class="fa fa-money"></i>&nbsp;{{$resume->minimum_salary . '$  ' }} <i class="bi bi-arrow-right"></i> {{$resume->maximum_salary . '$'}}</span>
                            @elseif($resume->type_salary == 2)
                                <span><i class="fa fa-money"></i>&nbsp;{{$resume->salary . '$' }}</span>
                            @else
                                <span><i class="fa fa-money"></i>&nbsp;Deal</span>
                            @endif
                        </div>
                        <div class="skills">
                            @php
                                $array_tag_id = explode(', ', $resume->tag_id);
                            @endphp
                            @foreach($data_tags as $tag)
                                @if (in_array($tag->id, $array_tag_id))
                                    <span class='job-tag border-radius-5'>{{$tag->name}}</span>
                                @endif
                            @endforeach
                        </div>
                        <div class="clearfix"></div>

                    </div>
                </div>
                <div class="clearfix"></div>
            </li>
        @endforeach
    </ul>
    <div class="clearfix"></div>

    <div class="pagination-container mb-5">
        <div class="paginate " id="pagination-links">
            {{$data_resumes->withQueryString()->appends($_GET)->links('.frontend.component.paginate')}}
        </div>
    </div>

</div>
