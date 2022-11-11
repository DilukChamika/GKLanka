<?php

require_once __DIR__ . '/vendor/autoload.php';

$inverterLine = "";
$panelLine ="";
$pvmod ="";
$invtr="";
$SPhEA="";
$TrPhEA="";
$AluStruc="";
$StStruc="";
$singlePhaseEA= array();
$threePhaseEA= array();
$aluminiumStructure= array();
$steelStructure= array();

$date = $_POST['date'];
$quatNo = $_POST['quatNo'];
$cname = $_POST['cname'];
$address = $_POST['address'];
$city = $_POST['city'];
$tel = $_POST['tel'];
$cEmail = $_POST['cemail'];
$SystemCap = $_POST['sysCap'];
$Price = $_POST['Price'];
$priceDiscount = $_POST['discount'];
$panalCount = $_POST['panelcount'];
$vehicles=$_POST["vehicle"];
$inverterBrands= $_POST['inverterBrands'];
$panelBrands = $_POST['panelBrands'];
$panelPWR = $_POST['panelPower'];
$MountingPara = $_POST['mountingPara'];
$singlePhaseEA= $_POST['elecAcceSPH'];
$threePhaseEA= $_POST['elecAcceTPH'];
$aluminiumStructure = $_POST['structAlu'];
$steelStructure = $_POST['structStee'];

//background-image: url("asset/gklogo.jpg");

$mpdf = new \Mpdf\Mpdf();

$pageborder = '
<style>
@page{
	background : url(\'asset/border.jpg\') no-repeat 0 0;
	background-image-resize: 6;
}

table.titletab{
	padding-left :105px;
	text-align: center;
	font-size: 13px;
}

#table1{
	font-family: calibri;
	font-size: 13px;
}
#table2{
	font-family: calibri;
	font-size: 12px;
}

.table2head{
	background-color: #009345;
	color: white;
	font-family: calibri;
	text-align: center;
}

#tnc{
	padding-left : 15px;
	text-align: justify;
	font-size: 10px;
}

#condi{
	font-family: calibri;
	font-size: 8px;
}

#wrnty{
	border-style: dashed;
	border-width: 2px;
	padding-left : 15px;
	padding-right :15px;
	padding-top : 15px;
	text-align: justify;
	font-size: 10px;
}

#secpage{
	text-align: center;
}

#agreement{
	 background-repeat: no-repeat;
	 background-attachment: fixed;
	 background-size: 100% 100%;
}

#warrantytable{
	font-family: calibri;
	font-size: 20px;
	margin-left:auto;
	margin-right:auto;
	width: 60%;
}

#logoset{
	text-align:center;
}

#sign{
	text-align: center;
	position: absolute;
	bottom:100px;
	font-size: 13px;
	padding-left : 3%;
	padding-right : -18%;
}

#footer{
	text-align: center;
	padding-left : 6%;
	font-size: 13px;
	position: absolute;
	bottom:44px;
}


</style>
';

if($priceDiscount>0){
	$lastPrice= $Price-$priceDiscount;
	$totalPrice= "LKR ".$Price ."<br><br>Discount<br>LKR ".$priceDiscount ."<br><br><b>Total Amount</b><br>LKR ".$lastPrice;
}elseif($priceDiscount==0){
	$lastPrice= $Price;
	$totalPrice= "<br> LKR ".$Price;
}


$gklogo= '
	<img src = "asset/gklogo.jpg" height="110" >
';

$logoset = '
	<img src = "asset/logoset.jpg"  height="80px" > 
';

$warrentyIcon = '
	<img src = "asset/warranty.jpeg" width="45%">
';


$data = $pageborder;

$data .= " <br> <table class='titletab'> <tr> <td> "  .$gklogo ." </td> <td> <h1> Quatation For On Grid<br> Solar Electricity System <br>" .$SystemCap  ." </h1> </td> </tr>  </table> <hr style='color:#009345; height:5px'>";

$data .= " <table style='width:100%' id='table1'> <tr> <td> Date </td> <td> : </td> <td> " .$date ." </td> <td rowspan='8' valign='top' style='width:29%'> GK Lanka International (Pvt) Ltd <br> No: 15/1/1,Kandawatta Road, <br>  Pelawatta, Battaramulla, <br> Sri Lanka. <br> 011 4 392 425 / 0777 006 325 <br> info@gklanka.lk <br> www.gklanka.lk </td> </tr> <tr>  <td> Quatation No</td> <td> : </td> <td> <b>" .$quatNo ." </b></td> </tr> <tr> <td colspan='3'> <b><br> Valid Only For 7 (Seven) Days <br> </b>  </td> </tr> <tr> <td> Client Name </td> <td>: </td> <td> " .$cname ."</td> </tr> <tr> <td> Address </td> <td> :</td> <td> " .$address ." </td> </tr> <tr> <td> Tel </td> <td> :</td> <td> ".$tel ." </td></tr> <tr> <td> Email </td> <td> : </td> <td>".$cEmail ." </td>  </tr> </table>  
";

