
@extends('frontend.layout.layout')
@section('content')

    <div class="clearfix margin-top-90"></div>

    <!-- Content
    ================================================== -->
    <div class="d-flex">
        @include('.frontend.component.menu_left_employer')
        <div class="" style="margin: auto; width: calc(100% - 260px);">
            <!-- Titlebar
            ================================================== -->
            <div id="titlebar" class="single">
                <div class="ms-5">

                    <div class="ms-5 sixteen columns">
                        <h2>Manage Applications</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li>You are here:</li>
                                <li><a href="#">Home</a></li>
                                <li>Job Dashboard</li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
            <div class="ms-5 me-5 margin-bottom-90">

                <!-- Table -->
                <div class="ms-5 me-5 sixteen columns overflow-x-auto">

                    <p class="margin-bottom-25"></p>

                    <table class="manage-table responsive-table">
                        <colgroup>
                            <col width="300">
                            <col width="150">
                            <col width="150">
                            <col width="250">
                            <col width="250">
                            <col width="200">
                            <col width="200">
                        </colgroup>
                        <thead>
                            <tr>
                                <th><i class="fa fa-file-text"></i> Title</th>
                                <th class="text-center"><i class="fa fa-check-square-o"></i>Filled?</th>
                                <th class="text-center"><i class="fa fa-check-square-o"></i>Active</th>
                                <th><i class="fa fa-calendar"></i> Date Posted</th>
                                <th><i class="fa fa-calendar"></i> Date Expires</th>
                                <th><i class="fa fa-user"></i> Applications</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <!-- Item #1 -->
                        @foreach($data_job as $job)
                        <tr>
                            <td class="title"><a href="#">{{$job->title . $job->id}}</a></td>
                            <td class="centered">
                                <input class='checkbox_fail'  {{$job->fill == 1 ? 'checked' : ''}} readonly type='checkbox'>
                            </td>
                            <td class="centered">
                                @if($job->active == 0)
                                <input class='checkbox_fail'   readonly type='checkbox'>
                                @elseif($job->active == 1)
                                <input class='checkbox_fail'  checked readonly type='checkbox'>
                                @elseif($job->active == -1)
                                <div class='label_check_fail'><i class='bi bi-x-lg'></i></div>
                                @endif
                            </td>
                            <td>{{$job->updated_at}}</td>
                            <td>{{$job->closing_day}}</td>
                            <td class="">
                                @if($job->applyJobs->count() > 0)
                                    <a href="{{route('application.manage', $job->id)}}" class="button">Show ({{$job->applyJobs->count()}})</a>
                                @endif
                            </td>
                            <td class="action">
                                @if($job->fill == 0)
                                    <a href="{{route('job.edit', $job->id)}}"><i class="fa fa-pencil"></i> Edit</a>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('fill-job-form-{{$job->id}}').submit();">
                                        <i class="bi bi-check2-circle"></i> Mark Filled
                                    </a>

                                    <form id="fill-job-form-{{$job->id}}" action="{{route('job.fill', $job->id)}}" method="POST" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                @endif
                                <a href="#" class="delete Alert_delete" data-target="{{route('job.delete', $job->id)}}" ><i class="fa fa-remove"></i> Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>



                <div class="m-5 d-flex position-relative">
                    <div class="w-50">
                        <div class="pagination-container ">
                            <div class="paginate " id="pagination-links">
                                {{$data_job->withQueryString()->appends($_GET)->links('.frontend.component.paginate')}}
                            </div>
                        </div>
                    </div>
                    <div class="w-50 d-flex position-relative align-items-center">
                        <a class="cursor-pointer button position-absolute end-0 {{Session::get('user_data.free_jobs_count') == 0 ? 'Alert_buy_service_package' : ''}}"
                            {{Session::get('user_data.free_jobs_count') == 0 ? '' : 'href='.route('job.add')}}>Add Job</a>
                    </div>
                </div>

            </div>
        </div>
@stop
