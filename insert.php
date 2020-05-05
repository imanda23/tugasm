<?php
    include "connection.php"; 
    if(isset($_GET['Submit'])) {            
        $nama = $_GET['Nama'];
        $NIM = $_GET['Nim'];
        $JK = $_GET['Jenis_kelamin'];
        $doswal = $_GET['select'];
        $temp = explode(" - ", $doswal);

        $sql = "SELECT id FROM `dosenwali` WHERE `nama` LIKE '$temp[0]'";    
        $result = $conn->query($sql);       
        if ($result->num_rows > 0){        
            while($row = $result->fetch_assoc()) {
                $id = $row["id"];
            }
        }    

        $sql = "INSERT INTO mahasiswa(id,nama,nim,jenis_kelamin, id_doswal) VALUES(NULL,'$nama','$NIM','$JK', '$id')";   

        if ($conn->query($sql) === TRUE) {
            echo "inserted";
            $conn->close();  
            header("Location:index.php");
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();  
    }
    else{
        echo "data kosong";
    }
    $conn->close();  
?>
