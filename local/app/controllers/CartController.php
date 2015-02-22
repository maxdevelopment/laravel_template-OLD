<?php

class CartController extends Controller {
    
    protected function _takeProductArr()
    {
        foreach (Session::get('products') as $product_id=>$product_count):
            $amount = (float)Product::find($product_id)->amount;
            $count = (int)$product_count[0];
            $product = array(
                    'id'    => $product_id,
                    'title' => Product::find($product_id)->title,
                    'image' => Product::find($product_id)->image,
                    'amount'=> $amount,
                    'count' => $count,
                    'sum'  => $amount*$count);
                $result[] = $product;
        endforeach;
        return $result;
    }

        public function add()
    {
        if (Input::get('many') < 1):
            return 0;
        else:
            $product_id = Input::get('product_id');
            $product_count = Input::get('many');
            if (!Session::has('products.'.$product_id)):
                Session::push('products.'.$product_id, $product_count);
                return count(Session::get('products'));
            else:
                return 'err';
            endif;
        endif;
    }
    
    public function view()
    {
        $products = $this->_takeProductArr();
        return View::make('pages.viewcart')->with('products', $products);
    }
    
    public function edit()
    {
        $product_id = Input::get('id');
        $product_count = Input::get('many');
        if ($product_count < 1):
            Session::forget('products.'.$product_id);
            if (count(Session::get('products')) > 0):
                return count(Session::get('products'));
            else:
                return 0;
            endif;
        else:
            Session::forget('products.'.$product_id);
            Session::push('products.'.$product_id, $product_count);
            return count(Session::get('products'));
        endif;
    }
    
    public function processing()
    {
        if (count(Session::get('products')) > 0):
            $products = $this->_takeProductArr();
        endif;
        
        if(!Auth::check()):
            return View::make('pages.processing')->with('products', $products);
        else:
            return View::make('pages.processing')->with('products', $products);
        endif;
    }
}

