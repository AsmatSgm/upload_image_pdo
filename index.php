<?php
    require_once('connection.php');

    if (isset($_REQUEST['delete_id'])) {
        $id = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare('SELECT * FROM tbl_file WHERE id = :id');
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        unlink("upload/".$row['image']);// unlink function permanently remove your file

        //delete an original record from db
        $delete_stmt = $db->prepare('DELETE FROM tbl_file WHERE id = :id');
        $delete_stmt->bindParam(':id', $id);
        $delete_stmt->execute();

        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="card border-light mb-3">
            <div class="card-header display-4 text-center ">Information Form</div>
            <div class="card-body">
                <a href="add.php" class="btn btn-success float-right mb-3">Add+</a>
                <table class="table table-striped table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th width="50%">Name</th>
                            <th width="30%">Image</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
            $select_stmt = $db->prepare('SELECT * FROM tbl_file');
            $select_stmt->execute();

            while($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
                        <tr>
                            <td><?php echo $row['name'];?></td>
                            <td><img src="upload/<?php echo $row['image'];?>" width="100px"></td>
                            <td><a href="edit.php?update_id=<?php echo $row['id'];?>" class="btn btn-warning"><i
                                        class="fas fa-pen-square"></i> Edit</a>
                                <a href="?delete_id=<?php echo $row['id'];?>" class="btn btn-danger"><i
                                        class="fas fa-minus-square"></i> Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>