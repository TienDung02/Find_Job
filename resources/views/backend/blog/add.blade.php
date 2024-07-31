@extends('backend.layout.layout')

@section('content')
<div class="contain">
    <section>
        <div class="title-table">
            <h4>
                @if(isset($id_blog))
                    EDIT
                @else
                    ADD
                @endif
                BLOG
            </h4>
        </div>
    </section>
    <div class="parent-form-admin">
        <form class="form_add_company  w-100 m-0 " method="post" action="" enctype="multipart/form-data">


            <div class="d-flex">

                <div class="form w-50">
                    <h5>Author</h5>
                    <input class="search-field" type="text" required name="author" placeholder=""
                           value=""/>
                </div>

                <div class="form w-50">
                    <h5>Blog Category</h5>
                    <select> </select>
                </div>

            </div>

            <div class="form">
                <h5>Title</h5>
                <input class="search-field w-100" type="text" required name="title" placeholder="" value=""/>
            </div>
            <div class="form mb-5">
                <h5>Description </h5>
                <textarea name="desc"></textarea>
            </div>
            <div class="parentContainer w-80 form">
                <form id="image-form">
                    <div class="d-flex">
                        <div class="form-group w-50">
                            <label for="input-type">Chọn cách nhập ảnh:</label>
                            <select id="input-type" class="me-5" onchange="toggleInput()">
                                <option value="none">-- Chọn --</option>
                                <option value="file">Chọn ảnh từ máy tính</option>
                                <option value="url">Nhập URL ảnh</option>
                            </select>
                        </div>

                        <div class="w-50">
                            <div class="form-group hidden d-none" id="file-input-group">
                                <label for="image-upload">Chọn ảnh từ máy tính:</label>
                                <input type="file" id="image-upload" accept="image/*">
                            </div>
                            <div class="form-group hidden d-none" id="url-input-group">
                                <label for="image-url">Nhập URL ảnh:</label>
                                <input type="url" id="image-url" placeholder="Nhập URL của ảnh">
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="loadImage()">Xem trước ảnh</button>
                </form>
                <div id="image-container">
                    <img id="image-preview" class="image-preview" alt="Image Preview">
                </div>
            </div>
            <div class="form text-end">
                <input type="submit" value="Save">
            </div>
        </form>
    </div>
</div>
@stop
