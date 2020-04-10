 @extends('admin.layout') 
 @section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Fabric Class Management</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Fabric Class Management</li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Fabric Class Management</h3>
                        @can('Create Fabric Class')<a href="/admin/product/fabric/class/create" class="btn btn-warning pull-right">Create Class</a>@endcan
                    </div>
                    <div class="box-body list-items">
                        <table class="table table-bordered ss-data-table">
                            <tr class="table_header">
                                <th style="width: 30px">#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price Range</th>                                
                                <th>Grade</th>
                                <th>Status</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                            @if ($classes)
                            @foreach($classes as $class)
                            <tr>
                                <td>{{$class->id }}</td>
                                <td><div class="list-image"><img src="/images/product/fabric/class/{{$class->image }}"></div></td>
                                <td>{{$class->name }}</td>
                                <td>{!!  substr(strip_tags($class->description), 0, 40) !!}...</td>
                                <td>{{$class->price }}</td>
                                <td>{{$class->grade }}</td>
                                <td>{{$class->status->name }}</td>
                                <td style="width: 150px;">
                                    <div class="action-ul-cover">
                                        <ul>
                                            {{-- <li><a href="/admin/brand/{{$brand->id}}" class="crud-ab-cover ab-view"><i class="fa fa-eye" aria-hidden="true"></i></a></li> --}}
                                            @can('Edit Fabric Class')<li><a href="/admin/product/fabric/class/{{$class->id}}/edit" class="crud-ab-cover ab-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>@endcan
                                            @can('Delete Fabric Class')<li><a href="/admin/product/fabric/class/{{$class->id}}/delete" class="crud-ab-cover ab-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>@endcan
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                    </div>
                    <div class="text-center">
                        {!! $classes->links() !!}
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