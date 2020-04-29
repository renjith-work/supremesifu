 @extends('admin.layout') 
 @section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Product Attribute Set Management</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Product Attribute Set Management</li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Product Attribute Set Management</h3>
                        <a href="/admin/product/attribute/set/create" class="btn btn-warning pull-right">Create Set</a>
                    </div>
                    <div class="box-body list-items">
                        <table class="table table-bordered ss-data-table">
                            <tr class="table_header">
                                <th style="width: 30px">#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th style="width: 150px">Action</th>
                            </tr>
                            @if ($attribute_sets)
                            @foreach($attribute_sets as $attribute_set)
                           <tr>
                                <td>{{$attribute_set->id }}</td>
                                <td>{{$attribute_set->name }}</td>
                                <td>{!!  substr(strip_tags($attribute_set->description), 0, 100) !!}...</td>
                                <td style="width: 150px;">
                                    <div class="action-ul-cover">
                                        <ul>
                                            <li><a href="/admin/product/attribute/set/{{$attribute_set->id}}/edit" class="crud-ab-cover ab-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>
                                            <li><a href="/admin/product/attribute/set/{{$attribute_set->id}}/delete" class="crud-ab-cover ab-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                    </div>
                    <div class="text-center">
                        {!! $attribute_sets->links() !!}
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