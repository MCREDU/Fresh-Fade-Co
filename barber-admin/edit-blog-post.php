<?php
    ob_start();
    session_start();

    //Page Title
    $pageTitle = 'Edit Blog Post';

    //Includes
    include 'connect.php';
    include 'Includes/functions/functions.php'; 
    include 'Includes/templates/header.php';

    //Check If user is already logged in
    if(isset($_SESSION['username_barbershop_Xw211qAAsq4']) && isset($_SESSION['password_barbershop_Xw211qAAsq4']))
    {
        // Check if ID is provided
        if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location: blog-posts.php');
            exit();
        }

        $post_id = $_GET['id'];

        // Handle form submission
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $excerpt = trim($_POST['excerpt']);
            $tags = trim($_POST['tags']);
            $status = $_POST['status'];
            $image_url = trim($_POST['image_url']);

            $errors = array();

            // Validation
            if(empty($title)) {
                $errors[] = "Title is required";
            }
            if(empty($content)) {
                $errors[] = "Content is required";
            }
            if(empty($excerpt)) {
                $excerpt = substr(strip_tags($content), 0, 200) . '...';
            }

            // If no errors, update the blog post
            if(empty($errors)) {
                $stmt = $con->prepare("UPDATE blog_posts SET title = ?, content = ?, excerpt = ?, tags = ?, status = ?, image_url = ? WHERE post_id = ?");
                $stmt->execute(array($title, $content, $excerpt, $tags, $status, $image_url, $post_id));
                
                if($stmt->rowCount() > 0) {
                    $successMsg = "Blog post updated successfully!";
                } else {
                    $errorMsg = "No changes were made or error updating blog post!";
                }
            } else {
                $errorMsg = implode("<br>", $errors);
            }
        }

        // Get the blog post data
        $stmt = $con->prepare("SELECT * FROM blog_posts WHERE post_id = ?");
        $stmt->execute(array($post_id));
        $post = $stmt->fetch();

        if(!$post) {
            header('Location: blog-posts.php');
            exit();
        }
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
    
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Edit Blog Post</h1>
                <a href="blog-posts.php" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                    <i class="fas fa-arrow-left fa-sm text-white-50"></i>
                    Back to Blog Posts
                </a>
            </div>

            <!-- Alert Messages -->
            <?php
                if(isset($successMsg)) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                    echo $successMsg;
                    echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                    echo "<span aria-hidden='true'>&times;</span>";
                    echo "</button>";
                    echo "</div>";
                }

                if(isset($errorMsg)) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
                    echo $errorMsg;
                    echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                    echo "<span aria-hidden='true'>&times;</span>";
                    echo "</button>";
                    echo "</div>";
                }
            ?>

            <!-- Edit Blog Post Form -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Blog Post: <?php echo htmlspecialchars($post['title']); ?></h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Title -->
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" 
                                           value="<?php echo htmlspecialchars($post['title']); ?>" 
                                           required>
                                </div>

                                <!-- Content -->
                                <div class="form-group">
                                    <label for="content">Content <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="content" name="content" rows="12" 
                                              required><?php echo htmlspecialchars($post['content']); ?></textarea>
                                    <small class="form-text text-muted">Write your blog post content here. You can use basic HTML tags.</small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Excerpt -->
                                <div class="form-group">
                                    <label for="excerpt">Excerpt</label>
                                    <textarea class="form-control" id="excerpt" name="excerpt" rows="4"><?php echo htmlspecialchars($post['excerpt']); ?></textarea>
                                    <small class="form-text text-muted">A short summary of your post. If left empty, it will be auto-generated from the content.</small>
                                </div>

                                <!-- Tags -->
                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <input type="text" class="form-control" id="tags" name="tags" 
                                           value="<?php echo htmlspecialchars($post['tags']); ?>"
                                           placeholder="e.g., Classic, Pompadour, Retro">
                                    <small class="form-text text-muted">Separate tags with commas.</small>
                                </div>

                                <!-- Image URL -->
                                <div class="form-group">
                                    <label for="image_url">Image URL</label>
                                    <input type="url" class="form-control" id="image_url" name="image_url" 
                                           value="<?php echo htmlspecialchars($post['image_url']); ?>"
                                           placeholder="https://example.com/image.jpg">
                                    <small class="form-text text-muted">Optional: URL to a featured image for your post.</small>
                                </div>

                                <!-- Status -->
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="draft" <?php echo ($post['status'] == 'draft') ? 'selected' : ''; ?>>Draft</option>
                                        <option value="published" <?php echo ($post['status'] == 'published') ? 'selected' : ''; ?>>Published</option>
                                    </select>
                                </div>

                                <!-- Post Info -->
                                <div class="form-group">
                                    <label>Post Information</label>
                                    <div class="form-control-plaintext">
                                        <small class="text-muted">
                                            <strong>Created:</strong> <?php echo date('M d, Y H:i', strtotime($post['created_at'])); ?><br>
                                            <strong>Last Updated:</strong> <?php echo date('M d, Y H:i', strtotime($post['updated_at'])); ?><br>
                                            <strong>Post ID:</strong> <?php echo $post['post_id']; ?>
                                        </small>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-save"></i> Update Blog Post
                                    </button>
                                </div>
                                
                                <!-- Preview Button (only show if post is published) -->
                                <?php if($post['status'] == 'published'): ?>
                                    <div class="form-group">
                                        <a href="../blog-post.php?id=<?php echo $post['post_id']; ?>" 
                                           class="btn btn-info btn-block" target="_blank">
                                            <i class="fas fa-eye"></i> View Published Post
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

<?php
        //Include Footer
        include 'Includes/templates/footer.php';
    }
    else
    {
        header('Location: login.php');
        exit();
    }
?>
