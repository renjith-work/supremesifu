 @extends('admin.layout') 
 @section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Post Management</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Post Management</li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Post Management</h3>
                        <a href="/admin/post/create" class="btn btn-warning pull-right">Create Post</a>
                    </div>
                    <div class="box-body list-items">
                        <table class="table table-bordered ss-data-table">
                            <tr class="table_header">
                                <th style="width: 30px">#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Body</th>
                                <th>Status</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                            @if ($posts)
                            @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id }}</td>
                                <td><div class="list-image"><img src="/images/post/{{$post->image}}" alt="{{$post->title}}"></div></td>
                                <td>{{$post->title }}</td>
                                <td>{{$post->category->name }}</td>
                                <td>
                                    @if($post->bodyE)
                                        {!!  substr(strip_tags($post->bodyE), 0, 100) !!}...</td>
                                    @elseif($post->bodyH)
                                        {!!  substr(strip_tags($post->bodyH), 0, 100) !!}...</td>
                                    @endif
                                <td>{{$post->status->name }}</td>
                                <td style="width: 150px;">
                                    <div class="action-ul-cover">
                                        <ul>
                                            <li><a href="/admin/post/{{$post->id}}" class="crud-ab-cover ab-view"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                            <li><a href="/admin/post/{{$post->id}}/edit" class="crud-ab-cover ab-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>
                                            <li><a href="/admin/post/{{$post->id}}/delete" class="crud-ab-cover ab-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                    </div>
                    <div class="text-center">
                        {!! $posts->links() !!}
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