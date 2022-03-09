<?php
session_start();
//include("header.php");
//include("config.php");
// session_destroy();
?>


<!DOCTYPE html>
<html>

<head>
	<title>
		To-Do
	</title>
	<link href="style.css" type="text/css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

<div class="container">
            <h2>TODO LIST</h2>
            <h3>Add Item</h3>
            <p>
                <input id="new-task" type="text"><button id='add' >Add</button><button id='update'>Update</button>
            </p>
    
            <h3>Todo</h3>
            <ul id="incomplete-tasks">
                <div id='disp' ></div>
            </ul>
    
            <h3>Completed</h3>
            <ul id="completed-tasks">

            <div id='disp2' ></div>
            </ul>
        </div>
	
	<script>





  
var len;
var  jsonArr = [];
$(document).ready(function(){
$('#update').hide();
	
$('#add').on('click',function(){
    var w =document.getElementById('new-task').value;
   
	
   $.ajax({
       url : 'functions.php',
       type : 'POST',
       datatype : 'JSON',
       data : {
              w:w,
          
           "action" : "add"
        }
   }).done(function(data){
         jsonArr = JSON.parse(data);
        
         display(jsonArr);
  
}) 

});

})

function display(jArr){
var html = "<table>";
    for(let i = 0; i<jArr.length ; i++){
        len = jArr.length
	    html += "<tr><td><input type = checkbox id='"+i+"' onclick='complete("+parseInt([i])+")' ></td><td>"+jArr[i]+"</td><td></td><td><button id='"+i+"' onclick='edit("+parseInt([i])+")' > Edit</button><td><button id='"+i+"' onclick='remove("+parseInt([i])+")' > Delete</button></td></tr>";
    }
html += "</table>";
 document.getElementById('disp').innerHTML= html ;

 }

function complete(id){
    
    $.ajax({
        url : "functions.php",
        type : "POST",
        datatype : "JSON",
        data : {
            id : id ,
            "action" : "comp"
        }
    }).done(function(data2){
        var jsonArr2 = JSON.parse(data2);
        displaycomp(jsonArr2);
       for(let i =0; i<jsonArr.length;i++){
        
           if (id == i){
            console.log(id);
             
               jsonArr.splice(i,1);
               display(jsonArr);
           }
       }
    
    })
}
function displaycomp(compjArr){
var html1 = "<table>";
    for(let i = 0; i<compjArr.length ; i++){
	    html1 += "<tr><td><input type = checkbox id='"+i+"' onclick='redo("+parseInt([i])+")' checked></td><td>"+compjArr[i]+"</td><td></td><td><button id='"+i+"' onclick='editcomp("+parseInt([i])+")'> Edit</button><td><button id='"+i+"' onclick='editcomp("+parseInt([i])+")' > Delete</button></td></tr>";
    }
html1 += "</table>";
 document.getElementById('disp2').innerHTML= html1 ;

 }

 function remove(removeid){
     console.log(removeid);
    $.ajax({
        url : "functions.php",
        type : "POST",
        datatype : "JSON",
        data : {
            removeid : removeid ,
            "action" : "remove"
        }
    }).done(function(data3){
         jsonArr = JSON.parse(data3);
         display(jsonArr);
         
  
    })
 }

 var updateid;
 function edit(editid){
    $('#update').show();
    $('#add').hide();
     for (var i = 0; i < len; i++) {
             if(i == editid){
               
                 $('#new-task').val(jsonArr[i]);
                 updateid = i;
             }
            }
                 $('#update').on('click',function(){
                     $('#add').show();
                     $('#update').hide();
                     console.log(updateid);
                     var uptask= $('#new-task').val();
                     $.ajax({
                         url : "functions.php",
                         type : "POST",
                         datatype : "JSON",
 
                       data:{
                            upid : updateid,
                         uptask : uptask,
                        "action" : "update"
                       }
                         }).done(function(data4){
                              jsonArr = JSON.parse(data4);
                              display(jsonArr);
                            
                         })
                 })
               
             
           
 
 }


</script>




</body>
</html>



