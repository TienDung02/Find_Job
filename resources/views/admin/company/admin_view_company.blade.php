@include('component.admin_head')
<body>
<div id="admin_wrapper">
    @include('component.admin_header')
    <main>
        <div class="contain">
            <section>
                <div class="title-table">
                    <h3>Company</h3>
                </div>
            </section>

            <div class="parent-form-admin  m-auto">
                <form class="form_add_company  w-100 m-0 " method="post" action="active_company_process.php?id_company=<?php echo $id_company; ?>"
                      enctype="multipart/form-data">

                    <div class="form w-100 rounded-top rounded-4"
                         style="background-color: #f5f5f5bf;padding: 0px 54px;">
                        <h3>Company Details</h3>
                        <hr style="width: 109%;  transform: translateX(-53px);">
                    </div>
                    <div class="d-flex m-auto"
                         style="width: 85%;justify-content: space-between;padding-bottom: 34px">
                        <div class="avatar_profile h-100" style=" width: 20%;position: relative">
                            <h5>Company Logo (optional)</h5>

                            <img class="border image-preview" style="width: auto; max-width: 270px; height: 270px;"
                                 src="" alt="">

                        </div>
                        <div class="" style="width: 70%">
                            <div class="form w-100">
                                <h5>Company name</h5>
                                <input class="search-field" type="text" readonly name="company_name" placeholder=""
                                       value="" required/>
                            </div>
                            <div class="form w-100">
                                <h5>Company Tagline (optional)</h5>
                                <input class="search-field" type="text" readonly name="company_tagline"
                                       placeholder="" value=""/>
                            </div>
                            <div class="form w-100">
                                <h5>Headquarters (optional)</h5>
                                <input class="search-field" type="text" readonly name="headquarter" placeholder=""
                                       value=""/>
                                <p>Leave this blank if the headquarters location is not important</p>
                            </div>
                        </div>
                    </div>
                    <input name="id_employer" value="<?php ?>" type="hidden">

                    <div class="d-flex form optional flex-wrap ">

                        <div class="form">
                            <h5>Latitude (optional)</h5>
                            <input class="search-field" type="text" readonly name="latitude" placeholder=""
                                   value=""/>
                        </div>

                        <div class="form">
                            <h5>Longitude (optional)</h5>
                            <input class="search-field" type="text" readonly name="longitude" placeholder=""
                                   value=""/>
                        </div>


                        <div class="form">
                            <h5>Video (optional)</h5>
                            <input class="search-field" type="text" readonly name="link_video" placeholder=""
                                   value=""/>
                        </div>

                        <div class="form">
                            <h5>Since (optional)</h5>
                            <input class="search-field" type="text" readonly name="since" placeholder=""
                                   value=""/>
                        </div>

                        <div class="form">
                            <h5>Company Website (optional)</h5>
                            <input class="search-field" type="text" name="company_website" readonly placeholder=""
                                   value=""/>
                        </div>

                        <div class="form">
                            <h5>Email (optional)</h5>
                            <input class="search-field" type="text" name="company_email" readonly placeholder=""
                                   value=""/>
                        </div>

                        <div class="form">
                            <h5>Phone (optional)</h5>
                            <input class="search-field" type="text" name="company_phone" readonly placeholder=""
                                   value=""/>
                        </div>

                        <div class="form">
                            <h5>Twitter (optional)</h5>
                            <input class="search-field" type="text" name="company_twitter" readonly placeholder=""
                                   value=""/>
                        </div>

                        <div class="form">
                            <h5>Facebook (optional)</h5>
                            <input class="search-field" type="text" name="company_facebook" readonly placeholder=""
                                   value=""/>
                        </div>
                        <div class="form">
                            <h5>Industry (optional)</h5>
                            <input class="search-field" type="text" name="company_facebook" readonly placeholder=""
                                   value=""/>
                        </div>
                        <div class="form">
                            <h5>Company Size (optional)</h5>
                            <input class="search-field" type="text" name="company_facebook" readonly placeholder=""
                                   value=""/>
                        </div>

                        <div class="form">
                            <h5>Average Salary (optional)</h5>
                            <input class="search-field" type="text" name="company_facebook" readonly placeholder=""
                                   value=""/>
                        </div>
                        <div class="d-flex m-auto w-100"
                             style="justify-content: space-between;padding-bottom: 34px">
                            <div class="" style="width: 70%">

                                <div class="form ms-0 w-100">
                                    <h5>Short Description (optional)</h5>
                                    <textarea style="height: 250px" name="desc"
                                              readonly> </textarea>
                                </div>
                            </div>
                            <div class="avatar_profile h-100" style=" width: 20%;position: relative">
                                <h5>Header Image (optional)</h5>
                                <img class="border image-preview"
                                     style="width: auto; max-width: 250px; height: 250px;"
                                     src="" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="form d-flex flex-row-reverse">
                        <input class="toggle_switch ms-3 me-5" name="active"   type="checkbox">
                        <h5>Active Company</h5>
                    </div>
                    <div class="form text-end">
                        <input type="submit" value="Save">
                    </div>
                </form>
            </div>

        </div>
    </main>
</div>
@include('component.admin_script')
</body>

</html>
