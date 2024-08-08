@extends('frontend.layout.layout')
@section('content')
<div class="clearfix margin-top-90"></div>


<!-- Menu left
================================================= -->

<div class="d-flex">
    @if(auth()->user()->role == 2)
        @include('.frontend.component.menu_left_candidate')
    @else
        @include('.frontend.component.menu_left_employer')
    @endif

    <div class="contain" style="margin: auto; width: calc(100% - 260px);background-color: #f7f7f7">

        <form class="form_add_company" method="post" action="change_password_process.php" style="width: 70%">

            <div class="form w-100" style="background-color: #f5f5f5bf;padding: 0px 54px;">
                <h3>Change Password</h3>
                <hr style="width: 109%;  transform: translateX(-53px);">
            </div>
            <div class="contain_form">
                <div class="form">
                    <h5>Current Password</h5>
                    <input class="search-field" type="password" name="cur_password" placeholder="" value="" required/>
                </div>
                <div class="form">
                    <h5>New Password</h5>
                    <input class="search-field" type="password" name="new_password" placeholder="" value="" required/>
                </div>
                <div class="form">
                    <h5>Confirm Password</h5>
                    <input class="search-field" type="password" name="confirm_password" placeholder="" value="" required/>
                </div>
                <div class="form">
                    <input type="submit" class="text-end" value="Save Changes">
                </div>
            </div>
        </form>
    </div>
</div>
@stop
