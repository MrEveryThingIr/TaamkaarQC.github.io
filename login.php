<?php include "partials/header.php";?>
    <!-- Navigation Bar -->
<?php include "partials/navbar.php";?>

   <!-- Header Section -->
 <?php include "partials/hero.php";?>

 <?php 
// Check if form is submitted

if (isPostRequest()) {
    $usernameOrEmail = getPostData('usernameOrEmail');
    $password = getPostData('password');

    if (empty($usernameOrEmail) || empty($password)) {
        echo "All fields are required!";
        exit;
    }

    $user = new User();
    if ($user->login($usernameOrEmail, $password)) {
        echo "Login successful!";
        redirect("admin.php"); // Redirect to dashboard or home page
    } else {
        echo "Login failed: Invalid username, email, or password.";
    }
}
 ?>
  <!-- Main Content -->
  <main class="container my-5">
        <h2 class="text-center mb-4">Login</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post">
                <div class="mb-3">
    <label for="usernameOrEmail" class="form-label">Username or Email *</label>
    <input
        name="usernameOrEmail"
        type="text"
        class="form-control"
        id="usernameOrEmail"
        required
    >
</div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password *</label>
                        <input
                        name="password"
                            type="password"
                            class="form-control"
                            id="password"
                            required
                        >
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <p class="mt-3 text-center">
                    Don't have an account? <a href="register.php">Register here</a>.
                </p>
            </div>
        </div>
    </main>
<?php include "partials/footer.php";?>