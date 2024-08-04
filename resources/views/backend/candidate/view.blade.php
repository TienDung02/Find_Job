@extends('.backend.layout.layout')
@section('content')
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
                    <h4 class="text-center mb-5">Personal information</h4>
                    <div class="d-flex  pe-0 justify-content-between pb-5 form-admin-insert-data" style="">
                        <div class="avatar_profile h-100 form-admin-insert-data d-block ms-5" style=" ">
                            <h5 class="text-center">Avatar</h5>
                            <img class="border image-preview" src="{{$data->avatar}}" alt="">
                        </div>
                        <div style="width: 65%" class="mt-5">
                            <div class="form-admin-insert-data w-100">
                                <label for="#">First name</label>
                                <input type="text" name="first-name" class="search-field" disabled
                                       value="{{$data->first_name}}">
                            </div>
                            <div class="form-admin-insert-data w-100">
                                <label for="#">Last name</label>
                                <input type="text" class="search-field" name="last-name" disabled
                                       value="{{$data->last_name}}">
                            </div>
                            <div class="form-admin-insert-data w-100">
                                <label for="#">Telephone</label>
                                <input type="text" name="tel" class="search-field" disabled
                                       value="{{$data->tel}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-admin-insert-data">
                        <label for="#">Email</label>
                        <input type="text" name="email" disabled
                               value="{{$user->email ?? 'No email available'}}">
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
                        <h4 class="text-center mb-5">Education</h4>
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
                        <h4 class="text-center mb-5">Experience</h4>
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
                        <h4 class="text-center mb-5">Network profile</h4>
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
        <form action="#" class="form-main p-3">
            <div class="form_add_company flex-wrap mb-3">
                <div class="form d-flex me-5">
                    <div class="w-25 m-auto d-flex">
                        <h5>Active Candidate</h5>
                        <span id="change_active" data-url="{{ route('candidate.update') }}"> </span>
                        <input class=" ms-3 mt-2 me-5 status_active" data-type="job with title "
                               data-id="{{$data->id}}"
                               data-name="{{$data->last_name . ' ' . $data->first_name}}"
                               {{$data->active==1?'checked':''}}  type="checkbox">
                    </div>
                </div>
                <div class="divider margin-top-0"></div>
                <div class=" text-end ">
                    <div class="text-end">
                        <div class="form ">
                            <input type="submit" style="width:10rem;" value="SAVE"
                                   class="btn me-3 text-light mt-3 rounded-pill fw-bold fs-6 mb-0 toggle_switch"
                                   data-type="view" data-id="{{$data->id}}" data-name="">
                            <a href="{{ route('job.index') }}" class="text-decoration-none">
                                <button type="button" style="width:10rem;padding: 0.75rem;"
                                        class="btn btn-danger mt-3 rounded-pill fw-bold fs-6 me-3">
                                    REFUSE
                                </button>
                            </a>

                            <a href="{{ route('job.index') }}">
                                <button type="button" style="width:10rem;padding: 0.75rem;"
                                        class="btn btn-secondary mt-3 rounded-pill fw-bold fs-6">
                                    CANCEL
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@stop
