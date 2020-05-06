<?php
// Display selected user data based on id
// Getting id from url
include "connection.php";
$id = $_GET['id'];

$sql = "SELECT mahasiswa.id, mahasiswa.nama, nim,jenis_kelamin, dosenwali.nama AS nama_dosen FROM mahasiswa INNER JOIN dosenwali ON mahasiswa.id_doswal = dosenwali.id WHERE mahasiswa.id = $id";
$result = $conn->query($sql);

while($user_data = $result->fetch_assoc())
{
    $id = $user_data['id'];
    $nama = $user_data['nama'];
    $nim = $user_data['nim'];
    $jk = $user_data['jenis_kelamin'];
    $doswal = $user_data['nama_dosen'];
    $temp = explode(" - ", $doswal);   
}

    $male_status = 'unchecked';
    $female_status = 'unchecked';    
    if ($jk == 'L') {

        $male_status = 'checked';

    }
    else if ($jk == 'P') {

        $female_status = 'checked';

    }
    $conn->close();  
?>
<html lang="en">
<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .main{
            padding: 100px;
        }     
        .form-group{
            padding: 0px 0px;
            left: 1080px;
        }     
    </style>

    <title>Edit</title>
</head>
<body>
<div class="main">
<a href="index.php">Home</a>
<h3>Sunting Data Mahasiswa</h3>
        <form action="update.php" method="post">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="input" class="form-control" name="Nama" <?php echo "value=", $nama?>>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-10">
                    <input type="input" class="form-control" name="Nim" <?php echo "value=", $nim?>>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis kelamin</label>
                <div class="form-check form-check-inline">                        
                    <input class="form-check-input" type="radio" name="Jenis_kelamin" id="inlineRadio1" value="1" <?php echo $male_status?>>
                    <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="Jenis_kelamin" id="inlineRadio2" value="2" <?php echo $female_status?>>
                    <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                </div>
            </div>   
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Dosen Wali</label>
                <select class="custom-select custom-select-lg col-md-6" name="select">
                    <option>Pilih Dosen</option> 
                    <?php
                        include "connection.php";        
                        $sql = "SELECT nama, nip FROM dosenwali";
                        $result = $conn->query($sql);       
                        if ($result->num_rows > 0){
                            // output data of each row
                                while($row = $result->fetch_assoc()) { 
                                    if($row["nama"]==$temp[0]) {
                                         echo '<option selected>', $row['nama'], ')','</option>';                                        
                                    }
                                    else{
                                        echo '<option>', $row['nama'],')','</option>';                                        
                                    }
                                }
                            }            
                            $conn->close();  ?>                                          
                </select>
            </div>
            <div class="form-group row">  
                <input type="hidden" class="form-control" name="myID" <?php echo "value=", $id?>>                      
                <input type="submit" name="Edit" class="btn btn-dark" value="Edit"></input>
            </div>
        </form>
    </div>   
</body>
</html>