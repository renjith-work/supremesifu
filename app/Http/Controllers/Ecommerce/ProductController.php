<?php

namespace App\Http\Controllers\Ecommerce;

use App\Models\Product\Product;
use App\Models\Product\Fabric\Fabric;
use App\Models\Product\Monogram;
use App\Models\Product\ProductMonogram;
use App\Models\Product\ProductAttribute;
use App\Models\Measurement\MeasurementAttribute;
use App\Models\Measurement\UserMeasurementProfile;
use App\Models\Measurement\UserMeasurementProfileValue;
use App\Models\Product\ProductDesign;
use App\Models\Product\ProductAttributeValueSave;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use Auth;
use Cart;

class ProductController extends Controller
{
    
    public function createShirt(Request $request){

        if($user = Auth::user())
        {
            $user_id = Auth::user()->id;
            $session_id = $session_id = Session::getId();
            $input = $request->all();

            $monogram_array = [];
            $monograms = Monogram::where('product_category_id', 3)->get();
            foreach($monograms as $monogram){
                if (array_key_exists($monogram->code, $input)) {
                    if (isset($input[$monogram->code])) {
                        $monogram_array[] = array(
                                            'monogram_id' => $monogram->id,
                                            'value' => $input[$monogram->code],
                        );
                    } 
                }
            }

            $inp_mp = UserMeasurementProfile::find($input['measurement_profile']);
            $inp_mp_id = $inp_mp->id;
            $ms_profile =  $this->loadMeasurements($inp_mp_id, $input);

            $pdesign = ProductDesign::find($request->product_design);

            $product = new Product;
            $product->user_id = $user_id;
            $product->session_id = $session_id;
            $product->product_design_id = $request->product_design;
            $product->product_category_id = 3;
            $product->fabric_id = $request->fabric_material;
            $product->u_mp_id = $ms_profile;
            $product->name = $pdesign->name;
            $product->price = $pdesign->price;
            $product->description = $pdesign->description;
            $product->summary = $pdesign->summary;
            $product->p_image = $pdesign->p_image;
            $product->s_image = $pdesign->s_image;
            $product->album = $pdesign->album;
            $product->folder = $pdesign->folder;
            $product->save();
            $product->monogram()->sync($monogram_array, false);

            $attribute_array = [];
            $attributes = ProductAttribute::where('product_category_id', 3)->get();
            foreach($attributes as $attribute){
                if (array_key_exists($attribute->code, $input)) {
                    if (isset($input[$attribute->code])) {
                        $attribute_array[] = array(
                                            'product_id' => $product->id,
                                            'product_attribute_id' => $attribute->id,
                                            'product_attribute_value_id' => $input[$attribute->code],
                        );
                    } 
                }
            }

            ProductAttributeValueSave::insert($attribute_array);
            return redirect("/design/confirm/$product->id");
        }else{
            session(['url.intended' => '/design/shirt']);
            return redirect('/login');
        }
    }


    public function loadMeasurements($inp_mp_id, $input){
        $inp_mp_values = UMProfileValue::where('u_mp_id', $inp_mp_id)->get();
        $code_array = array();
        foreach ($inp_mp_values as $value) {
            if($value->value !=  $input[$value->measurementAttribute->code])
            $code_array[] = array(
                            'code' => $value->measurementAttribute->code,
            );
        }
        if(empty($code_array)){
            return $inp_mp_id;
        }else{
            $um_p = new UserMeasurementProfile;
            $um_p->user_id = Auth::user()->id;;
            $um_p->product_category_id = 3;
            $um_p->save();

            $ma_array =[];
            $m_attributes = MeasurementAttribute::where('product_category_id', 3)->get();
            foreach($m_attributes as $m_attribute){
                if (array_key_exists($m_attribute->code, $input)) {
                    if (isset($input[$m_attribute->code])) {
                        $ma_array[] = array(
                                            'u_mp_id'       => $um_p->id,
                                            'm_at_id' => $m_attribute->id,
                                            'value' => $input[$m_attribute->code],
                        );
                    } 
                }
            }

            UMProfileValue::insert($ma_array);
            return $um_p->id;
        }
    }

    public function updateProduct(Request $request){
        $input = $request->data;
        $product = Product::find($request->id);

        $monogram_array = [];
        $monograms = Monogram::where('product_category_id', 3)->get();
        foreach($monograms as $monogram){
            if (array_key_exists($monogram->code, $input)) {
                if (isset($input[$monogram->code])) {
                    $monogram_array[] = array(
                                        'monogram_id' => $monogram->id,
                                        'value' => $input[$monogram->code],
                    );
                } 
            }
        }
        $product->monogram()->detach();
        $product->monogram()->sync($monogram_array, false);

        $attribute_array = [];
        $attributes = ProductAttribute::where('product_category_id', 3)->get();
        foreach($attributes as $attribute){
            if (array_key_exists($attribute->code, $input)) {
                if (isset($input[$attribute->code])) {
                    $attribute_array[] = array(
                                        'product_id' => $product->id,
                                        'product_attribute_id' => $attribute->id,
                                        'product_attribute_value_id' => $input[$attribute->code],
                    );
                } 
            }
        }
        
        // Product Attributes are saved.
        ProductAttributeValueSave::where('product_id', $product->id)->delete(); //Remove current product attributes.
        ProductAttributeValueSave::insert($attribute_array); //Attach the current attributes values on to the product,

        Cart::add(array(
                    'id' => $product->id,
                    'name' => $product->name, 
                    'quantity' => $input['quantity'], 
                    'price' => $input['price'],
                    'attributes' => array(
                                    'folder' => $product->folder,
                                    'image' => $product->p_image
                                    )
                ));


        return response()->json($input['quantity']);
    }

