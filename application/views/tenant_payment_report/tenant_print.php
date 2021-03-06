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
      padding: 5px;
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
        <?php foreach($clinet_payments as $data){ ?>
           <?php 
                $this->db->where('id', $data->clinet_id);
                $result_1 = $this->db->get('house_client')->result();
                
                foreach ($result_1 as $row_add): 
                $result_2 = $this->db->query("select * from add_house where id='$data->hid' ")->result();
            ?>
     <div class="col-xs-6" style="margin-left: -15px;">
      
         <img src="<?=base_url()?>public/img/only_logo.png" style="width: 100%">
		
      
      
     </div>
      
     <div class="col-xs-6 headP">
       <div class="pull-right">
           
		   <?php foreach ($result_2 as $dataa) { ?>                                
                              
           <img src="<?=base_url()?>public/img/reciept_logo.png">
           <P>HOUSE NAME:<?=$dataa->house_name?></P>
            
           <p>ADDRESS: <?php echo $dataa->address; ?></p>
           <?php } ?>
                  <p>তারিখ:<?php 
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
        </div>
     </div>
    
  </div>

  <div class="row b">
    <div class="col-xs-6"><p>ভাড়াটিয়ার নাম: <?=$row_add->client_name;?> </p></div>
    <div class="col-xs-3"><p>TENANTS ID:<?=$row_add->client_id; ?></p></div>    
    <div class="col-xs-3"><p>মাস:<?= $mont ?></p></div>
  </div>

  <div class="row 3">
    <div class="col-xs-4"><p>ভাড়া এবং মূল্যসমুহ </p></div>
    <div class="col-xs-4"><p>পরিসেবা বিল সমুহ</p></div>
    <div class="col-xs-4"><p>সারসংক্ষেপ</p></div>
  </div>

  <div class="row">

    <div  class="col-xs-4">
      <div class="row" >
         
		 <div class="b"><p>বাড়ি ভাড়া:<span class="pull-right pull"><?=$data->rent?>  টাকা</span></p></div>
         <div class="b"><p>গ্যারেজ ভাড়া:<span class="pull-right pull"><?=$data->garage?>  টাকা</span></p></div>
         <div class="b"><p>সার্ভিস মুল্য:<span class="pull-right pull"><?=$data->service?>  টাকা</span></p></div>
         <div class="b"><p>মাসের মোট:<span class="pull-right pull"><?=$data->rent+$data->garage+$data->service; ?>  টাকা</span></p></div>
         <div class="b"><p>পূর্বের বকেয়া:<span class="pull-right pull"><?=$row_add->pre_due ?>  টাকা</span></p></div>
         <div class="b"><p>মোট:<span class="pull-right pull"><?= $housetotal = $data->rent+$row_add->pre_due+$data->garage+$data->service;?>  টাকা</span></p></div>
		</div> 
    </div>

    <div class="col-xs-4">
     <div class="row">
       <div class="b"><p>বিদ্যুৎ বিল:<span class="pull-right pull"><?=$data->electrict?> টাকা</span></p></div>
       <div class="b"><p>পানি বিল:<span class="pull-right pull"><?=$data->water?> টাকা</span></p></div>
       <div class="b"><p>গ্যাস বিল:<span class="pull-right pull"><?=$data->gas?> টাকা</span></p></div>
       <div class="b"><p>মাসের মোট:<span class="pull-right pull"><?=$data->electrict+$data->water+$data->gas?> টাকা</span></p></div>
       <div class="b"><p>পূর্বের বকেয়া :<span class="pull-right pull"><?=$row_add->pre_uti_due?> টাকা</span></p></div>
       <div class="b"><p>মোট: <span class="pull-right pull"><?= $utitytotal = $data->electrict+$data->water+$data->gas+$row_add->pre_uti_due?> টাকা</span></p></div>

     </div>
    </div>
    <div class="col-xs-4">
     <div class="row">
	 
       <div class="b"><p>জরিমানা :<span class="pull-right pull"><?=$data->late?> টাকা</span></p></div>
       <div class="b"><p>সর্বমোট:<span class="pull-right pull"><?=$data->total?> টাকা</span></p></div>
       <div class="b"><p>পরিশোধ :<span class="pull-right pull"><?=$data->pay_amount?> টাকা</span></p><br></div>
       <div class="b"><p>বর্তমান বকেয়া:<span class="pull-right pull"><?= $data->current_due + $data->utility_due;  ?> টাকা</span></p><br></div>      
      </div> 
    </div>

  </div>
  <div class="row">

     <div class="col-xs-8">
       <div class="row b"><p>মন্তব্য:<?=$data->note?></p><br></div>
     </div>
     <div class="col-xs-4">
          <div class="row b"><p>ডেসকো মিটার রিডিং:(<?php echo $data->cu."-".$data->pu;
		  ?>) = <?php echo $data->cu - $data->pu.'x'.$row_add->elec_rate;?></p><br>
		  </div>
     </div> 
  </div>
  <div class="row">

     <div class="col-xs-4">

       <div class=" row b"><p>অগ্রিম টাকা:<span class="pull-right pull"><?php echo $row_add->advance ?> টাকা</span></p></div>
       
        
<br>

<br>
      <p>গ্রহিতা: <?php echo $this->session->userdata('user_name');?></p>
      
       
<br>

<br>
     <p> স্বাক্ষর  </p>
     <div style="border-top: 2px dotted black;"></div>
    
     </div>

     <div class="col-xs-4">

       <div  class=" row " >
           <div style="height: 100px; border:1px solid black; border-radius: 25px;margin-left: 5px; margin-right: 5px" ><center style="font-size:10px">আনুমোদিত সীল এবং তারিখ</center></div>
       </div>
       
      
    
     </div>

     <div class="col-xs-4">

       <div class=" ow">
        <div class="pull-right"> 
           <p>
			<b>রসিদ নং:
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

            <h6><b>বাড়ির ম্যানেজার:<?=$result_3_data->emp_name?><br>

মোবা: <?=$result_3_data->mobile_number?></b></h6>
             <?php } } ?>
           <br>
           <p><b>ভাড়ার জন্য কল/অনুসন্ধান কারুনঃ</b></p>
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
           <P>HOUSE NAME:<?=$dataa->house_name?></P>
           
            <P>ADDRESS: <?php echo $dataa->address; ?></P>
           <p>তারিখ:<?php 
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
                   ?></P>
          <?php } ?>
		  <p style="font-size:14px;float:right">SPACE CODE : <?=$row_add->code?></p> 
        </div>  

     </div>
    
  </div>

  <div class="row b">
    <div class="col-xs-6"><p>ভাড়াটিয়ার নাম: <?=$row_add->client_name;?> </p></div>
    <div class="col-xs-3"><p>TENANTS ID:<?=$row_add->client_id; ?></p></div>
    
    <div class="col-xs-3"><p>মাস:<?= $mont; ?></p></div>
  </div>

  <div class="row 3">
    <div class="col-xs-4"><p>ভাড়া এবং চার্জ</p></div>
    <div class="col-xs-4"><p>পরিসেবা বিল সমুহ</p></div>
    <div class="col-xs-4"><p>সারসংক্ষেপ</p></div>
  </div>

  <div class="row">

    <div  class="col-xs-3">
      <div class="row" >
         <div class="b"><p>বাড়ি ভাড়া:<span class="pull-right pull"><?=$data->rent?> টাকা</span></p></div>
         <div class="b"><p>গ্যারেজ ভাড়া:<span class="pull-right pull"><?=$data->garage?> টাকা</span></p></div>
         <div class="b"><p>সার্ভিস চার্জ:<span class="pull-right pull"><?=$data->service?> টাকা</span></p></div>
         <div class="b"><p>মাসের মোট:<span class="pull-right pull"><?=$data->rent+$data->garage+$data->service; ?> টাকা</span></p></div>
         <div class="b"><p>পূর্বের বকেয়া:<span class="pull-right pull"><?=$row_add->pre_due ?>  টাকা</span></p></div>
         <div class="b"><p>মোট:<span class="pull-right pull"><?= $housetotal = $data->rent+$row_add->pre_due+$data->garage+$data->service;?>  টাকা</span></p></div>
         
         

     </div> 
    </div>

    <div class="col-xs-3">
     <div class="row">
       <div class="b"><p>বিদ্যুৎ বিল:<span class="pull-right pull"><?=$data->electrict?> টাকা</span></p></div>
       <div class="b"><p>পানি বিল:<span class="pull-right pull"><?=$data->water?> টাকা</span></p></div>
       <div class="b"><p>গ্যাস বিল:<span class="pull-right pull"><?=$data->gas?> টাকা</span></p></div>
       <div class="b"><p>মাসের মোট:<span class="pull-right pull"><?=$data->electrict+$data->water+$data->gas?> টাকা</span></p></div>
       <div class="b"><p>পূর্বের বকেয়া :<span class="pull-right pull"><?=$row_add->pre_uti_due?> টাকা</span></p></div>
       <div class="b"><p>মোট: <span class="pull-right pull"><?= $utitytotal = $data->electrict+$data->water+$data->gas+$row_add->pre_uti_due?> টাকা</span></p></div>
       
       

     </div>
    </div>
    <div class="col-xs-3">
     <div class="row">
      <div class="b"><p>জরিমানা :<span class="pull-right pull"><?=$data->late?> টাকা</span></p></div>
       <div class="b"><p>সর্বমোট:<span class="pull-right pull"><?=$data->total?> টাকা</span></p></div>
       <div class="b"><p>পরিশোধ :<span class="pull-right pull"><?=$data->pay_amount?> টাকা</span></p><br></div>
       
       <div class="b"><p>বর্তমান বকেয়া:<span class="pull-right pull"><?= $data->current_due + $data->utility_due;  ?> টাকা</span></p></div>
      
      </div> 
    </div>
    <div class="col-xs-3">
     <div class="row">
       <div class="b"><p>অগ্রিম টাকা:<span class="pull-right"></span><?php echo $row_add->advance ?> টাকা</span></p></div>
       <div>  
        <p>রসিদ নং: <?php echo $reccode; ?></p>
		<br>
		 <p>গ্রহিতা: <?php echo $this->session->userdata('user_name');?></p>
        <br>
        <p>স্বাক্ষর</p>
      <div style="border-top: 2px dotted black;" ></div>
      </div>
       <div> 
          <div  class=" row " >
             <div style="height:75px; border:1px solid black; border-radius: 25px;margin-left: 18px; margin-right: 15px" ><center style="font-size:10px">ভাড়াটিয়ার স্বাক্ষর এবং তারিখ</center></div>
         </div>
       </div>

      </div> 
    </div>

  </div>
  <div class="row">

     <div class="col-xs-6">
       <div class="row b"><p>মন্তব্য:<?=$data->note?></p><br></div>
     </div>
     <div class="col-xs-6">
          <div class="row b"><p>ডেসকো মিটার রিডিং:(<?php echo $data->cu."-".$data->pu;
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