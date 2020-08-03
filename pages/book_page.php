<?php
$command = filter_input(INPUT_GET,'cmd');
if(isset($command)&&$command=='del'){
    $isbn = filter_input(INPUT_GET,'isbn');
    if(isset($isbn)){
        $link = new PDO("mysql:host=localhost; dbname=pwl20194", "root", "");
        $link->setAttribute(PDO::ATTR_AUTOCOMMIT,false);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = 'DELETE FROM book WHERE isbn = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1,$isbn);
        $link->beginTransaction();
        if ($stmt->execute()){
            $link->commit();
        }else{
            $link->rollBack();
        }
        $link = null;
        echo '<div class="bg-success">Data successfully deleted</div>';
    }
}

$submitPressed = filter_input(INPUT_POST,'btnSubmit');
if(isset($submitPressed)){
    $isbn = filter_input(INPUT_POST,'isbn');
    $title = filter_input(INPUT_POST,'title');
    $author = filter_input(INPUT_POST,'author');
    $publisher = filter_input(INPUT_POST,'publisher');
    $description = filter_input(INPUT_POST,'description');
    $cover = filter_input(INPUT_POST,'cover');
    $cat_id = filter_input(INPUT_POST,'cat_id');
    $link = new PDO("mysql:host=localhost; dbname=pwl20194", "root", "");
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT,false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = 'INSERT INTO book VALUES(?,?,?,?,?,?,?)';
    $stmt = $link->prepare($query);
    $stmt->bindParam(1,$isbn);
    $stmt->bindParam(2,$title);
    $stmt->bindParam(3,$author);
    $stmt->bindParam(4,$publisher);
    $stmt->bindParam(5,$description);
    $stmt->bindParam(6,$cover);
    $stmt->bindParam(7,$cat_id);
    $link->beginTransaction();
    if ($stmt->execute()){
        $link->commit();
    }else{
        $link->rollBack();
    }
    $link = null;
    echo '<div class="bg-success">Data successfully added</div>';
}
?>
<table id="myTable" class="display">
    <thead>
    <tr>
        <th>ISBN</th>
        <th>Title</th>
        <th>Author</th>
        <th>Publisher</th>
        <th>Description</th>
        <th>Cover</th>
        <th>Category_id</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $link = new PDO("mysql:host=localhost; dbname=pwl20194", "root", "");
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT,false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = 'SELECT * FROM book';

    $result = $link->query($query);
    foreach($result as $row){
        echo '<tr>';
        echo '<td>'. $row['isbn'] .'</td>';
        echo '<td>'. $row['title'] .'</td>';
        echo '<td>'. $row['author'] .'</td>';
        echo '<td>'. $row['publisher'] .'</td>';
        echo '<td>'. $row['description'] .'</td>';
        echo '<td>'. $row['cover'] .'</td>';
        echo '<td>'. $row['category_id'] .'</td>';
        echo '<td><button onclick="updateValueBook(\''.$row['isbn'].'\')">Update</button><button onclick="deleteValueBook(\''.$row['isbn'].'\')">Delete</button></td>';
        echo '</tr>';
    }
    $link = null;

    ?>
    </tbody>
</table>
<form action="" method="post">
    <div class="form-group">
        <label for="catId">ISBN</label>
        <input type="text" class="form-control" id="catId" name="isbn" class="btn btn-default" maxlength="13">
        <label for="catId">Title</label>
        <input type="text" class="form-control" id="catId" name="title" class="btn btn-default">
        <label for="catId">Author</label>
        <input type="text" class="form-control" id="catId" name="author" class="btn btn-default">
        <label for="catId">Publisher</label>
        <input type="text" class="form-control" id="catId" name="publisher" class="btn btn-default">
        <label for="catId">Description</label>
        <input type="text" class="form-control" id="catId" name="description" class="btn btn-default">
        <label for="catId">Cover</label>
        <input type="text" class="form-control" id="catId" name="cover" class="btn btn-default">
        <label for="catId">Category_id</label>
        <input type="text" class="form-control" id="catId" name="cat_id" class="btn btn-default">
    </div>
    <input type="submit" name="btnSubmit" class="btn btn-default">
</form>

tambahhan
