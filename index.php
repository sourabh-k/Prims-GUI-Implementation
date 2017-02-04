<!DOCTYPE html>
<html>
    <head>
    <script type="text/javascript" src="jquery.1.10.2.js"></script>
    <script type="text/javascript" src="../jquery.line.js"></script>
    <link rel="stylesheet" href="default_css.css">
        <script type="text/javascript"></script>
        <style>
            .top{
                width:100%;
                height:100px;
                background-color: white;
                color: black;
                text-align: center;
                margin-top:-20px;
                font-size:30px;
            }
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
                background-color:pink;
            }
        body{
            margin:0px auto;
        }
        </style>
    </head>
<body>
    <div class="top">
        <h1> Calculate MSP Using Prims Algorithm</h1>
    
    </div>
    <div id="right" onmousedown="WhichButton(event)">   
    </div>
    <div id='left'>
    
    </div>

<p><strong>Note:</strong> The which property is not supported in IE8 and earlier versions.</p>
    </body>
<script>
 
    var tempX = 0;
    var tempY = 0;
    var IE = document.all?true:false
    if (!IE) document.captureEvents(Event.MOUSEMOVE)
    var x = new Array();
    var y = new Array();
    var flag=1;
    var v1=0;
    var v2=0; 
    var r=0;
    var c=0;
    var k=0;
    var clk=0
    var id1,id2;
    var s1= new Array();
    var s2 = new Array();
    var str="";
    var s="";
    var ci =new Array();
    var ck=0;
    function edge(val)
    {
        if(flag==0)
            {
              clk++;
                //alert("clicked");
                if(clk==1)
                  id1=val;
                if(clk==2)
                    {
                        id2=val;
                        clk=0;
                        createedge();      
                    }  
            }
    }
    function createedge()
    {
      s1[r]=parseInt(id1.substr(2,id1.length-2));
       s2[r]=parseInt(id2.substr(2,id2.length-2));
        var f_u=0;
        for(i=0;i<r;i++)
            {
                if((s1[i]==s1[r] && s2[i]==s2[r] )||(s1[i]==s2[r] && s2[i]==s1[r]) )
                    f_u=1;
            }
        if(s1[r]!=s2[r] && f_u==0)
        {
      $('#right').line(x[s1[r]]+15,y[s1[r]]+15,x[s2[r]]+15,y[s2[r]]+15, {color:"white",stroke:3,zindex:0});
      var tb="<form method='post' action='cal.php' onsubmit='return check()'><table border='0' width='400px'><th> V1</th> <th> V2 </th> <th> Cost</th>";
      str="";
      var tb1="<tr><td><input name='"+v1+"'></td><td> <input name='"+v2+"'></td><td><input name='"+c+"'></td></tr>";
      str=str.concat(tb); 
      v1=v2=0;
            c=0;
      for(i=0;i<=r;i++)
            {
              tb1="<tr><td><input name='v"+v1+"' value='"+s1[i]+"'></td><td> <input name='vv"+v2+"' value='"+s2[i]+"'></td><td><input onclick='hello("+this.c+")' name='c"+c+"'></td></tr>";
               str=str.concat(tb1);
                v1++; 
                v2++;
                c++;
            }
        var lst="<tr align='center'><td colspan='3'><input name='sub' type='submit' value='Submit'> </td></tr>";
        var op1="<tr><td><input type='text' name='edge' style='display:none;' value='"+r+"'</td></tr><tr><td><input type='text' name='vet' style='display:none;' value='"+k+"'</td></tr></table> </form>";
        var op2="<tr><td><input type='text' value='"+JSON.stringify(x)+"'name='x' style='display:none;'></td></tr>"
        var op3="<tr><td><input type='text' value='"+JSON.stringify(y)+"'name='y' style='display:none;'></td></tr>"
        var op4="<tr><td><input type='text' value='"+JSON.stringify(s1)+"'name='s1' style='display:none;'></td></tr>"
        var op5="<tr><td><input type='text' value='"+JSON.stringify(s2)+"'name='s2' style='display:none;'></td></tr>"
        //var op6="<tr style='display:none;'><td><input type='text' value='"+s+"'name='s3' style='display:none;'></td></tr>"
        lst=lst+op2+op3+op4+op5+op1;
        str=str.concat(lst)
        document.getElementById('left').innerHTML=str;
            //alert(s);
        r++;                                                                            
        }
    }
    function hello(c)
    {
      for(i=0;i<=r;i++)
            {
               $('#right').line(x[s1[i]]+15,y[s1[i]]+15,x[s2[i]]+15,y[s2[i]]+15, {color:"white",stroke:3,zindex:ck});
            }
      $('#right').line(x[s1[c]]+15,y[s1[c]]+15,x[s2[c]]+15,y[s2[c]]+15, {color:"black",stroke:3,zindex:ck+1});
        ck++;
        
    }
    function check()
    {
        if(ck<c)
           {
               alert("Weight all edges");
               //alert(ck+" "+c)
                return false;
           }
        else
            return true;
    }
    function create()
    {
        s="";
       for(i=0;i<=k;i++)
            { 
                var d="<div id='pd"+i+"' onclick='edge(this.id)' style='width:30px;height:30px;position:absolute;background-color:teal;border-radius:50%;color:black;text-align:center;font-size:150%;z-index:60'>"+i+"</div>";
               s=s.concat(d);
            }
        document.getElementById('right').innerHTML=s;
        for(i=0;i<=k;i++)
            {
                var fu='pd'+i;
                e1=document.getElementById(fu)
                e1.style.backgroundColor='white';
               e1.style.left=x[i]+'px';
               e1.style.top=y[i]+'px';
            }
        k++;
        return true;
    }
function WhichButton(event) {
    if(event.which==1 && flag==1)
        {
            if (IE) {     
    tempX = event.clientX + document.body.scrollLeft
    tempY = event.clientY + document.body.scrollTop
  } else { 
    tempX = event.pageX;
    tempY = event.pageY;
  }  
  if (tempX < 0){tempX = 0}
  if (tempY < 0){tempY = 0} 
            var f2=1
            var ev=20;
            var t1=parseInt(tempX);
            var t2=parseInt(tempY);
            for(i=0;i<k;i++)
                {
                    var t3=parseInt(x[i]);
                    var t4=parseInt(y[i]);
                    if(Math.abs(eval(t1-t3))<50 && Math.abs(eval(t2-t4))<50)
                      {
                          f2=0;
                          break;
                      }
                }
                if(f2==1)        
     {
          x[k]=tempX-15;
      y[k]=tempY-15;
        var ret=create();
     }
        }
    else      {
            flag=0;
        }
    
}
    </script>
    </html>