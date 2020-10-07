



<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!--state overview start-->
        <h2 style="color:#009246;">
            Dashboard
        </h2>
        <div class="row state-overview">
          
        </div>
        <!--state overview end-->

        <div class="row">
            <div class="col-lg-12">
                <h4 style="color:green;font-weight:bold"></h4>
                <h4 style="color:red;font-weight:bold"></h4>
                <!--custom chart start-->
                <!-- <div class="border-head">
                     <h3>Earning Graph</h3>
                 </div>
                 <div class="custom-bar-chart">
                     <ul class="y-axis">
                         <li><span>100</span></li>
                         <li><span>80</span></li>
                         <li><span>60</span></li>
                         <li><span>40</span></li>
                         <li><span>20</span></li>
                         <li><span>0</span></li>
                     </ul>
                     <div class="bar">
                         <div class="title">JAN</div>
                         <div class="value tooltips" data-original-title="80%" data-toggle="tooltip" data-placement="top">80%</div>
                     </div>
                     <div class="bar ">
                         <div class="title">FEB</div>
                         <div class="value tooltips" data-original-title="50%" data-toggle="tooltip" data-placement="top">50%</div>
                     </div>
                     <div class="bar ">
                         <div class="title">MAR</div>
                         <div class="value tooltips" data-original-title="40%" data-toggle="tooltip" data-placement="top">40%</div>
                     </div>
                     <div class="bar ">
                         <div class="title">APR</div>
                         <div class="value tooltips" data-original-title="55%" data-toggle="tooltip" data-placement="top">55%</div>
                     </div>
                     <div class="bar">
                         <div class="title">MAY</div>
                         <div class="value tooltips" data-original-title="20%" data-toggle="tooltip" data-placement="top">20%</div>
                     </div>
                     <div class="bar ">
                         <div class="title">JUN</div>
                         <div class="value tooltips" data-original-title="39%" data-toggle="tooltip" data-placement="top">39%</div>
                     </div>
                     <div class="bar">
                         <div class="title">JUL</div>
                         <div class="value tooltips" data-original-title="75%" data-toggle="tooltip" data-placement="top">75%</div>
                     </div>
                     <div class="bar ">
                         <div class="title">AUG</div>
                         <div class="value tooltips" data-original-title="45%" data-toggle="tooltip" data-placement="top">45%</div>
                     </div>
                     <div class="bar ">
                         <div class="title">SEP</div>
                         <div class="value tooltips" data-original-title="50%" data-toggle="tooltip" data-placement="top">50%</div>
                     </div>
                     <div class="bar ">
                         <div class="title">OCT</div>
                         <div class="value tooltips" data-original-title="42%" data-toggle="tooltip" data-placement="top">42%</div>
                     </div>
                     <div class="bar ">
                         <div class="title">NOV</div>
                         <div class="value tooltips" data-original-title="60%" data-toggle="tooltip" data-placement="top">60%</div>
                     </div>
                     <div class="bar ">
                         <div class="title">DEC</div>
                         <div class="value tooltips" data-original-title="90%" data-toggle="tooltip" data-placement="top">90%</div>
                     </div>
                 </div>-->
                <!--custom chart end-->
            </div>
            <div class="col-lg-12">
                <!--new earning start-->
                <!--  <div class="panel terques-chart">
                      <div class="panel-body chart-texture">
                          <div class="chart">
                              <div class="heading">
                                  <span>Friday</span>
                                  <strong>$ 57,00 | 15%</strong>
                              </div>
                              <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,564,455]"></div>
                          </div>
                      </div>
                      <div class="chart-tittle">
                          <span class="title">New Earning</span>
                          <span class="value">
                              <a href="#" class="active">Market</a>
                              |
                              <a href="#">Referal</a>
                              |
                              <a href="#">Online</a>
                          </span>
                      </div>
                  </div>-->
                <!--new earning end-->

                <!--total earning start-->
                <!-- <div class="panel green-chart">
                     <div class="panel-body">
                         <div class="chart">
                             <div class="heading">
                                 <span>June</span>
                                 <strong>23 Days | 65%</strong>
                             </div>
                             <div id="barchart"></div>
                         </div>
                     </div>
                     <div class="chart-tittle">
                         <span class="title">Total Earning</span>
                         <span class="value">$, 76,54,678</span>
                     </div>
                 </div>-->
                <!--total earning end-->
            </div>
        </div>


    </section>
</section>
<!--main content end-->
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Attendance Picture</h4>
            </div>
            <div class="modal-body">

                <img id="pro_img" width=100%;height=auto; />

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                <!-- <button class="btn btn-success" type="button">Submit</button>-->
            </div>
        </div>
    </div>
</div>
<!-- modal -->
<script type="text/javascript">


    function showImg(img_name) {
        var url = "<?php echo $base_url . "/public/uploads/attendance/"; ?>" + img_name;
        //alert("uuu");
        $("#pro_img").attr("src", url);
        $("#myModal").modal();
    }
</script>