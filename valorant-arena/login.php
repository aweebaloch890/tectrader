<?php include 'config.php';
if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($query);

    if($user && password_verify($_POST['password'], $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: index.php");
    } else {
        echo "<script>alert('Invalid Login!');</script>";
    }
}
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="max-w-md mx-auto mt-20 bg-zinc-900 p-10 rounded-3xl border border-yellow-500">
    <h2 class="text-4xl font-bold neon-yellow text-center mb-8">LOGIN</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" class="w-full p-4 mb-4 bg-zinc-800 rounded-xl" required>
        <input type="password" name="password" placeholder="Password" class="w-full p-4 mb-6 bg-zinc-800 rounded-xl" required>
        <button type="submit" name="login" class="w-full bg-yellow-500 text-black py-4 text-xl font-bold rounded-xl">LOGIN</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>