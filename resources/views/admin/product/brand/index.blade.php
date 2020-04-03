 @extends('admin.layout') 
 @section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Brand Management</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Brand Management</li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Brand Management</h3>
                        <a href="/admin/brand/create" class="btn btn-warning pull-right">Create Brand</a>
                    </div>
                    <div class="box-body list-items">
                        <table class="table table-bordered ss-data-table">
                            <tr class="table_header">
                                <th style="width: 30px">#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                            @if ($brands)
                            @foreach($brands as $brand)
                            <tr>
                                <td>{{$brand->id }}</td>
                                <td><div class="list-image"><img src="/images/product/brands/{{$brand->image }}"></div></td>
                                <td>{{$brand->name }}</td>
                                <td>{{$brand->description }}</td>
                                <td>{{$brand->status->name }}</td>
                                <td style="width: 150px;">
                                    <div class="action-ul-cover">
                                        <ul>
                                            {{-- <li><a href="/admin/brand/{{$brand->id}}" class="crud-ab-cover ab-view"><i class="fa fa-eye" aria-hidden="true"></i></a></li> --}}
                                            <li><a href="/admin/brand/{{$brand->id}}/edit" class="crud-ab-cover ab-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>
                                            <li><a href="/admin/brand/{{$brand->id}}/delete" class="crud-ab-cover ab-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                    </div>
                    <div class="text-center">
                        {!! $brands->links() !!}
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