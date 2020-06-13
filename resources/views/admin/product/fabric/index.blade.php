 @extends('admin.layout') 
 @section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Fabric Management</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/product/fabric/">Fabric Management</a></li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Fabric</h3>
                        <a href="/admin/product/fabric/create" class="btn btn-warning pull-right">Add Fabric</a>
                    </div>
                    <div class="box-body list-items">
                        <table class="table table-bordered ss-data-table">
                            <tr class="table_header">
                                <th style="width: 30px">#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Price /M</th>
                                <th>Class</th>
                                <th>Brand</th>
                                <th>Categories</th>
                                <th>Status</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                            @foreach($fabrics as $fabric)
                            <tr>
                                <td>{{$fabric->id }}</td>
                                <td><div class="list-image"><img src="/images/product/fabric/{{$fabric->image }}" alt=""></div></td>
                                <td>{{$fabric->name }}</td>
                                <td>{{$fabric->slug }}</td>
                                <td>{!! $fabric->description !!}</td>
                                <td>{{$fabric->price }}</td>
                                <td>{{$fabric->class->name }}</td>
                                <td>{{$fabric->brand->name }}</td>
                                <td>
                                    @if($fabric->productCategories)
                                        @foreach ($fabric->productCategories as $category)
                                        <span class="label label-success show-tag-label">{{$category->name}}</span> 
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if($fabric->status == 1)
                                        <span class="label label-success label-pixtent-success">Active</span>
                                    @elseif($fabric->status == 1)
                                        <span class="label label-danger label-pixtent-success">In-Active</span>
                                    @endif
                                </td>
                                <td style="padding-left: 10px; padding-right: 10px;">
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-2">
                                            <a href="/admin/product/fabric/{{$fabric->id}}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="/admin/product/fabric/{{$fabric->id}}/delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="text-center">
                        {!! $fabrics->links() !!}
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