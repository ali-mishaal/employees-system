@extends('../structure')

@section('title' , 'attending|edit')

@section('content')

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>edit attending and depart</h3>
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
                    <h2>edit attending and depart <small>sub title</small></h2>
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

                    <form class="form-horizontal form-label-left" method="post" action="{{ route('up.attend' , $attend->id) }}" novalidate>
                    {{ csrf_field() }}

                      <div class="item form-group ">
                        <label class="control-label col-md-2 col-sm-2 col-xs-2" for="name">attend <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-2 {{ $errors->has('atthour') ? 'has-error' : '' }}">
                         <input type="number" id="link" name="atthour"  class="form-control col-md-2 col-xs-2" min="0" maxlength="2" minlength="2" placeholder="hour" max="12" value="01">
                        </div>
                        @if ($errors->has('atthour'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('atthour') }}</strong>
                              </span>
                          @endif

                        <div class="col-md-2 col-sm-2 col-xs-2 {{ $errors->has('attmin') ? 'has-error' : '' }}">
                         <input type="number"  id="link" name="attmin"  class="form-control col-md-2 col-xs-2" min="0" maxlength="2" minlength="2" placeholder="min" max="59">
                        </div>
                        @if ($errors->has('attmin'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('attmin') }}</strong>
                              </span>
                          @endif

                      </div>
                      <div class="item form-group ">
                        <label class="control-label col-md-2 col-sm-2 col-xs-2" for="name">depart <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-2 {{ $errors->has('dehour') ? 'has-error' : '' }}">
                         <input type="number" id="link" name="dehour"  class="form-control col-md-2 col-xs-2" min="0" maxlength="2" minlength="1" placeholder="hour" max="10">
                        </div>
                        @if ($errors->has('dehour'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('dehour') }}</strong>
                              </span>
                          @endif

                        <div class="col-md-2 col-sm-2 col-xs-2 {{ $errors->has('demin') ? 'has-error' : '' }}">
                         <input type="number"  id="link" name="demin"  class="form-control col-md-2 col-xs-2" min="0" maxlength="2" minlength="1" placeholder="min" max="59">
                        </div>
                        @if ($errors->has('demin'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('demin') }}</strong>
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