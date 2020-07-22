<?php
$command = filter_input(INPUT_GET, 'cmd');
if (isset($command) && $command == 'del'){
    $cid = filter_input(INPUT_GET, 'cid');
    if (isset($cid)){
        $link = new PDO("mysql:host=localhost; dbname=pwl20194", "root", "");
        $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "DELETE FROM category WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $cid);
        $link->beginTransaction();
        if ($stmt->execute()){
            $link->commit();
        } else {
            $link->rollBack();
        }
        $link = null;
        echo '<div class="bg-success">Data Successfully deleted</div>';
    }
}
$submitPressed = filter_input(INPUT_POST, 'submit');
if (isset($submitPressed)){
    $name = filter_input(INPUT_POST, 'name');
    $link = new PDO("mysql:host=localhost; dbname=pwl20194", "root", "");
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "INSERT INTO category(name) VALUES(?)";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $name);
    $link->beginTransaction();
    if ($stmt->execute()){
        $link->commit();
    } else {
        $link->rollBack();
    }
    $link = null;
    echo '<div class="bg-success">Data Successfully added (Category: ' . $name . ')</div>';
}
?>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.21/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>

</head>
<div class="page">
<form action="" method="POST">
    <div class="form-group">
        <label for="CatId">Name</label>
        <input type="text" name="name" class="form-control"  placeholder="Masukan Nama">
    </div>
    <p>
    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
    </p>
</form>
<table id="myTable" class="display" border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php

    $link = new PDO("mysql:host=localhost; dbname=pwl20194", "root", "");
    $link-> setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = 'SELECT * FROM category';
    $result = $link->query($query);
    foreach ($result as $row){
            echo '<tr>';
            echo '<td>' . $row['id']  . '</td>' ;
            echo '<td>' . $row['name'] . '</td>' ;
                echo '<td><button onclick="updateValue(\'' . $row['id'] . '\')">Update</button>
                      <button onclick="deleteValue(\'' . $row['id'] . '\')">Delete</button>  
                      </td>' ;
            echo '</tr>';
        }
    $link = null;

    ?>
    </tbody>
</table>
</div>

<script>
    $(document).ready( function () {
        $('#myTable').DataTable();

    } );
</script>
