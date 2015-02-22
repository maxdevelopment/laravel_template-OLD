<?php
/*
 *$rules = array(
 *"title"      => "required",
 *"description"=> "required",
 *"amount"     => "required|numeric",
 *"image"      => "required|regex:'/\.(gif|jpe?g|png)$/i'",
 *);
 *WAS FOUND LARAVEL BUG
 */
class ProductController extends Controller {
    
    protected $imgFileName;

    protected function _editImage($file)
    {
        $path = Config::get('image.upload_dir');
        if (!File::isDirectory($path)):
            File::makeDirectory($path, 0755, $recursive = false);
        endif;
        $filename = rand(100, 999).date('-Y_m_d-H_i_s.').$file->getClientOriginalExtension();
        $this->imgFileName = $filename;
        $file->move($path, $this->imgFileName);
        $img = Image::make($path.$this->imgFileName)->resize(Config::get('image.image_width'), null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path.$this->imgFileName);
        return $this->imgFileName;
    }
    
    public function add()
    {
        try {
            if (Request::ajax()):
                $rules = array(
                    'title' =>  array('required'),
                    //'description'=> array('required'),
                    'editor'=>  array('required'),
                    'amount'=>  array('required', 'numeric'),
                    'image' =>  array('required', 'regex:/\.(gif|jpe?g|png)$/i'),
                    );
                $validator = Validator::make(Input::all(), $rules);
                    if ($validator->fails()):
                        $errors = $validator->messages();
                        return $errors;
                    else:
                        if (Input::hasFile('file')):
                            $filename = $this->_editImage(Input::file('file'));
                        endif;
                            $productData = array(
                            'title' => Input::get('title'),
                            //'description' => Input::get('description'),
                            'description' => Input::get('editor'),
                            'image' => $filename,
                            'amount' => Input::get('amount'),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                            );
                        if (!Input::get('id')):
                            Product::create($productData);
                            return json_encode(array('success' => 'Product added!'));
                        else:
                            $update = Product::find(Input::get('id'));
                            File::delete(Config::get('image.upload_dir').$update->image);
                            $update->title = $productData['title'];
                            $update->description = $productData['description'];
                            $update->image = $productData['image'];
                            $update->amount = $productData['amount'];
                            $update->updated_at = $productData['updated_at'];
                            $update->save();
                            return json_encode(array('success' => 'Product update!'));
                        endif;
                    endif;
            endif;
        } catch (Exception $e) {
            return json_encode('Something wrong: '.$e->getMessage());
        }
    }
    
    public function view()
    {
        $products = Product::where('isActive', 1)->paginate(3);
        return View::make('pages.products')->with('products', $products);
    }
    
    public function adminView()
    {
        $products = Product::all();
        return View::make('admin.deleteproduct')->with('products', $products);
    }

    public function delete()
    {
        try {
            if (Request::ajax()):
            $id = Input::get('id');
            File::delete(Config::get('image.upload_dir').Product::find($id)->image);
            Product::destroy($id);
            return json_encode($id);
            endif;
        } catch (Exception $e) {
            return json_encode('Something wrong: '.$e->getMessage());
        }
        
    }
    
    public function active()
    {
        try {
            if (Request::ajax()):
            $id = Input::get('id');
            $status = Product::find($id)->isActive;
            switch ($status):
                case 0:
                    $product = Product::find($id);
                    $product -> isActive = 1;
                    $product -> save();
                    return 'active';
                case 1:
                    $product = Product::find($id);
                    $product -> isActive = 0;
                    $product -> save();
                    return 'hide';
            endswitch;
            endif;
        } catch (Exception $e) {
            return json_encode('Something wrong: '.$e->getMessage());
        }
    }
    
    public function edit()
    {
        try {
            if (Request::ajax()):
            $id = Input::get('id');
            $editedProduct = Product::find($id);
            $product['id'] = $editedProduct->id;
            $product['title'] = $editedProduct->title;
            $product['description'] = $editedProduct->description;
            $product['image'] = $editedProduct->image;
            $product['amount'] = $editedProduct->amount;
            return View::make('admin.editproduct')->with('product', $product);
            endif;
        } catch (Exception $e) {
            return json_encode('Something wrong: '.$e->getMessage());
        }
    }
}