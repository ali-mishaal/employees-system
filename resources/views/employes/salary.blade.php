@extends('../structure')

@section('title' , 'salary')

@section('content')

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Salary</h3>
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
                    <h2>Salary <small>sub title</small></h2>
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
                  <th>name</th>
                  <th>date</th>
                  <th>attend</th>
                  <th>time of attend</th>
                  <th>depart</th>
                  <th>time of depart</th>
                  <th>add hour</th>
                  <th>late hour</th>
                  <th>holiday</th>
                  <th>weekend</th>

                </tr>
              </thead>

              
              <tbody>
                <?php 
                     $month = $att = $dee = $nhour_add = $nhour_late = $con = 0;
                     $attend_count = 0;
                ?> 

                @foreach($attend as $value)
                <?php

                     $d = strtotime($datt['atend']) - strtotime($datt['depart'])  ;

                     $d =  12 - $d/60/60;
                ?>
                
                <tr>
                  
                    <td>{{ $value->user->name }}</td>
                    <td>{{ $value['created_at']->format('Y-m-d') }}</td>
                    <td>{{ $value['attend'] }}</td>
                    <td>{{ $datt['atend'] }}</td>
                    <td>{{ $value['depart'] }}</td>
                    <td>{{ $datt['depart'] }}</td>
                    <td>

                    @if(strtotime($datt['atend']) > strtotime($value['attend']))

                    <?php  
                      
                       $d = strtotime($datt['atend'])-strtotime($value['attend']);
                       $att = $d/60/60; 

                    ?>
                    @endif 

                   
                    @if(strtotime($value['depart']) > strtotime($datt['depart']))

                     <?php  

                       $d = (strtotime($value['depart']) - strtotime($datt['depart']))/60/60;
                      
                        $att += $d;

                    ?>  
                    @endif   
                    
                    {{ $att }}
                    </td>
                    <td>

                    @if(strtotime($value['attend']) > strtotime($datt['atend']))
                      <?php  $d = (strtotime($value['attend'])-strtotime($datt['atend']))/60/60;  $dee = $d;?>
                    
                    @endif

                    @if(strtotime($datt['depart']) > strtotime($value['depart']))

                     <?php  

                       $d = (strtotime($datt['depart']) - strtotime($value['depart']))/60/60;
                      
                        $dee += $d;

                    ?>  
                    @endif   
                    
                    {{ $dee }} 
                    </td>
                    <td>
                        @foreach($holiday as $day)
                          @if($day->date != date("Y-m-d"))
                             working day
                          @else
                              holiday
                          @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($weekend as $day)
             @if($day->name != rtrim(date('D', strtotime(date("Y-m-d"))),' ') )
                             working day
                          @else
                              holiday
                          @endif
                        @endforeach
                    </td>
                </tr>
                <?php 
                     $month = $value['created_at']->format('Y-m'); 
                     $nhour_add += $att; 
                     $nhour_late += $dee; 

                     $att = 0;
                     $dee = 0; 
                ?>
                <?php $attend_count += count($value) ?>

@if(isset($attend[$con+1]) && $attend[$con+1]['created_at']->format('Y-m') != $month || !isset($attend[$con+1]) )

<tr style="background-color: #607D8B;color: black">
  
  <td>{{ $month }}</td>
  <td>number of attending:{{ $attend_count }}</td>
  <td>number of absence:
  <?php $days_late = cal_days_in_month(CAL_GREGORIAN,$value['created_at']->format('m'),$value['created_at']->format('Y')) - ($attend_count + count($weekend) + count($holiday)); ?>
    {{ $days_late }}
  </td>
  <td>number of add days:@if($attend_count > cal_days_in_month(CAL_GREGORIAN,$value['created_at']->format('m'),$value['created_at']->format('Y')) - count($weekend) + count($holiday)) )
        <?php $days_add = $attend_count - cal_days_in_month(CAL_GREGORIAN,$value['created_at']->format('m'),$value['created_at']->format('Y')) - count($weekend) + count($holiday); ?>
      @else
         <?php $days_add = 0; ?>
      @endif
      {{ $days_add }}
  </td>
  <td>number of holidays:{{ count($weekend) + count($holiday) }}</td>
  <td>number of add hours:{{ $nhour_add }}</td>
  <td>number of late hours:{{ $nhour_late }}</td>
  <td>salary:{{ $value->user->salary }}</td>
  <td colspan="2">Remaining salary:
   <?php

        $salary_of_day = $value->user->salary/cal_days_in_month(CAL_GREGORIAN,$value['created_at']->format('m'),$value['created_at']->format('Y'));
        $salary_of_hour = $salary_of_day/$d;

        $salary_of_add_day = $salary_of_day * $sett->add_day * $days_add ;
        $salary_of_late_day = $salary_of_day * $sett->late_day * $days_late;
        $salary_of_add_hour = $salary_of_hour * $sett->add_hour * $nhour_add;
        $salary_of_late_hour = $salary_of_hour * $sett->late_hour * $nhour_late;

        $salary = $value->user->salary + $salary_of_add_day + $salary_of_add_hour - $salary_of_late_day - $salary_of_late_hour;


   ?>
   {{ number_format((float)$salary, 2, '.', '') }}
  </td>
</tr>

<?php
     $nhour_add = $nhour_late = $attend_count= 0;  
?>

@endif
    <?php  
         $con += 1; 
    ?>
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