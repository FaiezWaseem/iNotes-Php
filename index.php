<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = "notes";

// Create connection
$conn = new mysqli($servername, $username, $password , $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if(isset($_GET['delete'])){
    $sno = $_GET['delete'];
    $sql = "DELETE FROM `notes` WHERE `id` = $sno";
    $result = mysqli_query($conn, $sql);
  }
 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" >

    <title>Php CRUD || Notes App</title>
  </head>
  <body >
<!-- EDit Modal -->
  <div class="modal" tabindex="-1" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form  class="mt-3"  action="index.php" method="post">
      <input type="hidden" class="form-control" id="formSno" name="sid" placeholder="write here">
        <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Title</label>
  <input type="text" class="form-control" id="formTitle" name="title" placeholder="write here">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Description</label>
  <textarea class="form-control" id="formDes" name="desc" rows="3"></textarea>
</div>
<button type="submit" class="btn btn-primary">Save changes</button>
</form >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

   <?php   include 'navbar.php';
    include 'addData.php';
    include 'UpdateData.php';
    $update = isset($_POST['sid']);
    if($update){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_title = $_POST['title'];
            $_des = $_POST['desc'];
            $_sid = $_POST['sid'];
            UpdateData($conn , $_title , $_des , $_sid );
             }
           
    }else{
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_title = $_POST['title'];
        $_des = $_POST['desc'];
        addData($conn , $_title , $_des);
         }
   } 
   ?>

   <div class="container">
       <h1 >Add a Note</h1>
   <form  class="mt-3"  action="index.php" method="post">
  <div class="mb-3">
    <label for="text" class="form-label">Notes Title</label>
    <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Notes Description</label>
    <textarea class="form-control" name="desc" id="desc" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Add</button>
</form>
   </div>

    <div class="container">
    <table class="table mb-2" id="myTable">
  <thead>
    <tr>
      <th scope="col"># id</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col"> Operations</th>
    </tr>
  </thead>
  <tbody>
    <?php
         include 'getData.php';
         getData($conn);
        ?>
  </tbody>
</table>

    </div>
    <div class="mb-5"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js" integrity="sha512-6ORWJX/LrnSjBzwefdNUyLCMTIsGoNP6NftMy2UAm1JBm6PRZCO1d7OHBStWpVFZLO+RerTvqX/Z9mBFfCJZ4A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" ></script>
     <script>
         $(document).ready( function () {
    $('#myTable').DataTable();
} );
const edits = document.getElementsByClassName('edit');
const f1 = document.getElementById('formTitle');
const f2 = document.getElementById('formDes');
const f3 = document.getElementById('formSno');
Array.from(edits).forEach((el)=>{
el.addEventListener('click' , function(e){
 let tr = e.target.parentNode.parentNode;
 let title = tr.getElementsByTagName('td')[0].innerText;
 let des = tr.getElementsByTagName('td')[1].innerText;
 let key = e.target.getAttribute('data-key');
  f1.value = title;
  f2.value = des;
  f3.value = key;
})
})
const deletes = document.getElementsByClassName('delete');
Array.from(deletes).forEach((el)=>{
el.addEventListener('click' , function(e){
 let key = e.target.getAttribute('data-key');
 if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `index.php?delete=${key}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
})
})
         </script>
  </body>
</html>