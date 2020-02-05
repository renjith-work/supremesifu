 @extends('admin.layout') 
 @section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>User Management</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/users">User Management</a></li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Users</h3>
                        <a href="/admin/auth/users/create" class="btn btn-warning pull-right">Add User</a>
                    </div>
                    <div class="box-body list-items">
                        <table class="table table-bordered ss-data-table">
                            <tr class="table_header">
                                <th style="width: 30px">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>User Roles</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->fname }} {{ $user->lname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                                <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td> {{-- Retrieve array of roles associated to a user and convert to string --}}
                                <td style="padding-left: 10px; padding-right: 10px;">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="/admin/auth/users/{{$user->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </div> 
                                        <div class="col-md-4">
                                            <a href="/admin/auth/users/{{$user->id}}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="/admin/auth/users/{{$user->id}}/delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="text-center">
                        {!! $users->links() !!}
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