<html>

  <head>
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">  
 
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type='text/javascript' src='script.js'></script> 
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  </head>

  <body>
    <div class="container mt-3">
    <label for="daterange">
    
    <!-- a reservation can be made two ways:
        1. ask for all rooms available between a date range
        2. ask for a specific room after a date
    -->

      Rezervare:
    </label>
    <input type="text" id="daterange" name="daterange" value="01/01/2018 - 01/15/2018" />
    
    <!--
    <button id="CheckRoomsBttn" type="button">
      Verifica
    </button>
    -->
    
    <ul class="list-group">
    </ul>
    </div>
    <div id="test">
    </div>
  </body>

</html>
