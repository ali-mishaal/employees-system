@extends('../structure')

@section('title' , 'emplyee|edit')

@section('content')
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit employee</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>

            <div class="clearfix"></div>
            @if(Session::has('msg'))
            <div class="col-md-12">
             
                
                <div class="x_content bs-example-popovers">

                  <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>{{ session('msg') }}</strong> 
                  </div>

                
              </div>
            </div>
           @endif


            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit employee <small>sub title</small></h2>
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

                    <form class="form-horizontal form-label-left" method="post" action="{{route('update.emplo' , $user->id)}}" novalidate>
                    {{ csrf_field() }}

                     <div class="item form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" step="0.01" id="link" name="name" required="required" class="form-control col-md-7 col-xs-12" min="0" value="{{$user->name}}">
                        </div>
                         @if ($errors->has('name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                      </div>

                      <div class="item form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" step="0.01" id="link" name="email" required="required" class="form-control col-md-7 col-xs-12" min="0" value="{{$user->email}}">
                          @if ($errors->has('email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif

                          @if (Session::has('msgemail'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('msgemail') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>

                      <div class="item form-group {{ $errors->has('adress') ? 'has-error' : '' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">adress <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" step="0.01" id="email2" name="adress"  class="form-control col-md-7 col-xs-12" min="0" value="{{ $user->adress }}">
                          @if ($errors->has('adress'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('adress') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>

                      <div class="item form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">phone <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="phone" name="phone"  class="form-control col-md-7 col-xs-12" value="{{ $user->phone }}">

                          @if(Session::has('msgerr'))
                              <span class="help-block">
                                  <strong>{{ session('msgerr') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>

                      <div class="item form-group {{ $errors->has('salary') ? 'has-error' : '' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">salary <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" step="0.01" id="email2" name="salary"  class="form-control col-md-7 col-xs-12" min="0" value="{{ $user->salary }}">
                          @if ($errors->has('salary'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('salary') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>

                      <div class="item form-group {{ $errors->has('dhiring') ? 'has-error' : '' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">date of hiring <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date" step="0.01" id="email2" name="dhiring"  class="form-control col-md-7 col-xs-12" min="0" value="{{ $user->dhiring }}">
                          @if ($errors->has('dhiring'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('dhiring') }}</strong>
                              </span>
                          @endif
                        </div>
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