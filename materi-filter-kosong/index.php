<?php
include "config.php";
$getEmployees = "SELECT CONCAT(firstName, '', lastName) AS `name`, email, jobTitle FROM employees";
$employees = mysqli_query($config, $getEmployees);

$total_data = mysqli_num_rows($employees);

$batas = 10;
$total_page = ceil($total_data / $batas);

$mulai = 0;
$no = 1; 
$start = (isset($_GET['p'])) ? ($_GET['p'] * $batas)-$batas : 0;
if ($start){
    $no += $start;
}
$getEmployees = "SELECT CONCAT(firstName, ' ', lastName) AS `name`, email, jobTitle FROM employees LIMIT $start, $batas";
$employees = mysqli_query($config, $getEmployees);

if (isset($_GET['query'])){
    $query = $_GET['query'];
    $employees = mysqli_query($config, "SELECT CONCAT(firstName, ' ', lastName) AS `name`, email, jobTitle FROM employees WHERE
    firstName LIKE '%$query%' OR
    lastName LIKE '%$query%' OR
    email LIKE '%$query%' OR
    jobTitle LIKE '%$query%'");

    $total_data = mysqli_num_rows($employees);
    $total_page = ceil($total_data / $batas);
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto my-5">
                <form action="" class="d-flex align-items-center justify-content-center">
                    <!-- <div class="d-flex mb-4">
            <input type="date" class="form-control" name="start">
            <input type="date" class="form-control" name="end">
          </div> -->
                    <input type="text" class="form-control mb-4" name="query" placeholder="Search ...">
                    <input type="submit" class="btn btn-primary mb-4 ms-3" value="Search">
                </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Job Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($employees as $employee): ?>
                        <tr>
                            <td scope="row"><?=$no++?></td>
                            <td><?=$employee['name']?></td>
                            <td><?=$employee['email']?></td>
                            <td><?=$employee['jobTitle']?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for($i=1; $i <= $total_page; $i++): ?>
                            <li class="page-item"><a class="page-link" href="?p=<?=$i?>"><?=$i?></a></li>
                        <?php endfor; ?>
                        <li class="page-item">

                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>