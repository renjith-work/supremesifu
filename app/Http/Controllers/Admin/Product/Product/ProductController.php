<?php

namespace App\Http\Controllers\Admin\Product\Product;

use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductAttributeSet;
use App\Models\Product\Brand;
use App\Models\Settings\Country;
use App\Models\Product\Fabric\FabricClass;
use App\Models\Product\Tax\TaxClass;
use App\Models\Product\Inventory\InventoryUnit;
use App\Models\Product\Inventory\Inventory;
use App\Models\Product\ProductPrice;
use App\Models\Product\Weight\ProductWeight;
use App\Models\Product\ProductAttribute;
use App\Models\Product\ProductAttributeValueSave;
use App\Models\Product\File\ProductVideo;
use App\Models\Product\Image\ProductImage;
use App\Models\Product\Fabric\Fabric;
use App\Models\Product\Monogram;
use App\Models\Product\ProductMonogram;
use App\Models\Product\ProductDesign;
use App\Models\MeasurementAttribute;
use App\Models\UserMeasurementProfile;
use App\Models\UMProfileValue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product\File\ProductDocument;
use Illuminate\Support\Str;
use Auth;
use Validator;
use Session;
use Image;
use Storage;
use Purifier;
use File;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'product']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'asc')->paginate(15);
         return view('admin.product.product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::orderBy('id', 'asc')->get();
        $brands = Brand::orderBy('id', 'asc')->get();
        $attributeSets = ProductAttributeSet::orderBy('id', 'asc')->get();
        $countries = Country::orderBy('id', 'asc')->get();
        $fabricClasses = FabricClass::orderBy('id', 'asc')->get();
        $taxClasses = TaxClass::orderBy('id', 'asc')->get();
        $weightUnits = InventoryUnit::where('type_id', 2)->get();
        return view('admin.product.product.create')->with('categories', $categories)->with('brands', $brands)->with('attributeSets', $attributeSets)->with('countries', $countries)->with('fabricClasses', $fabricClasses)->with('taxClasses', $taxClasses)->with('weightUnits', $weightUnits);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validator = Validator::make( $request->all(),
            [
                'name' => 'required|min:5|max:255|unique:products,name',
                'sku' => 'min:2|max:255|unique:products,sku',
                'category' => 'required',
                'attributeSet' => 'required',
                'weight' => 'required',
                'weightUnit' => 'required',
                'brand' => 'required',
                'country' => 'required',
                'description' => 'required',
                'summary' => 'required',
                'fabric_class' => 'required',
                'fabric' => 'required',
                'price' => 'required',
                'startDate' => 'required_with:splPrice',
                'endDate' => 'required_with:splPrice',
                'taxClass'=> 'required_if:taxable,==,1',
                'stockManagable' => 'required',
                'quantity'=> 'required_if:stockManagable,==,1',
                'thresholdQuantity'=> 'required_if:stockManagable,==,1',
                'notifyQuantity'=> 'required_if:stockManagable,==,1',
                'stockStatus'=> 'required_if:stockManagable,==,1',
                'document' => 'mimes:pdf|max:10000',
                'p_image' =>   'required|image|mimes:jpeg,png,jpg,gif,svg|max:2000',
                's_image' =>   'required|image|mimes:jpeg,png,jpg,gif,svg|max:2000',
                'album*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
                'pageTitle' => 'required',
                'metatag' => 'required',
                'metadescp' => 'required',
            ],
            [
                'category.required' => 'Please select a category.',
                'taxClass.required_if' => 'Please select a tax class if the product is taxable.',
                'p_image.max' => 'Max image upload size is 2 MB.',
                's_image.max' => 'Max image upload size is 2 MB.',
                'album.max' => 'Max image upload size is 2 MB.',
            ]
        );
        

        if ($validator->passes()) {

            $product = new Product;
            $product->name = $request->name;
            $product->user_id = 1;
            $product->slug = Str::slug($request->name, '-');
            $product->sku = $request->sku;
            $product->product_attribute_set_id = $request->attributeSet;
            $product->brand_id = $request->brand;
            $product->country_id = $request->country;
            $product->description = $request->description;
            $product->fabric_id = $request->fabric;
            $product->summary = $request->summary;
            $product->sellable = $request->sellable;
            $product->inquirable = $request->inquirable;
            $product->featured = $request->featured;
            $product->menu = $request->menu;
            $product->tax_class_id = $request->taxClass;
            $product->pageTitle = $request->pageTitle;
            $product->metatag = $request->metatag;
            $product->metadescp = $request->metadescp;
            $product->status = $request->status;


            $product->save();
       
            $product->categories()->sync($request->category, false);

            $this->attributeSave($request, $product->id);
            $this->priceSave($request, $product->id);
            $this->inventorySave($request, $product->id);
            $this->weightSave($request, $product->id);
            $this->videoSave($request, $product->id);
            $this->imageSave($request, $product->id);
            $this->documentSave($request, $product->id);
            return redirect()->back();

        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }
                        
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product->price);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = ProductCategory::orderBy('id', 'asc')->get();
        $brands = Brand::orderBy('id', 'asc')->get();
        $attributeSets = ProductAttributeSet::orderBy('id', 'asc')->get();
        $countries = Country::orderBy('id', 'asc')->get();
        $fabricClasses = FabricClass::orderBy('id', 'asc')->get();
        $taxClasses = TaxClass::orderBy('id', 'asc')->get();
        $weightUnits = InventoryUnit::where('type_id', 2)->get();
        $product = Product::find($id);

        $sel_categories = array();
        foreach ($product->categories as $category) {
            $sel_categories[] = $category->id;
        }

        return view('admin.product.product.edit')->with('categories', $categories)->with('brands', $brands)->with('attributeSets', $attributeSets)->with('countries', $countries)->with('fabricClasses', $fabricClasses)->with('taxClasses', $taxClasses)->with('weightUnits', $weightUnits)->with('product', $product)->with('sel_categories', $sel_categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => "required|min:5|max:255|unique:products,name, $id",
                'sku' => "min:2|max:255|unique:products,sku, $id",
                'category' => 'required',
                'attributeSet' => 'required',
                'weight' => 'required',
                'weightUnit' => 'required',
                'brand' => 'required',
                'country' => 'required',
                'description' => 'required',
                'summary' => 'required',
                'fabric_class' => 'required',
                'fabric' => 'required',
                'price' => 'required',
                'startDate' => 'required_with:splPrice',
                'endDate' => 'required_with:splPrice',
                'taxClass' => 'required_if:taxable,==,1',
                'stockManagable' => 'required',
                'quantity' => 'required_if:stockManagable,==,1',
                'thresholdQuantity' => 'required_if:stockManagable,==,1',
                'notifyQuantity' => 'required_if:stockManagable,==,1',
                'stockStatus' => 'required_if:stockManagable,==,1',
                'document' => 'mimes:pdf|max:10000',
                'p_image' =>   'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
                's_image' =>   'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
                'album*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
                'pageTitle' => 'required',
                'metatag' => 'required',
                'metadescp' => 'required',
            ],
            [
                'category.required' => 'Please select a category.',
                'taxClass.required_if' => 'Please select a tax class if the product is taxable.',
                'p_image.max' => 'Max image upload size is 2 MB.',
                's_image.max' => 'Max image upload size is 2 MB.',
                'album.max' => 'Max image upload size is 2 MB.',
            ]
        );

        if ($validator->passes()) {

            $product = Product::find($id);
            $product->name = $request->name;
            $product->user_id = 1;
            $product->slug = Str::slug($request->name, '-');
            $product->sku = $request->sku;
            $product->product_attribute_set_id = $request->attributeSet;
            $product->brand_id = $request->brand;
            $product->country_id = $request->country;
            $product->description = $request->description;
            $product->fabric_id = $request->fabric;
            $product->summary = $request->summary;
            $product->sellable = $request->sellable;
            $product->inquirable = $request->inquirable;
            $product->featured = $request->featured;
            $product->menu = $request->menu;
            $product->tax_class_id = $request->taxClass;
            $product->pageTitle = $request->pageTitle;
            $product->metatag = $request->metatag;
            $product->metadescp = $request->metadescp;
            $product->status = $request->status;
            $product->save();

            if (isset($request->category)) {
                $product->categories()->sync($request->category);
            } else {
                $product->categories()->sync(array());
            }

            $this->attributeSaveEdit($request, $product->id);

            $this->priceSaveEdit($request, $product->id, $product->price->id);
            $this->inventorySaveEdit($request, $product->id, $product->inventory->id);
            $this->weightSaveEdit($request, $product->id, $product->weight->id);
            $this->videoSaveEdit($request, $product->id);
            $this->imageSaveEdit($request, $product->id);
            $this->documentSave($request, $product->id);

            Session::flash('success', 'The data was successfully updated.');
            return redirect()->back();
        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->categories()->detach();
        ProductPrice::where('product_id', $product->id)->delete();
        Inventory::where('product_id', $product->id)->delete();
        ProductWeight::where('product_id', $product->id)->delete();
        ProductVideo::where('product_id', $product->id)->delete();

        $images = ProductImage::where('product_id', $product->id)->get();
        foreach ($images as $image) {
            Storage::delete('product/product/' . $image->name);
            $image->delete();
        }

        $documents = ProductDocument::where('product_id', $product->id)->get();
        foreach ($documents as $document) {
            Storage::delete('product/files/' . $document->name);
            $document->delete();
        }

        ProductAttributeValueSave::where('product_id', $product->id)->delete();
        $product->delete();

        Session::flash('success', 'The data was successfully deleted.');
        return redirect()->back();
    }

    public function imageDel($id)
    {
        $image = ProductImage::find($id);
        Storage::delete('product/product/' . $image->name);
        $image->delete();
        return redirect(url()->previous() . "#uploaded_images");
    }

    public function videoDel($id)
    {
        $video = ProductVideo::find($id);
        $video->delete();
        return redirect(url()->previous() . "#uploaded_images");
    }

    public function documentDel($id)
    {
        $document = ProductDocument::find($id);
        Storage::delete('product/files/' . $document->name);
        $document->delete();
        return redirect(url()->previous() . "#uploaded_images");
    }

    private function priceSave($input, $product_id)
    {
        $productPrice = new ProductPrice;
        $productPrice->product_id = $product_id;
        $productPrice->price = $input->price;
        $productPrice->splPrice = $input->splPrice;
        $productPrice->startDate = $input->startDate;
        $productPrice->endDate = $input->endDate;
        $productPrice->mfdPrice = $input->mfdPrice;
        $productPrice->save();
        return $productPrice;
    }

    private function priceSaveEdit($input, $product_id, $id)
    {
        $productPrice = ProductPrice::find($id);
        $productPrice->product_id = $product_id;
        $productPrice->price = $input->price;
        $productPrice->splPrice = $input->splPrice;
        $productPrice->startDate = $input->startDate;
        $productPrice->endDate = $input->endDate;
        $productPrice->mfdPrice = $input->mfdPrice;
        $productPrice->save();
        return $productPrice;
    }

    private function inventorySave($input, $product_id)
    {
        $inventory = new Inventory;
        $inventory->product_id = $product_id;
        $inventory->managable = $input->stockManagable;
        $inventory->quantity = $input->quantity;
        $inventory->threshold = $input->thresholdQuantity;
        $inventory->notification_quantity = $input->notifyQuantity;
        $inventory->status = $input->stockStatus;
        $inventory->save();
        return $inventory;
    }

    private function inventorySaveEdit($input, $product_id, $id)
    {
        $inventory = Inventory::find($id);
        $inventory->product_id = $product_id;
        $inventory->managable = $input->stockManagable;
        $inventory->quantity = $input->quantity;
        $inventory->threshold = $input->thresholdQuantity;
        $inventory->notification_quantity = $input->notifyQuantity;
        $inventory->status = $input->stockStatus;
        $inventory->save();
        return $inventory;
    }

    private function weightSave($input, $product_id)
    {
        $weight = new ProductWeight;
        $weight->product_id = $product_id;
        $weight->inventory_unit_id = $input->weightUnit;
        $weight->weight = $input->weight;
        $weight->save();
        return $weight;
    }

    private function weightSaveEdit($input, $product_id, $id)
    {
        $weight = ProductWeight::find($id);
        $weight->product_id = $product_id;
        $weight->inventory_unit_id = $input->weightUnit;
        $weight->weight = $input->weight;
        $weight->save();
        return $weight;
    }

    private function attributeSave($input, $product_id)
    {
        $productAttribute_array = array();
        $data = $input->all();
        $attributes = ProductAttribute::where('product_attribute_set_id', $data['attributeSet'])->get();
        foreach ($attributes as $attribute) {
            if (array_key_exists($attribute->code, $data)) {
                $productAttribute_array[] = array(

                    'product_id' => $product_id,
                    'product_attribute_id' => $attribute->id,
                    'product_attribute_value_id' => $data[$attribute->code],
                );
            }
        }
        ProductAttributeValueSave::insert($productAttribute_array);
    }

    // Product Attributes Save while editing
    private function attributeSaveEdit($input, $product_id){
        
        $productAttribute_array = array();
        $data = $input->all();
        $attributes = ProductAttribute::where('product_attribute_set_id', $data['attributeSet'])->get();
        foreach ($attributes as $attribute) {
            if (array_key_exists($attribute->code, $data)) {
                $productAttribute_array[] = array(

                    'product_id' => $product_id,
                    'product_attribute_id' => $attribute->id,
                    'product_attribute_value_id' => $data[$attribute->code],
                );
            }
        }
        ProductAttributeValueSave::where('product_id', $product_id)->delete();
        ProductAttributeValueSave::insert($productAttribute_array);
    }

    private function videoSave($input, $product_id)
    {
        foreach ($input->video as $key => $video) {
            if (!empty($video)) {
                ProductVideo::create([
                    'product_id' => $product_id,
                    'name' => $video,
                ]);
            }
        }
    }

    private function videoSaveEdit($input, $product_id)
    {
        ProductVideo::where('product_id', $product_id)->delete();
        foreach ($input->video as $key => $video) {
            if (!empty($video)){
                ProductVideo::create([
                    'product_id' => $product_id,
                    'name' => $video,
                ]);
            }
        }
    }


    

    private function documentSave($request, $product_id)
    {
        if ($request->hasFile('document')) //Check if the file exists
        {
            $file = $request->file('document'); //Grab and store the file on to $image
            $filename = Str::slug(pathinfo($request->document->getClientOriginalName(), PATHINFO_FILENAME), '-') . '-' . time() . '.' . $file->getClientOriginalExtension(); //Create a new filename
            $file->move(public_path('images/product/files/'),$filename);

            $document = new ProductDocument;
            $document->product_id = $product_id;
            $document->name = $filename;
            $document->save();
        }
    }

    private function imageSave($request, $product_id)
    {
        if ($request->hasFile('p_image')) //Check if the file exists
        {
            $image = $request->file('p_image'); //Grab and store the file on to $image
            $filename = Str::slug($request->name, '-') . '-' . Str::slug(pathinfo($request->p_image->getClientOriginalName(), PATHINFO_FILENAME), '-') . '-' . time() . '.' . $image->getClientOriginalExtension(); //Create a new filename
            $location = public_path('images/product/product/' . $filename);
            Image::make($image)->resize(800, 800)->save($location); //Use intervention to create an image model and store the file with the resize.
            
            ProductImage::create([
                'product_id' => $product_id,
                'position_id' => 1,
                'name' => $filename,
            ]);
        }

        if ($request->hasFile('s_image')) //Check if the file exists
        {
            $image = $request->file('s_image'); //Grab and store the file on to $image
            $filename = Str::slug($request->name, '-') . '-' . Str::slug(pathinfo($request->s_image->getClientOriginalName(), PATHINFO_FILENAME), '-') . '-' . time() . '.' . $image->getClientOriginalExtension(); //Create a new filename
            $location = public_path('images/product/product/' . $filename);
            Image::make($image)->resize(800, 800)->save($location); //Use intervention to create an image model and store the file with the resize.

            ProductImage::create([
                'product_id' => $product_id,
                'position_id' => 2,
                'name' => $filename,
            ]);
        }

        if ($request->hasFile('album')) //Check if the file exists
        {
            $count = 1;
            foreach ($request->only('album') as $files) {
                foreach ($files as $file) {
                    if (is_file($file)) {    // not sure this is needed
                        $filename = Str::slug($request->name, '-') . '-' . $count . '-' . time() . '.' . $file->getClientOriginalExtension();
                        $location = public_path('images/product/product/' . $filename);
                        Image::make($file)->resize(800, 800)->save($location); // path to file
                        ProductImage::create([
                            'product_id' => $product_id,
                            'position_id' => 3,
                            'name' => $filename,
                        ]);
                        $count++;
                    }
                }
            }
        }
    }

    private function imageSaveEdit($request, $product_id)
    {
        if ($request->hasFile('p_image')) //Check if the file exists
        {
            $image = $request->file('p_image'); //Grab and store the file on to $image
            $filename = Str::slug($request->name, '-') . '-' . Str::slug(pathinfo($request->p_image->getClientOriginalName(), PATHINFO_FILENAME), '-') . '-' . time() . '.' . $image->getClientOriginalExtension(); //Create a new filename
            $location = public_path('images/product/product/' . $filename);
            Image::make($image)->resize(800, 800)->save($location); //Use intervention to create an image model and store the file with the resize.

            $oldImages1 = ProductImage::where('product_id', $product_id)->get();
            foreach($oldImages1 as $oldImage1){
                if($oldImage1->position_id == 1){
                    Storage::delete('product/product/' . $oldImage1->name);
                    $oldImage1->delete();
                }
            } 
            
            ProductImage::create([
                'product_id' => $product_id,
                'position_id' => 1,
                'name' => $filename,
            ]);
        }

        if ($request->hasFile('s_image')) //Check if the file exists
        {
            $image = $request->file('s_image'); //Grab and store the file on to $image
            $filename = Str::slug($request->name, '-') . '-' . Str::slug(pathinfo($request->s_image->getClientOriginalName(), PATHINFO_FILENAME), '-') . '-' . time() . '.' . $image->getClientOriginalExtension(); //Create a new filename
            $location = public_path('images/product/product/' . $filename);
            Image::make($image)->resize(800, 800)->save($location); //Use intervention to create an image model and store the file with the resize.

            $oldImages2 = ProductImage::where('product_id', $product_id)->get();
            foreach ($oldImages2 as $oldImage2) {
                if ($oldImage2->position_id == 2) {
                    Storage::delete('product/product/' . $oldImage2->name);
                    $oldImage2->delete();
                }
            } 

            ProductImage::create([
                'product_id' => $product_id,
                'position_id' => 2,
                'name' => $filename,
            ]);
        }

        if ($request->hasFile('album')) //Check if the file exists
        {
            $count = 1;
            foreach ($request->only('album') as $files) {
                foreach ($files as $file) {
                    if (is_file($file)) {    // not sure this is needed
                        $filename = Str::slug($request->name, '-') . '-' . $count . '-' . time() . '.' . $file->getClientOriginalExtension();
                        $location = public_path('images/product/product/' . $filename);
                        Image::make($file)->resize(800, 800)->save($location); // path to file
                        ProductImage::create([
                            'product_id' => $product_id,
                            'position_id' => 3,
                            'name' => $filename,
                        ]);
                        $count++;
                    }
                }
            }
        }
    }
}
