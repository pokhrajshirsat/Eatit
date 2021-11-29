<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="delete-category.php">
    <style>
         
        .popup {
            position: relative;
            width: 80%;
            height: 80px;
            margin: auto;
            border: 1px solid #d96459;
            
        } 

        .popup p {
            position: relative;
            color: #111111;
            font-size: 36px;
            font-family: sans-serif;
            font-weight: bold;
            top: -20px ;
            padding-left: 40px;

        }

        .popup .first-button {
            position: relative;
            top: -90px;
            margin-right: 40px;
            float: right;
            background: #ff5353;
            border: none;
            border-radius: 20px;
            color: #ffffff;
            font-size: 24px;
            padding: 4px 20px;
            cursor: pointer;
        }

        .popup .first-button:hover {
            background-color: #d96459;
        }

        .popup .content {
          position: absolute;
        width: 400px;
        height: 450px;
        z-index: 2;
        left: 50%;
        margin-top: 16%;
        transform: translate(-50%,-150%) scale(0);
        background: #FFFFFF;

        border-radius: 20px;
        text-align: center;

        padding: 20px;
        box-shadow: 0px 4px 4px 4px rgba(0, 0, 0, 0.25); 
        z-index: 1;

        }

        .popup .content h1 {
 font-weight: 600;
 padding-top: 20px;
 text-align: center;
 font-size: 32px;
 padding-bottom: 10px;
 color: #232323;
}


.popup .input-field .validate {
border: 1px solid #999999;
margin-bottom: 15px;
width: 90%;
color: #232323;
background: #ffffff;
padding: 20px;
font-size: 16px;
border-radius: 10px;

outline: none;
}

.popup .input-field .image {
    position: relative;
    width: 90%;
    height: 20%;
    margin-top: 20px;
    margin-bottom: 20px;
}

.popup .second-button {
margin-top: 20px;
padding: 20px 30px;
border-radius: 40px;
border: none;
color: white;
cursor: pointer;
font-size: 18px;
font-weight: 500;
background: #FF5E5E;
box-shadow:  0px 4px 4px 4px rgba(0, 0, 0, 0.25);
transition: box-shadow .35s ease !important;
outline: none;
}

.popup .second-button:hover {
  background-color: rgba(196, 196, 196, 0);
  color: #232323;
}

.popup.second-button:active{
background: linear-gradient(145deg,#222222, #292929);
box-shadow: 0px 4px 4px 4px rgba(0, 0, 0, 0.25);
border: none;
outline: none;
}

.popup.active .content {
transition: all 300ms ease-in-out;
transform: translate(-50%,-50%) scale(1);
}


.popup .close-btn {
 color: #292929;
 font-size: 24px;
 border-radius: 50%;
 background: rgba(196, 196, 196, 0);
 border: 1px solid #292929;
 position: absolute;
 right: 20px;
 top: 20px;
 width: 30px;
 
 height: 30px;
 cursor: pointer;
 }

 .btn-danger {
     background-color: red;
     color: white;
     text-decoration: none;
     font-size: 16px;
     padding: 4px 10px;
     border-radius: 10px;
 }

 







        table {
            border-collapse: collapse;
            width: 100%;
            color: #d96459;
            font-family: monospace;
            font-size: 25px;
            text-align: left;
            margin-top: 20px;

        }

        th {
            background-color: #ff5e5e;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="popup" id="popup">
    <p>Categories</p>

        <button onclick="togglePopup()" class="first-button">Add</button>
        <div class="content">
     
      <h1>Category</h1> 
      <form action="category.php" method="post">
      <div class="input-field"><input type="text" placeholder="Enter category" name="category" class="validate"></div>
      <div class="input-field"><input type="file" placeholder="Image" name="image" class="image"></div>
      
       <button class="second-button">Add</button>
     
      </form>
   <div class="close-btn" onclick="togglePopup()">
    ×</div>
     </div>
    </div>
    <table>
        <tr>
            <th>id</th>
            <th>category</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_NAME', 'categories');
        
        // Try connecting to the Database
        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        
        if (!$conn) {
              die("connection failed:".mysqli_connect_error());
          }
          
        
          $sql = "SELECT id, category from category";
          $result = $conn-> query($sql);
          if($result->num_rows>0) {
              while($row = $result-> fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>".$row["id"]."</td>";
                  echo "<td>".$row["category"]."</td>";
                  echo "<td>
                  <div class='btn-group'>
                  <a class='btn-secondary' name='edit' href='#'>Edit</a>
                  <a class='btn-danger' name='delete' href='delete.php?id=$row[id]'>Delete</a>
              </div>
              </td>";
                  echo "</tr>";
              }
          }
          else{
              echo "0 result";
          }
          $conn->close();
        ?>

        
    </table>

    <script src="categories.js"></script>
</body>
</html>