foreach($inverterBrands as $line1){
  	$inverterLine .= " " .$line1 .","; 
}
foreach($panelBrands as $line9){
  	$panelLine .= " " .$line9 .","; 
}

$data .= "<br> <table style='width:100%' id='table2'> <tr> <td class='table2head' colspan='4'  style='height:25px'><b> GK LANKA INTERNATIONAL PVT LTD </b></td> <td id='tnc' rowspan='11' style='width:20%'> <b> Payment Method </b> <ul> <br> <li> 75% of the total amount should be paid before installing at the system. </li> <br> <li>  20% of the rest of total amount should be paid during the installation. </li><br> <li>Remaining balance 5% will be taken soon after the connection is given by the electricity board.</li> </ul> <p id='condi'> <br> *Conditons Apply </p> <td> </tr> <tr> <td colspan='3' bgcolor='#ffa500'> System Capacity </td> <td bgcolor='#ffa500'> ". $SystemCap ." </td> </tr> <tr> <td colspan='3' bgcolor='#ffa500'> AC Voltage </td> <td bgcolor='#ffa500'> 230V </td> </tr> <tr> <td colspan='3' bgcolor='#ffa500'> AC Frequency </td> <td bgcolor='#ffa500'> 50Hz <br> </td> </tr> <tr> <td class='table2head' > Name </td> <td class='table2head' style='text-align:center'> Qty </td> <td class='table2head'> Brand(s) </td> <td class='table2head'> Amount </td> </tr> <tr> <td bgcolor='#ffa500'> Inverter </td> <td bgcolor='#ffa500' style='text-align:center'> 01 </td> <td bgcolor='#ffa500'> ". $inverterLine ." :" .$SystemCap ." inverter </td> <td rowspan='4' bgcolor='#ffa500' style='text-align:center; font-size:11px'>" .$totalPrice .".00 </td> </tr> <tr> <td bgcolor='#ffa500'> Panels </td> <td bgcolor='#ffa500' style='text-align:center'> " .$panalCount ." </td> <td bgcolor='#ffa500'>" .$panelLine ." :".$panelPWR ."W </td> </tr> <tr> <td colspan='3' bgcolor='#ffa500' style='font-size:11px; padding:6px' >" .$MountingPara ."</td> </tr> <tr> <td colspan='3' bgcolor='#009345' color='white' style='text-align:center'> Expected Monthly Generation " .($SystemCap*110) ." kWh - ".($SystemCap*130). " kWh </td> </tr> </table> <br>
";

$data .= "<div id='wrnty'> <b> Warrenty </b> <br> <br> To make any warranty claim, the purchaser shall report the defect by email or registered post within two weeks of its discovery. The full warranty period for the solar power system is 02 years from the date of the purchaser taking possession of the system This warranty covers manufacturing defects and installation defects when installation has been performed by GK LANKA INTERNATIONAL (PVT) LTD (its contractors, employees and / or authorized agents), and under normal conditions of use. <br> <br> <b> Guarantee </b>  <br> <br>The electrical output of each photovoltaic module shall never be lower than; <br> <ul> <li> For the first 10 years form the date of taking possession of the product; 90% of the specified minimum power </li> <li>  Between 10 and 25 years after the date of taking possession of the product 80% of the specified minimum power. </li> </ul> </div> <br>
";

$data .= "<div id='logoset'>".$logoset ."</div> <br> <br>";

$data .= " <div id='footer'> If You Have any Question about This Quotation, <br>Please Contact [Mr.Gayan 0777 006 325] <br> <b> Thanking for your quotation request, we pleased to give below our quotation from the above<br> as per your requirements. </b> </div>
";

$data .= "<pagebreak/>";

/////////////////////////////////////////////////////////////// SECOND PAGE //////////////////////////////////////////////////////////////////////////

$price75 = $lastPrice*0.75;
$price20 = $lastPrice*0.20;
$price5 = $lastPrice*0.05;

$data .= "<div id='secpage'>  " .$gklogo ." <h1 style='font-size:20px'> GK LANKA INTERNATIONAL (PVT) LTD </h1> No.15/1/1, Kandawatta Road, Pelawatta, Battaramulla, Sri Lanka. <br> info@gklanka.lk | www.gklanka.lk | 011 4 392 425 | 0777 006 325 <hr style='color:#009345; height:5px'> </div> ";

