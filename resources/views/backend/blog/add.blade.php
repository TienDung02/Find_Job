@extends('backend.layout.layout')

@section('content')
<div class="contain">
    <section>
        <div class="title-table">
            <h4>
                @if($id_blog != '')
                    EDIT
                @else
                    ADD
                @endif
                BLOG
            </h4>
        </div>
    </section>
    <div class="parent-form-admin">
        <form
            action="{{ $id_blog != '' ? route('blog.update', $id_blog) : route('blog.store') }}"
            method="POST" class="form_add_company  w-100 m-0 " enctype="multipart/form-data">
            @csrf
            @if($id_blog != '')
                @method('PUT')
            @endif

            <div class="d-flex">

                <div class="form w-50">
                    <h5>Author</h5>
                    <input class="search-field" type="text" required name="author" placeholder="" value="{{ $id_blog != '' ? $blog->author : '' }}"/>
                </div>

                <div class="form w-50">
                    <h5>Blog Category</h5>
                    <select class="form-control" name="category_blog_id">
                        @foreach($CategoryBlog as $category)
                            @if($category->level == 1)
                                <option style="font-weight: 500" value="{{$category->id}}"  {{isset($blog->category_blog_id) && $blog->category_blog_id == $category->id ? 'selected' : ''}}>{{$category->name}} </option>
                            @endif
                            @foreach($CategoryBlog as $category2)
                                @if($category2->parent_id == $category->id)
                                    <option value="{{$category2->id}}"  {{isset($blog->category_blog_id) && $blog->category_blog_id == $category2->id ? 'selected' : ''}}>&nbsp;&nbsp;&nbsp;&nbsp;{{$category2->name}} </option>
                                    @foreach($CategoryBlog as $category3)
                                        @if($category3->parent_id == $category2->id)
                                            <option value="{{$category3->id}}"  {{isset($blog->category_blog_id) && $blog->category_blog_id == $category3->id ? 'selected' : ''}}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$category3->name}} </option>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="form">
                <h5>Title</h5>
                <input class="search-field w-100" type="text" required name="title" placeholder="" value="{{ $id_blog != '' ? $blog->title : '' }}"/>
            </div>
            <div class="form mb-5">
                <h5>Description </h5>
                <textarea id="summernote" name="desc">{{ $id_blog != '' ? $blog->desc : '' }}</textarea>
            </div>
            <div class="parentContainer w-80 form">
                <form id="image-form">
                    <div class="d-flex">
                        <div class="w-50">
                            <div class="form-group hidden" id="file-input-group">
                                <div class="justify-content-center wrapper align-items-center">
                                    <h5 for="input-type">Chọn ảnh từ máy tính</h5>
                                    <input type="file" name="file" id="file" class="file-img d-none">
                                    <div class="d-flex">
                                        <input style="border-radius: 5px 0 0 5px" type="text" name="file-name" id="file-name" class="file-name" readonly="readonly">
                                        <input type="button" class="btn-select-img btn fw-bold rounded-start-0 rounded-end-2 fs-6" id="file-input" value="Select">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-50">
                            <div id="image-preview" class=" text-center mt-5 ">
                                @if($id_blog != '')
                                    <img src="{{ asset($blog->img) }}" alt="Image Preview">
                                @else
                                    <div>Preview</div>
                                @endif

                            </div>
                        </div>
                    </div>
                </form>

                <div class="form-group d-flex m-auto mt-5" style="width:23rem;">
                    <input type="submit" style="width:10rem;" value="SAVE"
                           class="btn me-5 mt-3 text-white fw-bold fs-6">
                    <a href="{{ route('blog.index') }}">
                        <button type="button" style="width:10rem;padding: 0.75rem;"
                                class="btn btn-secondary mt-3  fw-bold fs-6">
                            CANCEL
                        </button>
                    </a>
                </div>
            </div>
        </form>
    </div>

</div>
@stop
