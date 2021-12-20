<?php

    function UpdateData($conn , $title , $des , $sid){
        $_id = (int) $sid;
        $sql = "UPDATE notes SET title='$title', description='$des'  WHERE `notes`.`id`= $_id ";
        if( $title !== '' && $des !== '' ){
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Note Update</strong> Record Update Successfully.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
              } else {
                  echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                  <strong>Error</strong> Record Updating Failure
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