<script type="text/javascript">    
    $(function(){
      // $('form#commentForm').on('submit', function(){
          // console.log('1 comment posted');
       //});
       //$('button#submitBtn').on('click', function(e){
           //e.preventDefault();
           //e.stopPropagation();
           //var folder_id = $('#folder_id').val();
           //var comment_by= $('#comment_by').val();
           //var activity = $('#activity').val();
           //var comment = $('#comment').val();
           //$.post('comment', {folder_id:folder_id, comment_by:comment_by, //comment:comment, activity:activity}, function(data){
             //  $('#comment').val('');
            //   $("#chat-box").load(location.href+" #chat-box>*","");
           //});
       //});
       //$.ajaxSetup({
       //    headers: {
       //        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       //    }
       //});
       
       var temp = 0;
       function pageRefresh(view = ''){
           //var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
           $.ajax({
               url:"fetch_notification",
               method:"GET",
               dataType:"json",
               success:function(returnData)
               {
                   $('#folder_notif').html(returnData.notif_count);
                   console.log('Working, data.count is: '+ returnData.notif_count);
               },
               error:function(){
                   console.log('error');
               }
           });
       }
       pageRefresh();
       
       setInterval(function(){
           pageRefresh(); // refresh page every 5 sec.       
        }, 5000);        // for forward button.
       $('#forwardBtn').on('click', function(e){            //e.preventDefault();
           //e.stopPropagation();
           //console.log('Working');
       });
   })
</script>