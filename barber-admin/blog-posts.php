<?php
    ob_start();
    session_start();

	//Check If user is already logged in
	if(isset($_SESSION['username_barbershop_Xw211qAAsq4']) && isset($_SESSION['password_barbershop_Xw211qAAsq4']))
	{
        //Page Title
        $pageTitle = 'Blog Posts Management';

        //Includes
        include 'connect.php';
        include 'Includes/functions/functions.php'; 
        include 'Includes/templates/header.php';

        // Handle Delete Action
        if(isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            $post_id = $_GET['delete'];
            $stmt = $con->prepare("DELETE FROM blog_posts WHERE post_id = ?");
            $stmt->execute(array($post_id));
            if($stmt->rowCount() > 0) {
                $successMsg = "Blog post deleted successfully!";
            } else {
                $errorMsg = "Error deleting blog post!";
            }
        }

        // Handle Status Toggle
        if(isset($_GET['toggle_status']) && is_numeric($_GET['toggle_status'])) {
            $post_id = $_GET['toggle_status'];
            $stmt = $con->prepare("UPDATE blog_posts SET status = CASE WHEN status = 'published' THEN 'draft' ELSE 'published' END WHERE post_id = ?");
            $stmt->execute(array($post_id));
            if($stmt->rowCount() > 0) {
                $successMsg = "Blog post status updated successfully!";
            } else {
                $errorMsg = "Error updating blog post status!";
            }
        }

        // Get all blog posts
        $stmt = $con->prepare("SELECT bp.*, ba.full_name as author_name FROM blog_posts bp LEFT JOIN barber_admin ba ON bp.author_id = ba.admin_id ORDER BY bp.created_at DESC");
        $stmt->execute();
        $blogPosts = $stmt->fetchAll();
?>

	<!-- Begin Page Content -->
	<div class="container-fluid">
		
		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Blog Posts Management</h1>
			<a href="add-blog-post.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
				<i class="fas fa-plus fa-sm text-white-50"></i>
				Add New Post
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

		<!-- Blog Posts Table -->
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">All Blog Posts</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>ID</th>
								<th>Title</th>
								<th>Excerpt</th>
								<th>Author</th>
								<th>Status</th>
								<th>Tags</th>
								<th>Created</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(empty($blogPosts)) {
									echo "<tr>";
									echo "<td colspan='8' class='text-center'>No blog posts found.</td>";
									echo "</tr>";
								} else {
									foreach($blogPosts as $post) {
										echo "<tr>";
										echo "<td>" . $post['post_id'] . "</td>";
										echo "<td>";
										echo "<strong>" . htmlspecialchars($post['title']) . "</strong>";
										if($post['image_url']) {
											echo "<br><small class='text-muted'>Has image</small>";
										}
										echo "</td>";
										echo "<td>";
										$excerpt = $post['excerpt'] ?: substr(strip_tags($post['content']), 0, 100) . '...';
										echo htmlspecialchars($excerpt);
										echo "</td>";
										echo "<td>" . htmlspecialchars($post['author_name'] ?: 'Unknown') . "</td>";
										echo "<td>";
										$statusClass = $post['status'] == 'published' ? 'success' : 'warning';
										echo "<span class='badge badge-" . $statusClass . "'>";
										echo ucfirst($post['status']);
										echo "</span>";
										echo "</td>";
										echo "<td>";
										if($post['tags']) {
											$tags = explode(',', $post['tags']);
											foreach($tags as $tag) {
												echo "<span class='badge badge-info mr-1'>" . htmlspecialchars(trim($tag)) . "</span>";
											}
										}
										echo "</td>";
										echo "<td>" . date('M d, Y', strtotime($post['created_at'])) . "</td>";
										echo "<td>";
										echo "<div class='btn-group' role='group'>";
										if($post['status'] == 'published') {
											echo "<a href='../blog-post.php?id=" . $post['post_id'] . "' class='btn btn-sm btn-info' title='View Post' target='_blank'>";
											echo "<i class='fas fa-eye'></i>";
											echo "</a>";
										}
										echo "<a href='edit-blog-post.php?id=" . $post['post_id'] . "' class='btn btn-sm btn-primary' title='Edit'>";
										echo "<i class='fas fa-edit'></i>";
										echo "</a>";
										$toggleClass = $post['status'] == 'published' ? 'warning' : 'success';
										$toggleIcon = $post['status'] == 'published' ? 'eye-slash' : 'eye';
										$toggleTitle = $post['status'] == 'published' ? 'Set as Draft' : 'Publish';
										echo "<a href='?toggle_status=" . $post['post_id'] . "' class='btn btn-sm btn-" . $toggleClass . "' title='" . $toggleTitle . "' onclick='return confirm(\"Are you sure you want to change the status?\")'>";
										echo "<i class='fas fa-" . $toggleIcon . "'></i>";
										echo "</a>";
										echo "<a href='?delete=" . $post['post_id'] . "' class='btn btn-sm btn-danger' title='Delete' onclick='return confirm(\"Are you sure you want to delete this blog post? This action cannot be undone.\")'>";
										echo "<i class='fas fa-trash'></i>";
										echo "</a>";
										echo "</div>";
										echo "</td>";
										echo "</tr>";
									}
								}
							?>
						</tbody>
					</table>
				</div>
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
