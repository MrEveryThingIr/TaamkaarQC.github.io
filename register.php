<?php include "partials/header.php";?>
    <!-- Navigation Bar -->
<?php include "partials/navbar.php";?>

   <!-- Header Section -->
 <?php include "partials/hero.php";?>


<?php 
$firstname = $lastname = $username = $password = $email = $phone = $confirm_password = "";

// Check if form is submitted
if (isPostRequest()) {
    // Retrieve form data
    $firstname = getPostData("firstname");
    $lastname = getPostData("lastname");
    $username = getPostData('username');
    $password = getPostData('password');
    $confirm_password = getPostData('confirm_password');
    $email = getPostData('email');
    $phone = getPostData('phone');

    // Validate required fields
    if (empty($username) || empty($password) || empty($email) || empty($phone) || empty($firstname) || empty($lastname)) {
        echo "All fields are required!";
        exit;
    }

    // Validate that password and confirm password match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    // Create User instance and attempt registration
    $user = new User;
    $registered = $user->register($username, $password, $email, $phone, $firstname, $lastname);

    if ($registered) {
        redirect("login.php");
    } else {
        echo "THE REGISTRATION WAS NOT DONE!";
    }
}

  ?>
  <!-- Main Content -->
  <main class="container my-5">
        <h2 class="text-center mb-4">Register</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form  method="post">
                <div class="mb-3">
                        <label for="name" class="form-label">First Name</label>
                        <input
                            name="firstname"
                            type="text"
                            class="form-control"
                            id="firstname"
                            
                        >
                    </div>

                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input
                            name="lastname"
                            type="text"
                            class="form-control"
                            id="lastname"
                            
                        >
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">phone</label>
                        <input
                            name="phone"
                            type="text"
                            class="form-control"
                            id="phone"
                            
                        >
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">UserName *</label>
                        <input
                            name="username"
                            type="text"
                            class="form-control"
                            id="username"
                            required
                        >
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address *</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            id="email"
                            required
                        >
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password *</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            id="password"
                            required
                        >
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password *</label>
                        <input
                            type="password"
                            name="confirm_password"
                            class="form-control"
                            id="confirm_password"
                            required
                        >
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
                <p class="mt-3 text-center">
                    Already have an account? <a href="login.php">Login here</a>.
                </p>
            </div>
        </div>
    </main>
<?php include "partials/footer.php";?>