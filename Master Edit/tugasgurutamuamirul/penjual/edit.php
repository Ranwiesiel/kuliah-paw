<?php
// include database connection file
include_once("config.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{	
    $id = $_POST['id'];
    
    $Nama=$_POST['nama'];
    $Alamat=$_POST['alamat'];
    $No_Hp=$_POST['no_hp'];
        
    // update user data
    $result = mysqli_query($mysqli, "UPDATE penjual SET nama='$Nama',alamat='$Alamat',no_hp='$No_Hp' WHERE id_penjual=$id");
    
    // Redirect to homepage to display updated user in list
    header("Location: index.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];
 
// Fetech user data based on id
$result = mysqli_query($mysqli, "SELECT * FROM penjual WHERE id_penjual=$id");
 
while($user_data = mysqli_fetch_array($result))
{
    $Nama = $user_data['nama'];
    $Alamat = $user_data['alamat'];
    $No_Hp = $user_data['no_hp'];
}
?>
<html>
<head>	
    <title>Edit User Data</title>
</head>
 
<body>
    <a href="index.php">Home</a>
    <br/><br/>
    
    <form name="update_user" method="post" action="edit.php">
        <table border="0">
            <tr> 
                <td>Nama</td>
                <td><input type="text" name="nama" value=<?php echo $Nama;?>></td>
            </tr>
            <tr> 
                <td>Alamat</td>
                <td><input type="text" name="alamat" value=<?php echo $Alamat;?>></td>
            </tr>
            <tr> 
                <td>No Hp</td>
                <td><input type="text" name="no_hp" value=<?php echo $No_Hp;?>></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>