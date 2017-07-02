<script type="text/javascript">    
    $(function(){


        

       // refreshCommenDiv();
       
       //setInterval(function(){
        //   refreshCommenDiv(); // refresh page every sec.       
        //}, 1000); 

       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
       });
       
       
       var temp = 0;
       function pageRefresh(view = ''){
           
           $.ajax({
               url:"folder_notification",
               method:"GET",
               dataType:"json",
               success:function(returnData)
               {
                   var notif_count = returnData.notif_count;
                   $('#folder_notif').html(notif_count);
                   //console.log('Working, data.count is: '+ notif_count);

                   if(notif_count === 0){
                       $('#folder_notif').removeClass('label-danger');
                       $('#folder_notif_icon').removeClass('fa-folder-open-o').addClass('fa-folder-o');
                   }
                   else{
                       $('#folder_notif').addClass('label-danger');
                       $('#folder_notif_icon').removeClass('fa-folder-o').addClass('fa-folder-open-o');
                   }
               },
               error:function(){
                   console.log('error connecting to fetch folder notification');
               }
           });

           $.ajax({
               url:"memo_notification",
               method:"GET",
               dataType:"json",
               success:function(returnData)
               {
                   var memo_count = returnData.memo_count;
                   $('#memo_notif').html(memo_count);
                   $('#inbox_left').html(memo_count);
                   // console.log('Working, data.count is: '+ memo_count);
                   if(memo_count === 0){
                       $('#memo_notif').removeClass('label-success');
                       $('#inbox_left').removeClass('label-primary');
                   }
                   else{
                       $('#memo_notif').addClass('label-success');
                       $('#inbox_left').addClass('label-primary');
                   }
               },
               error:function(){
                   console.log('error connecting to fetch memo notification');
               }
           });

           $.ajax({
               url:"request_file_notification",
               method:"GET",
               dataType:"json",
               success:function(returnData)
               {
                   var file_request_count = returnData.file_request_count;
                   $('#request_file_notif').html(file_request_count);
                   //console.log('Working, data.count is: '+ notif_count);

                   if(file_request_count === 0){
                       $('#request_file_notif').removeClass('label-warning');
                       $('#request_file_notif').removeClass('fa-bell-o').addClass('fa-bell-slash-o');
                   }
                   else{
                       $('#request_file_notif').addClass('label-warning');
                       $('#request_file_notif').removeClass('fa-bell-slash-o').addClass('fa-bell-o');
                   }
               },
               error:function(){
                   console.log('error connecting to request file notification');
               }
           });
       }
       pageRefresh();
       
       setInterval(function(){
           pageRefresh(); // refresh page every sec.       
        }, 1000);        // for forward button.
       $('#forwardBtn').on('click', function(e){            //e.preventDefault();
           //e.stopPropagation();
           //console.log('Working');
       });

       $('#notif_toggle').on("click", function(){
           $.ajax({
               url:"notif_seen",
               method:"GET",
               dataType:"json",
               success:function(data)
               {
                   // var data_length = Object.keys(data).length;  // doesn't support old IE browsers
                   // console.log("connection to notification seen, successful");
               },
               error:function(){
                   console.log('error, connecting to notification controller ');
               }
           });
       });

       $('#memo_toggle, #inbox_left_li').on("click", function(){
           $.ajax({
               url:"memo_seen",
               method:"GET",
               dataType:"json",
               success:function(data)
               {
                   // perform actions...
               },
               error:function(){
                   console.log('error, connecting to memo notification controller ');
               }
           });
       });

       $('#request_file_toggle').on("click", function(){
           $.ajax({
               url:"request_file_seen",
               method:"GET",
               dataType:"json",
               success:function(data)
               {
                   // perform actions...
               },
               error:function(){
                   console.log('error, connecting to request notification controller ');
               }
           });
       });


   })
</script>