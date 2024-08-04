@extends('layouts.backend')
@section('content')
    <div id="content" xmlns="http://www.w3.org/1999/html">
        <div class="container-fluid">
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header d-sm-flex align-items-center py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ __("Agencies Managements")  }}</h5>
                    @if(auth()->user()->type >= 15)
                        <div class="ml-auto">
                            <a href="{{ route('admin.agency.add') }}" class="btn btn-primary min-w140"><i class="fas fa-plus-circle"></i> {{ __('Add new') }}</a>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form class="auto-filter well">
                        <div class="form-group d-sm-flex">
                                <div class="col-sm-3">
                                    <input name="title" value="{{ isset($_GET['title'])?$_GET['title']:'' }}" type="text" class="form-control" placeholder="{{ __("Please input name ...") }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <input name="email" value="{{ isset($_GET['email'])?$_GET['email']:'' }}" type="text" class="form-control" placeholder="{{ __("Email") }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <input name="tel" value="{{ isset($_GET['tel'])?$_GET['tel']:'' }}" type="text" class="form-control" placeholder="{{ __("Tel") }}"/>
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary {{ isset($_GET['title'])?'d-none':'' }}"><i class="fas fa-filter"></i> {{ __("Search") }}</button>
                                    <button onclick="window.location.href = '{{ route('admin.agency') }}';"type="button" class="btn btn-light {{ isset($_GET['title'])?'':'d-none' }}"><i class="fas fa-times-circle"></i> {{ __("Clear filter") }}</button>
                                </div>
                            </tr>
                        </div>
                    </form>

                    <div class="table-responsive">
                        {{--<p class="text-right"><button type="button" class="btn btn-primary download-csv"><i class="fa fa-download" aria-hidden="true"></i> Download</button></p>--}}
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col width="60">
                                <col>
                                <col>
                                <col width="150">
                                <col width="150">
                                <col width="150">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('No.') }}</th>
                                    <th class="text-left">{{ __('Name') }}</th>
                                    <th class="text-left">{{ __('Email') }}</th>
                                    <th class="text-left">{{ __('Tel') }}</th>
                                    <th class="text-left">{{ __('Channel') }}</th>
                                    <th class="text-center">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $k => $user)
                                <tr>
                                    <td class="text-center">{{ (($users->currentPage()-1)*$limit)+$k+1 }}</td>
                                    <td><a href="{{ route('admin.agency.detail', $user->id) }}">{{ $user->name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->tel }}</td>
                                    <td>{{ @$user->kol->name }}</td>
                                    <td class="text-right text-nowrap">
                                        <a href="{{ route('admin.agency.detail', $user->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> {{ __("Edit") }}</a>
                                        <a href="{{ route('admin.dashboard') }}?referral_code={{$user->referral_code}}" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i> {{ __("Students") }} <span class="memo bold">({{ $user->students->count() }})</span></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">{{ __("No data") }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $users->appends($_GET)->links('backend.paginations.admin') }}


                        {{--<div class="dowload-wrap">
                            <table class="table table-bordered download-table"  width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="text-left">{{ __('No') }}</th>
                                    <th class="text-left">{{ __('Name') }}</th>
                                    <th class="text-left">{{ __('Email') }}</th>
                                    <th class="text-left">{{ __('Tel') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users_all as $k => $user)
                                    <tr>
                                        <td class="text-center">{{ (($user->currentPage()-1)*$limit)+$k+1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>'{{ $user->tel }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">{{ __("No data") }}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>--}}
                    </div>
                </div>
            </div>
            <!-- End -->
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __("Delete") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __("Are you sure you want to delete") }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">{{ __("Yes") }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("No") }}</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#deleteModal').on('show.bs.modal', function(e) {
                $(this).find('.btn-primary').attr('form',$(e.relatedTarget).data('form'));
            });
            $('#deleteModal').on('click', '.btn-primary', function(e) {
                $($(this).attr('form')).submit();
                $(e.delegateTarget).modal('hide');
            });
        })
    </script>
@stop
