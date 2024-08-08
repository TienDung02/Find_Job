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
        <form method="post" class="m-auto mb-5 rounded-4 form_add_company" action="" style="width: 90%; background-color: #fff; padding: 50px 0;">
            <input type="hidden" name="id_employer" value="">
            <!-- Title -->
            <div class="form">
                <h5>Job Title</h5>
                <input class="search-field" type="text" name="job_title" placeholder=""  value="" required/>
            </div>
            <div class="form">
                <h5>Location <span>(optional)</span></h5>
                <select data-placeholder="Full-Time" class="chosen-select-no-single ps-3" name="location">
                        <option  value="">name</option>
                </select>
                <p class="note">Leave this blank if the location is not important</p>
            </div>

            <!-- Job Type -->
            <div class="form">
                <h5>Job Type</h5>
                <select data-placeholder="Full-Time" class="chosen-select-no-single" name="job_type">
                        <option value=""></option>
                </select>
            </div>


            <!-- Choose Category -->
            <div class="form">
                <div class="select">
                    <h5>Category</h5>
                    <select data-placeholder="Choose Categories" class="chosen-select" name="category[]" multiple required>
                            <option value=""></option>
                    </select>
                </div>
            </div>

            <!-- Tags -->
            <div class="form">
                <h5>Job Tags <span>(optional)</span></h5>
                <select multiple data-role="tagsinput" class="tags_input" name="tags_input[]">
                            <option value="">  </option>
                </select>
                <p class="note">Comma separate tags, such as required skills or technologies, for this
                    job.</p>
            </div>
            <!-- Description -->
            <div class="form">
                <h5>Description</h5>
                <textarea class="WYSIWYG " cols="40" rows="3" id="summary" name="description"  spellcheck="true"></textarea>
            </div>
            <div class="form">
                <h5>Job requirements</h5>
                <textarea class="WYSIWYG" cols="40" rows="3" id="summernote" name="job_requirements" spellcheck="true"></textarea>
            </div>

            <div class="d-flex form optional flex-wrap ">
                <div class="form">
                    <h5>Minimum rate/h ($) (optional)</h5>
                    <input class="search-field" type="number" name="minimum_rate" placeholder=""  value=""/>
                </div>

                <div class="form">
                    <h5>Maximum rate/h ($) (optional)</h5>
                    <input class="search-field" type="number" name="maximum_rate" placeholder="" value=" "/>
                </div>

                <div class="form">
                    <h5>Minimum Salary ($) (optional)</h5>
                    <input class="search-field" type="number" name="minimum_salary" placeholder="" value=" "/>
                </div>

                <div class="form">
                    <h5>Maximum Salary ($) (optional)</h5>
                    <input class="search-field" type="number" name="maximum_salary" placeholder="" value=" "/>
                </div>
            </div>
            <input type="hidden" id="alert_123">
            <!-- Closing Date -->
            <div class="form">
                <h5>Closing Date <span>(optional)</span></h5>
                <div class="container input_date">
                        <div class="select">
                            <input type="hidden" class="select_day" value="">
                            <select class="auto-select" id="select_day" name="closing_day" data-class="">
                                <option>Day</option>
                            </select>
                        </div>
                        <div class="select">
                            <input type="hidden" class="select_month" value="">
                            <select class="auto-select" id="select_month" name="closing_month" data-class="">
                                <option>Month</option>
                            </select>
                        </div>
                        <div class="select">
                            <input type="hidden" class="select_year" value="">
                            <select class="auto-select" id="select_year" name="closing_year" data-class="">
                                <option>Year</option>
                            </select>
                        </div>
                        <?php

                    ?>
                </div>
                <p class="note">Deadline for new applicants.</p>
            </div>


            <div class="divider margin-top-0"></div>
            <div class="form text-end">
                <input type="submit" value="Save">
            </div>
        </form>
    </div>
</div>
@stop
