<?php

    function addData($conn , $title , $des){
        $sql = "INSERT INTO notes (title, description)
        VALUES ('$title' , '$des')";
        if($title !== '' && $des !== '' ){
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Note Added</strong> Record Added Successfully.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
              } else {
                  echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                  <strong>Error</strong> Record Adding Failure
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
              }
        }else{
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Empty Submission</strong> Please Enter Something To Submit.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }
     
    }
?>