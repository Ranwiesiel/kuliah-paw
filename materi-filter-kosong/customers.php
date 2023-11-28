<?php
include "config.php";
$getCustomers = "SELECT customerName, phone, country FROM customers";
$customers = mysqli_query($config, $getCustomers);

$total_data = mysqli_num_rows($customers);

$batas = 10;
$total_page = ceil($total_data / $batas);

$mulai = 0;
$no = 1; 
$start = (isset($_GET['p'])) ? ($_GET['p'] * $batas)-$batas : 0;
if ($start){
    $no += $start;
}
$getCustomers = "SELECT customerName, phone, country FROM customers LIMIT $start, $batas";
$customers = mysqli_query($config, $getCustomers);


$getCountry = "SELECT country FROM customers GROUP BY country";
$countries = mysqli_query($config, $getCountry);

if (isset($_GET['country'])){
    $country = $_GET['country'];
    $getCustomers = "SELECT customerName, phone, country FROM customers WHERE country = '$country'";
    $customers = mysqli_query($config, $getCustomers);
    $total_data = mysqli_num_rows($customers);
    $total_page = ceil($total_data / $batas);
}

$no = 1;

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
                    <select class="form-select mb-4" aria-label="Default select example" name="country">
                        <option selected disabled>-- SELECT COUNTRY --</option>
                        <?php foreach($countries as $country): ?>
                        <option value="<?=$country['country']?>">
                            <?=$country['country']?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" class="btn btn-primary mb-4 ms-3" value="Search">
                </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Country</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($customers as $customers) { ?>
                        <tr>
                            <th scope="row">
                                <?php echo $no++ ?>
                            </th>
                            <td>
                                <?php echo $customers['customerName'] ?>
                            </td>
                            <td>
                                <?php echo $customers['phone'] ?>
                            </td>
                            <td>
                                <?php echo $customers['country'] ?>
                            </td>
                        </tr>
                        <?php } ?>
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