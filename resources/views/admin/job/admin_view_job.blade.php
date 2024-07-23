@include('component.admin_head')
<body>
<div id="admin_wrapper">
    @include('component.admin_header')
    <main>
        @include('component.admin_menu_left')
        <div class="contain">
            <section>
                <div class="title-table">
                    <h4>JOB / VIEW</h4>
                </div>
            </section>
            <div class="parent-form-admin  m-auto">
                <form method="post" class="m-auto mb-5 rounded-4 form_add_company" style="width: 90%; background-color: #fff; padding: 50px 0;">
                    <div class="form p-5 m-auto">
                        <h5>Job Title</h5>
                        <input class="search-field" type="text" value="" readonly/>
                    </div>

                    <div class="form">
                        <h5>Location <span>(optional)</span></h5>
                        <input class="search-field" type="text" value="" readonly/>
                    </div>

                    <!-- job Type -->
                    <div class="form">
                        <h5>Job Type</h5>
                        <input class="search-field" type="text" value="" readonly/>
                    </div>


                    <!-- Choose Category -->
                    <div class="form">
                        <div class="select">
                            <h5>Category</h5>
                            <input class="search-field" type="text" value="" readonly/>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="form">
                        <h5>Job Tags <span>(optional)</span></h5>
                        <input class="search-field" type="text" value="" readonly/>
                    </div>
                    <!-- Description -->
                    <div class="form">
                        <h5>Description</h5>
                        <textarea class="WYSIWYG " cols="40" rows="3" id="summary" name="description"
                                  spellcheck="true"></textarea>
                    </div>
                    <div class="form">
                        <h5>Job requirements</h5>
                        <textarea class="WYSIWYG d-none" cols="40" rows="3" id="summernote" name="job_requirements"
                                  spellcheck="true"></textarea>
                    </div>

                    <div class="d-flex form optional flex-wrap ">
                        <div class="form">
                            <h5>Minimum rate/h ($) (optional)</h5>
                            <input class="search-field" type="number" placeholder="" value="" readonly/>
                        </div>

                        <div class="form">
                            <h5>Maximum rate/h ($) (optional)</h5>
                            <input class="search-field" type="number" placeholder="" value="" readonly/>
                        </div>

                        <div class="form">
                            <h5>Minimum Salary ($) (optional)</h5>
                            <input class="search-field" type="number"  placeholder="" value="" readonly/>
                        </div>

                        <div class="form">
                            <h5>Maximum Salary ($) (optional)</h5>
                            <input class="search-field" type="number" placeholder="" value="" readonly/>
                        </div>
                    </div>


                    <!-- Closing Date -->
                    <div class="form d-flex">
                        <div class=" w-50">
                            <h5>Closing Date <span>(optional)</span></h5>
                            <div class="container input_date">

                                <div class="select">
                                    <input type="hidden" class="select_day" value="">
                                    <input class="search-field" type="text" value="" readonly/>
                                </div>
                                <div class="select">
                                    <input type="hidden" class="select_month" readonly value="">
                                    <select class="auto-select" disabled id="select_month" name="closing_month" data-class="">
                                        <option>Month</option>
                                    </select>
                                </div>
                                <div class="select">
                                    <input type="hidden" class="select_year" readonly value="">
                                    <select class="auto-select" disabled id="select_year" name="closing_year" data-class="">
                                        <option>Year</option>
                                    </select>
                                </div>


                            </div>
                            <p class="note">Deadline for new applicants.</p>
                        </div>
                        <div class="w-25 m-auto d-flex">
                            <h5>Active Company</h5>
                            <input class="toggle_switch ms-3 me-5" name="active"  type="checkbox">
                        </div>
                    </div>


                    <div class="divider margin-top-0"></div>
                    <div class=" text-end ">
                        <div class="text-end">
                            <div class="form ">
                                <input type="submit" class="me-3 bg-secondary" value="Cancel">
                                <input type="submit" class="ms-3 me-3 bg-danger" value="Refuse">
                                <input type="submit" class="ms-3" value="Save">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
@include('component.admin_script')
</body>

</html>
