<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{ HTML::script('local/app/js/jquery-1.11.2.min.js')}}
    {{ HTML::script('local/app/js/bootstrap.min.js')}}
    {{ HTML::script('local/app/js/ckeditor/ckeditor.js')}}
    {{ HTML::script('local/app/js/ckeditor/adapters/jquery.js')}}
    {{ HTML::style('local/app/css/bootstrap.min.css') }}
    {{ HTML::style('local/app/css/justified-nav.css') }}
    
        {{ HTML::script('local/app/js/admin.js') }}
        {{ HTML::style('local/app/css/admin.css') }}
        
        {{ HTML::script('local/app/js/main.js') }}
        <title>Laravel Shop Template[MaxDevelopment]</title>
    </head>
    <body>
        <div class="container">
            <div class="masthead">
                <h3 class="text-muted">Laravel Shop Template</h3>
                    <nav>
                        <ul class="nav nav-justified">
                            @include('pages.menu')
                        </ul>
                    </nav>
            </div>
            <div class="row">
                <div class="col-md-9 col-md-push-3">
                    <div class="row">
                        @section('content')
                        <dl>
                            <dt>Admin:</dt>
                            <dd>login: admin password: a111111</dd>
                            <dt>Demo users:</dt>
                            <dd>login: user1 password: a111111</dd>
                            <dd>login: user2 password: a111111</dd>
                            <dd>login: user3 password: a111111</dd>
                            <dt>Git:</dt>
                            <dd>https://github.com/maxdevelopment/laravel_template</dd>
                        </dl>
                        @show
                    </div>
                </div>
                <div class="col-md-3 col-md-pull-9">
                    <div class="session_container">
                        @if (Session::has('message'))
                            <div class="alert alert-danger" role="alert">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error:</span>
                                {{ Session::get('message') }}
                            </div>
                        @else
                            <div class="jq_result"></div>
                        @endif
                        @section('login_or_user')
                            @if (!Auth::check())
                                @include('auth.login')
                            @else
                                <b>Hello, {{ Auth::user()->username }} !</b>
                                <br />{{ link_to_route('logout', 'Logout') }}
                            @endif
                        @show
                        <br />
                        <div class="center-block">
                            <div class="addtocart">
                                <p class="text-center">
                                    @if (Session::has('products'))
                                        Shopping Cart [ <span class="productnum"><?php echo count(Session::get('products'))?></span> ]
                                        <a class="bg-success" href="javascript:void(0);" onclick = "ViewCart();">view cart</a>
                                    @else
                                        Shopping Cart [ <span class="productnum">0</span> ]
                                        <a class="bg-success" href="javascript:void(0);">view cart</a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="loader"></div>
    </body>
</html>