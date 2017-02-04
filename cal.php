<html>
    <head>
    <script type="text/javascript" src="jquery.1.10.2.js"></script>
    <script type="text/javascript" src="../jquery.line.js"></script>
    <link rel="stylesheet" href="default_css.css">
        <script type="text/javascript"></script>
        <style>
        #right{
            width:800px;
            height: 700px;
            float:left;
            background-color:teal;
          //  margin: 0px auto;
            //margin-top: 0px;
        }
            #left{
                //width:400px;
                height:700px;
                float: left;
                //background-color:pink;
            }
        body{
            margin:0px auto;
        }
            .recheck{
                background-color: teal;
                width:200px;
                float:left;
                margin-left:190px;
                height:100px;
                text-align: center;
                font-size: 40px;
                text-decoration: none;
                color: aliceblue;
                margin-top: 280px;
                
                
            }
            .recheck span{
                margin-top:100px;
            }
        </style>
    </head>
<body>
    <div id="right">   
       
    </div>
    <div id='left'>
    
        <a href="index.php" class="recheck"><span>Calculate Again</span></a>
    </div>
    </body>
</html>
<?php
$e=$_REQUEST['edge'];
$v=$_REQUEST['vet'];
$x=json_decode($_REQUEST['x']);
$y=json_decode($_REQUEST['y']);
$s1=json_decode($_REQUEST['s1']);
$s2=json_decode($_REQUEST['s2']);
   // echo $e." ".$v."<br>";
   // echo $s1[0]." ".$s2[0]."<br>";
    if($_REQUEST['sub'])
    {
       for($i=0;$i<$v;$i++)
        {
            for($j=0;$j<$v;$j++) 
            {
               if($i==$j)
                   $c[$i][$j]=0;
                else
                    $c[$i][$j]=100;
            }
        }
         for($i=0;$i<=$e;$i++)
        {
            $v1=$_REQUEST['v'.$i];
            $v2=$_REQUEST['vv'.$i];
            $c[$v1][$v2]=$_REQUEST['c'.$i];
            $c[$v2][$v1]=$c[$v1][$v2];
            
        }
       // $c[$v][$v]=0;
        $mini=0;
        $minj=0;
        $flag=0;
        for($i=0;$i<$v;$i++)
        {
            for($j=0;$j<$v;$j++) 
            {
               if(($c[$i][$j]<$c[$mini][$minj] && $i!=$j) || ($flag==0 && $i!=$j))
               {
                   $mini=$i;
                   $minj=$j;
                   $flag=1;
               }
            }
            //echo "<br>";
        }
       $ii=0;
        for($i=0;$i<$v;$i++)
        {
             if($c[$i][$mini]<$c[$i][$minj])
            $near[$i]=$mini;
        else
            $near[$i]=$minj;
        }
         $near[$mini]=$near[$minj]=-1;
    $t[$ii][0]=$mini;
    $t[$ii][1]=$minj;
    $ii++;
        $k=0;
        $sk=-1;
        $fc=$c[$mini][$minj];
       for($i=1;$i<$v;$i++)
    {
        $flag=0;
       for($j=0;$j<$v;$j++) 
        {
           if($near[$j]!=$sk)
           {
            if(($c[$j][$near[$j]]<$k && $near[$j]!=$sk &&  $j!=$near[$j]) || ($flag==0 && $j!=$near[$j] && $near[$j]!=$sk))
                {
                    $k=$j;
                    $flag=1;
                }
           }
        }
       //  $fc+=$c[$k][$near[$k]];
         $t[$ii][0]=$k;
         $t[$ii][1]=$near[$k];
         $near[$k]=-1;
          // $fc+=$c[$k][$near[$k]];
          for($j=0;$j<$v;$j++) 
         {
             if($near[$j]!=$sk)
             {
                 if($c[$j][$near[$j]]>$c[$j][$k])
                    $near[$j]=$k;
             }
         }
         $ii++;
    }  
         $s="";
        for($i=0;$i<$v;$i++)
        {
            $d="<div id='pd".$i."' style='width:30px;height:30px;position:absolute;background-color:teal;border-radius:50%;color:black;text-align:center;font-size:150%;z-index:6'>".$i."</div>";
            $s=$s.$d;
        }
        echo $s;
     //for($i=0;$i<$v;$i++)
        $i=0;
        for($i=0;$i<$v;$i++)
            {
              $fu="pd$i";
               // echo $fu;
             echo  "<script>
             e1=document.getElementById('".$fu."');
             //alert(e1);
                e1.style.backgroundColor='white';
                e1.style.left='".$x[$i]."px';
                e1.style.top='".$y[$i]."px';
                </script>";
            }
        for($i=0;$i<=$e;$i++)
        {
            $x1=$x[$s1[$i]]+15;
            $y1=$y[$s1[$i]]+15;
            $x2=$x[$s2[$i]]+15;
            $y2=$y[$s2[$i]]+15;
          //  echo $x1." ".$x2."<br>";
            echo "<script> $('#right').line(".$x1.",".$y1.",".$x2.",".$y2.", {color:'white',stroke:2,zindex:4});</script>";
        }
        echo "<br>";
        for($i=0;$i<$v-1;$i++)
        {
             $x1=$x[$t[$i][0]]+15;
            $y1=$y[$t[$i][0]]+15;
            $x2=$x[$t[$i][1]]+15;
            $y2=$y[$t[$i][1]]+15;
           // echo $x1." ".$x2."<br>";
            echo "<script> $('#right').line(".$x1.",".$y1.",".$x2.",".$y2.", {color:'red',stroke:3,zindex:6});</script>";
        }
       // echo $fc;
    }
?>