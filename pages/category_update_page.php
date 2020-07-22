<?php
$cid = filter_input(INPUT_GET, 'cid');
if (isset($cid)){
    $link = new PDO("mysql:host=localhost; dbname=pwl20194", "root", "");
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM category WHERE id = ?";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $cid);
    $stmt->execute();
    $result = $stmt->fetch();
    $link = null;
}
$submitPressed = filter_input(INPUT_POST, 'submit');
if (isset($submitPressed)){
    $name = filter_input(INPUT_POST, 'name');
    $link = new PDO("mysql:host=localhost; dbname=pwl20194", "root", "");
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "UPDATE category SET name = ? WHERE id = ? ";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $result['id']);
    $link->beginTransaction();
    if ($stmt->execute()){
        $link->commit();
    } else {
        $link->rollBack();
    }
    $link = null;
    header("location:index.php?menu=cat");
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
        <input type="text" name="name" class="form-control"  placeholder="Masukan Nama" value="<?php echo $result['name'];?>">
    </div>
    <p>
    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
    </p>
</form>

</div>

