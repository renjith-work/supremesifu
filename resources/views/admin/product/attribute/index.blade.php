 @extends('admin.layout') 
 @section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Product Attribute Management</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Product Attribute Management</li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Product Attribute Management</h3>
                        <a href="/admin/product/attribute/create" class="btn btn-warning pull-right">Create Attribute</a>
                    </div>
                    <div class="box-body list-items">
                        <table class="table table-bordered ss-data-table">
                            <tr class="table_header">
                                <th style="width: 30px">#</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Product Category</th>
                                <th>Filterable</th>
                                <th>Required</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                            @if ($attributes)
                            @foreach($attributes as $attribute)
                            <tr>
                                <td>{{$attribute->id }}</td>
                                <td>{{$attribute->name }}</td>
                                <td>{{$attribute->code }}</td>
                                <td>{{$attribute->productCategory->name }}</td>
                                <td>
                                    @if($attribute->is_filterable == 0)
                                        No
                                    @else 
                                        Yes
                                    @endif
                                </td>
                                <td>
                                    @if($attribute->is_required == 0)
                                        No
                                    @else 
                                        Yes
                                    @endif
                                </td>
                                <td style="width: 150px;">
                                    <div class="action-ul-cover">
                                        <ul>
                                            <li><a href="/admin/product/attribute/{{$attribute->id}}" class="crud-ab-cover ab-view"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                            <li><a href="/admin/product/attribute/{{$attribute->id}}/edit" class="crud-ab-cover ab-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>
                                            <li><a href="/admin/product/attribute/{{$attribute->id}}/delete" class="crud-ab-cover ab-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                    </div>
                    <div class="text-center">
                        {!! $attributes->links() !!}
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