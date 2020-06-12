@extends('admin.layout')
@section('header')
     <link rel="stylesheet" href="/cmadmin/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    {!! Html::style('cmadmin/parsley/parsley.css') !!}
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=olg2smjmsqjy5ogdk1zogy9sj5qginfm4e5ozpvxrm5ecfek"></script>
    <link rel="stylesheet" href="/cmadmin/bower_components/select2/dist/css/select2.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/fabric/">Fabric Management</a></li>
            <li class="active">Create Fabric</li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                <div class="box cms-form-box-cover">
                    <div class="box-header with-border form-box-head">
                        <h3 class="form-box-title">Create Fabric</h3> 
                    </div>
                    <div class="form-box-body">
                        <form action="{{route('admin.fabric.store')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">Fabric Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" maxlength="255" value="{{ old('name') }}" placeholder="Please enter an attribute name">
                                @error('name') <p class="error-p">{{$errors->first('name')}}</p> @enderror
                            </div>
                            <div class="form-group">
                                <label for="body">Fabric Description</label>
                                <textarea name="description" id="description" class="form-control tiny_body @error('description') is-invalid @enderror" rows="10" >{{ old('description') }}</textarea>
                                @error('description') <p class="error-p">{{$errors->first('description')}}</p> @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Fabric Price /Meter</label>
                                <input type="number" step="any" name="price" class="form-control @error('price') is-invalid @enderror" id="price" maxlength="255" value="{{ old('price') }}" placeholder="Please enter a price or leave it blank.">
                                @error('price') <p class="error-p">{{$errors->first('price')}}</p> @enderror
                            </div>
                            <div class="form-group">
                                <label for="class">Fabric Class</label>
                                <select name="class" id="class" class="form-control @error('class') is-invalid @enderror">
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                                @error('class') <p class="error-p">{{$errors->first('class')}}</p> @enderror
                            </div>
                            <div class="form-group">
                                <label for="brand">Fabric Brand</label>
                                <select name="brand" id="brand" class="form-control @error('brand') is-invalid @enderror">
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand') <p class="error-p">{{$errors->first('brand')}}</p> @enderror
                            </div>
                            @if($categories)
                            <div class="form-group">
                                <label for="categories">Product Category</label>
                                <select id="categories" multiple class="form-control custom-select mt-15 @error('categories') is-invalid @enderror select2" name="categories[]">
                                    @foreach($categories as $category)
                                        @if($category->id != 1)
                                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('categories') <p class="error-p">{{$errors->first('categories')}}</p> @enderror
                            </div> 
                            @endif
                            <div id="attribute_cover"></div>
                            <br>
                            <div class="form-group">
                                <label>Fabric Image</label>
                                <div class="form-instruction">This image will be used as a display image for the fabric. Preffered Image size - 500 x 400 Pixels.</div>
                                <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror" id="image">
                                @error('image') <p class="error-p">{{$errors->first('image')}}</p> @enderror
                                <div id="image_preview" class="row"></div>
                            </div>
                            <div class="form-group">
                                <label for="status">Fabric Status</label>
                                <select id="status" class="form-control custom-select mt-15 @error('status') is-invalid @enderror" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">In-Active</option>
                                </select>
                                @error('status') <p class="error-p">{{$errors->first('status')}}</p> @enderror
                            </div> 
                            <div class="box-footer">
                                <input id="submitTag" type="Submit" value="Submit" class="btn btn-success btn-lg pull-right submit-button btn-submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('footer')
    <script src="/cmadmin/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="/cmadmin/parsley/parsley.js"></script>
    <script type="text/javascript">
    $(document).ready(function(e){

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }});

        tinymce.init({
            selector: '.tiny_body',
            theme: 'modern',
            plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
            toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
            image_advtab: true,
        });
        
        // Initialize Select2 features
        $(function () {
            $('.select2').select2()
        });

        $('#image').change(function(){
            $('#image_preview').html("");
            $('#image_preview').append("<div class='col-md-4 upload-multi-img'><img src='"+URL.createObjectURL(event.target.files[0])+"'></div>");
        }); 

        loadFabricAttributes();
        function loadFabricAttributes(){
            $('#attribute_cover').html('');
            $.ajax({
                url: "/admin/fabric/attribute/list",
                type:'GET',
                dataType: 'json',
                success:function(response){
                    // console.log(response);
                    $.each(response, function(key,value){
                        $('#attribute_cover').append('<div class="form-group">');
                        $('#attribute_cover').append('<label for="attribute">'+value.name+'</label>');
                        $('#attribute_cover').append('<select name="'+value.name+'" id="'+value.name+'" class="form-control"></select>');
                        $('#attribute_cover').append('</div>');
                        $.each(value.values, function(key1,value1){
                            $('#'+ value.name).append('<option value="'+value1.id+'">'+value1.value+'</option>');
                        });

                    });
                }
            });
        }
        
    });
</script>
@endsection