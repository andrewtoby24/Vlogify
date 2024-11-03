<?php
    include"../layouts/navbar_side.php";
    include"../../dbconnect.php";

    $sql = "SELECT posts.*, categories.categories_name as c_name, users.name as u_name FROM posts INNER JOIN categories ON posts.categories_id = categories.categories_id INNER JOIN users ON posts.users_id = users.users_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchAll();
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
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody class="text-center">
                    <?php
                        $j = 1;
                        foreach($posts as $post){
                    ?>
                        <tr>
                            <td><?= $j++ ?></td>
                            <td><?= $post['title'] ?></td>
                            <td><?= $post['c_name'] ?></td>
                            <td><?= $post['u_name'] ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning">Edit</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                                <a href="../../detail.php?id=<?= $post['posts_id'] ?>" class="btn btn-sm btn-primary" target="blank">Detail</a>
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