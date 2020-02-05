 @extends('admin.layout') 
 @section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Permissions Management</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/auth/permissions">Permissions Management</a></li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Permissions</h3>
                        <a href="/admin/auth/permissions/create" class="btn btn-warning pull-right">Add Permissions</a>
                    </div>
                    <div class="box-body list-items">
                        <table class="table table-bordered ss-data-table">
                            <tr class="table_header">
                               <th>Permissions</th>
                                <th>Operation</th>
                            </tr>
                            @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td> 
                                <td style="padding-left: 10px; padding-right: 10px;">
                                    <div class="row"> 
                                        <div class="col-md-4 offset-md-2">
                                            <a href="/admin/auth/permissions/{{$permission->id}}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="/admin/auth/permissions/{{$permission->id}}/delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="text-center">
                        {!! $permissions->links() !!}
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