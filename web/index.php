<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<form action="index.php" method="post">
　請輸入名字: <input type="text" name="mmm" />
　<input type="submit" value="送出表單"/>
</form> 
</html>

<?php
if($_POST["mmm"]!=""){
//echo "Hello world!";
            $message =$_POST["mmm"];

            $json = file_get_contents('https://spreadsheets.google.com/feeds/list/12Evtrm0J6V4W6jKgfhlj4HSSNABOHYiuscq6i83jEg0/oi3ucld/public/values?alt=json');
            $data = json_decode($json, true);
            $result = 'fail';
            
             foreach ($data['feed']['entry'] as $item) {
                 
                if(is_numeric($message))
                    $keywords = $item['gsx$no']['$t'];
                else
                    $keywords = $item['gsx$name']['$t'];
                 
                 //如果找出的name=輸入的message
               
                    if ($message==$keywords) {
                        
                        $result = "資料尋找完畢.... <br><br>#正心螞蟻布登記#<br>";                      
                        $result .= "No.".$item['gsx$no']['$t']."<br>";
                        $result .= "名字: ".$item['gsx$name']['$t']."<br><br>";
                        
                        $result .="<委託項目><br>";
                        if( $item['gsx$cbs']['$t']!="" || $item['gsx$cws']['$t']!="" || $item['gsx$bdis']['$t']!="" ||$item['gsx$wdis']['$t']!="" || $item['gsx$petticoat']['$t']!="")
                        {       
                            if($item['gsx$cbs']['$t']!="") $result .="藍底黃蟻裙 ".$item['gsx$cbs']['$t']."件<br>";
                            if($item['gsx$cbu']['$t']!="") $result .="藍上衣 ".$item['gsx$cbu']['$t']."件<br>";
                            
                            if($item['gsx$cws']['$t']!="") $result .="白底紅蟻裙 ".$item['gsx$cws']['$t']."件<br>";
                            if($item['gsx$cwu']['$t']!="") $result .="白上衣 ".$item['gsx$cws']['$t']."件<br>";
                            if($item['gsx$cru']['$t']!="") $result .="紅上衣 ".$item['gsx$cws']['$t']."件<br>";
                
                            
                            if($item['gsx$bdis']['$t']!="") $result .="藍底黃蟻識別帶 ".$item['gsx$bdis']['$t']."個<br>";
                            if($item['gsx$wdis']['$t']!="") $result .="白底紅蟻識別帶 ".$item['gsx$wdis']['$t']."個<br>";
                            
                            if($item['gsx$petticoat']['$t']!="") $result .="蓬蓬裙 ".$item['gsx$petticoat']['$t']."個<br>";
                            
                            if($item['gsx$ssize']['$t']!="") $result .="裙子尺寸 ".$item['gsx$ssize']['$t']."<br>";
                            if($item['gsx$usize']['$t']!="") $result .="上衣尺寸 ".$item['gsx$usize']['$t']."<br>";
                            $result .="<br>";
   
                        }
                        else
                            $result .="無<br><br>";
                        
                        $result .="<自製項目><br>";
                        if( $item['gsx$bant']['$t']!="" || $item['gsx$want']['$t']!="")
                        {
                            if($item['gsx$bant']['$t']!="") $result .="藍底黃蟻布 ".$item['gsx$bant']['$t']."碼<br>";
                            if($item['gsx$want']['$t']!="") $result .="白底紅蟻布 ".$item['gsx$want']['$t']."碼<br>";
                            if($item['gsx$nb']['$t']!="")   $result .="藍素布 ".$item['gsx$nb']['$t']."碼<br>";
                            if($item['gsx$nw']['$t']!="")   $result .="白素布 ".$item['gsx$nw']['$t']."碼<br>";
                            if($item['gsx$nr']['$t']!="")   $result .="紅素布 ".$item['gsx$nr']['$t']."碼<br>";
                        }
                        else
                            $result .="無<br>";
                        
                        $result .= "<br>金額: ".$item['gsx$money']['$t']."<br>";
                        if($item['gsx$paid']['$t']!="")  
                            $result .= "繳費: ".$item['gsx$paid']['$t']."<br>";
                        else
                            $result .= "繳費:Non <br>";
                        $result .= "備註:\n".$item['gsx$other']['$t']."<br>";
                       
                
                        break;
                }
             }
           
 
              echo $result;

}

?>

