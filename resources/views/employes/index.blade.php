@extends('../structure')

@section('title' , 'emplyee')

@section('content')


<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Employess</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                      {{ csrf_field() }}
                    <select id="mo" name="month">
                      @for($i = 1;$i<=12;$i++)
                       <option value="{{ $i }}">{{ $i }}</option>
                      @endfor

                      <input type="submit" value="choose">
                    </select>
                  </form>
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

            <div class="row" style="width: 125%;">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Emplyees <small>sub title</small></h2>
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
                  <th>name</th>
                  <th>email</th>
                  <th>adress</th>
                  <th>phone</th>
                  <th>salary</th>
                  <th>dat of hiring</th>
                  <th>Days of Attendance</th>
                  <th>Days absence </th>
                  <th>Additional days</th>
                  <th>number of holidays</th>
                  <th>add hours</th>
                  <th>late hour</th>
                  <th>Remaining salary</th>
                  <th>action</th>
                </tr>
              </thead>
              
              
              <tbody>
                <?php $count_att=$number_days =$att=$dee= $days_add=0; ?>
                @foreach($weekend as $week)
                            @foreach($holiday as $holi)
                                 @if($holi->date != $week)
                                    <?php $days_add += 0; ?>
                                  @else
                                    <?php $days_add -= 1; ?>
                                  @endif
                            @endforeach
                    @endforeach
                
                @foreach($user as $value)




                <tr>

                    @foreach($attend as $x)
                      @if($x->id_em == $value->id)
                       <?php 
                            $count_att = $count_att+1;

                            if(strtotime($x['attend']) < strtotime($datt['atend']))
                            {
                              $d = (strtotime($datt['atend'])-strtotime($x['attend']))/60/60;  $att += $d;
                            }

                            if(strtotime($x['depart']) > strtotime($datt['depart']))
                            {
                              $d = (strtotime($x['depart']) - strtotime($datt['depart']))/60/60;
                      
                              $att += $d;
                            }


                            if(strtotime($x['attend']) > strtotime($datt['atend']))
                            {
                              $d = (strtotime($x['attend'])-strtotime($datt['atend']))/60/60;  $dee += $d;
                            }

                            if(strtotime($datt['depart']) > strtotime($x['depart']))
                            {
                              $d = (strtotime($datt['depart']) - strtotime($x['depart']))/60/60;
                      
                              $dee += $d; 
                            }
                            
                        ?>

                        @foreach($holiday as $holi)
                        

                            @if($x['created_at']->format('Y-m-d') != $holi->date)
                            
                               <?php $days_add += 0; ?>
                            @else
                            
                              <?php $days_add += 1; ?>

                            @endif
                         @endforeach

                         @foreach($weekend as $week)
                        

                            @if($x['created_at']->format('Y-m-d') != $week)
                            
                               <?php $days_add += 0; ?>
                            @else
                            
                              <?php $days_add += 1; ?>

                            @endif
                         @endforeach

                        

                      @endif

                      <?php
                        $number_days = cal_days_in_month(CAL_GREGORIAN,$x['created_at']->format('m'),$x['created_at']->format('Y'));
                         

                      ?>
                    @endforeach

                    <?php 
                 
                        if(empty($number_days))
                         {
                          $number_days = 30;
                         }



                         $days_late = $number_days-(count($weekend) + count($holiday))-($count_att - $days_add); 
                         
                         
                         
                      
                    ?>


     
                   
                    
                    <td>{{ $value['id'] }}</td>
                    <td><a href="{{ route('salary.emplo',$value['id']) }}">{{ $value['name'] }}</a></td>
                    <td>{{ $value['email'] }}</td>
                    <td>{{ $value['adress'] }}</td>
                    <td>{{ $value['phone'] }}</td>
                    <td>{{ $value['salary'] }}</td>
                    <td>{{ $value['dhiring'] }}</td>
                    <td>{{ $count_att }}</td>
                    <td>{{ $days_late }}</td>
                    <td>{{ $days_add }}</td>
                    <td>{{ count($weekend) + count($holiday) }}</td>
                    <td>{{ floor($att) }}</td>
                    <td>{{ floor($dee) }}</td>
                    <td>
                      <?php
                         $d = strtotime($datt['atend'])-strtotime($datt['depart']);
                         $d = abs($d/60/60);
                         
                         $salary_of_day = $value->salary/$number_days;
                         $salary_of_hour = $salary_of_day/$d;

                         $salary_of_add_day = $salary_of_day * $sett->add_day * $days_add ;
                         $salary_of_late_day = $salary_of_day * $sett->late_day * $days_late;

                         $salary_of_add_hour = $salary_of_hour * $sett->add_hour * $att;
                         $salary_of_late_hour = $salary_of_hour * $sett->late_hour * $dee;

                        $salary = $value->salary + $salary_of_add_day + $salary_of_add_hour - $salary_of_late_day - $salary_of_late_hour;

                        if ($salary < 0) {
                          $salary = 0;
                        }


                     ?>

                    
                   {{ number_format((float)$salary, 2, '.', '') }}


                    </td>
                      <td>
                      <a id="send" href="{{ route('edit.emplo' , $value['id']) }}" class="btn btn-success">Edit</a>
                     <a id="send" href="{{ route('destroy.emplo' , $value['id']) }}" class="btn btn-danger">Delete</a>
                    </td> 


                </tr>
                <?php  $count_att = $att=$dee=$days_add=0; ?>
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

@section('script')


@endsection
