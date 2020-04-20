 @extends('admin.layout') 
 @section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Catalogue Management</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Catalogue Management</li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Catalogue Management</h3>
                        <a href="/admin/product/catalogue/create" class="btn btn-warning pull-right">Create Catalogue</a>
                    </div>
                    <div class="box-body list-items">
                        <table class="table table-bordered ss-data-table">
                            <tr class="table_header">
                                <th style="width: 30px">#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                            @if ($catalogues)
                            @foreach($catalogues as $catalogue)
                           <tr>
                                <td>{{$catalogue->id }}</td>
                                <td>{{$catalogue->name }}</td>
                                <td>{!!  substr(strip_tags($catalogue->description), 0, 100) !!}...</td>
                                <td style="width: 150px;">
                                    <div class="action-ul-cover">
                                        <ul>
                                            <li><a href="/admin/product/catalogue/{{$catalogue->id}}/edit" class="crud-ab-cover ab-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>
                                            <li><a href="/admin/product/catalogue/{{$catalogue->id}}/delete" class="crud-ab-cover ab-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                    </div>
                    <div class="text-center">
                        {!! $catalogues->links() !!}
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