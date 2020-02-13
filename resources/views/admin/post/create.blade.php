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
            <li><a href="/admin/post">Post Management</a></li>
            <li class="active">Create Post</li>
        </ol>
    </section>
    <section class="content">
        <div class="admin-footer-error">@include('admin.partials.flashErrorMessage')</div>
        <div class="global-settings-cover">
            <form action="{{route('admin.post.store')}}" method="POST" enctype="multipart/form-data" data-parsley-validate >
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
                                    <h3 class="box-title">Create Post</h3>
                                </div>
                                <div class="gb-body">
                                    <div class="form-group">
                                        <label for="title">Post Title</label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="name" maxlength="255" value="{{ old('title') }}">
                                        @error('title') <p class="error-p">{{$errors->first('title')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="user">Post Author</label>
                                        <div class="form-instruction">If no author is selected, the post will be assigned to the current user.</div>
                                        <select id="user" class="form-control custom-select mt-15 @error('user') is-invalid @enderror" name="user">
                                            <option disabled selected>Select an author</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}"> {{ $user->fname }} {{ $user->lname }}</option>
                                            @endforeach
                                        </select>
                                        @error('user') <p class="error-p">{{$errors->first('user')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="metadescp">Post Category</label>
                                        <select id="category" class="form-control custom-select mt-15 @error('category') is-invalid @enderror" name="category">
                                            <option disabled selected>Select a category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('category') <p class="error-p">{{$errors->first('category')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tags">Post Tags</label>
                                        <select id="tags"  class="form-control select2 @error('tags') is-invalid @enderror" name="tags[]" multiple="multiple">
                                            <option disabled>Select Tags</option>
                                            @foreach($tags as $tag)
                                                <option value="{{ $tag->id }}"> {{ $tag->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('tags') <p class="error-p">{{$errors->first('tags')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="bodyE">Post Body (Text Editor)</label>
                                        <div class="form-instruction">Use the editor to write the body of the post. If you have the html of the body, please ennter it in the html body and leave this field blank.</div>
                                        <textarea name="bodyE" id="bodyE" class="form-control wysiwyg @error('bodyE') is-invalid @enderror" rows="5">{{ old('bodyE') }}</textarea>
                                        @error('bodyE') <p class="error-p">{{$errors->first('bodyE')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="bodyH">Post Body (HTML)</label>
                                        <div class="form-instruction">Please enter the html of the body here. You need to leave the text editor body blank to display the html body.</div>
                                        <textarea name="bodyH" id="bodyH" class="form-control @error('bodyH') is-invalid @enderror" rows="5">{{ old('bodyH') }}</textarea>
                                        @error('bodyH') <p class="error-p">{{$errors->first('bodyH')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Post Status</label>
                                        <div class="form-instruction">If no status is set, the post will be saved as a draft and published only if status is set to publish.</div>
                                        <select id="status" class="form-control custom-select mt-15 @error('status') is-invalid @enderror" name="status">
                                            <option disabled>Set Status</option>
                                            @foreach($statuses as $status)
                                                <option value="{{ $status->id }}"> {{ $status->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('status') <p class="error-p">{{$errors->first('status')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="featured">Show as featured</label>
                                        <div class="form-instruction">Set the post as featured if you want to show it in featured destinations.</div>
                                        <select id="featured" class="form-control custom-select mt-15 @error('featured') is-invalid @enderror" name="featured">
                                            <option value="0"> No </option>
                                            <option value="1"> Yes </option>
                                        </select>
                                        @error('featured') <p class="error-p">{{$errors->first('featured')}}</p> @enderror
                                    </div>
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
                                            @foreach($designs as $design)
                                                <option value="{{$design->id}}"> {{$design->name}} </option>
                                            @endforeach
                                        </select>
                                        @error('design') <p class="error-p">{{$errors->first('design')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="video">Post Video</label>
                                        <div class="form-instruction">You may leave this blank if the post has no video.</div>
                                        <textarea name="video" id="video" class="form-control @error('video') is-invalid @enderror" rows="1">{{ old('video') }}</textarea>
                                        @error('video') <p class="error-p">{{$errors->first('video')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Category Cover Image - <span>(Image size should be less than 2 MB)</span></label>
                                        <div class="form-instruction">Select the display image for the category. Preferred Image size is - ( You may leave it blank if you don't need a display image. )</div>
                                        <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror" id="image">
                                        @error('image') <p class="error-p">{{$errors->first('image')}}</p> @enderror
                                        <div id="image_preview" class="row"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="album">Post Album Images - <span>(Image size should be less than 2 MB)</span></label>
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

            $('#image').change(function(){
                $('#image_preview').html("");
                $('#image_preview').append("<div class='col-md-4 upload-multi-img'><img src='"+URL.createObjectURL(event.target.files[0])+"'></div>");
            });

        });
    </script>
@endsection