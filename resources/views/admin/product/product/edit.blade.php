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
            <li class="active">Edit Product</li>
        </ol>
    </section>
    <section class="content">
        <div class="admin-footer-error">@include('admin.partials.flashErrorMessage')</div>
        <div class="global-settings-cover">
            <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('PUT') }}
                <div class="row user">
                    <div class="col-md-3">
                        <div class="tile p-0 gb-settings-body" style="background: #fff;">
                            <ul class="nav nav-stacked gb-nav">
                                <li class="nav-item active" id="liMain"><a class="nav-link active" href="#mainPane" id="mainTab" data-toggle="tab">MAIN CONTENT</a></li>
                                <li class="nav-item" id="liAttr"><a class="nav-link" href="#attrPane" id="attrTab" data-toggle="tab">ATTRIBUTES</a></li>
                                <li class="nav-item" id="liPrice"><a class="nav-link" href="#pricePane" id="priceTab" data-toggle="tab">PRICE</a></li>
                                <li class="nav-item" id="liInventory"><a class="nav-link" href="#inventoryPane" id="InventoryTab" data-toggle="tab">INVENTORY</a></li>
                                <li class="nav-item" id="liImage"><a class="nav-link" href="#imagePane" id="imageTab" data-toggle="tab">MEDIA CONTENT</a></li>
                                <li class="nav-item" id="liSeo"><a class="nav-link" href="#seoPane" id="seoTab" data-toggle="tab">SEO CONTENT</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="mainPane">
                                <div class="box-header">
                                    <h3 class="box-title">Edit Product</h3>
                                </div>
                                <div class="gb-body">
                                    <div class="form-group">
                                        <label for="name">Product Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" maxlength="255" value="{{ old('name', $product->name) }}">
                                        @error('name') <p class="error-p">{{$errors->first('name')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="sku">SKU</label>
                                        <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" id="sku" maxlength="255" value="{{ old('sku', $product->sku) }}">
                                        @error('sku') <p class="error-p">{{$errors->first('sku')}}</p> @enderror
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="category">Product Category</label>
                                        <select id="category" multiple class="form-control custom-select mt-15 @error('category') is-invalid @enderror select2" name="category[]">
                                            @foreach($categories as $category)
                                                @if($category->id != 1)
                                                    <option value="{{ $category->id }}" {{ in_array($category->id, $sel_categories)?'selected':''}}> {{ $category->name }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('category') <p class="error-p">{{$errors->first('category')}}</p> @enderror
                                    </div>     
                                    <div class="form-group">
                                        <label for="attributeSet">Attribute Set</label>
                                        <div class="form-instruction">Select the attribute set to get the attributes of this product.</div>
                                        <select id="attributeSet" class="form-control custom-select mt-15 @error('attributeSet') is-invalid @enderror" name="attributeSet">
                                            <option disabled selected>Select an attribute set</option>
                                            @foreach($attributeSets as $set)
                                                <option value="{{ $set->id }}" @if($set->id == $product->product_attribute_set_id) selected @endif> {{ $set->name }} </option>                                            
                                            @endforeach
                                        </select>
                                        @error('attributeSet') <p class="error-p">{{$errors->first('attributeSet')}}</p> @enderror
                                    </div> 
                                    <div class="form-group">
                                        <label for="productDesign">Product Design</label>
                                        <select id="productDesign" class="form-control custom-select mt-15 @error('productDesign') is-invalid @enderror" name="productDesign">
                                            <option value="">Select a product design</option>
                                            @foreach($productDesigns as $design)
                                                <option value="{{ $design->id }}" @if(!empty($product->product_design_id)) @if($design->id == $product->design->id) selected @endif @endif> {{ $design->name }} </option>                                            
                                            @endforeach
                                        </select>
                                        @error('productDesign') <p class="error-p">{{$errors->first('productDesign')}}</p> @enderror
                                    </div>   
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="weight">Product Weight</label>
                                                <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror" id="weight" maxlength="255" value="{{ old('weight', $product->weight->weight) }}">
                                                @error('weight') <p class="error-p">{{$errors->first('weight')}}</p> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="weightUnit">Weight Unit</label>
                                                <select id="weightUnit" class="form-control custom-select mt-15 @error('weightUnit') is-invalid @enderror" name="weightUnit">
                                                    <option disabled selected>Select an unit</option>
                                                    @foreach($weightUnits as $unit)
                                                        <option value="{{ $unit->id }}" @if($unit->id == $product->weight->inventory_unit_id) selected @endif> {{ $unit->name }} </option>                                            
                                                    @endforeach
                                                </select>
                                                @error('weightUnit') <p class="error-p">{{$errors->first('weightUnit')}}</p> @enderror
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="brand">Brand</label>
                                        <div class="form-instruction">You may leave this blank if the product doesn't have any brand.</div>
                                        <select id="brand" class="form-control custom-select mt-15 @error('brand') is-invalid @enderror" name="brand">
                                            <option disabled selected>Select a brand</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" @if($brand->id == $product->brand_id) selected @endif> {{ $brand->name }} </option>                                            
                                            @endforeach
                                        </select>
                                        @error('brand') <p class="error-p">{{$errors->first('brand')}}</p> @enderror
                                    </div>  
                                    <div class="form-group">
                                        <label for="country">Country Of Manufacture</label>
                                        <select id="country" class="form-control custom-select mt-15 @error('country') is-invalid @enderror" name="country">
                                            <option disabled selected>Select a country</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}" @if($country->id == $product->country_id) selected @endif> {{ $country->name }} </option>                                            
                                            @endforeach
                                        </select>
                                        @error('country') <p class="error-p">{{$errors->first('country')}}</p> @enderror
                                    </div> 
                                    <div class="section-sub-title">Product Descriptions</div>
                                    <div class="form-group">
                                        <label for="description">Product Description</label>
                                        <div class="form-instruction">Use the editor to write the description of the product.</div>
                                        <textarea name="description" id="description" class="form-control wysiwyg @error('description') is-invalid @enderror" rows="5">{{ old('description', $product->description) }}</textarea>
                                        @error('description') <p class="error-p">{{$errors->first('description')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="summary">Product Summary</label>
                                        <textarea name="summary" id="summary" class="form-control @error('summary') is-invalid @enderror" rows="5">{{ old('summary', $product->summary) }}</textarea>
                                        @error('summary') <p class="error-p">{{$errors->first('summary')}}</p> @enderror
                                    </div>
                                    <div class="section-sub-title">Product Display</div>
                                    <div class="form-group">
                                        <label for="featured">Featured</label>
                                        <div class="form-instruction">Do you want the category to be a featued.</div>
                                        <select id="featured" class="form-control custom-select mt-15 @error('featured') is-invalid @enderror" name="featured">
                                            <option value="1" @if($product->featured == 1) selected @endif>Yes</option>
                                            <option value="0" @if($product->featured == 0) selected @endif>No</option>
                                        </select>
                                        @error('featured') <p class="error-p">{{$errors->first('featured')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Menu</label>
                                        <div class="form-instruction">Do you want the category to be listed in the menu.</div>
                                        <select id="menu" class="form-control custom-select mt-15 @error('menu') is-invalid @enderror" name="menu">
                                            <option value="1" @if($product->menu == 1) selected @endif>Yes</option>
                                            <option value="0" @if($product->menu == 0) selected @endif>No</option>
                                        </select>
                                        @error('menu') <p class="error-p">{{$errors->first('menu')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Purchase Model</label>
                                        <div class="form-instruction">You can either set the product as purchasable or enquiry only. You can make the product purchasable and enquirable at the same time. If no options are selected, the product will be set as sellable by default.</div>
                                        <div class="row pchs-box">
                                            <div class="col-md-4">
                                                <div class="pchs-chck-cover">
                                                    <input type="checkbox" id="sellable" name="sellable" value="1" @if($product->sellable == 1) checked @endif>
                                                    <label for="male">Sellable Product</label><br>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="pchs-chck-cover">
                                                    <input type="checkbox" id="inquirable" name="inquirable" value="1" @if($product->inquirable == 1) checked @endif>
                                                    <label for="male">Inquirable Product</label><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Product Status</label>
                                        <select id="status" class="form-control custom-select mt-15 @error('status') is-invalid @enderror" name="status">
                                            <option value="1" @if($product->status == 1) selected @endif>Active</option>
                                            <option value="0" @if($product->status == 0) selected @endif>In-Active</option>
                                        </select>
                                        @error('status') <p class="error-p">{{$errors->first('status')}}</p> @enderror
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
                            <div class="tab-pane" id="attrPane">
                                <div class="box-header">
                                    <h3 class="box-title">PRODUCT ATTRIBUTES</h3>
                                </div>
                                <div class="gb-body">
                                    <div class="form-group">
                                        <label for="fabric_class">Fabric Class</label>
                                        <select id="fabric_class" class="form-control custom-select mt-15 @error('fabric_class') is-invalid @enderror" name="fabric_class">
                                            <option disabled selected>Select a fabric class</option>
                                            @foreach($fabricClasses as $class)
                                                <option value="{{ $class->id }}" @if($class->id == $product->fabric->class->id) selected @endif> {{ $class->name }} </option>                                            
                                            @endforeach
                                        </select>
                                        @error('fabric_class') <p class="error-p">{{$errors->first('fabric_class')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="fabric">Fabric</label>
                                        <select id="fabric" class="form-control custom-select mt-15 @error('fabric') is-invalid @enderror" name="fabric">
                                            <option disabled selected>Select a fabric</option>
                                        </select>
                                        @error('fabric') <p class="error-p">{{$errors->first('fabric')}}</p> @enderror
                                    </div>
                                    <div class="section-sub-title">Product Attributes</div>
                                    <div id="prd-attr-cover">
                                        <div class="admin-blank-section">
                                            Please select a product category to load the product attributes.
                                        </div>
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
                            <div class="tab-pane" id="pricePane">
                                <div class="box-header">
                                    <h3 class="box-title">PRICE & TAX</h3>
                                </div>
                                <div class="gb-body">
                                    <div class="section-sub-title">Price Details</div>
                                    <div class="form-group">
                                        <label for="price">Product Price</label>
                                        <div class="form-instruction">Enter your product price here.</div>
                                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" maxlength="255" value="{{ old('price', $product->price->price) }}">
                                        @error('price') <p class="error-p">{{$errors->first('price')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="splPrice">Product Special Price</label>
                                        <div class="form-instruction">If you want to provide a special offer price for the product, please enter it here.</div>
                                        <input type="number" name="splPrice" class="form-control @error('splPrice') is-invalid @enderror" id="splPrice" maxlength="255" value="{{ old('splPrice', $product->price->splPrice) }}">
                                        @error('splPrice') <p class="error-p">{{$errors->first('splPrice')}}</p> @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="startDate">Special Price - Begin Date</label>
                                                <input type="date" name="startDate" class="form-control @error('startDate') is-invalid @enderror" id="startDate" maxlength="255" value="{{ old('startDate', $product->price->startDate) }}">
                                                @error('startDate') <p class="error-p">{{$errors->first('startDate')}}</p> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="endDate">Special Price - End Date</label>
                                                <input type="date" name="endDate" class="form-control @error('endDate') is-invalid @enderror" id="endDate" maxlength="255" value="{{ old('endDate', $product->price->endDate) }}">
                                                @error('endDate') <p class="error-p">{{$errors->first('endDate')}}</p> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mfdPrice">Manufacturing Price</label>
                                        <div class="form-instruction">Manufacturer suggested price. This Won't be displayed.</div>
                                        <input type="number" name="mfdPrice" class="form-control @error('mfdPrice') is-invalid @enderror" id="mfdPrice" maxlength="255" value="{{ old('mfdPrice', $product->price->mfdPrice) }}">
                                        @error('mfdPrice') <p class="error-p">{{$errors->first('mfdPrice')}}</p> @enderror
                                    </div>
                                    <div class="section-sub-title">Tax Details</div>
                                    <div class="form-group">
                                        <label for="taxable">Taxable Product</label>
                                        <select id="taxable" class="form-control custom-select mt-15 @error('taxable') is-invalid @enderror" name="taxable">
                                            <option value="1" @if(!empty($product->tax_class_id)) selected @endif>Taxable</option>
                                            <option value="0" @if(empty($product->tax_class_id)) selected @endif>Non Taxable</option>
                                        </select>
                                        @error('taxable') <p class="error-p">{{$errors->first('taxable')}}</p> @enderror
                                    </div>  
                                    <div class="form-group">
                                        <label for="taxClass">Tax Class</label>
                                        <select id="taxClass" class="form-control custom-select mt-15 @error('taxClass') is-invalid @enderror" name="taxClass">
                                            <option disabled selected>Select a tax class</option>
                                            @foreach($taxClasses as $taxClass)
                                                <option value="{{ $taxClass->id }}" @if($taxClass->id == $product->tax_class_id) selected @endif> {{ $taxClass->name }} </option>                                            
                                            @endforeach
                                        </select>
                                        @error('taxClass') <p class="error-p">{{$errors->first('taxClass')}}</p> @enderror
                                    </div>
                                </div>

                                <div class="tile-footer">
                                    <div class="row d-print-none mt-2">
                                        <div class="col-md-6 text-left">
                                            <a class="btn btn-success" href="#" id="section3P"><i class="fa fa-fw fa-lg fa-arrow-circle-left"></i> &nbsp;Previous</a>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a class="btn btn-success" href="#" id="section3N"><i class="fa fa-fw fa-lg fa-arrow-circle-right"></i> &nbsp;Next</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="inventoryPane">
                                <div class="box-header">
                                    <h3 class="box-title">STOCK & INVENTORY</h3>
                                </div>
                                <div class="gb-body">
                                    <div class="form-group">
                                        <label for="stockManagable">Stock Managable</label>
                                        <select id="stockManagable" class="form-control custom-select mt-15 @error('stockManagable') is-invalid @enderror" name="stockManagable">
                                            <option value="1" @if($product->inventory->managable == 1) selected @endif>Stock Managable</option>
                                            <option value="0" @if($product->inventory->managable == 0) selected @endif>Non Stock Managable</option>
                                        </select>
                                        @error('stockManagable') <p class="error-p">{{$errors->first('stockManagable')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <div class="form-instruction">Available Quantity</div>
                                        <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" id="quantity" maxlength="255" value="{{ old('quantity', $product->inventory->quantity) }}">
                                        @error('quantity') <p class="error-p">{{$errors->first('quantity')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="thresholdQuantity">Out Of Stock Threshold</label>
                                        <div class="form-instruction">Stock quantity at which the item is to de displayed as out of stock.</div>
                                        <input type="number" name="thresholdQuantity" class="form-control @error('thresholdQuantity') is-invalid @enderror" id="thresholdQuantity" maxlength="255" value="{{ old('thresholdQuantity', $product->inventory->threshold) }}">
                                        @error('thresholdQuantity') <p class="error-p">{{$errors->first('thresholdQuantity')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="notifyQuantity">Quantity Notification</label>
                                        <div class="form-instruction">Stock quantity at which the admin is to be notified of the low stock.</div>
                                        <input type="number" name="notifyQuantity" class="form-control @error('notifyQuantity') is-invalid @enderror" id="notifyQuantity" maxlength="255" value="{{ old('notifyQuantity', $product->inventory->notification_quantity) }}">
                                        @error('notifyQuantity') <p class="error-p">{{$errors->first('notifyQuantity')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="stockStatus">Stock Status</label>
                                        <select id="stockStatus" class="form-control custom-select mt-15 @error('stockStatus') is-invalid @enderror" name="stockStatus">
                                            <option value="1" @if($product->inventory->status == 1) selected @endif>In Stock</option>
                                            <option value="0" @if($product->inventory->status == 0) selected @endif>Out Of Stock</option>
                                        </select>
                                        @error('stockStatus') <p class="error-p">{{$errors->first('stockStatus')}}</p> @enderror
                                    </div>
                                </div>
                                <div class="tile-footer">
                                    <div class="row d-print-none mt-2">
                                        <div class="col-md-6 text-left">
                                            <a class="btn btn-success" href="#" id="section4P"><i class="fa fa-fw fa-lg fa-arrow-circle-left"></i> &nbsp;Previous</a>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a class="btn btn-success" href="#" id="section4N"><i class="fa fa-fw fa-lg fa-arrow-circle-right"></i> &nbsp;Next</a>
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
                                        <label for="video">Product Videos</label>

                                        <div id="dynamic-video-cover">
                                            @if($product->videos) @foreach($product->videos as $video)
                                            <div class="row dynamic-added-video">
                                                <div class="col-md-10">
                                                <textarea name="video[]" class="form-control" rows="1">{{$video->name}}</textarea>
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="/admin/product/video/delete/{{$video->id}}" class="btn btn-danger remove_video">X</a>
                                                </div>
                                            </div>
                                            @endforeach @endif
                                            <div class="row first-video">
                                                <div class="col-md-10">
                                                    <textarea name="video[]" id="video" class="form-control @error('video') is-invalid @enderror" rows="1"></textarea>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" name="add_video" id="add_video" class="btn btn-success">Add More</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="section-sub-title">File Uploads</div>
                                    <div class="form-group">
                                        <label for="document">Product Document</label>
                                        <div class="form-instruction">If any product document needs to be attached plese link here.</div>
                                        <input type="file" name="document" class="form-control  @error('document') is-invalid @enderror" id="document">
                                        @error('document') <p class="error-p">{{$errors->first('document')}}</p> @enderror
                                        @if($product->documents)
                                        <div class="uds-cover">
                                            @foreach($product->documents as $document)
                                            <div class="row uds-item">
                                                <div class="col-md-10">
                                                    <a href="/images/product/files/{{$document->name}}" target="_blank"><i class="fa fa-file-pdf-o cm-pdf-icon" aria-hidden="true"></i> {{$document->name}}</a>
                                                </div>
                                                <div class="col-md-2 uds-item-button">
                                                    <a href="/admin/product/document/delete/{{$document->id}}" class="btn btn-danger remove_video">X</a>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                    <div class="section-sub-title">Image Uploads</div>
                                    <div class="form-group">
                                        <label for="p_image">Product Primary Image - <span>(Image size should be less than 2 MB)</span></label>
                                        <input type="file" name="p_image" class="form-control  @error('p_image') is-invalid @enderror" id="p_image">
                                        @error('p_image') <p class="error-p">{{$errors->first('p_image')}}</p> @enderror
                                        <div id="p_image_preview" class="row">@foreach($product->images as $image) @if($image->position_id == 1)<div class='col-md-4 upload-multi-img'><img src="/images/product/product/{{$image->name}}" alt="{{$image->name}}"></div>@endif @endforeach</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="s_image">Product Secondary Image - <span>(Image size should be less than 2 MB)</span></label>
                                        <input type="file" name="s_image" class="form-control  @error('s_image') is-invalid @enderror" id="s_image">
                                        @error('s_image') <p class="error-p">{{$errors->first('s_image')}}</p> @enderror
                                        <div id="s_image_preview" class="row">@foreach($product->images as $image) @if($image->position_id == 2)<div class='col-md-4 upload-multi-img'><img src="/images/product/product/{{$image->name}}" alt="{{$image->name}}"></div>@endif @endforeach</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="album">Product Album Images - <span>(Image size should be less than 2 MB)</span></label>
                                        <div class="form-instruction">If you want to associate more images to the post please add them here. Preferred Image size is - </div>
                                        <input type="file" name="album[]" class="form-control  @error('album') is-invalid @enderror" id="album" multiple>
                                        @error('album') <p class="error-p">{{$errors->first('album')}}</p> @enderror
                                        <div id="images_preview" class="row">
                                            @foreach($product->images as $image) @if($image->position_id == 3)
                                                <div class='col-md-4 upload-multi-img'>
                                                    <img src="/images/product/product/{{$image->name}}" alt="{{$image->name}}">
                                                    <a href="/admin/product/image/delete/{{$image->id}}" class="btn btn-md btn-danger btn-listing ">Delete Image</a>
                                                </div>
                                            @endif @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="tile-footer">
                                    <div class="row d-print-none mt-2">
                                        <div class="col-md-6 text-left">
                                            <a class="btn btn-success" href="#" id="section5P"><i class="fa fa-fw fa-lg fa-arrow-circle-left"></i> &nbsp;Previous</a>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a class="btn btn-success" href="#" id="section5N"><i class="fa fa-fw fa-lg fa-arrow-circle-right"></i> &nbsp;Next</a>
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
                                        <label for="pageTitle">Product Page Title</label>
                                        <input type="text" name="pageTitle" class="form-control @error('pageTitle') is-invalid @enderror" id="pageTitle" maxlength="255" value="{{ old('pageTitle', $product->pageTitle) }}">
                                        @error('pageTitle') <p class="error-p">{{$errors->first('pageTitle')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="metatag">Meta Tags</label>
                                        <textarea name="metatag" id="metatag" class="form-control @error('metatag') is-invalid @enderror" rows="5">{{ old('metatag', $product->metatag) }}</textarea>
                                        @error('metatag') <p class="error-p">{{$errors->first('metatag')}}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="metadescp">Meta Description</label>
                                        <textarea name="metadescp" id="metadescp" class="form-control @error('metadescp') is-invalid @enderror" rows="5">{{ old('metadescp', $product->metadescp) }}</textarea>
                                        @error('metadescp') <p class="error-p">{{$errors->first('metadescp')}}</p> @enderror
                                    </div>
                                </div>
                                <div class="tile-footer">
                                    <div class="row d-print-none mt-2">
                                        <div class="col-md-6 text-left">
                                            <a class="btn btn-success" href="#" id="section6P"><i class="fa fa-fw fa-lg fa-arrow-circle-left"></i> &nbsp;Previous</a>
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
        var product_id  = {!! json_encode($product->id) !!};
        var fabric_id  = {!! json_encode($product->fabric->id) !!};
    </script>
    <script src="/cmadmin/code/js/productCRUD-1.js"></script>
@endsection