$data .= "<div id='agreement'> <br> This AGREEMENT is made on the " .$date .", Between GK LANKA INTERNATIONAL (PVT) LTD and other parties of " .$cname .", " .$address ." <br> <br>This agreement is valid until start the site installation process. After the site installation we’ll hand over final agreement and insurance for the system. <br> <br> <br> <b> <u> Terms & Conditions </u> </b> <ul> <li>  Here and after GK LANKA INTERNATIONAL (PVT) LTD is not allowed for verbal transactions. </li> <br> <li> All payments should be transferred via bank transfer to the bank account. </li> <br> <li> We are not responsible for any other verbal money transactions. </li> <br> <li> Bank Accounts Details - <ul style='list-style-type:none;'> <li> GK Lanka International </li> <li> Seylan Bank - Piliyandalla Branch </li> <li>0990-13297469-001 </li> </ul> </ul> <br> <b> <u> Payment Method for" .$SystemCap ."kW Solar Power System </u> </b> <br> <br> <ul> <li>  75% of the total amount LKR ".$lastPrice .".00 should be paid before installing at the system <br> – LKR ".$price75 .".00<br> </li> <br> <li> 20% of the rest of the total LKR ".$price20 .".00 should be paid during the installation. </li> <br> <li>5% Remaining Balance will be taken soon after the connection is given by the CEB, LKR " .$price5 .".00 </li> </ul> <br> <br> <b> When you made a 75% first installment within 7(seven) days, we will start our installation. <br><br> Further Apply for the CEB Clearance will charge Rs.100,000/= </b> </div> 
  ";

  $data .= "<pagebreak/>";

  /////////////////////////////////////////////////////////////// THIRD PAGE //////////////////////////////////////////////////////////////////////////

  foreach($panelBrands as $val1){
  	$pvmod .= " <li>" .$val1 ."</li>"; 
  }
  foreach($inverterBrands as $val2){
  	$invtr .= " <li>" .$val2 ."</li>"; 
  } 
  
  if(!(is_null($singlePhaseEA))){
  	$SPh= "<br> <b> Single Phase </b><br>";
	  	foreach($singlePhaseEA as $val4){
	  	$SPhEA .= " <li>" .$val4 ."</li>"; 
	  }
  }
  if(!(is_null($threePhaseEA))){
  	$TPh = "<br> <b> Three Phase </b>";
	  	foreach($threePhaseEA as $val5){
	  	$TrPhEA .= " <li>" .$val5 ."</li>"; 
	  }
  }
  if(!(is_null($aluminiumStructure))){
  	$alu = "<br> <b> Aluminum Structure </b>";
	  	foreach($aluminiumStructure as $val10){
	  	$AluStruc .= " <li>" .$val10 ."</li>"; 
	  }
  }
  if(!(is_null($steelStructure))){
  	$stee = "<br> <b> Steel Structure </b>";
	  	foreach($steelStructure as $val11){
	  	$StStruc .= " <li>" .$val11 ."</li>"; 
	  }
  }

  $data .= " <div id='usematerial'> <br> <br> <h1 style='font-size:20px; text-align:center'> USE MATERIALS FOR SOLAR POWER SYSTEM </h1><hr style='color:#009345; height:5px'> <ol> <li> <b> PV Module (Solar Panel) Brands </b> <br> <br> <ul>". $pvmod ." </ul> </li> <br> <br> <li> <b> Inverter Brands </b> <br> <br> <ul>". $invtr ." </ul> </li> <br> <br> <li> <b> Electrical Accessories </b> <br> " .$SPh ."<ul>" .$SPhEA ." </ul> <br> ". $TPh ."<ul>".$TrPhEA ."</ul> </li> <br> <li> <b> Structure </b> <br> <b>" .$alu ." </b> <br> <ul> " .$AluStruc ." </ul> <br> <b>".$stee ."</b> <br> <ul> " .$StStruc ." </ul> </li> </ol> </div>";

  $data .= "<pagebreak/>";

    /////////////////////////////////////////////////////////////// FORTH PAGE //////////////////////////////////////////////////////////////////////////


  $data .= "<div id='warrantypage' align='center'> " .$gklogo ." <hr style='color:#009345; height:5px'> <br> <br> <br><br> " .$warrentyIcon ." <br> <br> <br> <br> <table id='warrantytable'> <tr> <td style='border: 1px solid black; text-align:right; padding:6px'> Panel </td> <td style='border: 1px solid black; text-align:center; padding:6px'> 25 Years Warrenty </td> </tr> <tr> <td style='border: 1px solid black; text-align:right; padding:6px'> Inverter </td> <td style='border: 1px solid black; text-align:center; padding:6px'> 10 years Warrenty </td> </tr> <tr> <td style='border: 1px solid black; text-align:right; padding:6px'> Wiring </td> <td style='border: 1px solid black; text-align:center; padding:6px'> 10 Years Warrenty </td> </tr> <tr> <td style='border: 1px solid black; text-align:right; padding:6px'> Structure </td> <td style='border: 1px solid black; text-align:center; padding:6px'> 10 Years warranty </td> </tr> </table> </div>   
  ";

  $data .= "<div id='sign'> <table style='width:100%'> <tr> <td> ...................................................... </td> <td> ...................................................... </td> </tr> <tr> <td> " .$cname ."</td> <td> GK Lanka International (Pvt) Ltd </td> </tr> </table> </div> ";




$mpdf -> WriteHTML($data);

$mpdf -> Output($quatNo .'.pdf', 'D');




?>