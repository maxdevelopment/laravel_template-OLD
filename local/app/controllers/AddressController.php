<?php

class AddressController extends Controller {
    public function view()
    {
        if ((User::find(Auth::id())->addresses->count()) > 0):
            $addresses = User::find(Auth::id())->addresses;
            return View::make('user.addaddress')->with('addresses', $addresses);
        else:
            return View::make('user.addaddress');
        endif;
    }
    
    public function viewForm($id = false)
    {
        if(!$id):
            return View::make('user.formaddress');
        else:
            $address = Address::find($id);
            return View::make('user.formaddress')->with('address', $address);
        endif;
        
    }

    public function add()
    {
        try {
            if (Request::ajax()):
                $rules = array(
                    'name'    =>  array('required', 'regex:/^[\.\,\w\d\s]+$/i'),
                    'surname' =>  array('required', 'regex:/^[\.\,\w\d\s]+$/i'),
                    'address' =>  array('required', 'regex:/^[\.\,\w\d\s]+$/i'),
                    'city'    =>  array('required', 'regex:/^[\.\,\w\d\s]+$/i'),
                    'state'   =>  array('required'),
                    'zip'     =>  array('required', 'alpha_dash'),
                    'country' =>  array('required', 'alpha'),
                    );
                $validator = Validator::make(Input::all(), $rules);
                if ($validator->fails()):
                    $errors = $validator->messages();
                    return json_encode($errors);
                else:
                    $addressData = array(
                        'user_id' => Auth::id(),
                        'name'    =>  Input::get('name'),
                        'surname' =>  Input::get('surname'),
                        'address' =>  Input::get('address'),
                        'city'    =>  Input::get('city'),
                        'state'   =>  Input::get('state'),
                        'zip'     =>  Input::get('zip'),
                        'country' =>  Input::get('country'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    );
                    if (!Input::get('id')):
                        Address::create($addressData);
                        return 'Address added!';
                    else:
                        $update = Address::find(Input::get('id'));
                        $update->name = $addressData['name'];
                        $update->surname = $addressData['surname'];
                        $update->address = $addressData['address'];
                        $update->city = $addressData['city'];
                        $update->state = $addressData['state'];
                        $update->zip = $addressData['zip'];
                        $update->country = $addressData['country'];
                        $update->updated_at = $addressData['updated_at'];
                        $update->save();
                        return 'Address updated!';
                    endif;
                endif;
            endif;
        } catch (Exception $e) {
            return json_encode('Something wrong: '.$e->getMessage());
        }
    }
    
    public function upDelAddress()
    {
        if (Input::get('del') !== 'delete'):
            return $this->viewForm(Input::get('id'));
        else:
            try {
                Address::destroy(Input::get('id'));
                return 'deleted';
            } catch (Exception $e) {
                return 'Err: '.$e;
            }
            
        endif;
    }
}