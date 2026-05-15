<?php include 'config.php'; 
if(isset($_POST['register'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $valorant = mysqli_real_escape_string($conn, $_POST['valorant_id']);
    $discord = mysqli_real_escape_string($conn, $_POST['discord']);

    $sql = "INSERT INTO users (username, email, password, valorant_id, discord_id) VALUES ('$username','$email','$pass','$valorant','$discord')";
    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Registration Successful!'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Username or Email already exists!');</script>";
    }
}
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="max-w-lg mx-auto mt-20 bg-zinc-900 p-10 rounded-3xl border border-yellow-500">
    <h2 class="text-4xl font-bold neon-yellow text-center mb-8">PLAYER REGISTRATION</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" class="w-full p-4 mb-4 bg-zinc-800 rounded-xl" required>
        <input type="email" name="email" placeholder="Email" class="w-full p-4 mb-4 bg-zinc-800 rounded-xl" required>
        <input type="password" name="password" placeholder="Password" class="w-full p-4 mb-4 bg-zinc-800 rounded-xl" required>
        <input type="text" name="valorant_id" placeholder="Valorant ID (Name#Tag)" class="w-full p-4 mb-4 bg-zinc-800 rounded-xl" required>
        <input type="text" name="discord" placeholder="Discord ID" class="w-full p-4 mb-6 bg-zinc-800 rounded-xl">
        <button type="submit" name="register" class="w-full bg-yellow-500 text-black py-4 text-xl font-bold rounded-xl">REGISTER</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>