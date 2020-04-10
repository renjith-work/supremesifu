@extends('admin.layout')
@section('header')
    <link rel="stylesheet" type="text/css" href="/cmadmin/parsley/parsley.css">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=olg2smjmsqjy5ogdk1zogy9sj5qginfm4e5ozpvxrm5ecfek"></script>
    <link rel="stylesheet" href="/cmadmin/bower_components/select2/dist/css/select2.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/product/fabric/class">Fabric Class Management</a></li>
            <li class="active">Create Class</li>
        </ol>
    </section>
    <section class="content">
        <div class="admin-footer-error">@include('admin.partials.flashErrorMessage')</div>
        <div class="global-settings-cover">
            <form action="{{ route('admin.product.fabric.class.update', $class->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('PUT') }}
                <div class="row user">
                    <div class="col-md-3">
                        <div class="tile p-0 gb-settings-body" style="background: #fff;">
                            <ul class="nav nav-stacked gb-nav">
                                <li class="nav-item active" id="liMain"><a class="nav-link active" href="#mainPane" id="mainTab" data-toggle="tab">MAIN CONTENT</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="mainPane">
                                <div class="box-header">
                                    <h3 class="box-title">Create Class</h3>
                                </div>
                                <div class="gb-body">
                                    <div class="form-group">
                                        <label for="name">Class Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" maxlength="255" value="{{ old('name', $class->name) }}">
                                        @error('name') <p class="error-p">{{$errors->first('name')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description (Text Editor)</label>
                                        <div class="form-instruction">Use the editor to write the body of the post. If you have the html of the body, please ennter it in the html body and leave this field blank.</div>
                                        <textarea name="description" id="description" class="form-control wysiwyg @error('description') is-invalid @enderror" rows="5">{{ old('description', $class->description) }}</textarea>
                                        @error('description') <p class="error-p">{{$errors->first('description')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Class Status</label>
                                        <div class="form-instruction">You can set the class as active or not active.</div>
                                        <select id="status" class="form-control custom-select mt-15 @error('status') is-invalid @enderror" name="status">
                                            <option disabled>Set Status</option>
                                            @foreach($statuses as $status)
                                                <option value="{{ $status->id }}" @if($class->status_id == $status->id) selected @endif> {{ $status->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('status') <p class="error-p">{{$errors->first('status')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="grade">Class Grade</label>
                                        <div class="form-instruction">You can set the number of stars to display</div>
                                        <select id="grade" class="form-control custom-select mt-15 @error('grade') is-invalid @enderror" name="grade">
                                            <option disabled>Set Grade</option>
                                            <option value="1" @if($class->grade == 1) selected @endif> 1 Star </option>
                                            <option value="2" @if($class->grade == 2) selected @endif> 2 Star </option>
                                            <option value="3" @if($class->grade == 3) selected @endif> 3 Star </option>
                                            <option value="4" @if($class->grade == 4) selected @endif> 4 Star </option>
                                            <option value="5" @if($class->grade == 5) selected @endif> 5 Star </option>    
                                         </select>
                                        @error('grade') <p class="error-p">{{$errors->first('grade')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Class Price Range</label>
                                        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price" maxlength="255" value="{{ old('price', $class->price) }}">
                                        @error('price') <p class="error-p">{{$errors->first('price')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="metatag">Meta Tags</label>
                                        <textarea name="metatag" id="metatag" class="form-control @error('metatag') is-invalid @enderror" rows="5">{{ old('metatag', $class->metatag) }}</textarea>
                                        @error('metatag') <p class="error-p">{{$errors->first('metatag')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="metadescp">Meta Description</label>
                                        <textarea name="metadescp" id="metadescp" class="form-control @error('metadescp') is-invalid @enderror" rows="5">{{ old('metadescp', $class->metadescp) }}</textarea>
                                        @error('metadescp') <p class="error-p">{{$errors->first('metadescp')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Class Image - <span>(Image size should be less than 2 MB)</span></label>
                                        <div class="form-instruction">Select the display image for the class. Preferred Image size is - (400 x 400)</div>
                                        <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror" id="image">
                                        @error('image') <p class="error-p">{{$errors->first('image')}}</p> @enderror
                                        <div id="image_preview" class="row"><div class='col-md-4 upload-multi-img'><img src="/images/product/fabric/class/{{$class->image}}"></div></div>
                                    </div>
                                </div>
                                <div class="tile-footer">
                                    <div class="row d-print-none mt-2">
                                        <div class="col-md-12 text-right">
                                            <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </section>
</div>
@endsection
@section('footer')
    <script src="/cmadmin/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="/cmadmin/parsley/parsley.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            // Initialize Select2 features
            $(function () {
                $('.select2').select2()
            });

            tinymce.init({
                selector: '.wysiwyg',
                theme: 'modern',
                plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                image_advtab: true,
            });

            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }});

            $('#image').change(function(){
                $('#image_preview').html("");
                $('#image_preview').append("<div class='col-md-4 upload-multi-img'><img src='"+URL.createObjectURL(event.target.files[0])+"'></div>");
            });

        });
    </script>
@endsection