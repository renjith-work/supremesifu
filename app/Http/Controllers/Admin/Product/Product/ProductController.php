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
use App\Models\Product\Fabric\Fabric;
use App\Models\Product\Monogram;
use App\Models\Product\ProductMonogram;
use App\Models\Product\ProductDesign;
use App\Models\MeasurementAttribute;
use App\Models\UserMeasurementProfile;
use App\Models\UMProfileValue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


        // $validator = Validator::make(
        //     $request->all(),
        //     [
        //         'name' => 'required|min:5|max:255|unique:products,name',
        //         'sku' => 'min:2|max:255|unique:products,sku',
        //         'category' => 'required',
        //         'attributeSet' => 'required',
        //         'weight' => 'required',
        //         'weightUnit' => 'required',
        //         'brand' => 'required',
        //         'country' => 'required',
        //         'description' => 'required',
        //         'summary' => 'required',
        //         'fabric_class' => 'required',
        //         'fabric' => 'required',
        //         'price' => 'required',
        //         'startDate' => 'required_with:splPrice',
        //         'endDate' => 'required_with:splPrice',
        //         'taxClass'=> 'required_if:taxable,==,1',
        //         'stockManagable' => 'required',
        //         'quantity'=> 'required_if:stockManagable,==,1',
        //         'thresholdQuantity'=> 'required_if:stockManagable,==,1',
        //         'notifyQuantity'=> 'required_if:stockManagable,==,1',
        //         'stockStatus'=> 'required_if:stockManagable,==,1',
        //         'album*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2000',
        //         'pageTitle' => 'required',
        //         'metatag' => 'required',
        //         'metadescp' => 'required',
        //     ],
        //     [
        //         'category.required' => 'Please select a category.',
        //         'taxClass.required_if' => 'Please select a tax class if the product is taxable.',
        //     ]
        // );
        // if ($validator->passes()) {

        // $product = new Product;
        // $product->name = $request->name;
        // $product->user_id = 1;
        // $product->slug = Str::slug($request->name, '-');
        // $product->sku = $request->sku;
        // $product->product_attribute_set_id = $request->attributeSet;
        // $product->brand_id = $request->brand;
        // $product->country_id = $request->country;
        // $product->description = $request->description;
        // $product->fabric_id = $request->fabric;
        // $product->summary = $request->summary;
        // $product->sellable = $request->sellable;
        // $product->inquirable = $request->inquirable;
        // $product->featured = $request->featured;
        // $product->menu = $request->menu;
        // $product->tax_class_id = $request->taxClass;
        // // $product->inventory_id = $request->taxClass;
        // $product->pageTitle = $request->pageTitle;
        // $product->metatag = $request->metatag;
        // $product->metadescp = $request->metadescp;
        // $product->status = $request->status;


        // $product->save();
        // return response()->json($product);

        // $product->categories()->sync($request->category, false);
        //     return redirect()->back();
        // } else {
        //     return redirect()->back()->withInput()->withErrors($validator);
        // }

        return response()->json($request->all());
        $product = Product::find(1);
        // $this->priceSave($request, $product->id);
        // $this->inventorySave($request, $product->id);
        // $this->weightSave($request, $product->id);
        $this->attributeSave($request, $product->id);
        return response()->json($product->attributes);
    }
                        
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find(1);
        $data = array();
        foreach($product->attributes as $attribute)
        {
            $data = array([
                    'attribute' => $attribute->productAttribute->name,
                    'value' => $attribute->value->value,
            ]);
        }
        return response()->json($product->attributes);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    private function inventorySave($input, $product_id)
    {
        $inventory = new Inventory;
        $inventory->product_id = $product_id;
        $inventory->managable = $input->stockManagable;
        $inventory->quantity = $input->quantity;
        $inventory->threshold = $input->thresholdQuantity;
        $inventory->notification_quantity = $input->notifyQuantity;
        $inventory->status = $input->status;
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
}
