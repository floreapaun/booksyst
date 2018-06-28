$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
   
     
    $.ajax({
        type    	: 'POST', //method type
        url     	: 'get_avail_rooms.php', //form processing file url
        data        : { "start" : start.format("YYYY-MM-DD"),
                        "end"   : end.format("YYYY-MM-DD") },
        dataType 	: 'json',
        success 	: function(response) {
                        for(var i=0; i<response.room_arr.length; i=i+7)
                        {
                           console.log(response.room_arr[i]+response.room_arr[i+1]+
                                       response.room_arr[i+2]+response.room_arr[i+3]+
                                       response.room_arr[i+4]+response.room_arr[i+5]+response.room_arr[i+6]);
                           $add = $("<li class='list-group-item d-flex justify-content-between align-items-center'>"+
                                   "Apartamentul nr." +  response.room_arr[i] + "," + response.room_arr[i+1] +
                                   "," + response.room_arr[i+2] + "," + response.room_arr[i+3] + 
                                   "," + response.room_arr[i+4] + "," + response.room_arr[i+5] + "lei/zi" +
                                   "<span class='badge badge-primary badge-pill'>" + response.room_arr[i+6] + 
                                   "lei total </span>" + "<button type='button' class='btn btn-primary' id='" + 
                                    response.room_arr[i] + "_ChsRoomBttn'>Alege</button></li>"); 
                           $("ul.list-group").append($add);
                        }
                      }
    });
  });
});
