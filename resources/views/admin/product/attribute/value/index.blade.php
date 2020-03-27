 @extends('admin.layout') 
 @section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Product Attribute Value Management</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Product Attribute Value Management</li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Product Attribute Value Management</h3>
                        <a href="/admin/product/attribute/value/create" class="btn btn-warning pull-right">Create Value</a>
                    </div>
                    <div class="box-body list-items">
                        <table class="table table-bordered ss-data-table">
                            <tr class="table_header">
                                <th style="width: 30px">#</th>
                                <th>Image</th>
                                <th>Value</th>
                                <th>Attribute</th>
                                <th>Attribute Code</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                            @if ($values)
                            @foreach($values as $value)
                            <tr>
                                <td>{{$value->id }}</td>
                                <td>@if($value->d_image)<div class='list-image'><img src="/images/product/attributes/{{$value->d_image}}"></div>@endif</td>
                                <td>{{$value->value }}</td>
                                <td>{{$value->productAttribute->name }}</td>
                                <td>{{$value->productAttribute->code }}</td>
                                <td>{!!  substr(strip_tags($value->description), 0, 25) !!}...</td>
                                <td>MYR 
                                    @if($value->price)
                                        {{$value->price}}
                                    @else
                                        0.00
                                    @endif

                                </td>
                                <td style="width: 150px;">
                                    <div class="action-ul-cover">
                                        <ul>
                                            <li><a href="/admin/product/attribute/value/{{$value->id}}" class="crud-ab-cover ab-view"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                            <li><a href="/admin/product/attribute/value/{{$value->id}}/edit" class="crud-ab-cover ab-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>
                                            <li><a href="/admin/product/attribute/value/{{$value->id}}/delete" class="crud-ab-cover ab-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                    </div>
                    <div class="text-center">
                        {!! $values->links() !!}
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