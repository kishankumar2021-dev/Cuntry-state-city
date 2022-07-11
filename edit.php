<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dynamic Dropdown List Country State City in PHP MySQL using Ajax - Tutsmake.COM</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        #dashbox {
            height: 50px;
            line-height: 50px;
            background-color: forestgreen;
        }
    </style>
</head>

<body>
    <div id="dashbox">

        <h5><a href="show.php" style="float:left; margin-left:10px;">Show Details</a></h5>
        <h5>
            <p style="float:left;margin-left:400px;color:white;">Edit student records</p>
        </h5>

    </div>
    <?php

    include('config.php');

    $id = $_GET['id'];

    $sql = "SELECT * FROM STUDENT WHERE `id`='$id'";

    $run = mysqli_query($conn, $sql);

    $data = mysqli_fetch_assoc($run);

    ?>
    <div class="container mt-5">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-success">Student Details</h2>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" id="frm" name="frm">
                        <div class="form-group">
                            <label for="state">FirstName</label><br>
                            <input class="form-control" type="text" name="fname" id="fname" value="<?php echo $data['fname'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="state">Last Name</label><br>
                            <input class="form-control" type="text" name="lname" id="lname" value="<?php echo $data['lname'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="state">Age</label><br>
                            <select class="form-control" id="age" name="age" value="">

                                <option name="age" value=" "><?php echo $data['age'] ?></option>
                                <option name="age" value="10">10</option>
                                <option name="age" value="11">11</option>
                                <option name="age" value="12">12</option>
                                <option name="age" value="13">13</option>
                                <option name="age" value="14">14</option>
                                <option name="age" value="15">15</option>
                                <option name="age" value="16">16</option>
                                <option name="age" value="17">17</option>
                                <option name="age" value="18">18</option>
                                <option name="age" value="19">19</option>
                                <option name="age" value="20">20</option>
                                <option name="age" value="21">21</option>
                                <option name="age" value="22">22</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select class="form-control" id="country-dropdown" name="country" id="country">

                                <?php
                                require_once "config.php";
                                $result = mysqli_query($conn, "SELECT * FROM country");
                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <option name="country   " value=""><?php echo $data['country']; ?></option>
                                    <option name="country   " value="<?php echo $row['id']; ?>"><?php echo $row["country"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <select class="form-control" id="state-dropdown" name="state" id="state">
                                <option name="state" id="state" value=""><?php echo $data['state'] ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <select class="form-control" id="city-dropdown" name="city" id="city">
                                <option name="state" id="state"><?php echo $data['city'] ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="state">Image</label><br>
                            <input type="file" name="simg" id="simg" value="<?php echo $data['file'] ?>">
                        </div>
                        <div class="form-group">

                            <input class="form-control" type="submit" name="submit" id="submit" value="update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#country-dropdown').on('change', function() {
                var country_id = this.value;
                $.ajax({
                    url: "state.php",
                    type: "POST",
                    data: {
                        country_id: country_id
                    },
                    cache: false,
                    success: function(result) {
                        $("#state-dropdown").html(result);
                        $('#city-dropdown').html('<option value="">Select State First</option>');
                    }
                });
            });
            $('#state-dropdown').on('change', function() {
                var state_id = this.value;
                $.ajax({
                    url: "city.php",
                    type: "POST",
                    data: {
                        state_id: state_id
                    },
                    cache: false,
                    success: function(result) {
                        $("#city-dropdown").html(result);
                    }
                });
            });
        });
    </script>


</body>

</html>

<?php
include('config.php');

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];

    $imagename = $_FILES['simg']['name'];
    $tempname = $_FILES['simg']['tmp_name'];

    move_uploaded_file($tempname, "img/" . $imagename);

    $sql = "UPDATE `student` SET `fname`='$fname',`lname`='$lname',`age`='$age',`country`='$country',`state`='$state',`city`='$city',`file`='$imagename' WHERE id='$id'";

    $run = mysqli_query($conn, $sql);
}

?>