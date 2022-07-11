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

        .card {
            margin-left: 400px;
            margin-top: -40px;
        }
    </style>
</head>

<body>
    <div id="dashbox">

        <h5><a href="show.php" style="float:left;line-height: 50px; margin-left:10px;">Show Details</a></h5>
        <h5>
            <p style="float:left;margin-left:400px;line-height: 50px;color:white;">Add student records</p>
        </h5>

    </div>
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
                            <input class="form-control" type="text" name="fname" id="fname" placeholder="Enter Your Frist Name">
                        </div>
                        <div class="form-group">
                            <label for="state">Last Name</label><br>
                            <input class="form-control" type="text" name="lname" id="lname" placeholder="Enter Your Last Name">
                        </div>
                        <div class="form-group">
                            <label for="state">Age</label><br>
                            <select class="form-control" id="age" name="age" value="">

                                <?php
                                for ($i = 1; $i <= 100; $i++) {
                                ?>
                                    <option name="age" id="age" valie="$i"><?php echo $i ?></option>
                                <?php
                                }


                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select class="form-control" id="country-dropdown" name="country" id="country">
                                <option name="country" id="country" value="country">Select Country</option>
                                <?php
                                require_once "config.php";
                                $result = mysqli_query($conn, "SELECT * FROM country");
                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <option name="<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>"><?php echo $row["country"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <select class="form-control" id="state-dropdown" name="state" id="state">
                                <option name="country" id="country" value="<?php echo $row['id']; ?>">Select state</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <select class="form-control" id="city-dropdown" name="city" id="city">
                                <option name="country" id="country" value="<?php echo $row['id']; ?>">Select city</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="state">Image</label><br>
                            <input type="file" name="simg" id="simg">
                        </div>
                        <div class="form-group">

                            <input class="form-control" type="submit" name="submit" id="submit">
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
                        var text = result.responseText;
                        console.log(text)
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script>
        $('#frm').validate({
            rules: {
                fname: "required",
                lname: "required",
                age: "required",
                country: "required",
                simg: "required",



            },
            messages: {
                fname: "Enter Your Fristname!!",
                lname: "Enter Your Lastname!!",
                age: "Enter Age!!",
                country: "Select country!!",
                simg: "Choose file!!",


            }
        })
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

    $sql = "INSERT INTO `student`(`fname`, `lname`, `age`, `country`, `state`, `city`, `file`)
     VALUES
      ('$fname','$lname','$age','$country','$state','$city','$imagename')";

    $run = mysqli_query($conn, $sql);
}

?>