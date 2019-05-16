<form action="index.php" method="post">
　請輸入名字: <input type="text" name="mmm" />
　<input type="submit" value="送出表單"/>
</form> 

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
                        
                        $result = "資料尋找完畢.... \n\n#正心螞蟻布登記#\n";                      
                        $result .= "No.".$item['gsx$no']['$t']."\n";
                        $result .= "名字: ".$item['gsx$name']['$t']."\n\n";
                        
                        $result .="<委託項目>\n";
                        if( $item['gsx$cbs']['$t']!="" || $item['gsx$cws']['$t']!="" || $item['gsx$bdis']['$t']!="" ||$item['gsx$wdis']['$t']!="" || $item['gsx$petticoat']['$t']!="")
                        {       
                            if($item['gsx$cbs']['$t']!="") $result .="藍底黃蟻裙 ".$item['gsx$cbs']['$t']."件\n";
                            if($item['gsx$cbu']['$t']!="") $result .="藍上衣 ".$item['gsx$cbu']['$t']."件\n";
                            
                            if($item['gsx$cws']['$t']!="") $result .="白底紅蟻裙 ".$item['gsx$cws']['$t']."件\n";
                            if($item['gsx$cwu']['$t']!="") $result .="白上衣 ".$item['gsx$cws']['$t']."件\n";
                            if($item['gsx$cru']['$t']!="") $result .="紅上衣 ".$item['gsx$cws']['$t']."件\n";
                
                            
                            if($item['gsx$bdis']['$t']!="") $result .="藍底黃蟻識別帶 ".$item['gsx$bdis']['$t']."個\n";
                            if($item['gsx$wdis']['$t']!="") $result .="白底紅蟻識別帶 ".$item['gsx$wdis']['$t']."個\n";
                            
                            if($item['gsx$petticoat']['$t']!="") $result .="蓬蓬裙 ".$item['gsx$petticoat']['$t']."個\n";
                            
                            if($item['gsx$ssize']['$t']!="") $result .="裙子尺寸 ".$item['gsx$ssize']['$t']."\n";
                            if($item['gsx$usize']['$t']!="") $result .="上衣尺寸 ".$item['gsx$usize']['$t']."\n";
                            $result .="\n";
   
                        }
                        else
                            $result .="無\n\n";
                        
                        $result .="<自製項目>\n";
                        if( $item['gsx$bant']['$t']!="" || $item['gsx$want']['$t']!="")
                        {
                            if($item['gsx$bant']['$t']!="") $result .="藍底黃蟻布 ".$item['gsx$bant']['$t']."碼\n";
                            if($item['gsx$want']['$t']!="") $result .="白底紅蟻布 ".$item['gsx$want']['$t']."碼\n";
                            if($item['gsx$nb']['$t']!="")   $result .="藍素布 ".$item['gsx$nb']['$t']."碼\n";
                            if($item['gsx$nw']['$t']!="")   $result .="白素布 ".$item['gsx$nw']['$t']."碼\n";
                            if($item['gsx$nr']['$t']!="")   $result .="紅素布 ".$item['gsx$nr']['$t']."碼\n";
                        }
                        else
                            $result .="無\n";
                        
                        $result .= "\n金額: ".$item['gsx$money']['$t']."\n";
                        if($item['gsx$paid']['$t']!="")  
                            $result .= "繳費: ".$item['gsx$paid']['$t']."\n";
                        else
                            $result .= "繳費:Non \n";
                        $result .= "備註:\n".$item['gsx$other']['$t']."\n";
                       
                
                        break;
                }
             }
           
 
              echo $result;

}

?>

