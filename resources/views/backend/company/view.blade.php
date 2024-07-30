@include('backend.component.admin_head')
<body>
<div id="admin_wrapper">
    @include('backend.component.admin_header')
    <main>
        @include('backend.component.admin_menu_left')

        <div class="contain">
            <section>
                <div class="title-table">
                    <h4>COMPANY</h4>
                </div>
            </section>

            <div class="parent-form-admin  m-auto">
                <form class="form_add_company  w-100" method="post" action="" enctype="multipart/form-data">


                    <div class="d-flex m-auto company_fnl" style="">
                        <div class="avatar_profile h-100" style=" ">
                            <h5 class="text-center">Company Logo (optional)</h5>

                            <img class="border image-preview" src="{{$company->company_logo}}" alt="">

                        </div>
                        <div style="width: 65%">
                            <div class="form w-100">
                                <h5>Company name</h5>
                                <input class="search-field " type="text" readonly name="company_name"
                                       value="{{$company->company_name}}" required/>
                            </div>
                            <div class="form w-100">
                                <h5>Company Tagline (optional)</h5>
                                <input class="search-field" type="text" readonly name="company_tagline"
                                       value="{{$company->company_tagline}}"/>
                            </div>
                            <div class="form w-100">
                                <h5>Headquarters (optional)</h5>
                                <input class="search-field" type="text" readonly name="headquarter"
                                       value="{{$company->headquarters}}"/>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex form optional flex-wrap ">

                        <div class="form w-50">
                            <h5>Latitude (optional)</h5>
                            <input class="search-field" type="text" readonly name="latitude"
                                   value="{{$company->latitude}}"/>
                        </div>

                        <div class="form w-50">
                            <h5>Longitude (optional)</h5>
                            <input class="search-field" type="text" readonly name="longitude"
                                   value="{{$company->longitude}}"/>
                        </div>


                        <div class="form w-50">
                            <h5>Video (optional)</h5>
                            <input class="search-field" type="text" readonly name="link_video"
                                   value="{{$company->video}}"/>
                        </div>

                        <div class="form w-50">
                            <h5>Since (optional)</h5>
                            <input class="search-field" type="text" readonly name="since" value="{{$company->since}}"/>
                        </div>

                        <div class="form w-50">
                            <h5>Company Website (optional)</h5>
                            <input class="search-field" type="text" name="company_website" readonly
                                   value="{{$company->company_website}}"/>
                        </div>

                        <div class="form w-50">
                            <h5>Email (optional)</h5>
                            <input class="search-field" type="text" name="company_email" readonly
                                   value="{{$company->email}}"/>
                        </div>

                        <div class="form w-50">
                            <h5>Phone (optional)</h5>
                            <input class="search-field" type="text" name="company_phone" readonly
                                   value="{{$company->phone}}"/>
                        </div>

                        <div class="form w-50">
                            <h5>Twitter (optional)</h5>
                            <input class="search-field" type="text" name="company_twitter" readonly
                                   value="{{$company->twitter}}"/>
                        </div>

                        <div class="form w-50">
                            <h5>Facebook (optional)</h5>
                            <input class="search-field" type="text" name="company_facebook" readonly
                                   value="{{$company->facebook}}"/>
                        </div>
                        <div class="form w-50">
                            <h5>Industry (optional)</h5>
                            <input class="search-field" type="text" name="company_facebook" readonly
                                   value="{{$company->industry->name ?? 'N / A'}}"/>
                        </div>
                        <div class="form w-50">
                            <h5>Company Size (optional)</h5>
                            <input class="search-field" type="text" name="company_facebook" readonly
                                   value="{{$company->company_size}}"/>
                        </div>

                        <div class="form w-50">
                            <h5>Average Salary (optional)</h5>
                            <input class="search-field" type="text" name="company_facebook" readonly
                                   value="{{$company->company_average_salary }}"/>
                        </div>

                    </div>
                    <div class="d-flex m-auto w-100 mt-3 company_fnl">
                        <div class="" style="width: 70%">

                            <div class="form ms-0 w-100">
                                <h5>Short Description (optional)</h5>
                                <textarea name="desc" readonly>{{$company->description}}</textarea>
                            </div>
                        </div>
                        <div class="avatar_profile h-100">
                            <h5 class="text-center">Header Image (optional)</h5>
                            <img class="border image-preview" src="{{$company->header_img}}" alt="">
                        </div>
                    </div>
                    <div class="form d-flex flex-row-reverse pe-5">
                        {{--                        <input class="toggle_switch ms-3 me-5" name="active" {{$company->active == 1?'checked' : 'aaa'}}  type="checkbox">--}}
                        <span id="change_active" data-url="{{ route('company.update') }}"> </span>
                        <input class=" ms-3 mt-2 me-5 status_active" data-id="{{$company->id_company}}"
                               {{$company->active==1?'checked':''}}  type="checkbox">
                        <h5>Active Company</h5>
                    </div>
                    <div class="form text-end pe-5">
                        {{--                        <input type="submit" style="width:10rem;" value="SAVE"   class="btn me-5 mt-3 rounded-pill fw-bold fs-6 mb-0">--}}
                        <input type="submit" style="width:10rem;" value="SAVE"
                               class="btn me-3 text-light mt-3 rounded-pill fw-bold fs-6 mb-0 toggle_switch"
                               data-type="view" data-id="{{$company->id_company}}" data-name="">
                        <a href="{{ route('company.index') }}">
                            <button type="button" style="width:10rem;padding: 0.75rem;"
                                    class="btn btn-danger mt-3 rounded-pill fw-bold fs-6">
                                CANCEL
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
@include('backend.component.admin_script')
</body>
</html>
