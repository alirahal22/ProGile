@extends('Dashboard/layout')

@section('title', 'Statistics')

@section('content')

<?php
$number = array(1,4,5,4,2,1,3,1,2,3,1,5,4);

?>

<script type="text/javascript">
    function drawShape(array,x,y,size,isDrawCircles){

    var canvas = document.querySelector('#MyCanvas').getContext('2d'),side = 0,
    len = array.length;

    var newX,newY,X,Y,D;
    var newArray = new Array();
    canvas.beginPath();
    canvas.moveTo(x + size * Math.cos(0), y + size * Math.sin(0));
    for (side; side < len; side++) {
        X = x + size * Math.cos(side * (Math.PI - (len-2) * Math.PI / (len)));
        Y =  y + size * Math.sin(side * (Math.PI - (len-2) * Math.PI / (len)));
        canvas.lineTo(X,Y);
        if(isDrawCircles){
            canvas.strokeText("Quest " + (side+1),X,Y);
            D = Math.sqrt(Math.pow((x + size * Math.cos(side * 2 * Math.PI / (len-1)) - 250),2) + Math.pow((y + size * Math.cos(side * 2 * Math.PI / (len-1)) - 250),2));
            newX = x - (((array[side]*D)/5)*(x - X))/D;
            newY = y - (((array[side]*D)/5)*(y - Y))/D;
            newArray.push(newX,newY);
        }
    }
        canvas.closePath();
        canvas.stroke();

        if(isDrawCircles)
            return newArray;
    }

function drawPoly(poly,stroke){
    var canvas=document.getElementById("MyCanvas")
    var ctx = canvas.getContext('2d');
    ctx.beginPath();
    ctx.moveTo(poly[0], poly[1]);
    for( item=2 ; item < poly.length-1 ; item+=2 ){ctx.lineTo( poly[item] , poly[item+1] )}
    ctx.closePath();
    ctx.strokeStyle = stroke;
    ctx.stroke();
}

function SpiderGraph(array,centerX,centerY,size,stroke){
    drawShape(array,centerX,centerY,(size + size/2)/2+13,false);
    drawShape(array,centerX,centerY,size/2+26,false);
    drawShape(array,centerX,centerY,(size/2 + size/4)/2+7,false);
    drawShape(array,centerX,centerY,size/4-12,false);
    drawPoly(drawShape(array,centerX,centerY,size,true),stroke);
}
</script>

<div class="content">
        <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Answers Charts</h4>
                                <p class="category">Reports about your team's progress</p>
                            </div>
                            <div class="content">
                                <div class="table-full-width">
                                    <table class="table">
                                        <tbody>
                                        	
                                            <tr>
                                            	<canvas id="MyCanvas" width="600" height="600">
                                                       
                                                </canvas>

                                                <script type="text/javascript">
                                                    // var array = <?php 
                                                    // $ar = "[";
                                                    // foreach($number as $elem)
                                                    //     $ar = $ar.$elem.","; 
                                                    // $ar = rtrim($ar,",")."]";
                                                    // echo $ar;
                                                    // ?>;
                                                    // SpiderGraph(array,300,300,250,"#FF0000");
                                                </script>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="footer">
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
                
@endsection






























