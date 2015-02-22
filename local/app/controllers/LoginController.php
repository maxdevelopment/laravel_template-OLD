<?php

class LoginController extends \BaseController {

    public function reg() {
            return View::make('auth.reg');
        }

	public function create()
	{
            $rules = array(
            'username'   => 'required',
            'email'      => 'required|email',
            'password'   => 'required|min:6'
            );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()):
            $errors = $validator->messages();
            Input::flashOnly('username', 'email');
            return Redirect::to('/auth')->withErrors($errors);
        else:
            $userData = array(
            'username' => Input::get('username'),
            'email' => Input::get('email'),
            'password' => Hash::make(Input::get('password')),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            );
            User::create($userData);
            Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')));
            Session::put('role', Crypt::encrypt('user'));
            return Redirect::route('main')->with('message', 'Thank you for registration!');
        endif;
	}
        
        public function login()
        {            
            if(!Auth::check()):
                if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')), true) ||
                    Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')), true)):
                    switch (Auth::user()->isAdmin):
                        case 0:
                            Session::put('role', Crypt::encrypt('user'));
                            return Redirect::route('user.main');
                        case 1:
                            Session::put('role', Crypt::encrypt('admin'));
                            return Redirect::route('admin.main');
                    endswitch;
                else:
                    return Redirect::route('main')->with('message', 'Wrong login/password!');
                endif;
            endif;
        }
        
        public function logout()
        {
            Auth::logout();
            return Redirect::route('main')->with('message', 'See you again!');
        }
}
