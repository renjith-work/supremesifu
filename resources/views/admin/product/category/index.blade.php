 @extends('admin.layout') 
 @section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Product Category Management</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Product Category Management</li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Product Category Management</h3>
                        <a href="/admin/product/category/create" class="btn btn-warning pull-right">Create Category</a>
                    </div>
                    <div class="box-body list-items">
                        <table class="table table-bordered ss-data-table">
                            <tr class="table_header">
                                <th style="width: 30px">#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Parent</th>
                                <th>Description</th>
                                <th>Featured</th>
                                <th>Menu</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                            @if ($categories)
                            @foreach($categories as $category)
                            @if(!empty($category->parent_id))
                            <tr>
                                <td>{{$category->id }}</td>
                                <td>{{$category->image }}</td>
                                <td>{{$category->name }}</td>
                                <td>
                                    @if($category->parent_id)
                                        {{$category->parent->name }}
                                    @endif
                                </td>
                                <td>{{$category->description }}</td>
                                <td>
                                    @if($category->featured == 0)
                                        No
                                    @else 
                                        Yes
                                    @endif
                                </td>
                                <td>
                                    @if($category->menu == 0)
                                        No
                                    @else 
                                        Yes
                                    @endif
                                </td>
                                <td style="width: 150px;">
                                    <div class="action-ul-cover">
                                        <ul>
                                            <li><a href="/admin/product/category/{{$category->id}}" class="crud-ab-cover ab-view"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                            <li><a href="/admin/product/category/{{$category->id}}/edit" class="crud-ab-cover ab-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>
                                            <li><a href="/admin/product/category/{{$category->id}}/delete" class="crud-ab-cover ab-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                        </table>
                    </div>
                    <div class="text-center">
                        {!! $categories->links() !!}
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