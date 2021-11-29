<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            color: #d96459;
            font-family: monospace;
            font-size: 25px;
            text-align: left;

        }

        th {
            background-color: #d96459;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <table1>
        <tr>
            <th>TableNumber</th>
            
            <!-- <th>tableno</th> -->
            
         
            <th>guest</th>
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
          $conn->close();
        ?>
    </table1>
</body>
</html>