<?php
    include "layouts/navbar.php";
    include "dbconnect.php";

    $post_id = $_GET['id'];
    // echo $id;
    $sql = "SELECT * FROM posts WHERE posts_id = :postID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':postID',$post_id);
    $stmt->execute();
    $post = $stmt->fetch();
    // var_dump($post);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog Post - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1"><?= $post['title'] ?></h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Post On <?= $post['created_at'] ?> by <?= $post['users_id'] ?></div>
                            <!-- Post categories-->
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!"><?= $post['categories_id'] ?></a>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="<?= $post['image'] ?>" alt="..." /></figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <p><?= $post['description'] ?></p>
                        </section>
                    </article>
                    <!-- Comments section-->
                </div>
<?php
    include "layouts/footer.php";
?>