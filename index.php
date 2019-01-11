<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
      <title>Rectangle Packing</title>
   </head>
   <body>
      <div class="container">
         <br>
         <div class="row">
            <div class="col-sm" align="center">
               <div class="alert alert-primary" role="alert">
                  Creat a new project
               </div>
               <form method='POST' action='result.php'>
                  <div class="input-group mb-3">
                     <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Project name</span>
                     </div>
                     <input type="text" name="name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required autofocus>
                  </div>
                  <div class="card">
                     <div class="card-header">Enter the height and width of the rectangle</div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col">
                              <input type="text" name="yuk" class="form-control" placeholder="Height" required autofocus>
                           </div>
                           <div class="col">
                              <input type="text" name="gen" class="form-control" placeholder="Width" required autofocus>
                           </div>
                        </div>
                     </div>
                  </div>
                  <br>
                  <div class="card">
                     <div class="card-header">Enter the desired size (H x W)</div>
                     <div class="card-body">
                        <div class="input-group control-group after-add-more">
                           <input type="text" name="boyut[]" class="form-control" placeholder="Height"  required autofocus>
                           <div class="input-group-btn"></div>
                           <input type="text" name="boyut[]" class="form-control" placeholder="Width"  required autofocus>
                           <div class="input-group-btn">
                              <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> &#xA0;Add &#xA0; &#xA0; &#xA0;</button>
                           </div>
                        </div>
                        <br>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                     </div>
                  </div>
               </form>
               <!-- Copy Fields -->
               <div class="copy d-none">
                  <div class="control-group input-group" style="margin-top:10px">
                     <input type="text" name="boyut[]" class="form-control" placeholder="Height" required autofocus>
                     <div class="input-group-btn"></div>
                     <input type="text" name="boyut[]" class="form-control" placeholder="Width" required autofocus>
                     <div class="input-group-btn">
                        <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-sm" align="center">
               <?php
                  require_once("database.php");
                              $result = mysqli_query($conn,"SELECT  `name` FROM `table`");
                           ?>
               <div class="alert alert-primary" role="alert">
                  Open a saved project
               </div>
               <form method="post" name="city" action="getfromdb.php">
                  <div class="input-group">
                     <select class="custom-select" name="name" id="inputGroupSelect04" aria-label="Example select with button addon">
                        <option selected>Choose...</option>
                        <?php
                           foreach ($result as $row) {
                           $name = $row["name"];
                           ?>
                        <option value="<?php echo $name ?>">
                           <?php echo  $name ?>
                        </option>
                        <?php
                           }?>
                     </select>
                     <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Submit</button>
                     </div>
                  </div>

				</form>
            </div>
         </div>
      </div>
      <script type="text/javascript">
         $(document).ready(function() {
         
             $(".add-more").click(function() {
                 var html = $(".copy").html();
                 $(".after-add-more").after(html);
             });
         
             $("body").on("click", ".remove", function() {
                 $(this).parents(".control-group").remove();
             });
         
         });
      </script>
   </body>
</html>
