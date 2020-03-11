 @extends('admin.layout') 
 @section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Product Management</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Product Management</li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Product Management</h3>
                        <a href="/admin/product/create" class="btn btn-warning pull-right">Create Product</a>
                    </div>
                    <div class="box-body list-items">
                        <table class="table table-bordered ss-data-table">
                            <tr class="table_header">
                                <th style="width: 30px">#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Category</th>
                                <th>Fabric</th>
                                <th>Summary</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                            @if ($products)
                            @foreach($products as $product)
                            <tr>
                                <td>{{$product->id }}</td>
                                <td><div class="list-image"><img src="/images/product/product/{{$product->p_image}}" alt="{{$product->name}}"></div></td>
                                <td>{{$product->name }}</td>
                                <td>{{$product->slug }}</td>
                                <td>{{$product->productCategory->name }}</td>
                                <td>@if($product->fabric_id){{$product->fabric->name }}@endif</td>
                                <td>{{$product->summary}}</td>
                                <td>{{$product->status_id }}</td>
                                <td>MYR {{$product->price }}</td>
                                <td style="padding-left: 10px; padding-right: 10px;">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="/admin/product/{{$product->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </div> 
                                        <div class="col-md-4">
                                            <a href="/admin/product/{{$product->id}}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="/admin/product/{{$product->id}}/delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                    </div>
                    <div class="text-center">
                        {!! $products->links() !!}
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