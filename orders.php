<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: flex;
            flex-direction: row;
           justify-content: space-between;
        }
        table {
            /* border-collapse: collapse; */
            width: 50%;
            color: #d96459;
            font-family: monospace;
            font-size: 25px;
            text-align: left;

        }

        

        th {
            background-color: #d96459;
            color: white;
            height: 20px;
        }
        
        
        
        tr:nth-child(even) {
            background-color: #f2f2f2;
            height: 20px;
        }

        

        
    </style>
</head>
<body>
    <table>
        <tr>
            <th>id</th>
            <th>quantity</th>
            
        </tr>
        <?php
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_NAME', 'orders');
        
        // Try connecting to the Database
        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        
          
          if ($conn-> connect_error) {
              die("connection failed:".$conn-> connect_error);
          }
          $sql =  "SELECT id, quantity from orders";
          
          $result = $conn-> query($sql);
        if($result->num_rows>0) {
             while($row = $result-> fetch_assoc()) {
                  echo "<tr><td>".$row["id"]."</td><td>".$row["quantity"]."</td></tr>";
                  
              }
         }
        else{
            echo "0 result";
        }

        
        

          $conn->close();
        ?>
    </table>
    <table>
        <tr>
            <th>TableNumber</th>
            
            <!-- <th>tableno</th> -->
            
         
            <th>guest</th>
        </tr>
        <?php
       
        
       $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
          
          $sql =  "SELECT TableNumber, guest from guestenter";

          $result = $conn-> query($sql);
        if($result->num_rows>0) {
             while($row = $result-> fetch_assoc()) {
                  echo "<tr><td>".$row["TableNumber"]."</td><td>".$row["guest"]."</td></tr>";
              }
         }
        else{
            echo "0 result";
        }
        
        ?>
    </table1>
</body>
</html>