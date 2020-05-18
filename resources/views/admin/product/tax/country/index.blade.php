 @extends('admin.layout') 
 @section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Tax Country Management</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Tax Country Management</li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Tax Country Management</h3>
                        <a href="/admin/product/tax/country/create" class="btn btn-warning pull-right">Create Country</a>
                    </div>
                    <div class="box-body list-items">
                        <table class="table table-bordered ss-data-table">
                            <tr class="table_header">
                                <th style="width: 30px">#</th>                                
                                <th>Name</th>
                                <th>Alpha Code-2 (iso_code2)</th>
                                <th>Alpha Code-3 (iso_code3)</th>
                                <th>Numeric</th>
                                <th>Status</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                            @if ($countries)
                            @foreach($countries as $country)
                            <tr>
                                <td>{{$country->id }}</td>
                                <td>{{$country->name }}</td>
                                <td>{{$country->iso_code2 }}</td>
                                <td>{{$country->iso_code3 }}</td>
                                <td>{{$country->numeric }}</td>
                                <td>@if($country->status == 0)
                                    <span class="label label-danger label-pixtent-success">Inactive</span>
                                    @elseif($country->status == 1)
                                    <span class="label label-success label-pixtent-success">Active</span>
                                    @endif
                                </td>
                                <td style="width: 150px;">
                                    <div class="action-ul-cover">
                                        <ul>
                                            {{-- <li><a href="/admin/mfd-country/{{$brand->id}}" class="crud-ab-cover ab-view"><i class="fa fa-eye" aria-hidden="true"></i></a></li> --}}
                                            <li><a href="/admin/product/tax/country/{{$country->id}}/edit" class="crud-ab-cover ab-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>
                                            <li><a href="/admin/product/tax/country/{{$country->id}}/delete" class="crud-ab-cover ab-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                    </div>
                    <div class="text-center">
                        {!! $countries->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>  
 @endsection
 @section('script')
<script src="/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
 @endsection