@extends('structure')

@section('title' , 'employee')

@section('content')


<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Create attend</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Go!</button>
                          </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>
            @if(session('msg'))
            <div class="col-md-12">
             
                
                <div class="x_content bs-example-popovers">

                  <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong> {{ session('msg') }}</strong> 
                  </div>

                
              </div>
            </div>
           @endif

           @if(session('msgerr'))
            <div class="col-md-12">
             
                
                <div class="x_content bs-example-popovers">

                  <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong> {{ session('msgerr') }}</strong> 
                  </div>

                
              </div>
            </div>
           @endif


            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create attend <small>sub title</small></h2>
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



                    <form class="form-horizontal form-label-left" method="post" action="{{
                   url('attend')}}" novalidate>
                    {{ csrf_field() }}

                      <!-- <div class="item form-group {{ $errors->has('attend') ? 'has-error' : '' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">attend <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="time" step="0.01" id="link" name="attend" required="required" class="form-control col-md-7 col-xs-12" min="0">
                        </div>
                         @if ($errors->has('attend'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('attend') }}</strong>
                              </span>
                          @endif
                      </div>

                      <div class="item form-group {{ $errors->has('depart') ? 'has-error' : '' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">depart <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="time" step="0.01" id="link" name="depart" required="required" class="form-control col-md-7 col-xs-12" min="0">
                          @if ($errors->has('depart'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('depart') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div> -->

                      <div class="form-group ">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success" name="attend">Attending</button>
                        </div>
                      </div>
                    </form>

                    <form class="form-horizontal form-label-left" method="post" action="{{
                   route('depart.attend') }}" novalidate>
                    {{ csrf_field() }}

                      <!-- <div class="item form-group {{ $errors->has('attend') ? 'has-error' : '' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">attend <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="time" step="0.01" id="link" name="attend" required="required" class="form-control col-md-7 col-xs-12" min="0">
                        </div>
                         @if ($errors->has('attend'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('attend') }}</strong>
                              </span>
                          @endif
                      </div>

                      <div class="item form-group {{ $errors->has('depart') ? 'has-error' : '' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">depart <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="time" step="0.01" id="link" name="depart" required="required" class="form-control col-md-7 col-xs-12" min="0">
                          @if ($errors->has('depart'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('depart') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div> -->

                      <div class="form-group ">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success" name="depart">Depart</button>
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
