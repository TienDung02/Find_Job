@include('component.admin_head')

<body>
<div id="admin_wrapper">
    @include('component.admin_header')

    <main>
        @include('component.admin_menu_left')
        <div class="contain">
            <section>
                <div class="title-table">
                    <h3>Candidate</h3>
                </div>
            </section>
            <div class="parent-form-admin">
                <form action="#" class="form-main">
                    <div class="form-admin-company flex-wrap">
                        <div class="about-contact-person col-md-5">
                            <h4>Personal information</h4>
                            <div class="form-admin-insert-data">
                                <label for="#">First name</label>
                                <input type="text" name="first-name">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Last name</label>
                                <input type="text" name="last-name">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Telephone</label>
                                <input type="text" name="tel">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Email</label>
                                <input type="text" name="email">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">About</label>
                                <textarea name="" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="about-contact-person col-md-5">
                            <h4>Education</h4>
                            <div class="form-admin-insert-data">
                                <label for="#">School name</label>
                                <input type="text">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Qualification(s)</label>
                                <input type="text">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Start</label>
                                <input type="text">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">End</label>
                                <input type="text">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Notes</label>
                                <textarea name="" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="about-contact-person col-md-5">
                            <h4>Experience</h4>
                            <div class="form-admin-insert-data">
                                <label for="#">Employer</label>
                                <input type="text">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Job title</label>
                                <input type="text">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Start</label>
                                <input type="text">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">End</label>
                                <input type="text">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Notes</label>
                                <textarea name="" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="about-contact-person network-profile col-md-5">
                            <h4>Network profile</h4>
                            <div class="form-admin-insert-data">
                                <label for="#">Name</label>
                                <input type="text">
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Url</label>
                                <input type="text">
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
