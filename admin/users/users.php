<?php
    include"../layouts/navbar_side.php";
    include"../../dbconnect.php";

    $sql = "SELECT name, email, role FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();
    // var_dump($posts);
?>

<div class="container my-5">
    <div class="mb-5">
        <h3 class="d-inline">Posts Lists</h3>
        <a href="create_post.php" class="btn btn-primary float-end">Create Posts</a>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>

                <tbody class="text-center">
                    <?php
                        $u = 1;
                        foreach($users as $user){
                    ?>
                        <tr>
                            <td><?= $u++ ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning">Edit</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                                <a href="../../detail.php?id=<?= $user['users_id'] ?>" class="btn btn-sm btn-primary" target="blank">Detail</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot class="text-center">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr> 
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?php
    include"../layouts/footer.php";
?>