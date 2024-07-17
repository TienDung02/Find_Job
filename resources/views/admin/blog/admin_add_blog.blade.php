@include('component.admin_head')
<body>
<div id="admin_wrapper">
    @include('component.admin_header')
    <main>
        @include('component.admin_menu_left')
        <div class="contain">
            <section>
                <div class="title-table">
                    <h3>Add Blog</h3>
                </div>
            </section>
            <div class="parent-form-admin">
                <form class="form_add_company  w-100 m-0 " method="post" action=""
                      enctype="multipart/form-data">
                    <div class="form w-100 rounded-top rounded-4"
                         style="background-color: #f5f5f5bf;padding: 0px 54px;">
                        <h3>Blog Details</h3>
                        <hr style="width: 109%;  transform: translateX(-53px);">
                    </div>

                    <div class="d-flex form optional flex-wrap m-auto">

                        <div class="form">
                            <h5>Author</h5>
                            <input class="search-field" type="text" required name="author" placeholder=""
                                   value=""/>
                        </div>

                        <div class="form">
                            <h5>Category</h5>
                            <select>
                            </select>
                        </div>

                    </div>

                    <div class="form">
                        <h5>Title</h5>
                        <input class="search-field" type="text" required name="title" placeholder="" value=""/>
                    </div>
                    <div class="form">
                        <h5>Description </h5>
                        <textarea name="desc"></textarea>
                    </div>
                    <div class="parentContainer w-80 form">
                        <h5>Header Image (optional)</h5>
                        <div class="controlContainer">
                            <div class="inputFileHolder">
                                <a  class="btn btn-flat-browse" style="height: 42px; font-size: 1.5rem" href="#" title="Browse">
                                    <i style="font-size: 1.5rem" class="fa fa-folder-open"></i>
                                </a>
                                <input id="fileInput2" name="img" class="fileInput w-100 h-100 fileInput2" title="Choose file to upload" value=""   type="file">
                            </div>
                            <div class="inputFileMask">
                                <input class="inputFileMaskText2" readonly="readonly" name="img_old" placeholder="Choose file.." type="text" id="inputFileMaskText2" value="">
                            </div>
                        </div>
                        <img class="image-preview m-auto mt-3" style=" max-height: 400px;" src=" alt="">
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
