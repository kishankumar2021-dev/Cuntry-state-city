<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        #outer {
            height: 300px;
            padding: 20px;
            margin-left: 500px;
            margin-top: 40px;
        }

        .star {
            color: red;
        }

        #dashbox {
            height: 50px;
            line-height: 50px;
            background-color: forestgreen;
        }

        table {
            margin-top: 5px;
            margin-left: 350px;
            text-align: center;
        }
    </style>
</head>

<body>

    <form method="post">
        <table width="50%" border="1" cellspacing="0" cellpadding="1">
            <tr>

                <th>FristName</th>
                <th>lastName</th>
                <th>Age</th>
                <th>Country</th>
                <th>state</th>
                <th>City</th>
                <th>Image</th>


            </tr>


    </form>
    <div id="dashbox">

        <h5><a href="show.php" style="float:left; margin-left:10px;">Show All Record</a></h5>
        <h5>
            <p style="float:left;margin-left:500px;color:white;">Viwe student records</p>
        </h5>
        


    </div>

    <?php


    include('config.php');

    $id = $_GET['id'];

    $query = "SELECT * FROM `student` WHERE id='$id'";

    $run = mysqli_query($conn, $query);

    $row = mysqli_num_rows($run);



    while ($data = mysqli_fetch_assoc($run)) {


    ?>


        <td><?php echo $data['fname']; ?></td>
        <td><?php echo $data['lname']; ?></td>
        <td><?php echo $data['age']; ?></td>
        <td><?php echo $data['country']; ?></td>
        <td><?php echo $data['state']; ?></td>
        <td><?php echo $data['city']; ?></td>
        <td><img src="img/<?php echo $data['file']; ?>" style="max-width:100px;" /> </td>


        </tr>
    <?php
    }
    ?>
    </table>


</body>

</html>