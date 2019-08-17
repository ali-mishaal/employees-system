@extends('../structure')

@section('title' , 'attending')

@section('content')

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Attending</h3>
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

                  <div class="alert alert-success alert-dismissible fade in" role="alert">
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
                    <h2>Attending <small>sub title</small></h2>
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
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>id</th>
                  <th>id employee </th>
                  <th>date</th>
                  <th>attend</th>
                  <th>depart</th>
                  <th>action</th>
                </tr>
              </thead>

              
              <tbody>
                
                
                @foreach($attend as $value)

                <tr>
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['id_em'] }}</td>
                    <td>{{ $value['created_at'] }}</td>
                    <td>{{ $value['attend'] }}</td>
                    <td>{{ $value['depart'] }}</td>
                    <td>
                     <a id="send" href="{{ route('delete.attend',$value->id )}}" class="btn btn-danger">Delete</a>

                     <a id="send" href="{{ route('ed.attend',$value->id) }}" class="btn btn-success">Edit</a>
                    </td> 
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
     </div>
</div> 
                    
                  </div>
                </div>
              
        <!-- /page content -->

@endsection