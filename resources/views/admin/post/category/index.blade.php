 @extends('admin.layout') 
 @section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Post Category Management</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Post Category Management</li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Post Category Management</h3>
                        <a href="/admin/post/category/create" class="btn btn-warning pull-right">Create Category</a>
                    </div>
                    <div class="box-body list-items">
                        <table class="table table-bordered ss-data-table">
                            <tr class="table_header">
                                <th style="width: 30px">#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Parent</th>
                                <th>Description</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                            @foreach($categories as $category)
                            @if ($category->id != 1)
                            <tr>
                                <td>{{$category->id }}</td>
                                <td>{{$category->name }}</td>
                                <td>{{$category->slug }}</td>
                                <td>{{$category->parent->name }}</td>
                                <td>{{$category->description }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-2">
                                            <a href="/admin/post/category/{{$category->id}}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="/admin/post/category/{{$category->id}}/delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
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