
@extends('frontend.layout.layout')
@section('content')
<div class="clearfix"></div>


<!-- Menu left
================================================= -->

<div class="d-flex margin-top-90">
    @if(auth()->user()->role == 2)
        @include('.frontend.component.menu_left_candidate')
    @else
        @include('.frontend.component.menu_left_employer')
    @endif

    <div class="contain" style="margin: auto; width: calc(100% - 260px);background-color: #f7f7f7">

        <div class="form" style="width: 80%; margin: 50px auto 0 auto">
            <h3>My Profile</h3>
            <hr>
        </div>

        <form class="form_add_company" method="post" enctype="multipart/form-data"
              action="{{route('profile.update')}}"
              style="width: 80%">
            @method('PUT')
            @csrf
            <div class="form w-100" style="background-color: #f5f5f5bf;padding: 0px 54px;">
                <h3>Profile Details</h3>
                <hr style="width: 109%;  transform: translateX(-53px);">
            </div>

            <div class="contain_form">
                <div class="d-flex m-auto" style="width: 85%;justify-content: space-between;padding-bottom: 34px">
                    <div class="avatar_profile" style=" width: 30%;position: relative">
                        <h5>Avatar</h5>
                        <div class="controlContainer position-absolute bottom-0 w-100">
                            <div class="inputFileHolder h-100">
                                <a class="w-100 h-100" href="#" title="Browse">
                                </a>
                                <input id="fileInput2" name="avatar" class="file-img fileInput w-100 h-100" title="Choose file to upload" value="{{$data->avatar}}"   type="file">
                                <input name="avatar_old" value="{{$data->avatar}}"   type="hidden">
                            </div>
                        </div>
                        <img class="border image-preview btn-select-img cursor-pointer" style="" src="{{asset($data->avatar)}}" alt="">
                        <h6>(reasonable size: 300px x 300px)</h6>

                    </div>
                    <div class="" style="width: 60%">
                        <div class="form w-100">
                            <h5>First Name</h5>
                            <input class="search-field" type="text" name="first_name" placeholder="" value="{{$data->first_name}}" required/>
                        </div>
                        <div class="form w-100">
                            <h5>Last Name</h5>
                            <input class="search-field" type="text" name="last_name" placeholder=""  value="{{$data->last_name}}" required/>
                        </div>
                        <div class="form w-100">
                            <h5>Phone</h5>
                            <input class="search-field" type="text" name="tel" placeholder="" value="{{$data->tel}}" required/>
                        </div>
                    </div>
                </div>

                <div class="form">
                    <h5>E-mail</h5>
                    <input class="search-field" type="text" readonly placeholder="" value="{{auth()->user()->email}}" required/>
                </div>
                <div class="form">
                    <h5>About me</h5>
                    <textarea name="desc">{{$data->about}}</textarea>
                </div>
                <div class="form position-relative margin-bottom-90">
                    <input type="submit" class="position-absolute end-0" value="Save Changes">
                </div>
            </div>
        </form>

    </div>
</div>
<div class="margin-top-60"></div>

<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>

</div>
<!-- Wrapper / End -->
@stop
