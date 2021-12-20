<?php
    function getData($conn){
            
        $sql = "SELECT * FROM notes";
        $result = $conn->query($sql);
        
        if (mysqli_num_rows($result)  > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            $_title = $row["title"];
            $_des = $row["description"];
            $_id = $row["id"];

           echo  "
           <tr>
           <th scope='row'>$_id</th>
           <td>$_title</td>
           <td> $_des</td>
           <td> 
           <button type='button'  class='btn btn-primary edit' data-key='$_id' data-bs-toggle='modal' data-bs-target='#editModal'>Edit</button>
           <button type='button'   data-key='$_id' class='btn btn-danger delete'>Delete</button>
           </td>
           </tr>
           "   ;
          }
        } else {
        
        }
    }

        ?>