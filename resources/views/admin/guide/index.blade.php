 @extends('admin.layout') 
 @section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Guide Management</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Guide Management</li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Guide Management</h3>
                        <a href="/admin/post/create" class="btn btn-warning pull-right">Create Guide</a>
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
                                <td style="padding-left: 10px; padding-right: 10px;">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="/admin/post/{{$post->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </div> 
                                        <div class="col-md-4">
                                            <a href="/admin/post/{{$post->id}}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="/admin/post/{{$post->id}}/delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </div>
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