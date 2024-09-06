@extends('frontend.layout.layout')
@section('content')
<div class="clearfix margin-top-90"></div>


<!-- Menu left
================================================= -->

<div class="d-flex">
    @include('.frontend.component.menu_left_employer')

    <div class="contain" style="margin: auto; width: calc(100% - 260px);background-color: #f7f7f7">

        <div class="form" style="width: 90%; margin: 50px auto 0 auto">
            <h3>
                @if($company != '')
                   Edit
                @elseif($company == '')
                    Add
                @endif
                Company</h3>
            <hr>
        </div>

        <form class="form_add_company" method="post" action="
        @if($company != '')
            {{route('company.update', $company->id)}}
        @else
            {{route('company.store')}}
        @endif
        " enctype="multipart/form-data" style="width: 90%">
            @csrf
            @if($company != '')
                @method('PUT')
            @endif
            <div class="form w-100" style="background-color: #f5f5f5bf;padding: 0px 54px;">
                <h3>Company Details</h3>
                <hr style="width: 109%;  transform: translateX(-53px);">
            </div>
            <input name="id_employer" value="" type="hidden">
            <div class="form">
                <h5>Company name</h5>
                <input class="search-field" type="text" name="company_name" placeholder="" value="{{$company != '' ? $company->company_name : ''}}" required/>
            </div>
            <div class="d-flex form optional flex-wrap ">
                <div class="form d-flex justify-content-between w-100">
                    <div class="avatar_profile" style=" width: 25%;position: relative">
                        <h5>Logo Company</h5>
                        <div class="controlContainer " style="position: absolute;bottom: 0; width: 100%; height: calc(100% - 28px)">
                            <div class="inputFileHolder h-100">
                                <a class="w-100 h-100 btn-select-img" title="Browse">
                                </a>
                                <input name="avatar_old" value="{{$company != '' ? $company->company_logo : ''}}" type="hidden">
                            </div>
                        </div>
                        <img class="border image-preview btn-select-img" style="height: 160px;max-width: 160px" src="{{$company != '' ? asset($company->company_logo) : ''}}" alt="">
                        <h6>(reasonable size: 160px x 160px)</h6>
                    </div>
                    <div class="w-75">
                        <div class="parentContainer w-100 form">
                            <h5>Company Logo (optional)</h5>
                            <div class="controlContainer">
                                <div class="inputFileHolder">
                                    <a  class="btn btn-flat-browse" title="Browse">
                                        <i  class="fa fa-folder-open"></i>
                                    </a>
                                    <input id="fileInput2" name="company_logo" class="fileInput fileInput2 file-img" title="Choose file to upload" type="file" >
                                </div>
                                <div class="inputFileMask">
                                    <input class="inputFileMaskText2" readonly="readonly" placeholder="Choose file.." value="{{$company != '' ? $company->company_logo : ''}}" type="text" id="inputFileMaskText2">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="form" style="width: 49%">
                                <h5>Company Tagline (optional)</h5>
                                <input class="search-field" type="text" name="company_tagline" placeholder="" value="{{$company != '' ? $company->company_tagline : ''}}" />
                            </div>

                            <div class="form" style="width: 49%">
                                <h5>Company Website (optional)</h5>
                                <input class="search-field" type="text" name="company_website" placeholder="" value="{{$company != '' ? $company->company_website : ''}}" />
                            </div>
                        </div>
                    </div>
                </div>
                <span id="formSearch" data-url-suggest="{{ route('company.suggest') }}"></span>
                <span id="value-data-selected" data-id-province="{{$company != '' ? $company->province_id : ''}}"
                      data-id-district="{{$company != '' ? $company->district_id : ''}}"
                      data-id-ward="{{$company != '' ? $company->ward_id : ''}}"
                      data-id-industry="{{$company != '' ? $company->industry_id : ''}}"></span>
                <div class="form d-flex w-100">
                    <div class="w-100 ">
                        <h5>Headquarters (optional)</h5>
                        <div class="d-flex row">
                            <div class="form-group select2-company col-2">
                                <select class="js-example-basic-single form-control" id="first_suggest" data-type="province" data-placeholder="Province" name="province">
                                </select>
                            </div>
                            <div class="form-group select2-company  col-2">
                                <select class="js-example-basic-single form-control" id="second_suggest" data-type="district"
                                        data-placeholder="District" name="district">
                                </select>
                            </div>
                            <div class="form-group select2-company col-2">
                                <select class="js-example-basic-single form-control" id="select_active" data-type="ward"
                                        data-placeholder="Ward" name="ward">
                                </select>
                            </div>
                            <div class="form-group  col-6">
                                <input type="text" name="address" placeholder="specific address (house number, street name, ...)" value="{{$company != '' ? $company->headquarters : ''}}">
                            </div>
                        </div>
                    </div>
                </div>



                <div class="form">
                    <h5>Email (optional)</h5>
                    <input class="search-field" type="text" name="company_email" placeholder="" value="{{$company != '' ? $company->email : ''}}" />
                </div>

                <div class="form">
                    <h5>Phone (optional)</h5>
                    <input class="search-field" type="text" name="company_phone" placeholder="" value="{{$company != '' ? $company->phone : ''}}" />
                </div>

                <div class="form">
                    <h5>Twitter (optional)</h5>
                    <input class="search-field" type="text" name="company_twitter" placeholder="" value="{{$company != '' ? $company->twitter : ''}}" />
                </div>

                <div class="form">
                    <h5>Facebook (optional)</h5>
                    <input class="search-field" type="text" name="company_facebook" placeholder="" value="{{$company != '' ? $company->facebook : ''}}" />
                </div>

                <div class="form select2-company">
                    <h5>Industry (optional)</h5>
                    <select class="js-example-basic-single form-control " id="select_industry" data-type="industry"
                            data-placeholder="Industry" name="industry">
                    </select>
                </div>


                <div class="form">
                    <h5>Company Size (optional)</h5>
                    <select class="form-select form-select-lg mb-3" name="company_size" style="height: 57px;color: #909090;" aria-label=".form-select-lg example">
                        <option {{$company != '' ? 'selected' : ''}}>Company Size</option>
                        <option {{$company != '' && $company->company_size == "01 - 05" ? 'selected' : ''}} value="01 - 05">01 - 05</option>
                        <option {{$company != '' && $company->company_size == "05 - 15" ? 'selected' : ''}} value="05 - 15">05 - 15</option>
                        <option {{$company != '' && $company->company_size == "15 - 30" ? 'selected' : ''}} value="15 - 30">15 - 30</option>
                        <option {{$company != '' && $company->company_size == "30 - 50" ? 'selected' : ''}} value="30 - 50">30 - 50</option>
                        <option {{$company != '' && $company->company_size == "50+" ? 'selected' : ''}} value="50+">50+</option>
                    </select>
                </div>
            </div>

            <div class="form">
                <h5>Short Description (optional)</h5>
                <textarea id="summernote" name="desc"> {{$company != '' ? $company->description : ''}}</textarea>
            </div>
            <div class="form text-end">
                <input type="submit" value="Save">
            </div>
        </form>

    </div>
</div>
<div class="margin-top-60"></div>
@stop
