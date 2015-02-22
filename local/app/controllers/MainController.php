<?php

class MainController extends \BaseController {
    
	public function index()
	{
            if(Auth::check()):
                $user = Auth::user()->username;
                return View::make('pages.main')->with($user);
            else:
                return View::make('pages.main');
            endif;
	}
}
