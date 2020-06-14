 @extends('admin.layout') 
 @section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Shirt Design Management</h1>
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
                        <h3 class="box-title">Shirt Design Management</h3>
                        <a href="/admin/product/design/shirt/create" class="btn btn-warning pull-right">Create Shirt</a>
                    </div>
                    <div class="box-body list-items">
                        <table class="table table-bordered ss-data-table">
                            <tr class="table_header">
                                <th style="width: 30px">#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                            @if ($designs)
                            @foreach($designs as $design)
                            <tr>
                                <td>{{$design->id }}</td>
                                <td>
                                    @foreach($design->images as $image)
                                        @if($image->position_id == 1)
                                           <div class="list-image"><img src="/images/product/design/{{$image->name}}" alt="{{$image->name}}"></div></td>
                                        @endif
                                    @endforeach
                                <td>{{$design->name }}</td>
                                <td>{{$design->slug }}</td>
                                <td>MYR {{$design->price->price }}</td>
                                <td>@if($design->status == 0)
                                    <span class="label label-danger label-pixtent-success">Inactive</span>
                                    @elseif($design->status == 1)
                                    <span class="label label-success label-pixtent-success">Active</span>
                                    @endif
                                </td>
                                <td style="width: 150px;">
                                    <div class="action-ul-cover">
                                        <ul>
                                            {{-- <li><a href="/admin/product/design/shirt/{{$product->id}}" class="crud-ab-cover ab-view"><i class="fa fa-eye" aria-hidden="true"></i></a></li> --}}
                                            <li><a href="/admin/product/design/shirt/{{$design->id}}/edit" class="crud-ab-cover ab-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>
                                            <li><a href="/admin/product/design/shirt/{{$design->id}}/delete" class="crud-ab-cover ab-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                    </div>
                    <div class="text-center">
                        {!! $designs->links() !!}
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