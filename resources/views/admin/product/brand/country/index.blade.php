 @extends('admin.layout') 
 @section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Manufacturing Country Management</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manufacturing Country Management</li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Manufacturing Country Management</h3>
                        <a href="/admin/product/mfd-country/create" class="btn btn-warning pull-right">Create Country</a>
                    </div>
                    <div class="box-body list-items">
                        <table class="table table-bordered ss-data-table">
                            <tr class="table_header">
                                <th style="width: 30px">#</th>                                
                                <th>Name</th>
                                <th>Alpha Code-2 (iso_code2)</th>
                                <th>Alpha Code-3 (iso_code3)</th>
                                <th>Numeric</th>
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
                                <td style="width: 150px;">
                                    <div class="action-ul-cover">
                                        <ul>
                                            {{-- <li><a href="/admin/mfd-country/{{$brand->id}}" class="crud-ab-cover ab-view"><i class="fa fa-eye" aria-hidden="true"></i></a></li> --}}
                                            <li><a href="/admin/product/mfd-country/{{$country->id}}/edit" class="crud-ab-cover ab-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>
                                            <li><a href="/admin/product/mfd-country/{{$country->id}}/delete" class="crud-ab-cover ab-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
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