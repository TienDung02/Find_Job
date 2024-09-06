@extends('frontend.layout.layout')
@section('content')
<div class="clearfix margin-top-90"></div>
<!-- Content
================================================== -->
<div class="d-flex main-application">
    @include('.frontend.component.menu_left_employer')
    <!-- Submit Page -->
    <div class="contain" style="margin: auto; width: calc(100% - 260px);background-color: #f7f7f7">
        <div class="form" style="width: 90%; margin: 50px auto 0 auto">
            <h3>Add Job</h3>
            <hr>
        </div>
        @php
            $data_jobs = $data_jobs ?? null;
        @endphp
        <form method="post" class="m-auto mb-5 rounded-4 form_add_company" action="
        @if($data_jobs != null)
            {{route('job.update', $data_jobs->id)}}
        @else
            {{route('job.store')}}
        @endif

        " style="width: 90%; background-color: #fff; padding: 50px 0;">
            @csrf
            @if($data_jobs != '')
                @method('PUT')
            @endif
            <input type="hidden" name="id_employer" value="">
            <!-- Title -->
            <div class="form">
                <h5>Job Title</h5>
                <input class="search-field" type="text" name="job_title" placeholder=""  value="{{$data_jobs != '' ? $data_jobs->title : ''}}" required/>
            </div>
            <!-- Job Type -->
            <div class="form">
                <h5>Job Type</h5>
                <select data-placeholder="Full-Time" class="chosen-select-no-single" name="job_type" required>
                    <option value="">Job Type</option>
                    @foreach($data_type_job as $type_job)
                        <option {{$data_jobs != '' &&  $data_jobs->job_type_id == $type_job->id ? 'selected' : ''}} value="{{$type_job->id}}">{{$type_job->name}}</option>
                    @endforeach

                </select>
            </div>


            <!-- Choose Category -->
            <div class="form">
                <div class="select">
                    <h5>Category</h5>
                    <select data-placeholder="Choose Categories" class="chosen-select" name="category[]" multiple required>
                        @if($data_jobs)
                            @php
                                $array_category = explode(', ', $data_jobs->category_id);
                            @endphp
                        @endif
                        @foreach($data_category as $category_1)
                            @if($category_1->level == 1)
                                <option class="fw-semibold"
                                    @if (isset($data_jobs) && in_array($category_1->id, $array_category))
                                        {{'selected'}}
                                    @endif
                                value="{{$category_1->id}}">{{$category_1->name}}</option>
                            @endif
                            @foreach($data_category as $category_2)
                                @if($category_2->parent_id == $category_1->id)
                                    <option class="fw-medium ms-4"
                                    @if (isset($data_jobs) && in_array($category_2->id, $array_category))
                                        {{'selected'}}
                                    @endif
                                    value="{{$category_2->id}}"  >{{$category_2->name}} </option>
                                    @foreach($data_category as $category_3)
                                        @if($category_3->parent_id == $category_2->id)
                                            <option class="ms-5"
                                            @if (isset($data_jobs) && in_array($category_3->id, $array_category))
                                                {{'selected'}}
                                            @endif
                                            value="{{$category_3->id}}"  >{{$category_3->name}} </option>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Tags -->
            <div class="form">
                <h5>Job Tags</h5>
                <select data-placeholder="Job Tags" class="chosen-select" name="tag[]" multiple required>
                    @if($data_jobs)
                        @php
                            $array_tag = explode(', ', $data_jobs->tag_id);
                        @endphp
                    @endif`
                    @foreach($data_tag as $tag)
                        <option
                            @if (isset($data_jobs) && in_array($tag->id, $array_tag))
                                {{'selected'}}
                            @endif
                            value="{{$tag->id}}"> {{$tag->name}} </option>
                    @endforeach
                </select>
                <p class="note">Comma separate tags, such as required skills or technologies, for this job.</p>
            </div>
            <!-- Description -->
            <div class="form">
                <h5>Description <span>(optional)</span></h5>
                <textarea class="WYSIWYG cursor-pointer summernote" cols="40" rows="3" id="summary" name="description"  spellcheck="true">@if($data_jobs != ''){!! $data_jobs->description !!}@endif </textarea>
            </div>
            <div class="form">
                <h5>Job requirements <span>(optional)</span></h5>
                <textarea class="WYSIWYG cursor-pointer summernote" cols="40" rows="3" name="job_requirements" spellcheck="true">@if($data_jobs != ''){!! $data_jobs->job_requirements !!}@endif
                </textarea>
            </div>
            <div class="form">
                <h5>Benefit <span>(optional)</span></h5>
                <textarea class="WYSIWYG cursor-pointer summernote" cols="40" rows="3"  name="job_benefit" spellcheck="true">@if($data_jobs != ''){!! $data_jobs->benefit !!}@endif
                </textarea>
            </div>

            <div class="d-flex form optional flex-wrap mb-5">
                <div class="select-grid">
                    <h5>Type Salary <span>(optional)</span></h5>
                    <select data-placeholder="Application Status" id="type-salary" name="type_salary" class="chosen-select-no-single border-radius-5">
                            <option {{$data_jobs != '' && $data_jobs->type_salary == 3 ? 'selected' : ''}} value="3">Deal</option>
                            <option {{$data_jobs != '' && $data_jobs->type_salary == 1 ? 'selected' : ''}} value="1">From ... To ...</option>
                            <option {{$data_jobs != '' && $data_jobs->type_salary == 2 ? 'selected' : ''}} value="2">Fixed</option>
                    </select>
                </div>
                <div id="type-salary-fixed" class="form chosen-container-single d-none">
                    <h5>Minimum rate/h ($) (optional)</h5>
                    <input class="search-field cursor-pointer chosen-single rounded-0" type="number" name="salary_fixed" placeholder=""  value="{{$data_jobs != '' && $data_jobs->type_salary == 2 ? $data_jobs->salary : ''}}"/>
                </div>
                <div id="type-salary-from-to" class="d-flex d-none">
                    <div class="form chosen-container-single width-45">
                        <h5>Minimum Salary ($)</h5>
                        <input class="search-field cursor-pointer chosen-single rounded-0 " type="number" name="minimum_salary" placeholder="Min (Number only)"  value="{{$data_jobs != '' ? $data_jobs->minimum_salary : ''}}"/>
                    </div>
                    <div class="form chosen-container-single width-45 ">
                        <h5>Maximum Salary ($)</h5>
                        <input class="search-field cursor-pointer chosen-single rounded-0 " type="number" name="maximum_salary" placeholder="Max (Number only)"  value="{{$data_jobs != '' ? $data_jobs->maximum_salary : ''}}"/>
                    </div>
                </div>
            </div>
            <input type="hidden" id="alert_123">
            <!-- Closing Date -->
            <div class="form d-flex align-items-center">
                <div class="w-75 me-2">
                    <h5 class="heading">Closing Date</h5>
                    <div class="col-1-4 col-1-4-sm">
                        <div class="controls job-closingDay position-relative">
                            <input type="date" id="dateInput" class="floatLabel cursor-pointer" name="closing-date" value="">
                            <span id="value-input-type-date" data-value="{{$data_jobs != '' ? $data_jobs->closing_day : ''}}"></span>
                        </div>
                    </div>
                </div>

                <div class="form text-end w-25 mb-0 mt-3">
                    <input type="submit" value="Save">
                </div>
            </div>
            <div class="divider margin-top-0"></div>
        </form>
    </div>
</div>
@stop
