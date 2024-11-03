<?php
    include"../layouts/navbar_side.php";
    include"../../dbconnect.php";

    $sql = "SELECT * FROM categories";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();


    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $category_id = $_POST['category_id'];
        $description = $_POST['description'];
        $user_id = 1;

        $image_array = $_FILES['image'];
        if(isset($image_array) && $image_array['size'] > 0) {
            $dir = '../images/';
            $image_dir = $dir.$image_array['name']; //  ../images/eg.jpeg (the real save file path)
            $image = 'admin/images/'.$image_array['name']; // file path that save in the database
            $tmp_name = $image_array['tmp_name'];
            move_uploaded_file($tmp_name, $image_dir);
        }

        // echo $title, $category_id, $description;
        $sql = "INSERT INTO posts (title,image,description,categories_id,users_id) VALUES(:title,:image,:description,:category_id,:user_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':title',$title);
        $stmt->bindParam(':image',$image);
        $stmt->bindParam(':description',$description);
        $stmt->bindParam(':category_id',$category_id);
        $stmt->bindParam(':user_id',$user_id);
        $stmt->execute();

        header("location: posts.php");
    }
?>

    <div class="container-fluid my-5">
        <div class="mb-4">
            <h3 class="d-inline">Posts</h3>
            <a href="create_post.php" class="btn btn-danger float-end">Cancel</a>
            <div>
                <a href="" class="">Dashboard</a> /
                <a href="" class="">Posts</a> /
                <span>Posts</span>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Create Posts</h5>
            </div>
            <div class="card-body">
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="category_id"></label>Categories</label>
                        <select class="form-select" id="category_id" name="category_id" >
                            <option selected>Choose...</option>
                            <?php
                                foreach($categories as $category) {
                            ?>  
                                <option value="<?= $category['categories_id'] ?>"><?= $category['categories_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image" aria-label="Upload">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>
                    <div class="d-grip gap-2">
                        <button type="submit" class="btn btn-primary w-100">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
    include"../layouts/footer.php";
?>