<?php 
include_once 'header.php';
include_once 'headerfiles.php';

        
?>
 <body class="business-page sidebar-collapse">
     <div class="wrapper">
         <div class="content-wrapper">
             <section class="content">
                 
                 <div class="business-options box box-solid">
                     <div class="box-header with-border">
                         <h3 class="box-title">Choose a Business</h3>
                     </div>
                     <div class="box-body">
                         <div class="row">
                             <div class="col-xs-6">
                                 <a href="home.php?application=event">
                                     <div tabindex="0" class="focus focusable small-box bg-green">
                                        <div class="inner">
                                          <h4><u>E</u>vent</h4>
                                          <h4>Management</h4>
                                        </div>
                                         <div class="small-box-footer" style="display: none">
                                             Press Enter <i class="fa fa-arrow-circle-right"></i>
                                         </div>
                                      </div>
                                 </a>
                             </div>
                             <div class="col-xs-6">
                                 <a href="home.php?application=catering">
                                     <div tabindex="1" class="focusable small-box bg-green">
                                        <div class="inner">
                                          <h4><u>C</u>atering</h4>
                                          <h4>Management</h4>
                                        </div>
                                         <div class="small-box-footer" style="display: none">
                                             Press Enter <i class="fa fa-arrow-circle-right"></i>
                                         </div>
                                      </div>
                                 </a>
                             </div>
                         </div>
<!--                         <div class="row">
                             <div class="col-xs-offset-3 col-xs-6">
                                 <a href="#">
                                     <div class="small-box bg-aqua">
                                        <div class="inner">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-plus fa-4x"></i>
                                                </div>
                                                <div class="col-xs-9">
                                                  <h4><u>A</u>dd</h4>
                                                  <h4>New Business</h4>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                 </a>
                             </div>
                         </div>-->
                     </div>
                 </div>
             </section>
         </div>
         <?php
         include_once 'footer.php';
         ?>
     </div>
  </body>
</html>
