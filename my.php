<?php
    include "connection.php";        
    $sql = "SELECT mahasiswa.id, mahasiswa.nama, nim, jenis_kelamin dosenwali.nama AS nama_dosen FROM mahasiswa INNER JOIN dosenwali ON mahasiswa.id_doswal = dosenwali.id";
    $result = $conn->query($sql);   
    
    if ($result->num_rows > 0){
        // output data of each row
?> 
        <ul class="list-group list-group-horizontal-sm">
        <li class="list-group-item item">ID</li>
        <li class="list-group-item">Nama</li>
        <li class="list-group-item">NIM</li>
        <li class="list-group-item item">Jenis_Kelamin</li>
        <li class="list-group-item">Dosen Wali</li> 
        <li class="list-group-item buton">Aksi</li>    
        </ul>
    <?php
        while($row = $result->fetch_assoc()) { 
    ?>   
                <ul class="list-group list-group-horizontal-sm">                 
                    <li class="list-group-item item"><?php echo $row["id"]?></li>
                    <li class="list-group-item"><?php echo $row["nama"]?></li>
                    <li class="list-group-item"><?php echo $row["nim"]?></li>
                    <li class="list-group-item item"><?php echo $row["jenis_kelamin"]?></li>
                    <li class="list-group-item"><?php echo $row["nama_dosen"]?></li>     
                    <li class="list-group-item buton">
                        <a class="edit" href="edit.php?id=<?php echo $row['id']?>">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        <a class="trash" href="delete.php?id=<?php echo $row['id']?>">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </li>     
                </ul>
    <?php   }
        }   
    //    else{
        //    echo "<h3 style='text-align:center;'>Database Kosong</h3>";
    //    }         
        $conn->close();  
    ?>