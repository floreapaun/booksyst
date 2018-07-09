<html>

  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type='text/javascript' src='script.js'></script> 

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">  
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="css/blueimp-gallery.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
  </head>

  <body>
    <div class=" container-fluid">
      <div id="step1_form">
        <div class="row">
          <div class="col-4 text-left">
            <img src="images/pensionlogo.png">
          </div>
          <div class="col-4 flex-center text-center">
            <div>
              <h3><span class='badge badge-info'>Rezervare </span></h3>
              <input type="text" id="daterange" name="daterange" value="01/01/2018 - 01/15/2018" />
            </div>   
          </div>
          <div class="col-4 text-right">
            <img src="images/facebooklogo.png">
          </div>
        </div>
      </div> 
    </div> 

   <div id="roomlist" class="d-flex justify-content-center align-items-center container-fluid">
     <ul class="list-group">
     </ul>
   </div>
      
 
   <div class="container-fluid"> 
     <div class="row">
       <div class="col-sm-4">
       </div>
       <div class="col-sm-4 flex-center text-center" >  
         <div id="step2_form"> 
         </div> 
       </div>
       <div class="col-sm-4">
       </div>
     </div>
   </div> 

  

    <div id="test">
    </div>

    <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
    <div id="blueimp-gallery-carousel" class="blueimp-gallery blueimp-gallery-carousel">
      <div class="slides"></div>
      <h3 class="title"></h3>
      <a class="prev">‹</a>
      <a class="next">›</a>
      <a class="play-pause"></a>
      <ol class="indicator"></ol>
    </div>

    <div id="links" class="links" hidden>
      <a href="images/pens0.jpg" title="Constructie moderna in varful muntelui">
          <img src="images/pens0.jpg" alt="Constructie moderna in varful muntelui">
      </a>
      <a href="images/pens1.jpg" title="Varful Retezat, dimineata, de la fereastra">
          <img src="images/pens1.jpg" alt="Varful Retezat, dimineata, de la fereastra">
      </a>
      <a href="images/pens7.jpg" title="Confort sporit demn de urbe">
          <img src="images/pens7.jpg" alt="Confort sporit demn de urbe">
      </a>
      <a href="images/pens6.jpg" title="Mobilier din lemn, ca doar suntem in munti">
          <img src="images/pens6.jpg" alt="Mobilier din lemn, ca doar suntem in munti">
      </a>
      <a href="images/pens8.jpg" title="Relaxare? O familie numeroasa?">
          <img src="images/pens6.jpg" alt="Relaxare? O familie numeroasa?">
      </a>
    </div>



    <script src="js/blueimp-gallery.min.js"></script>
    <script>
      document.getElementById('links').onclick = function (event) {
          event = event || window.event;
          var target = event.target || event.srcElement,
              link = target.src ? target.parentNode : target,
              options = {index: link, event: event},
              links = this.getElementsByTagName('a');
          blueimp.Gallery(links, options);
      };
    </script>
    <script>
      blueimp.Gallery(
          document.getElementById('links').getElementsByTagName('a'),
          {
              container: '#blueimp-gallery-carousel',
              carousel: true
          }
      );
    </script> 



  </body>

</html>
