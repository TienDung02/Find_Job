@extends('frontend.layout.layout')
@section('content')
<div class="clearfix margin-top-90"></div>

<div class="d-flex">
    @include('.frontend.component.menu_left_candidate')
    <!-- Titlebar
    ================================================== -->
    <div style="margin: auto;width: calc(100% - 260px); ">
        <div id="titlebar" class="single ps-5" >
            <div class="ps-5">

                <div class="sixteen columns">
                    <h2>Job Alerts</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li>You are here:</li>
                            <li><a href="#">Home</a></li>
                            <li>Job Alerts</li>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>


        <!-- Content
        ================================================== -->
        <div class="padding-50">

        <!-- Table -->
        <div class="sixteen columns overflow-x-auto ">

            <p class="margin-bottom-25">Your job alerts are shown below.</p>

            <table class="manage-table resumes responsive-table ">
                <colgroup>
                    <col width="300">
                    <col width="200">
                    <col width="150">
                    <col width="200">
                    <col width="200">
                    <col width="200">
                    <col width="200">
                    <col width="200">
                </colgroup>
                <thead>
                    <tr>
                        <th><i class="fa fa-file-text"></i> Alert Name</th>
                        <th><i class="fa fa-calendar"></i> Date Created</th>
                        <th><i class="fa fa-tags"></i> Keywords</th>
                        <th><i class="fa fa-map-marker"></i> Location</th>
                        <th><i class="bi bi-gear-fill position-static me-2"></i> Industry</th>
                        <th><i class="fa fa-clock-o"></i> Frequency</th>
                        <th><i class="fa fa-check-square-o"></i> Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <!-- Item -->
                @foreach($data_alerts as $alert)
                    <tr>
                        <td class="alert-name">{{$alert->alert_name}}</td>
                        <td>{{getDayDifference($alert)}}</td>
                        <td class="keywords">{{$alert->keyword}}</td>
                        <td>{{$alert->province->name}}</td>
                        <td>{{$alert->industry->name}}</td>
                        <td>{{$alert->frequency->name}}</td>
                        <td>{{$alert->active == 1 ? 'Enable' : 'Disable'}}</td>
                        <td class="action">
                            <a href="#"><i class="fa fa-check-circle-o"></i> Show Results</a>
                            <a href="#"><i class="fa fa-envelope"></i> Email</a>
                            <a href="#"><i class="fa fa-pencil"></i> Edit</a>
                            <a href="{{route('alert.change_active', [$alert->id, $alert->active])}}">
                                @if ($alert->active == 0)
                                    <i class="bi bi-eye-fill"></i>   Enable
                                @else
                                    <i class="bi bi-eye-slash-fill"></i> Disable
                                @endif
                            </a>

                            <a href="#" class="delete"><i class="fa fa-remove"></i> Delete</a>
                        </td>
                    </tr>
                @endforeach
            </table>

            <br>
        </div>
        <div class="w-100 position-relative d-flex align-items-center margin-top-60">
            <a href="#small-dialog" id="btn-dialog" class="popup-with-zoom-anim button position-absolute end-0">Add Alert</a>
        </div>
        <div id="small-dialog" class="zoom-anim-dialog mfp-hide apply-popup ">
            <div class="small-dialog-headline border-radius-5">
                <h2>Add Alert</h2>
            </div>

            <div class="small-dialog-content border-radius-5">
                <form action="#" method="get" >
                    <input type="text" placeholder="Alert Name" value=""/>
                    <input type="text" placeholder="Keyword" value=""/>

                    <div class="form">
                        <div class="form-group select2-company ">
                            <select class="js-example-basic-single form-control ps-3" id="first_suggest" data-type="province" data-placeholder="Province" name="province">
                            </select>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="margin-top-15"></div>

                    <div class="form">
                        <select data-placeholder="Job Tags " class="chosen-select" name="tag[]" multiple>
                            @foreach($data_tags as $tag)
                                <option value="{{$tag->id}}"> {{$tag->name}} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="clearfix"></div>
                    <div class="margin-top-15"></div>

                    <!-- Select -->
                    <select data-placeholder="Email Frequency(optional)" class="chosen-select-no-single border-radius-5 pt-1 pb-1">
                        <option value="">Email Frequency</option>
                        <option value="1">Daily</option>
                        <option value="2">Weekly</option>
                        <option value="3">Fortnightly</option>
                    </select>

                    <div class="clearfix"></div>
                    <div class="margin-top-15"></div>

                    <!-- Select -->
                    <select data-placeholder="Job Type" class="chosen-select border-radius-5 pt-1 pb-1" multiple>
                        <option value="1">Full-Time</option>
                        <option value="2">Part-Time</option>
                        <option value="3">Internship</option>
                        <option value="4">Freelance</option>
                        <option value="5">Temporary</option>
                    </select>



                    <div class="clearfix"></div>
                    <div class="margin-top-15"></div>

                    <!-- Select -->
                    <div class="form select2-company w-100">
                        <select class="js-example-basic-single form-control w-100 " id="select_industry" data-type="industry"
                                data-placeholder="Industry (optional)" name="industry">
                        </select>
                    </div>



                    <div class="clearfix"></div>
                    <div class="margin-top-15"></div>

                    <div class="d-flex justify-content-between">
                        <div class="form chosen-container-single w-50 pe-2">
                            <input class="search-field cursor-pointer chosen-single " type="number" name="minimum_salary" placeholder="Min salary (Number only)"  value=""/>
                        </div>
                        <div class="form chosen-container-single w-50 ps-2">
                            <input class="search-field cursor-pointer chosen-single " type="number" name="maximum_salary" placeholder="Max salary (Number only)"  value=""/>
                        </div>
                    </div>



                    <div class="margin-top-20"></div>
                    <div class="divider"></div>

                    <button class="send">Save Alert</button>
                </form>
                <span id="formSearch" data-url-suggest="{{ route('company.suggest') }}"></span>
            </div>
        </div>
    </div>
</div>

@stop
