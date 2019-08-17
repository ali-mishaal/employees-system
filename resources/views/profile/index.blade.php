@extends('structure')

@section('title' , 'profile')

@section('content')

 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>User Profile</h3>
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
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar --><!-- 
                          <img class="img-responsive avatar-view" src="images/picture.jpg" alt="Avatar" title="Change the avatar"> -->
                        </div>
                      </div>
                      <h3>{{ Auth::user()->name }}</h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> {{ Auth::user()->adress }}
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> {{ Auth::user()->phone }}
                        </li>

                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i>
                          {{ Auth::user()->email }}
                        </li>

                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i>
                          {{ Auth::user()->salary }}
                        </li>

                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i>
                          {{ Auth::user()->dhiring }}
                        </li>
                        <li class="m-top-xs">
                          
                          <a href="{{route('edit.profile') }}"  class="btn  btn-success">edit profile</a>
                        </li>

                        <li class="m-top-xs">
                          
                          <a href="{{route('pass.profile')}}"  class="btn  btn-success">change password</a>
                        </li>

                      </ul>


                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

@endsection