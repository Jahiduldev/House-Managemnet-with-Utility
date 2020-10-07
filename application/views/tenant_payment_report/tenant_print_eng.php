<!DOCTYPE html>
<html lang="en">
<head>
  <title>Invoice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet"  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
      p{
        margin: 0!important;
        padding: 0!important;
    }

    div{
      margin-top: 3px;

    }
 /* .bor{border: 1px solid}*/


     .b{
       border: 1px solid gray;
      background: #EFF0F0;
     /* margin-left: 1%;*/
      padding: 6px;
      font-weight: bold;
     }

     p{
     /*  margin-left: 5%;*/
      font-weight: bold;
      font-size: 10px;
      }
    .headP{ font-size: 14px; }
   


@media print {
    .b {
       
        border: 1px solid gray;
        background: #EFF0F0 !important;
      /*  margin-top: 2%;*/
        font-weight: bold;
        -webkit-print-color-adjust: exact; 
  
    }


.pull{margin-right:10px; margin-left:20px;}
}



  </style>
</head>
<body>

<div class="container""> 
  

  <div class="row">
        <?php foreach($clinet_payments as $data){ 
		
               
			   $this->db->where('id', $data->clinet_id);
			   $result_1 = $this->db->get('house_client')->result();
			   
			   foreach ($result_1 as $row_add):
			   
					$result_2 = $this->db->query("select * from add_house where id='$data->hid' ")->result();
					
            ?>
		 <div class="col-xs-6" style="margin-left: -15px">
		  
			 <img src="<?=base_url()?>public/img/only_logo.png" style="width: 100%">   
		 </div>
      
      <div class="col-xs-6 headP">
       <div class="pull-right">
            <?php foreach ($result_2 as $dataa) { ?>
                                     
                              
           <img src="<?=base_url()?>public/img/reciept_logo.png">
           <P>HOUSE NAME:<?=$dataa->house_name?></P>
            
           <P>ADDRESS: <?php echo $dataa->address;?></P>
           
            <?php } ?>
           <p>DATE:<?php 
                                  			   
			   if($row_add->mont=='')
				  {
					  $month = '';
				  }
				  else
				  {
				  $date = explode('/',$row_add->mont);
				  $month = date("F", mktime(0, 0, 0, $date[0], 10));
				  $month = $month.','.$date[1];
				  echo date('d/m/Y');
			   
				  }
                   ?></P>
				   <p style="font-size:14px; float:right">SPACE CODE : <?=$row_add->code?></p> 
        </div>

     </div>
    
  </div>

  <div class="row b">
    <div class="col-xs-6"><p>TENENT NAME: <?=$row_add->client_name;?> </p></div>
    <div class="col-xs-3"><p>TENANTS ID:<?=$row_add->client_id; ?></p></div>
     
    <div class="col-xs-3"><p>MONTH:<?= $month ?></p></div>
  </div>

  <div class="row 3">
    <div class="col-xs-4"><p>RENT & CHARGES</p></div>
    <div class="col-xs-4"><p>UTILITY BILLS</p></div>
    <div class="col-xs-4"><p>SUMMARY</p></div>
  </div>

  <div class="row">

    <div  class="col-xs-4">
      <div class="row" >
         <div class="b"><p>House Rent:<span class="pull-right pull"><?=$data->rent; ?> TK</span></p></div>
         <div class="b"><p>Garage Rent:<span class="pull-right pull"><?=$data->garage; ?> TK</span></p></div>
         <div class="b"><p>Services Charge:<span class="pull-right pull"><?=$data->service; ?> TK</span></p></div>
         <div class="b"><p>Monthly Amount:<span class="pull-right pull"><?=$data->rent+$data->garage+$data->service; ?> TK</span></p></div>
         <div class="b"><p>Previous Arrears:<span class="pull-right pull"><?=$row_add->pre_due; ?> TK</span></p></div>
         <div class="b"><p>SUB TOTAL:<span class="pull-right pull"> <?= $housetotal = $data->rent + $row_add->pre_due + $data->garage + $data->service; ?> TK</span></p></div>

     </div> 
    </div>

    <div class="col-xs-4">
     <div class="row">
	 
       <div class="b"><p>Electricity BILL:<span class="pull-right pull"><?= $data->electrict ?> TK</span></p></div>
       <div class="b"><p>Water Supply BIll:<span class="pull-right pull"><?= $data->water ?> TK</span></p></div>
       <div class="b"><p>Gas Supply BIll:<span class="pull-right pull"><?= $data->gas ?> TK</span></p></div>
       <div class="b"><p>Monthly Amount:<span class="pull-right pull"><?= $data->electrict + $data->water + $data->gas?> TK</span></p></div>
       <div class="b"><p>Previous Arrears:<span class="pull-right pull"><?= $row_add->pre_uti_due ?> TK</span></p></div>
       <div class="b"><p>SUB TOTAL: <span class="pull-right pull"><?= $utitytotal = $data->electrict+$data->water+$data->gas+$row_add->pre_uti_due?> TK</span></p></div>
	</div>
    </div>
    <div class="col-xs-4">
     <div class="row">
	 
       <div class="b"><p>Fine:<span class="pull-right pull"><?= $data->late ?> TK</span></p></div>
       <div class="b"><p>Total:<span class="pull-right pull"><?= $data->total ?> TK</span></p></div>
       <div class="b"><p>Payment:<span class="pull-right pull"><?= $data->pay_amount ?> TK</span></p><br></div>
       <div class="b"><p>Curr.Arrears:<span class="pull-right pull"><?= $Arrears = $data->current_due+$data->utility_due;  ?> TK</span></p><br></div>
      
      </div> 
    </div>

  </div>
  <div class="row">

     <div class="col-xs-8">
       <div class=" row b"><p>NOTE:<?=$data->note?></p><br></div>
     </div>
     <div class="col-xs-4">
         <div class="row b"><p>DESCO Meter Reading:(<?php echo $data->cu."-".$data->pu; ?>) = <?php echo $data->cu - $data->pu.'x'.$row_add->elec_rate;?></p><br></div>
     </div> 
  </div>
  <div class="row">

     <div class="col-xs-4">

       <div class=" row b"><p>Advance amount:<span class="pull-right pull"><?php echo $row_add->advance ?>TK</span></p></div>
       <p>Received by:<?php echo $this->session->userdata('user_name'); ?></p>
	 <br>

	 <br>
	 
		 <p>signature</p>
		 <div style="border-top: 2px dotted black;"></div>    
     </div>

     <div class="col-xs-4">

           <div  class=" row " >
               <div style="height: 100px; border:1px solid black; border-radius: 25px;margin-left: 5px; margin-right: 5px" ><center style="font-size:10px">Authorised Seal and Date</center></div>
           </div>
     </div>

     <div class="col-xs-4">

       <div class=" ow">
        <div class="pull-right"> 
           <p>
            <b>REG:
                <?php 

                    $reg =  $row_add->code; 
                    $code = explode("-",$reg);

                    $FirstCode =  strtoupper($code[0]);
                    $date =  $row_add->date; 
                    $d = date_parse_from_format("Y-m-d", $date);
                    
                    $year =  $d["year"]%1000;
                    $month =  $d["month"];
                    $day = $d["day"];
                    $day += 305;
                    echo $reccode = $FirstCode.date('my').$data->id;                    
               ?>
            </b></p>
           <?php 
 
              foreach ($result_2 as $dataa) { 
              $result_3 = $this->db->query("select * from employee where id='$dataa->emp_id' ")->result();             
              foreach ($result_3 as $result_3_data) { 

            ?> 

				<h6><b>HOUSE MANAGER:<?=$result_3_data->emp_name?>, Mob: <?=$result_3_data->mobile_number?></b></h6>
		   <?php }
		   } ?>
           <br>
           <p><b>CALL FOR RENT/INQUERY:</b></p>
           <P><b>+88 0255050509</b></P>
           <P><b>+88 01747837226,+088 01715053223</b></P>
        </div>


       </div>
      
     </div>
     <div class="col-xs-4">
       <div class="" style="border-radius: 25px;"></div>
     </div>    
  </div>

  <br>
  <div class="row" style="border-top: 2px dotted black;">
    
  </div>


</div>

<div class="container""> 
  

  <div class="row">
        
     <div class="col-xs-6" style="margin-left: -15px">
     
        <img src="<?=base_url()?>public/img/only_logo.png" style="width: 100%">
		 

       
     </div>
      
      <div class="col-xs-6 headP">
        <div class="pull-right">
            <?php foreach ($result_2 as $dataa) { ?>
           <img src="<?=base_url()?>public/img/reciept_logo.png">
           <P>HOUSE NAME:<?=$dataa->house_name;?></P>
           <P>ADDRESS: <?php echo $dataa->address;?></P>
           <p>DATE:<?php 
		   if($row_add->mont=='')
				  {
					  $mont = '';
				  }
				  else
				  {
			   $date = explode('/',$row_add->mont);
				  $mont = date("F", mktime(0, 0, 0, $date[0], 10));
				  $mont = $mont.','.$date[1];
				  echo date('d/m/Y');
				  }
		  ?></p>
		  <p style="font-size:14px;float:right">SPACE CODE : <?=$row_add->code?></p> 
          <?php } ?>
        </div>  

     </div>
    
  </div>

  <div class="row b">
    <div class="col-xs-6"><p>TENENT NAME: <?=$row_add->client_name;?> </p></div>
    <div class="col-xs-3"><p>TENANTS ID:<?=$row_add->client_id ?></p></div>
    
    <div class="col-xs-3"><p>MONTH:<?= $mont ?></p></div>
  </div>

  <div class="row 3">
    <div class="col-xs-4"><p>RENT & CHARGES</p></div>
    <div class="col-xs-4"><p>UTILITY BILLS</p></div>
    <div class="col-xs-4"><p>SUMMARY</p></div>
  </div>

  <div class="row">

    <div  class="col-xs-3">
      <div class="row" >
         <div class="b"><p>House Rent:<span class="pull-right pull"><?=$data->rent?> TK</span></p></div>
         <div class="b"><p>Garage Rent:<span class="pull-right pull"><?=$data->garage?> TK</span></p></div>
         <div class="b"><p>Services Charge:<span class="pull-right pull"><?=$data->service?> TK</span></p></div>
         <div class="b"><p>Monthly Amount:<span class="pull-right pull"><?=$data->rent+$data->garage+$data->service;?> TK</span></p></div>
         <div class="b"><p>Previous Arrears:<span class="pull-right pull"><?=$row_add->pre_due?> TK</span></p></div>
         <div class="b"><p>SUB TOTAL:<span class="pull-right pull"> <?=$data->rent+$row_add->pre_due+$data->garage+$data->service;?> TK</span></p></div>

     </div> 
    </div>

    <div class="col-xs-3">
     <div class="row">
       <div class="b"><p>Electricity BILL:<span class="pull-right pull"><?=$data->electrict?> TK</span></p></div>
       <div class="b"><p>Water Supply BIll:<span class="pull-right pull"><?=$data->water?> TK</span></p></div>
       <div class="b"><p>Gas Supply BIll:<span class="pull-right pull"><?=$data->gas?> TK</span></p></div>
       <div class="b"><p>Monthly Amount:<span class="pull-right pull"><?=$data->electrict+$data->water+$data->gas?> TK</span></p></div>
       <div class="b"><p>Previous Arrears:<span class="pull-right pull"><?=$row_add->pre_uti_due?> TK</span></p></div>
       <div class="b"><p>SUB TOTAL: <span class="pull-right pull"><?=$data->electrict+$data->water+$data->gas+$row_add->pre_uti_due?> TK</span></p></div>

     </div>
    </div>
    <div class="col-xs-3">
     <div class="row">
      <div class="b"><p>Fine:<span class="pull-right pull"><?=$data->late?> TK</span></p></div>
       <div class="b"><p>Total:<span class="pull-right pull"><?=$data->total?> TK</span></p></div>
       <div class="b"><p>Payment:<span class="pull-right pull"> <?=$data->pay_amount?> TK</span></p><br></div>
       <div class="b"><p>Curr.Arrears:<span class="pull-right pull"><?= $Arrears ?> TK</span></p><br></div>
      
      </div> 
    </div>
    <div class="col-xs-3">
     <div class="row">
       <div class="b"><p>Advance amount:<span class="pull-right pull"><?php echo $row_add->advance ?> TK</span></p></div>
       <div> 
        <p>Reg :
        <?php echo $reccode; ?></p><br>
        <p>Received by : <?php echo $this->session->userdata('user_name');?></p>
        <br>
        <p>Signature</p>
      <div style="border-top: 2px dotted black;" ></div>
      </div>
       <div> 
          <div  class=" row " >
             <div style="height:65px; border:1px solid black; border-radius: 25px;margin-left: 18px; margin-right: 15px" ><center style="font-size:10px">Tenants Signature and Date</center></div>
         </div>
       </div>

      </div> 
    </div>

  </div>
  <div class="row">

     <div class="col-xs-6">
       <div class="row b"><p>NOTE:<?=$data->note?></p><br></div>
     </div>
     <div class="col-xs-6">
         <div class="row b"><p>DESCO Meter Reading :(<?php echo $data->cu."-".$data->pu;
		  ?>) = <?php echo $data->cu - $data->pu.'x'.$row_add->elec_rate;?></p><br></div>
     </div> 
     
  </div>
  
  </div>

 

</div>

<?php  endforeach;  } ?>

 <script type="text/javascript">
        window.print();
 </script>
</body>
</html>