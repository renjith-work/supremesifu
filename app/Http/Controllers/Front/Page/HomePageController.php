<?php

namespace App\Http\Controllers\Front\Page;

use App\Models\Post\Post;
use App\Models\Product\ProductDesign;
use App\Models\Product\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use stdClass;

class HomePageController extends Controller
{
    public function index()
    {
        $posts = Post::where('featured', 1)->orderBy('id', 'desc')->take(3)->get();
        
        $products = $this->listproduct();
        return view('front.pages.home')->with('posts', $posts)->with('products', $products);
    }

    private function listproduct()
    {
        $products = Product::where('user_id', 1)
                            ->where('featured', 1)
                            ->orderBy('id', 'desc')->get();
        $product_array = array();
        foreach($products as $product)
        {
            $data = new stdClass();
            // $data = new stdClass();
            $data->name = $this->substrwords($product->name, 68);
            $data->slug = '/product/shirt/'. $product->slug;
            foreach($product->images as $image)
            {
                if($image->position_id == 1)
                {
                    $data->primary_image = '/images/product/product/'.$image->name;
                }elseif ($image->position_id == 2) {
                    $data->secondary_image = '/images/product/product/'. $image->name;
                }
            }
            if($product->price->splPrice == null)
            {
                $data->price = 'RM '. $product->price->price;
            }else{
                $data->price = '<span>RM '. $product->price->price.'</span> RM '. $product->price->splPrice;
            }
            $product_array[] = $data;
            // $product_array[] = $product;
        }
        return $product_array;
        
    }

    private function substrwords($text, $maxchar, $end='...') {
        if (strlen($text) > $maxchar || $text == '') {
            $words = preg_split('/\s/', $text);      
            $output = '';
            $i      = 0;
            while (1) {
                $length = strlen($output)+strlen($words[$i]);
                if ($length > $maxchar) {
                    break;
                } 
                else {
                    $output .= " " . $words[$i];
                    ++$i;
                }
            }
            $output .= $end;
        } 
        else {
            $output = $text;
        }
        return $output;
    }
}
