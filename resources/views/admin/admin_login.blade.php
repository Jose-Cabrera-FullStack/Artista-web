<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin</title><meta charset="UTF-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script></head> 
<body class="text-center">  
        <script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>       
        <div class="container">
            <div class="row vertical-offset-100">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                          <div class="panel-heading">
                                @if(Session::has('flash_message_error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert"></button>
                                        <strong>{!! session('flash_message_error')!!}</strong>
                                </div>
                            @endif
                            @if(Session::has('flash_message_success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert"></button>
                                        <strong>{!! session('flash_message_success')!!}</strong>
                                </div>
                            @endif
                            <h3 class="panel-title">Please sign in</h3>
                         </div>
                          <div class="panel-body">
                          <form accept-charset="UTF-8" role="form" method="post" action="{{url('admin/dashboard')}}">{{csrf_field()}}
                            <fieldset>
                                  <div class="form-group">
                                    <input class="form-control" placeholder="email" name="email" type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                                    </label>
                                </div>
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                            </fieldset>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>