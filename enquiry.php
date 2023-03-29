<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body style="margin: 10px;">
    <h1>Available Enquiries</h1>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Enquiry Person</th>
                <th>Organisation</th>
                <th>Mobile Number</th>
                <th>Service ID</th>

                <th style="padding:14px;" class="pb-2"><?php echo " Details" ?></th>
            </tr>

        </thead>
        <a style="margin-left:60%; margin-top:-110px; border-radius:20px" class='btn btn-primary mb-4' href='enquiry_form.php'><i class="fa-solid fa-circle-plus"></i> Add Enquiry</a>
        <a style="margin-left:71%; margin-top:-158px; background-color:#04aa6d; border-color:#04aa6d; border-radius:20px;" class=' btn btn-primary mb-4' href='index.php'> <i class="fa-sharp fa-solid fa-circle-arrow-left"></i> Back</a>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "enquiryproj";

            // Create connection
            $connection = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            // read all row from database table
            $sql = "SELECT * FROM tbl_enquiry";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: " . $connection->error);
            }
            $initialID = 1;
            // read data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $initialID . "</td>
                    <td>" . $row["enquiry_person"] . "</td>
                    <td>" . $row["org_name"] . "</td>
                    <td>" . $row["mobile_no"] . "</td>
                    <td>" . $row["service_type_id"] . "</td>

                    <td>  <a href='enquiry_view.php?id=" . $row['enquiryid'] . "' class=' btn btn-primary btn-sm'><i class='fa-sharp fa-solid fa-mountain-sun'> </i> view</a>
                    </td>

                    <td>
                        <a href='enquiry_update_form.php?id=" . $row['enquiryid'] . "' class=' btn btn-primary btn-sm'><i class='fa-solid fa-pen-to-square'></i> Update</a>
                        <a href='enquiry_delete.php?id=" . $row['enquiryid'] . "' class='del-btn btn btn-danger btn-sm'><i class='fa-solid fa-trash'></i> Delete</a>
                    </td>
                </tr>";
                $initialID++;
            }
            ?>
            <script>
                $('.del-btn').on('click', function(e) {
                    e.preventDefault();
                    const href = $(this).attr('href')
                    Swal.fire({
                        title: 'Are you sure to delete?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                            document.location.href = href;

                        }
                    })
                })

                const flashdata = $('.flash-data').data('flashdata')
                if (flashdata) {
                    swal.fire({
                        type: 'success',
                        title: 'Record Deleted',
                        text: 'Record has been deleted'
                    })
                }
            </script>
            <?php $connection->close();
            ?>
        </tbody>
    </table>
</body>

</html>
