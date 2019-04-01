$(function() {
  $('input[name="daterange"]').daterangepicker({ opens: 'left'}, function(start, end, label) 
  {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
       
         
        var smokers = 0;
        var with_kids = 0;
        var with_fridge = 0;
        var with_animals = 0;
        if ($('#smokers').is(":checked"))
        {
            smokers = 1; 
        }
        if ($('#with_kids').is(":checked"))
        {
            with_kids = 1; 
        }
        if ($('#with_fridge').is(":checked"))
        {
            with_fridge = 1; 
        }
        if ($('#with_animals').is(":checked"))
        {
            with_animals = 1; 
        }

        $.ajax({
            type    	: 'POST', //method type
            url     	: 'get_avail_rooms.php', //form processing file url
            data        : { "start" : start.format("YYYY-MM-DD"),
                            "end"   : end.format("YYYY-MM-DD"),
                            "smokers" : smokers,
                            "with_kids" : with_kids,
                            "with_fridge" : with_fridge,
                            "with_animals" : with_animals 
                          },
            dataType 	: 'json',
            success 	: function(response) 
                          {
                            $("#recom_rooms ul.list-group").append("<h3>Recomandam</h3>");
                            for(var i=0; i<response.length; i++) 
                            {
                               /*console.log("ajax response: " + response.room_arr[i]+response.room_arr[i+1]+
                                           response.room_arr[i+2]+response.room_arr[i+3]+
                                           response.room_arr[i+4]+response.room_arr[i+5]+response.room_arr[i+6]);
                               */
                               console.log(response);
                               var petlogo = "";  
                               if(response[i]["pet"])
                                    petlogo = "<img src='images/allowedpet-logo.gif'" +  
                                               "title='cu animal de companie'>";
                               else
                                    petlogo = "<img src='images/notallowedpet-logo.gif'" +
                                                "title='fara animal de companie'>";
                                
                               
                               var roomnumber = "";
                               if(response[i]["room_id"])
                                    roomnumber = response[i]["room_id"].toString();
                               
                               var roomprice = "";
                               roomprice = response[i]["price_pday"].toString();
                                
                               var aclogo = "";
                               if(response[i]["ac"])
                                    aclogo = "<img src='images/ac-logo.jpg' title='cu aer conditionat'>";
                               else
                                    aclogo = "<img src='images/noac-logo.jpg' title='fara aer conditionat'>";
                                    
                               $add = $("<li class='list-group-item d-flex " + 
                                        "justify-content-between align-items-center'>"+
                                        "Apartamentul nr." + roomnumber + ", " + 
                                         response[i]["type"] +
                                         ", " + response[i]["bath"] + 
                                         ", " + roomprice + "lei/zi" + aclogo + petlogo +
                                         "<span class='badge badge-primary badge-pill'>" + response[i]["totprice"] + 
                                         "lei total </span>" + "<button type='button' class='btn btn-primary " +
                                         start.format("YYYY-MM-DD") + " " + end.format("YYYY-MM-DD") + "' id='" + 
                                         roomnumber + "_ChsRoomBttn'>Alege</button></li>"); 
                               if(response[i]["count"])
                                    $("#recom_rooms ul.list-group").append($add);
                               else
                                    $("#notrecom_rooms ul.list-group").append($add);

                            }
                          }
    });
  });

  $("ul.list-group").on("click", "button[id$='ChsRoomBttn']", function() {
      console.log("Button has been pressed!");
     
      $(this).hide(); 
      var BttnId = $(this).attr("id"); 
      var classList = document.getElementById(BttnId).className.split(/\s+/);
      var bk_startdate = classList[classList.length-2];
      var bk_enddate   = classList[classList.length-1];
      var room_id = BttnId.replace(/[^0-9]/g, '');

      $("#step2_form").append("<form class='form-inline'><div id='get_number' class='form-group'></div></form>");
      $("#get_number").append("<h3><span class='badge badge-info'>Numar telefon </span></h3>");
      $("#get_number").append("<input type='text' class='form-control' id='phnumber' name='phnumber'>");
      $("#get_number").append("<input type='hidden' class='form-control' id='bk_startdate' name='bk_startdate'" +
                             "value='" + bk_startdate + "'>");
      $("#get_number").append("<input type='hidden' class='form-control' id='bk_enddate' name='bk_enddate'" +
                             "value='" + bk_enddate + "'>");
      $("#get_number").append("<input type='hidden' class='form-control' id='room_id' name='room_id'" +
                             "value='" + room_id + "'>");
      
              
      $("#get_number").append("<button type='button' class='btn btn-primary' id='MakeReservBttn'>Rezerva</button>");
     
      //$("ul.list-group").hide();
      $("ul.list-group").children("li").each(function() {
          console.log($(this));
          var bttn = $(this).find("button");
          console.log(bttn);
          if(bttn.attr("id")!=BttnId) {
              console.log(bttn.parent());
             
              bttn.parent().remove();
          }
      });

      //$("#step2_form").removeClass("hideMe");
  });

  $("#step2_form").on("click", "#MakeReservBttn", function() 
  {
      console.log("button pressed inside step2_form");
      var formdata = {
          "room_id"      : $("#room_id").val(), 
          "client_phone" : $("#phnumber").val(),
          "start"        : $("#bk_startdate").val(),
          "end"          : $("#bk_enddate").val()
      };

      
      $.ajax({ 
          type 	: 'POST', //method type
          url 	: 'makereservation.php', //form processing file url
          data 	: formdata, //data to send
          dataType 	: 'json',
          success 	: function(response) 
                      {
                            $("#step2_form").append("<div id='resp_mssg'></div>");
                            $('#resp_mssg').append("<span id='respmssg'>" + response.message + "</span>").hide().fadeIn(2500);
                              console.log(response.message);
                      }
      });
  


      
  });
});

