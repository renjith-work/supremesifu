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
            <li><a href="/admin/product">Product Management</a></li>
            <li class="active">Create Product</li>
        </ol>
    </section>
    <section class="content">
        <div class="admin-footer-error">@include('admin.partials.flashErrorMessage')</div>
        <div class="global-settings-cover">
            <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data" data-parsley-validate >
                {{ csrf_field() }}
                <div class="row user">
                    <div class="col-md-3">
                        <div class="tile p-0 gb-settings-body" style="background: #fff;">
                            <ul class="nav nav-stacked gb-nav">
                                <li class="nav-item active" id="liMain"><a class="nav-link active" href="#mainPane" id="mainTab" data-toggle="tab">MAIN CONTENT</a></li>
                                <li class="nav-item" id="liImage"><a class="nav-link active" href="#imagePane" id="imageTab" data-toggle="tab">MEDIA CONTENT</a></li>
                                <li class="nav-item" id="liSeo"><a class="nav-link" href="#seoPane" id="seoTab" data-toggle="tab">SEO CONTENT</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="mainPane">
                                <div class="box-header">
                                    <h3 class="box-title">Create Product</h3>
                                </div>
                                <div class="gb-body">
                                    <div class="form-group">
                                        <label for="name">Product Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" maxlength="255" value="{{ old('name') }}">
                                        @error('name') <p class="error-p">{{$errors->first('name')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Product Category</label>
                                        <select id="category" class="form-control custom-select mt-15 @error('category') is-invalid @enderror" name="category">
                                            <option disabled selected>Select a category</option>
                                            @foreach($categories as $category)
                                                @if($category->id != 1)
                                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('category') <p class="error-p">{{$errors->first('category')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="fabric">Fabric</label>
                                        <select id="fabric" class="form-control custom-select mt-15 @error('fabric') is-invalid @enderror" name="fabric">
                                            <option disabled selected>Select a fabric</option>
                                            @foreach($fabrics as $fabric)
                                                <option value="{{ $fabric->id }}"> {{ $fabric->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('fabric') <p class="error-p">{{$errors->first('fabric')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_design">Product Design</label>
                                        <select id="product_design" class="form-control custom-select mt-15 @error('product_design') is-invalid @enderror" name="product_design">
                                            <option disabled selected>Select a design</option>
                                            @foreach($designs as $design)
                                                <option value="{{ $design->id }}"> {{ $design->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('product_design') <p class="error-p">{{$errors->first('product_design')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Product Price</label>
                                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" maxlength="255" value="{{ old('price') }}">
                                        @error('price') <p class="error-p">{{$errors->first('price')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="og_price">Product Original Price</label>
                                        <input type="number" name="og_price" class="form-control @error('og_price') is-invalid @enderror" id="og_price" maxlength="255" value="{{ old('og_price') }}">
                                        @error('og_price') <p class="error-p">{{$errors->first('og_price')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Product Description</label>
                                        <div class="form-instruction">Use the editor to write the description of the product.</div>
                                        <textarea name="description" id="description" class="form-control wysiwyg @error('description') is-invalid @enderror" rows="5">{{ old('description') }}</textarea>
                                        @error('description') <p class="error-p">{{$errors->first('description')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="summary">Product Summary</label>
                                        <textarea name="summary" id="summary" class="form-control @error('summary') is-invalid @enderror" rows="5">{{ old('summary') }}</textarea>
                                        @error('summary') <p class="error-p">{{$errors->first('summary')}}</p> @enderror
                                    </div>
{{--                                     <div class="form-group">
                                        <label for="featured">Show as featured</label>
                                        <div class="form-instruction">Set the post as featured if you want to show it in featured destinations.</div>
                                        <select id="featured" class="form-control custom-select mt-15 @error('featured') is-invalid @enderror" name="featured">
                                            <option value="0"> No </option>
                                            <option value="1"> Yes </option>
                                        </select>
                                        @error('featured') <p class="error-p">{{$errors->first('featured')}}</p> @enderror
                                    </div> --}}
                                </div>
                                <div class="tile-footer">
                                    <div class="row d-print-none mt-2">
                                        <div class="col-md-12 text-right">
                                            <a class="btn btn-success" href="#" id="section1N"><i class="fa fa-fw fa-lg fa-arrow-circle-right"></i> &nbsp;Next</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="imagePane">
                                <div class="box-header">
                                    <h3 class="box-title">MEDIA CONTENT</h3>
                                </div>
                                <div class="gb-body">
                                    <div class="form-group">
                                        <label for="design">Page Template</label>
                                        <div class="form-instruction">You may set the template designs for the post to be displayed in the front end. If no design is selected, default design will be applied.</div>
                                        <select id="design" class="form-control custom-select mt-15 @error('design') is-invalid @enderror" name="design">
                                            {{-- @foreach($designs as $design)
                                                <option value="{{$design->id}}"> {{$design->name}} </option>
                                            @endforeach --}}
                                        </select>
                                        @error('design') <p class="error-p">{{$errors->first('design')}}</p> @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="video">Product Video</label>
                                        <div class="form-instruction">You may leave this blank if the post has no video.</div>
                                        <textarea name="video" id="video" class="form-control @error('video') is-invalid @enderror" rows="1">{{ old('video') }}</textarea>
                                        @error('video') <p class="error-p">{{$errors->first('video')}}</p> @enderror
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="p_image">Product Primary Image - <span>(Image size should be less than 2 MB)</span></label>
                                        <input type="file" name="p_image" class="form-control  @error('p_image') is-invalid @enderror" id="p_image">
                                        @error('p_image') <p class="error-p">{{$errors->first('p_image')}}</p> @enderror
                                        <div id="p_image_preview" class="row"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="s_image">Product Secondary Image - <span>(Image size should be less than 2 MB)</span></label>
                                        <input type="file" name="s_image" class="form-control  @error('s_image') is-invalid @enderror" id="s_image">
                                        @error('s_image') <p class="error-p">{{$errors->first('s_image')}}</p> @enderror
                                        <div id="s_image_preview" class="row"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="album">Product Album Images - <span>(Image size should be less than 2 MB)</span></label>
                                        <div class="form-instruction">If you want to associate more images to the post please add them here. Preferred Image size is - </div>
                                        <input type="file" name="album[]" class="form-control  @error('album') is-invalid @enderror" id="album" multiple>
                                        @error('album') <p class="error-p">{{$errors->first('album')}}</p> @enderror
                                        <div id="images_preview" class="row"></div>
                                    </div>
                                </div>

                                <div class="tile-footer">
                                    <div class="row d-print-none mt-2">
                                        <div class="col-md-6 text-left">
                                            <a class="btn btn-success" href="#" id="section2P"><i class="fa fa-fw fa-lg fa-arrow-circle-left"></i> &nbsp;Previous</a>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a class="btn btn-success" href="#" id="section2N"><i class="fa fa-fw fa-lg fa-arrow-circle-right"></i> &nbsp;Next</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="seoPane">
                                <div class="box-header">
                                    <h3 class="box-title">SEO CONTENT</h3>
                                </div>
                                <div class="gb-body">
                                    <div class="form-group">
                                        <label for="metatag">Meta Tags</label>
                                        <textarea name="metatag" id="metatag" class="form-control @error('metatag') is-invalid @enderror" rows="5">{{ old('metatag') }}</textarea>
                                        @error('metatag') <p class="error-p">{{$errors->first('metatag')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="metadescp">Meta Description</label>
                                        <textarea name="metadescp" id="metadescp" class="form-control @error('metadescp') is-invalid @enderror" rows="5">{{ old('metadescp') }}</textarea>
                                        @error('metadescp') <p class="error-p">{{$errors->first('metadescp')}}</p> @enderror
                                    </div>
                                </div>
                                <div class="tile-footer">
                                    <div class="row d-print-none mt-2">
                                        <div class="col-md-6 text-left">
                                            <a class="btn btn-success" href="#" id="section3P"><i class="fa fa-fw fa-lg fa-arrow-circle-left"></i> &nbsp;Previous</a>
                                        </div>
                                        <div class="col-md-6 text-right">
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

            $('#section1N').click(function(e){
                e.preventDefault();
                $('#mainPane').removeClass("active");
                $('#imagePane').addClass("active");

                $('#mainTab').removeClass("active");
                $('#imageTab').addClass("active");

                $('#liMain').removeClass("active");
                $('#liImage').addClass("active");
            });

            $('#section2P').click(function(e){
                e.preventDefault();
                $('#imagePane').removeClass("active");
                $('#mainPane').addClass("active");

                $('#imageTab').removeClass("active");
                $('#mainTab').addClass("active");

                $('#liImage').removeClass("active");
                $('#liMain').addClass("active");
            });

            $('#section2N').click(function(e){
                e.preventDefault();
                $('#imagePane').removeClass("active");
                $('#seoPane').addClass("active");

                $('#imageTab').removeClass("active");
                $('#seoTab').addClass("active");

                $('#liImage').removeClass("active");
                $('#liSeo').addClass("active");
            });

            $('#section3P').click(function(e){
                e.preventDefault();
                $('#seoPane').removeClass("active");
                $('#imagePane').addClass("active");

                $('#seoTab').removeClass("active");
                $('#imageTab').addClass("active");

                $('#liSeo').removeClass("active");
                $('#liImage').addClass("active");
            });

            $("#album").change(function(){
                $('#images_preview').html("");
                var total_file=document.getElementById("album").files.length;
                for(var i=0;i<total_file;i++)
                {
                    $('#images_preview').append("<div class='col-md-4 upload-multi-img'><img src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
                }
            });

            $('#p_image').change(function(){
                $('#p_image_preview').html("");
                $('#p_image_preview').append("<div class='col-md-4 upload-multi-img'><img src='"+URL.createObjectURL(event.target.files[0])+"'></div>");
            });

            $('#s_image').change(function(){
                $('#s_image_preview').html("");
                $('#s_image_preview').append("<div class='col-md-4 upload-multi-img'><img src='"+URL.createObjectURL(event.target.files[0])+"'></div>");
            });

        });
    </script>
@endsection