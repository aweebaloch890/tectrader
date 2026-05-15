<?php include '../config.php'; 
if(isset($_POST['admin_login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND role='admin'");
    $admin = mysqli_fetch_assoc($query);

    if($admin && password_verify($pass, $admin['password'])){
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['username'];
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Invalid Admin Login!');</script>";
    }
}
?>
<?php include '../includes/header.php'; ?>

<div class="max-w-md mx-auto mt-20 bg-zinc-900 p-10 rounded-3xl border border-red-500">
    <h2 class="text-4xl font-bold text-red-500 text-center mb-8">ADMIN LOGIN</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Admin Email" class="w-full p-4 mb-4 bg-zinc-800 rounded-xl" required>
        <input type="password" name="password" placeholder="Password" class="w-full p-4 mb-6 bg-zinc-800 rounded-xl" required>
        <button type="submit" name="admin_login" class="w-full bg-red-600 hover:bg-red-500 py-4 text-xl font-bold rounded-xl">LOGIN AS ADMIN</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>