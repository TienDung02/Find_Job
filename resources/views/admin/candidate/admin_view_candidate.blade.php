@include('component.admin_head')

<body>
<div id="admin_wrapper">
    @include('component.admin_header')

    <main>
        @include('component.admin_menu_left')
        <div class="contain">
            <section>
                <div class="title-table">
                    <h4>CANDIDATE / VIEW</h4>
                </div>
            </section>
            <div class="parent-form-admin">
                <form action="#" class="form-main p-3">
                    <div class="form_add_company flex-wrap mb-3">
                        <div class="about-contact-person ">
                            <h4 class="text-center">Personal information</h4>
                            <div class="form-admin-insert-data">
                                <label for="#">First name</label>
                                <input type="text" name="first-name" disabled value="{{$data->first_name}}">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Last name</label>
                                <input type="text" name="last-name" disabled value="{{$data->last_name}}">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Telephone</label>
                                <input type="text" name="tel" disabled value="{{$data->tel}}">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Email</label>
                                <input type="text" name="email" disabled value="{{$data->email}}">
                            </div>
                            <div class="form-admin-insert-data h-auto">
                                <label for="#">About</label>
                                <textarea name="" id="" cols="30" disabled rows="10"> {{$data->about}}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
                <form action="#" class="form-main p-3">
                        @foreach($educations as $education)
                        <div class="form_add_company flex-wrap mb-3">
                        <div class="about-contact-person ">
                            <h4 class="text-center">Education</h4>
                            <div class="form-admin-insert-data">
                                <label for="#">School name</label>
                                <input type="text" disabled value="{{$education->school_name}}">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Qualification(s)</label>
                                <input type="text" disabled value="{{$education->qualification}}">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Start</label>
                                <input type="text" disabled value="{{$education->start_day}}">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">End</label>
                                <input type="text" disabled value="{{$education->end_day}}">
                            </div>
                            <div class="form-admin-insert-data h-auto">
                                <label for="#">Notes</label>
                                <textarea name="" id="" cols="30" rows="10">{{$education->note}}</textarea>
                            </div>
                        </div>
                        </div>

                        @endforeach
                </form>
                <form action="#" class="form-main p-3">
                        @foreach($experience as $exp)
                        <div class="form_add_company flex-wrap mb-3">

                        <div class="about-contact-person ">
                            <h4 class="text-center">Experience</h4>
                            <div class="form-admin-insert-data">
                                <label for="#">Employer</label>
                                <input type="text" disabled value="{{$exp->employer}}">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Job title</label>
                                <input type="text" disabled value="{{$exp->job_title}}">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Start</label>
                                <input type="text" disabled value="{{$exp->start_day}}">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">End</label>
                                <input type="text" disabled value="{{$exp->end_day}}">
                            </div>
                            <div class="form-admin-insert-data h-auto">
                                <label for="#">Notes</label>
                                <textarea name="" id="" cols="30" rows="10">{{$exp->note}}</textarea>
                            </div>
                        </div>
                        </div>

                        @endforeach
                </form>
                <form action="#" class="form-main p-3">
                        @foreach($network_profile as $np)
                        <div class="form_add_company flex-wrap mb-3">

                        <div class="about-contact-person network-profile ">
                            <h4 class="text-center">Network profile</h4>
                            <div class="form-admin-insert-data">
                                <label for="#">Name</label>
                                <input type="text" disabled value="{{$np->name}}">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Url</label>
                                <input type="text" disabled value="{{$np->url}}">
                            </div>
                        </div>
                        </div>

                        @endforeach
                </form>
            </div>

    </main>
</div>
@include('component.admin_script')

</body>

</html>
