@include('backend.component.head')
<body>
<div id="admin_wrapper">
    @include('backend.component.header')
    <main>
        @include('backend.component.menu_left')
        <div class="contain">
            <section>
                <div class="title-table">
                    <h4>JOB / VIEW</h4>
                </div>
            </section>
            <div class="parent-form-admin  m-auto">
                <form action="#" class="form-main p-3">
                    <div class="form_add_company flex-wrap mb-3">
                        <h4 class="text-center mb-5">{{$job->title}}</h4>

                        <div class="form-admin-insert-data">
                            <label for="#">Location</label>
                            <input type="text" name="first-name" disabled value="{{$job->location->name}}">
                        </div>

                        <!-- job Type -->
                        <div class="form-admin-insert-data">
                            <label for="#">Job Type</label>

                            <input type="text" name="first-name" disabled value="{{$job->jobType->name}}">
                        </div>

                        <!-- Choose Category -->
                        <div class="form-admin-insert-data">
                            <label for="#">Category</label>
                            <input type="text" name="first-name" disabled value="{{$job->category->name}}">
                        </div>
                        <!-- Tags -->
                        <div class="form-admin-insert-data">
                            <label for="#">Job Tag</label>
                            <input type="text" name="first-name" disabled value="{{$job->jobTag ->name}}">
                        </div>
                        <!-- Description -->
                        <div class="form-admin-insert-data">
                            <label for="#">Description</label>
                            <textarea class="WYSIWYG" cols="40" rows="3" id="summary" name="description" disabled
                                      spellcheck="true">{{$job->description}}</textarea>
                        </div>
                        <div class="form-admin-insert-data mb-5">
                            <label for="#">Job requirements</label>
                            <textarea class="WYSIWYG" cols="40" rows="3" id="summernote" name="job_requirements"
                                      disabled
                                      spellcheck="true">{{$job->job_requirements}}</textarea>
                        </div>

                        <div class="d-flex form optional flex-wrap mb-5 me-5">
                            <div class="form-admin-insert-data w-50 me-0">
                                <label class="mt-2">Rate/h ($): </label>
                                <input type="text" name="first-name" class="ms-5 me-5" disabled
                                       value="{{$job->minimum_rate . ' - ' . $job->maximum_rate}}">
                            </div>

                            <div class="form-admin-insert-data w-50 me-0">
                                <label class="mt-2">Salary ($): </label>
                                <input type="text" name="first-name" class="" disabled
                                       value="{{$job->minimum_salary . ' - ' . $job->maximum_salary}}">
                            </div>

                        </div>


                        <!-- Closing Date -->
                        <div class="form d-flex me-5">
                            <div class="form-admin-insert-data w-50 me-0">
                                <label class="mt-2">Closing Date</label>
                                <input type="text" name="first-name" class="ms-5 me-5" disabled
                                       value="{{$job->closing_day}}">
                            </div>
                            <div class="w-25 m-auto d-flex">
                                <h5>Active Job</h5>
                                <span id="change_active" data-url="{{ route('job.update') }}"> </span>
                                <input class=" ms-5 mt-1 me-5 status_active" data-type="job with title "
                                       data-id="{{$job->id}}" data-name="{{$job->title}}"
                                       {{$job->active==1?'checked':''}}  type="checkbox">
                            </div>
                        </div>


                        <div class="divider margin-top-0"></div>
                        <div class=" text-end ">
                            <div class="text-end">
                                <div class="form ">
                                    <input type="submit" style="width:10rem;" value="SAVE"
                                           class="btn me-3 text-light mt-3 rounded-pill fw-bold fs-6 mb-0 toggle_switch"
                                           data-type="view" data-id="{{$job->id}}" data-name="">
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
    </main>
</div>
@include('backend.component.script')
</body>

</html>