    public function cartAdd(Request $request){
        $input = $request->data;
        $product = Product::find($request->id);

        $monogram_array = [];
        $monograms = Monogram::where('product_category_id', 3)->get();
        foreach($monograms as $monogram){
            if (array_key_exists($monogram->code, $input)) {
                if (isset($input[$monogram->code])) {
                    $monogram_array[] = array(
                                        'monogram_id' => $monogram->id,
                                        'value' => $input[$monogram->code],
                    );
                } 
            }
        }
        $product->monogram()->detach();
        $product->monogram()->sync($monogram_array, false);

        $attribute_array = [];
        $attributes = ProductAttribute::where('product_category_id', 3)->get();
        foreach($attributes as $attribute){
            if (array_key_exists($attribute->code, $input)) {
                if (isset($input[$attribute->code])) {
                    $attribute_array[] = array(
                                        'product_id' => $product->id,
                                        'product_attribute_id' => $attribute->id,
                                        'product_attribute_value_id' => $input[$attribute->code],
                    );
                } 
            }
        }
        
        // Product Attributes are saved.
        ProductAttributeValueSave::where('product_id', $product->id)->delete(); //Remove current product attributes.
        ProductAttributeValueSave::insert($attribute_array); //Attach the current attributes values on to the product,

        Cart::add(array(
                    'id' => $product->id,
                    'name' => $product->name, 
                    'quantity' => $input['quantity'], 
                    'price' => $input['price'],
                    'attributes' => array(
                                    'folder' => $product->folder,
                                    'image' => $product->p_image
                                    )
                ));


        return response()->json($product->name);
        // return response()->json($input['quantity']);
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);
        $options = $request->except('_token', 'productId', 'price', 'qty');

        Cart::add(uniqid(), $product->name, $request->input('price'), $request->input('qty'), $options);

        return redirect()->back()->with('message', 'Item added to cart successfully.');
    }

    public function resetCart(){
        
    }

    public function cartAddNewShirt(Request $request)
    {       
            if(Auth::check()){
                $user_id = Auth::user()->id;
            }else{
                $user_id = null;
            }
            $session_id = $session_id = Session::getId();
            $input = $request->data;

            $monogram_array = [];
            $monograms = Monogram::where('product_category_id', 3)->get();
            foreach($monograms as $monogram){
                if (array_key_exists($monogram->code, $input)) {
                    if (isset($input[$monogram->code])) {
                        $monogram_array[] = array(
                                            'monogram_id' => $monogram->id,
                                            'value' => $input[$monogram->code],
                        );
                    } 
                }
            }


            $fabric = Fabric::find($input['fabric_id']);
            $design = ProductDesign::find($input['design_id']);

            $product = new Product;
            $product->user_id = $user_id;
            $product->session_id = $session_id;
            $product->product_design_id = $design->id;
            $product->product_category_id = 3;
            $product->fabric_id = $fabric->id;
            $product->name = $fabric->name.' '.$design->name;
            $product->price = $design->price;
            $product->og_price = $design->og_price;
            $product->description = $design->description;
            $product->summary = $design->summary;
            $product->p_image = $design->p_image;
            $product->s_image = $design->s_image;
            $product->album = $design->album;
            $product->folder = $design->folder;
            $product->save();

            $product->monogram()->sync($monogram_array, false);
            
            $attribute_array = [];
            $attributes = ProductAttribute::where('product_category_id', 3)->get();
            foreach($attributes as $attribute){
                if (array_key_exists($attribute->code, $input)) {
                    if (isset($input[$attribute->code])) {
                        $attribute_array[] = array(
                                            'product_id' => $product->id,
                                            'product_attribute_id' => $attribute->id,
                                            'product_attribute_value_id' => $input[$attribute->code],
                        );
                    } 
                }
            }

            ProductAttributeValueSave::insert($attribute_array);

            $options = array(
                        'folder' => $product->folder,
                        'image' => $product->p_image,
            );

            Cart::add($product->id, $product->name, $product->price, $input['quantity'], $options);
            // Cart::add($product->id, $product->name, $request->input('price'), $request->input('qty'));
            return response()->json($product->name);
    }
}
