<?php
    include "layouts/navbar.php";
    include "dbconnect.php";

    if(isset($_GET["category_id"])){
        $category_id = $_GET['category_id'];
        $sql = "SELECT * FROM posts WHERE posts.categories_id = :categoryID ORDER BY posts_id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':categoryID',$category_id);
        $stmt->execute();
        $posts = $stmt->fetchAll();
    }else{

    // 18446744073709551615 is the maximum value  in mySQL
    $sql = "SELECT * FROM posts ORDER BY posts_id DESC LIMIT 18446744073709551615 OFFSET 1";
    // $stmt = $conn->query($sql);
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchAll();
    // var_dump($posts);

    $sql = "SELECT * FROM posts ORDER BY posts_id DESC LIMIT 1";
    // $stmt = $conn->query($sql);
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $latest_post = $stmt->fetch();

    }
?>
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to Vlogify!</h1>
                    <p class="lead mb-0">A Page that you can consume all the knowledges!</p>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                <?php
                    if(isset($_GET['category_id'])) {

                    }else{
                ?>
                    <!-- Featured blog post-->
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="<?= $latest_post['image'] ?>" alt="..." /></a>
                        <div class="card-body">
                            <div class="small text-muted"><?= date('F d,Y',strtotime($latest_post['created_at'])) ?></div>
                            <h2 class="card-title"><?= $latest_post['title'] ?></h2>
                            <p class="card-text"><?= substr($latest_post['description'],0,200) ?>.....</p>
                            <a class="btn btn-primary" href="detail.php?id=<?= $latest_post['posts_id'] ?>">Read more →</a>
                        </div>
                    </div>
                <?php } ?>
                    <!-- Nested row for non-featured blog posts-->
                    <div class="row">
                    <?php
                        foreach($posts as $post){
                    ?>
                        <div class="col-lg-6">
                            <!-- Blog post-->
                             <!-- substr (string, start, number) -->
                            <div class="card mb-4">
                                <a href="#!"><img class="card-img-top" src="<?= $post['image'] ?>" alt="..." /></a>
                                <div class="card-body">
                                    <div class="small text-muted"><?= date('F d,Y',strtotime($post['created_at'])) ?></div>
                                    <h2 class="card-title h4"><?= $post['title'] ?></h2>
                                    <p class="card-text"><?= substr($post['description'],0,150) ?>.....</p>
                                    <a class="btn btn-primary" href="detail.php?id=<?= $post['posts_id'] ?>">Read more →</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    </div>
                   
                </div>
<?php
    include "layouts/footer.php";
?>              