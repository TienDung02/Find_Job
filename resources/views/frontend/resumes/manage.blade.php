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
<div  style="    margin: auto;width: calc(100% - 260px);   ">
    <!-- Titlebar
    ================================================== -->
    <div id="titlebar" class="single padding-50 mb-0">
        <div class="sixteen columns ">
            <h2>Manage Resumes</h2>
            <nav id="breadcrumbs">
                <ul>
                    <li>You are here:</li>
                    <li><a href="#">Home</a></li>
                    <li>Manage Resumes</li>
                </ul>
            </nav>
        </div>
    </div>


    <!-- Content
    ================================================== -->
	<!-- Table -->
	<div class="sixteen columns overflow-x-auto padding-50 pt-0">

		<p class="margin-bottom-25">Your resume can be viewed, edited or removed below.</p>

		<table class="manage-table resumes responsive-table border-radius-5" style="width: 1500px">
            <colgroup>
                <col width="300">
                <col width="150">
                <col width="100">
                <col width="100">
                <col width="100">
            </colgroup>
            <thead>
                <tr>
                    <th><i class="fa fa-user"></i> Name</th>
                    <th><i class="fa fa-file-text"></i> Title</th>
                    <th><i class="fa fa-map-marker"></i> Location</th>
                    <th><i class="fa fa-calendar"></i> Date Posted</th>
                    <th></th>
                </tr>
            </thead>
			<!-- Item -->
            @foreach($resumes as $resume)
                <tr>
                    <td class="title"><a href="#">{{$resume->full_name}}</a></td>
                    <td>{{$resume->professional_title}}</td>
                    <td>{{$resume->province_id ? $resume->province->name : ''}}</td>
                    <td>{{$resume->created_at}}</td>
                    <td class="action">
                        <a href="{{route('resume.edit', $resume->id)}}"><i class="fa fa-pencil"></i> Edit</a>
                        <a href="#"><i class="fa  fa-eye-slash"></i> Hide</a>
                        <a href="#" class="delete Alert_delete" data-target="{{route('resume.delete', $resume->id)}}" ><i class="fa fa-remove"></i> Delete</a>
                    </td>
                </tr>
            @endforeach


		</table>
        <div class="w-100 position-relative margin-top-55 ">
            <a href="#" class="button position-absolute end-0 me-5">Add Resume</a>
        </div>
		<br>


	</div>

</div>
</div>

@stop
