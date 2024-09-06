@extends('frontend.layout.layout')
@section('content')


    <!-- Header
================================================== -->

<div class="d-flex margin-top-90">
@if(auth()->user()->role == 2)
    @include('.frontend.component.menu_left_candidate')
@else
    @include('.frontend.component.menu_left_employer')
@endif
<div class="clearfix"></div>

<div class="m-auto" style="width: calc(100% - 260px);background-color: #f6f6f6">
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single mb-0 ms-5 pb-0">
	<div class="">

		<div class="sixteen columns">
			<h2 class="p-0"><i class="fa fa-plus-circle"></i> Add Resume</h2>
            <nav id="breadcrumbs">
                <ul>
                    <li>You are here:</li>
                    <li><a href="#">Home</a></li>
                    <li>Add Resumes</li>
                </ul>
            </nav>
		</div>

	</div>
</div>

<!-- Content
================================================== -->
<div class="ms-5 me-5 mb-3">
    @php
        $data_resume = $data_resume ?? null;
    @endphp
	<!-- Submit Page -->
	<div class="ms-4 me-4" >
        <form method="post" style class="m-auto mb-5 pb-0 rounded-4 margin-bottom-60  w-100" action="
        @if($data_resume != null)
            {{route('resume.update', $data_resume->id)}}
        @else
            {{route('resume.store')}}
        @endif

        " style="width: 90%; background-color: #f6f6f6; ">
            @csrf
            @if($data_resume != null)
                @method('PUT')
            @endif
            <div class="submit-page mt-5 mb-0">

                <div class="d-flex flex-wrap  p-5 pb-0">

                    <div class="w-100 d-flex justify-content-between pe-3 ps-3">
                        <!-- Logo -->
                        <div class="avatar_profile position-relative w-25">
                            <h5>Avatar</h5>
                            <div class="controlContainer position-absolute bottom-0 w-100">
                                <div class="inputFileHolder h-100">
                                    <a class="w-100 h-100" href="#" title="Browse">
                                    </a>
                                    <input id="fileInput2" name="avatar" class="file-img fileInput w-100 h-100" title="Choose file to upload" value="{{$data_resume != '' ? $data_resume->photo : ''}}"   type="file">
                                    <input name="avatar_old" value="{{$data_resume != '' ? $data_resume->photo : ''}}"   type="hidden">
                                </div>
                            </div>
                            <img class="border image-preview cursor-pointer btn-select-img" style="" src="{{$data_resume != '' ? asset($data_resume->phpto) : ''}}" alt="">
                            <h6>(reasonable size: 300px x 300px)</h6>

                        </div>

                        <div class="width-75">
                            <!-- Email -->
                            <div class="form w-100 p-3 mb-0">
                                <h5>Your Name</h5>
                                <input class="search-field me-3" type="text" name="full_name" placeholder="Your full name" value="{{$data_resume != '' ? $data_resume->full_name : ''}}"/>
                            </div>

                            <!-- Email -->
                            <div class="form w-100 p-3 mb-0">
                                <h5>Your Email</h5>
                                <input class="search-field" type="text" name="email" placeholder="mail@example.com" value="{{$data_resume != '' ? $data_resume->email : ''}}"/>
                            </div>

                            <!-- Title -->
                            <div class="form w-100 p-3 mb-0">
                                <h5>Professional Title</h5>
                                <input class="search-field" type="text" name="professional_title" placeholder="e.g. Web Developer" value="{{$data_resume != '' ? $data_resume->professional_title : ''}}" required/>
                            </div>
                        </div>
                    </div>

                    <!-- Location -->
                    <span id="formSearch" data-url-suggest="{{ route('resume.suggest') }}"></span>
                    <span id="value-data-selected" data-id-province="{{$data_resume != '' ? $data_resume->province_id : ''}}"
                          data-id-district="{{$data_resume != '' ? $data_resume->district_id : ''}}"
                          data-id-ward="{{$data_resume != '' ? $data_resume->ward_id : ''}}"
                          data-id-industry="{{$data_resume != '' ? $data_resume->industry_id : ''}}"></span>
                    <div class="form d-flex w-100 ps-3 pe-3 pt-4">
                        <div class="w-100 ">
                            <h5>Headquarters (optional)</h5>
                            <div class="d-flex row">
                                <div class="form-group select2-company col-4">
                                    <select class="js-example-basic-single form-control" id="first_suggest" data-type="province" data-placeholder="Province" name="province_id">

                                    </select>
                                </div>
                                <div class="form-group select2-company  col-4">
                                    <select class="js-example-basic-single form-control" id="second_suggest" data-type="district" data-placeholder="District" name="district_id">
                                    </select>
                                </div>
                                <div class="form-group select2-company col-4">
                                    <select class="js-example-basic-single form-control" id="select_active" data-type="ward" data-placeholder="Ward" name="ward_id">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="form ps-5 pe-5 ">
                    <div class="ps-3 pe-3">
                        <h5>Skill(s)</h5>
                        <select data-placeholder="Skills" class="chosen-select " name="tag_id[]" multiple >
                            @if($data_resume != null)
                                @php
                                    $array_tag_id = explode(', ', $data_resume->tag_id);
                                @endphp
                            @endif
                            @foreach($data_tag as $tag)
                                <option
                                    @if($data_resume != null)
                                        @if (in_array($tag->id, $array_tag_id))
                                            {{'selected'}}
                                        @endif
                                    @endif
                                    value="{{$tag->id}}"> {{$tag->name}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex form flex-wrap  ps-5 pe-5">
                    <div class="select-grid ps-3 width-30 pe-3 ps-3">
                        <h5>Type Salary <span>(optional)</span></h5>
                        <select data-placeholder="Application Status" id="type-salary" name="type_salary" class="chosen-select-no-single border-radius-5">
                            <option {{$data_resume != '' && $data_resume->type_salary == 3 ? 'selected' : ''}} value="3">Deal</option>
                            <option {{$data_resume != '' && $data_resume->type_salary == 1 ? 'selected' : ''}} value="1">From ... To ...</option>
                            <option {{$data_resume != '' && $data_resume->type_salary == 2 ? 'selected' : ''}} value="2">Fixed</option>
                        </select>
                    </div>
                    <div id="type-salary-fixed" class="form chosen-container-single d-none width-45 ms-5">
                        <h5>Salary (optional)</h5>
                        <input class="search-field cursor-pointer chosen-single rounded-0" type="number" name="salary_fixed" placeholder="Salary (Number only)"
                               value="{{$data_resume != '' && $data_resume->type_salary == 2 ? $data_resume->salary : ''}}"/>
                    </div>
                    <div id="type-salary-from-to" class="d-flex d-none width-70">
                        <div class="form chosen-container-single width-50 ps-3 pe-3">
                            <h5>Minimum Salary ($)</h5>
                            <input class="search-field cursor-pointer chosen-single rounded-0 " type="number" name="minimum_salary" placeholder="Min (Number only)"
                                   value="{{$data_resume != '' ? $data_resume->minimum_salary : ''}}"/>
                        </div>
                        <div class="form chosen-container-single width-50 ps-3 pe-3">
                            <h5>Maximum Salary ($)</h5>
                            <input class="search-field cursor-pointer chosen-single rounded-0 " type="number" name="maximum_salary" placeholder="Max (Number only)"
                                   value="{{$data_resume != '' ? $data_resume->maximum_salary : ''}}"/>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="form ps-5 pe-5">
                    <h5 class="ps-3 pe-3">Resume Content</h5>
                    <div class="ps-3 pe-3">
                        <textarea class="WYSIWYG summernote" name="resume_content" cols="40" rows="3" id="summary" spellcheck="true">{{$data_resume != '' ? $data_resume->resume_content : ''}}</textarea>
                    </div>
                </div>

            </div>

            <div class="submit-page mt-4 mb-0 pb-0">
                <!-- Add URLs -->
                <div class="form with-line p-5">
                    <h5 class="ps-3">URL(s) <span>(optional)</span></h5>
                    <div class="form-inside ps-3">

                        @if(isset($networkProfiles) && $networkProfiles != null)
                            @foreach($networkProfiles as $nwp)
                                <!-- Adding URL(s) -->
                                <div class="form boxed box-to-clone url-box d-block">
                                    <a href="#" data-target="{{route('resume.delete_nwp', $nwp->id)}}" class="close-form Alert_delete button"><i class="fa fa-close"></i></a>
                                    <input class="search-field" type="text" name="nwp_name[{{$nwp->id}}][]" placeholder="Name" value="{{$nwp->name}}"/>
                                    <input class="search-field" type="text" name="nwp_url[{{$nwp->id}}][]" placeholder="http://" value="{{$nwp->url}}"/>
                                </div>
                            @endforeach
                        @endif

                        <!-- Adding URL(s) -->
                        <div class="form boxed box-to-clone url-box">
                            <a href="#" class="close-form remove-box button"><i class="fa fa-close"></i></a>
                            <input class="search-field" type="text" name="nwp_name[][]" placeholder="Name" value=""/>
                            <input class="search-field" type="text" name="nwp_url[][]" placeholder="http://" value=""/>
                        </div>

                        <a href="#" class="button gray add-url add-box"><i class="fa fa-plus-circle"></i> Add URL</a>
                        <p class="note">Optionally provide links to any of your websites or social network profiles.</p>
                    </div>
                </div>
            </div>

            <div class="submit-page mt-4 mb-0 pb-0">
                <!-- Education -->
                <div class="form with-line p-5">
                    <h5 class="ps-3">Education <span>(optional)</span></h5>
                    <div class="form-inside ps-3">

                        @if(isset($educations) && $educations != null)
                            @foreach($educations as $edu)
                                <!-- Add Education -->
                                <div class="form boxed box-to-clone education-box d-block">
                                    <a href="#" data-target="{{route('resume.delete_edu', $edu->id)}}" class="close-form Alert_delete button"><i class="fa fa-close"></i></a>
                                    <h5>School Name</h5>
                                    <input class="search-field" type="text" name="school_name[{{$edu->id}}][]" placeholder="School Name" value="{{$edu->school_name}}"/>
                                    <h5>Qualification</h5>
                                    <input class="search-field" type="text" name="qualification[{{$edu->id}}][]" placeholder="Qualification" value="{{$edu->qualification}}"/>
                                    <div class="d-flex justify-content-between">
                                        <div class="pe-3 w-50 controls">
                                            <h5>Start</h5>
                                            <input type="date" placeholder="Start" class="border-radius-5 start-date floatLabel cursor-pointer w-100 pe-3 ps-3" name="start-education[{{$edu->id}}][]" value="" style="padding: 14px 18px">
                                            <span id="value-input-type-date" data-value="{{$edu != '' ? $edu->start_day : ''}}"></span>

                                        </div>
                                        <div class="ps-3 w-50 controls">
                                            <h5>End</h5>
                                            <input type="date" placeholder="End" class="border-radius-5 end-date floatLabel cursor-pointer w-100 pe-3 ps-3" name="end-education[{{$edu->id}}][]" value="" style="padding: 14px 18px">
                                            <span id="value-input-type-date" data-value="{{$edu != '' ? $edu->end_day : ''}}"></span>

                                        </div>
                                    </div>
                                    <p><span class="text-danger notification d-none">End date must be greater than start date</span></p>
                                    <h5>Notes (optional)</h5>
                                    <textarea name="note-education[{{$edu->id}}][]" id="desc" cols="30" rows="10" placeholder="Notes">{{$edu->note != null ? $edu->note : ''}}</textarea>
                                </div>
                            @endforeach
                        @endif

                        <!-- Add Education -->
                        <div class="form boxed box-to-clone education-box">
                            <a href="#" class="close-form remove-box button"><i class="fa fa-close"></i></a>
                            <h5>School Name</h5>
                            <input class="search-field" type="text" name="school_name[][]" placeholder="School Name" value=""/>
                            <h5>Qualification</h5>
                            <input class="search-field" type="text" name="qualification[][]" placeholder="Qualification" value=""/>
                            <div class="d-flex justify-content-between">
                                <div class="pe-3 w-50">
                                    <h5>Start</h5>
                                    <input type="date" placeholder="Start" class="border-radius-5 start-date floatLabel cursor-pointer w-100 pe-3 ps-3" name="start-education[][]" value="" style="padding: 14px 18px">
                                </div>
                                <div class="ps-3 w-50">
                                    <h5>End</h5>
                                    <input type="date" placeholder="End" class="border-radius-5 end-date floatLabel cursor-pointer w-100 pe-3 ps-3" name="end-education[][]" value="" style="padding: 14px 18px">
                                </div>
                            </div>
                            <p><span class="text-danger notification d-none">End date must be greater than start date</span></p>
                            <h5>Notes (optional)</h5>
                            <textarea name="note-education[][]" id="desc" cols="30" rows="10" placeholder="Notes"></textarea>
                        </div>

                        <a href="#" class="button gray add-education add-box"><i class="fa fa-plus-circle"></i> Add Education</a>
                    </div>
                </div>
            </div>
            <div class="submit-page mt-4 mb-0 pb-0">
                <!-- Experience  -->
                <div class="form with-line p-5">
                    <h5 class="ps-3">Experience <span>(optional)</span></h5>
                    <div class="form-inside ps-3">

                        @if(isset($experiences) && $experiences != null)
                            @foreach($experiences as $exp)
                                <!-- Add Experience -->
                                <div class="form boxed box-to-clone experience-box d-block">
                                    <a href="#" data-target="{{route('resume.delete_exp', $exp->id)}}" class="close-form Alert_delete remove-box button"><i class="fa fa-close"></i></a>
                                    <h5>Employer</h5>
                                    <input class="search-field" type="text" name="employer[{{$exp->id}}][]" placeholder="Employer" value="{{$exp->employer}}"/>
                                    <h5>Job Title</h5>
                                    <input class="search-field" type="text" name="job_title[{{$exp->id}}][]" placeholder="Job Title" value="{{$exp->job_title}}"/>
                                    <div class="d-flex justify-content-between">
                                        <div class="pe-3 w-50 controls">
                                            <h5>Start</h5>
                                            <input type="date" placeholder="Start" class="border-radius-5 floatLabel start-date cursor-pointer w-100 pe-3 ps-3" name="start-exp[{{$exp->id}}][]" value="" style="padding: 14px 18px">
                                            <span id="value-input-type-date" data-value="{{$exp->start_day}}"></span>
                                        </div>
                                        <div class="ps-3 w-50 controls">
                                            <h5>End</h5>
                                            <input type="date" placeholder="End" class="border-radius-5 floatLabel end-date cursor-pointer w-100 pe-3 ps-3" name="end-exp[{{$exp->id}}][]" value="" style="padding: 14px 18px">
                                            <span id="value-input-type-date" data-value="{{$exp->end_day}}"></span>
                                        </div>
                                    </div>
                                    <p><span class="text-danger notification d-none">End date must be greater than start date</span></p>
                                    <h5>Notes (optional)</h5>
                                    <textarea name="note-exp[{{$exp->id}}][]" id="desc1" cols="30" rows="10" placeholder="Notes">{{$exp->note != null ? $exp->note : ''}}</textarea>
                                </div>
                            @endforeach
                        @endif

                        <!-- Add Experience -->
                        <div class="form boxed box-to-clone experience-box">
                            <a href="#" class="close-form remove-box button"><i class="fa fa-close"></i></a>
                            <h5>Employer</h5>
                            <input class="search-field" type="text" name="employer[][]" placeholder="Employer" value=""/>
                            <h5>Job Title</h5>
                            <input class="search-field" type="text" name="job_title[][]" placeholder="Job Title" value=""/>
                            <div class="d-flex justify-content-between">
                                <div class="pe-3 w-50">
                                    <h5>Start</h5>
                                    <input type="date" placeholder="Start" class="border-radius-5 floatLabel start-date cursor-pointer w-100 pe-3 ps-3" name="start-exp[][]" value="" style="padding: 14px 18px">
                                </div>
                                <div class="ps-3 w-50">
                                    <h5>End</h5>
                                    <input type="date" placeholder="End" class="border-radius-5 floatLabel end-date cursor-pointer w-100 pe-3 ps-3" name="end-exp[][]" value="" style="padding: 14px 18px">
                                </div>
                            </div>
                            <p><span class="text-danger notification d-none">End date must be greater than start date</span></p>
                            <h5>Notes (optional)</h5>
                            <textarea name="note-exp[][]" id="desc1" cols="30" rows="10" placeholder="Notes"></textarea>
                        </div>

                        <a href="#" class="button gray add-experience add-box"><i class="fa fa-plus-circle"></i> Add Experience</a>
                    </div>
                </div>
            </div>

            <div class="divider margin-top-0 padding-reset"></div>
            <div class="margin-bottom-80 d-flex justify-content-end">
                    <input type="submit" value="SAVE">
            </div>
        </form>
	</div>

</div>

</div>
</div>
@stop
