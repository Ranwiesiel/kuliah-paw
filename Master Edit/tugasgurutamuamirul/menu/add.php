<html>
<head>
    <title>Add Users</title>
</head>
 
<body>
    <a href="index.php">Go to Home</a>
    <br/><br/>
 
    <form action="add.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Nama</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr> 
                <td>Jenis</td>
                <td>
                    <select name="jenis">
                        <option value="makanan">makanan</option>
                        <option value="minuman">minuman</option>
                    </select>
                </td>
            </tr>
            <tr> 
                <td>Harga</td>
                <td><input type="text" name="harga"></td>
            </tr>
            <tr> 
                <td>Stok</td>
                <td><input type="text" name="stok"></td>
            </tr>
            <td>Nama Penjual</td>
                <td>
                    <select name="namapenjual">
                        <?php
                    $query = mysqli_query($mysqli, "SELECT nama FROM penjual");?>

                    <?php while($isi = mysqli_fetch_assoc($query)): ?>
                    	<option value="<?php $isi['penjual']; ?>"><?php $isi['nama']; ?></option>
                    <?php endwhile; ?>
                   
                    </select>
                </td>
            <tr> 
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>
    
    <?php
 
    // Check If form submitted, insert form data into users table.
    if(isset($_POST['Submit'])) {
        $Nama = $_POST['nama'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        
        // include database connection file
        include("config.php");
                
        // Insert user data into table
        $result = mysqli_query($mysqli, "INSERT INTO users(name,email,mobile) VALUES('$name','$email','$mobile')");
        
        // Show message when user added
        echo "User added successfully. <a href='index.php'>View Users</a>";
    }
    ?>
</body>
</html>