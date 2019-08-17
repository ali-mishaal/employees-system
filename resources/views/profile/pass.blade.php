@extends('../structure')

@section('title' , 'profile|edit')

@section('content')
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Password</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>

            <div class="clearfix"></div>
            @if(Session::has('msgerr'))
            <div class="col-md-12">
             
                
                <div class="x_content bs-example-popovers">

                  <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>{{ session('msgerr') }}</strong> 
                  </div>

                
              </div>
            </div>
           @endif


            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Password <small>sub title</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" method="post" action="{{route('uppass.profile')}}" novalidate>
                    {{ csrf_field() }}

                    <div class="item form-group {{ $errors->has('cr-pass') ? 'has-error' : '' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">current password<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="password" step="0.01" id="link" name="cr-pass" required="required" class="form-control col-md-7 col-xs-12" >
                        </div>
                         @if ($errors->has('cr-pass'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('cr-pass') }}</strong>
                              </span>
                          @endif
                      </div>

                      <div class="item form-group {{ $errors->has('nw-pass') ? 'has-error' : '' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">new password<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="password" step="0.01" id="link" name="nw-pass" required="required" class="form-control col-md-7 col-xs-12" >
                        </div>
                         @if ($errors->has('nw-pass'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('nw-pass') }}</strong>
                              </span>
                          @endif
                      </div>


                      <div class="form-group ">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success">Edit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

@endsection