@extends('layouts.master')

@section('head_extra')
    <!-- jVectorMap 1.2.2 -->
    <link href="{{ asset("/bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css") }}" rel="stylesheet" type="text/css" />  
    @include('partials._head_extra_jstree_css')
    @include('partials._head_extra_select2_css')
@endsection

@section('content')

  <style type="text/css">
    #read-time{
      color:  tomato;
    }
    .box-footer{
      
    }
    .mailbox-attachment-icon{
      width:200px !important;
      height:105px !important;
      background-color: #efe;
    }
    .mailbox-attachment-info{
      width: 200px !important;
      height: 70px;
    }
    #activity-timeline{
      margin-top: -15px !important;
    }
  </style>
  <script>
    $( function() {
      var availableTags = [
          @foreach($users as $user)   
             "@if($user->position){{$user->position}} - @endif {{ $user->first_name }}, {{$user->last_name}}",
          @endforeach
          ""
        ];

      availableTags.splice(0, 0,'Select Recipient');
      
      $(".select-with-search").select2({
        data: availableTags,
        placeholder: "Select Recipient",
        theme: "bootstrap",
        minimumResultsForSearch: Infinity
      });
    });
  </script>

  <style type="text/css">
    .column{margin-top: -10px; float: right; }
  </style>
 
    <div class='row pull right'>
  
        <div class='col-md-3 pull-left'>
          <!-- USERS LIST -->
        <div class="box box-primary">
          <div class="box-header with-border">
              <!-- @cpnwaugha: c-e: here we will allow users see the other users in their department
                and admin and registry see all the users that are in the system.
              -->
               {{--@unless(Auth::user()->isRoot()) --}}
                <h3 class="box-title">Department: {{ Auth::user()->department }}</h3>
               {{--@endunless --}}
              <div class="box-tools pull-right">
                  {{-- auto fetch the users in the department--}}
                  <span class="label label-primary">15 users online</span>
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
          </div><!-- /.box-header -->
          <div class="box-body no-padding">
            <ul class="users-list clearfix">
              @foreach($users as $user)
        @if($user->department == Auth::user()->department)
                <li>
        {{--<img src="{{ Gravatar::get($user->email) }}" class="user-image" alt="User Image"/> --}}
           <img src="img/profile_picture/photo/{{ $user->avatar }}" class="offline" style="width: 52px; height: 52px; top: 10px; left: 10px; border-radius: 50%;" alt="User Image"/>
                    <a class="users-list-name" href="">{!! link_to_route('admin.users.show', $user->full_name, [$user->id], []) !!}</a>
                    {{-- <span class="users-list-date">{{ $user->created_at }}</span> --}}
                </li>
        @endif
              @endforeach
            </ul><!-- /.users-list -->
          </div><!-- /.box-body -->
          <div class="box-footer text-center">
              <a href="javascript::" class="uppercase">View All Users</a>
          </div><!-- /.box-footer -->
        </div>       
        </div><!-- /.col -->
    
    

      <div class="pull right">
        <div class='col-md-6'>
            <!-- SERVER HEALTH REPORT -->
		<div id="activity-timeline" class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>
              <h3 class="box-title">MyActivity Timeline</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <ul class="todo-list">
                @foreach($activity as $activity_by)
        @if($activity_by->activity_by == Auth::user()->email || Auth::user()->username)
                    <li>                     
                      <small>{{ $activity_by->activity }}
                      <i class="fa fa-clock-o"></i>
           <b>{{ date('F d, Y', strtotime($activity_by->created_at )) }}</b></small>
                      </li>
                      
               @endif
        @endforeach
        
              </ul>
<?php echo $activity->render(); ?>
   </div><!-- /.box-body -->
        </div><!-- /.box -->   
      <!-- PROJECT STATUS -->
      </div><!-- /.col md-->
      </div>  

    
      </div><!-- /.row -->

    {{-- <script>
    // Work on this later. Fix like on Linked in
    // http://jsfiddle.net/FDv2J/1913/
    // https://css-tricks.com/scroll-fix-content/
    // https://forums.digitalpoint.com/threads/stop-scrolling-div-before-footer.2751269/
      // $(document).scroll(function(){
      //   $('.main-header').css('position', 'fixed');
      // }).mouseup(function(){
      //   $('.navbar').css('position', 'absolute');
      // }).keyup(function(){
      //   $('.navbar').css('position', 'relative');
      // });     
   //</script> --}}
@endsection