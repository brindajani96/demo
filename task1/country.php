<?php
session_start();
if(isset($error))
{
 ?>
    <tr>
    <td id="error"><?php echo $error; ?></td>
    </tr>
    <?php
} 
?><html>
<head>
​
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script> 
​
<style>
.error {color: #FF0000;}
.request {text-align: center;}
</style>
</head>
<body>
  <div class="container">
    <div class="request"><h3 class="register-heading">Country Details</h3></div>
    <div class="row"> 
        <div class="float-center"><button  type="button" class="btn btn-primary" id="add"><span class="glyphicon glyphicon-plus"></span></button></div>
    </div>
    </body>
</html>
​
        <!-- form for insert -->
​
    <form action="name.php" method="POST" id="contry_form" name="country">
​
        <div class="row" >
                <div class="col-sm-6">
                    <label for="Name">Country Name:</label> 
                    <span class="error">* <?php echo $nameErr;?></span>
                    <input type="text" autocomplete="off" class="form-control country_validate" id="countryname[0]"
                    placeholder="Enter country Name" name="countryname[0]" value="<?php if(isset($countryname['0'])){echo $countryname['0'];} ?>" <?php if(isset($code) && $code == 1){ echo "autofocus"; }  ?> />
                    <label for="student_name">Student Name:</label> 
                    <span class="error">* <?php echo $nameErr;?></span>
                    <input type=text name="student_name[0]"  autocomplete="off" id="student_name"data-validation="length" class="form-control country_validate""/>
                </div>
        </div>
                <div class="form-group">
                    <div  id="dynamic">   
                    </div>
                </div>
                <div class="form-group">
                   <button class="btn btn-success" id="submit" value="submit" name="submit" type="submit">Insert</button>
                      <br/>
                      <br/>
                </div>
              
        
    </form>
​
        <!-- form for search -->
​
    <form method="post" id="country_search_form" name="country_search">
        <div class="row">
            <div  class="col-sm-6" id="example">
                 <br /><br />
                 <label for="Name">Search Country:</label>
                 <input type="text" name="country_search" id="country_search" class="form-control search_validate" autocomplete="off" placeholder="Type Country Name" />
                 <br/>
                 <input class="btn btn-primary" type="submit" name="submit" value="Search"/>
                 <br />
            </div>
        </div>
    </form>
​
<div class="container">   
                <div class="table-responsive" id="pagination_data">  
                </div>  
​
</div>
​
</div> 
​
        <!-- client side validation -->
​
<script>
​
        // Validation for insert
​
    $('#contry_form').validate({ // initialize the plugin
        // other options
    });
​
    $.validator.addClassRules({
        country_validate: {
            required: true
        }
    });  
​
        // Validation for searching
​
    $('#country_search_form').validate({ // initialize the plugin
        // other options
    });
​
    $.validator.addClassRules({
        search_validate: {
            required: true
        }
    });  
        // Add dynamic data
​
    var plus = "0";
    $("#add").click(function () {
        plus++;
        $("#dynamic").append(
            '<div class="row" id="number">'+
                '<div class="col">'+
                    '<label for="Name">country Name:</label>'+
                    '<span class="error">* <?php echo $nameErr;?></span>'+
                    '<input type="text" class="form-control country_validate" autocomplete="off" id="countryname['+plus+']" placeholder="Enter Country Name" name="countryname['+plus+']"data-validation="custom required" data-validation-regexp="^([A-Za-z]+)$" data-validation-error-msg="Only Alphabetic Character Allow">'+
                '</div>' +
                '<div class="col mt-4">'+
                    '<div>'+
                        '<label></label>'+
                        '<button type="button" name="remove" id="'+plus+'" class="btn btn-danger removeProduct"><span class="glyphicon glyphicon-minus"></button>'+
                    '</div>'+
                '</div>'+
            '</div>'
            );
​
        //For Remove Add field Button
​
        $(".removeProduct").click(function(){
            $(this).parents("#number").remove();
        });
        $('form').submit(function () {
            var countryname = document.getElementById("countryname[]");
        });
    });
</script>
​
           
        <!-- Script for searching -->
​
<script>
$(document).ready(function(){
 
 $('#country_search').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"fetch.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
   })
  }
 });
 
});
</script>
​
        <!-- script for pagination -->
​
 <script>  
 $(document).ready(function(){  
      load_data();  
      function load_data(page)  
      {  
           $.ajax({  
                url:"pagination.php",  
                method:"POST",  
                data:{page:page},  
                success:function(data){  
                     $('#pagination_data').html(data);  
                }  
           })  
      }  
      $(document).on('click', '.pagination_link', function(){  
           var page = $(this).attr("id");  
           load_data(page);  
      });  
 });  
 </script> 
​
​
 <!-- <script>
    $(document).ready(function () {
        $('#submit').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "fetch.php",
                    data: 'query=' + query,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
​
                    }
                });
            }
        });
    });
</script> -->
​
<script type="text/javascript">  
            function totalelements()  
              {  
                var allgenders=document.getElementByName("countryname[0]");
                alert("!Oops Country Name Not Null:");  
              }  
</script> 
​
<!-- <script>
​
     $(function(){
      console.log("hii");
      readRecords(); 
    });
​
​
    function readRecords() {
      var readRecords = "readRecords";
      $.post({
        url: 'name.php',
        type: 'post',
        data: {readRecords:readRecords},
        success: function(data, status){
          $('#records_content').html(data)
​
        }
      })
    }
​
    function addRecords() {
      var countryname[] = $('#countryname').val();
​
​
      $.post({
        url: 'name.php',
        type: 'post',
        data: {countryname[]:countryname[]},
        success:function(data, status) {
          readRecords();
        }
      });
      
    }
</script> -->