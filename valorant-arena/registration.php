<?php include 'config.php'; 

if(isset($_POST['register'])){
    $username   = mysqli_real_escape_string($conn, $_POST['username']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $valorant_id = mysqli_real_escape_string($conn, $_POST['valorant_id']);
    $discord_id  = mysqli_real_escape_string($conn, $_POST['discord_id']);

    $sql = "INSERT INTO users (username, email, password, valorant_id, discord_id) 
            VALUES ('$username', '$email', '$password', '$valorant_id', '$discord_id')";

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Registration Successful! Now Login.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Error: Username or Email already exists!');</script>";
    }
}
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="max-w-lg mx-auto mt-16 bg-zinc-900 p-10 rounded-3xl border border-yellow-500">
    <h2 class="text-4xl font-bold neon-yellow text-center mb-8">PLAYER REGISTRATION</h2>
    
    <form method="POST">
        <input type="text" name="username" placeholder="Username" 
               class="w-full p-4 mb-4 bg-zinc-800 rounded-xl focus:outline-none focus:border-yellow-500" required>
        
        <input type="email" name="email" placeholder="Email Address" 
               class="w-full p-4 mb-4 bg-zinc-800 rounded-xl focus:outline-none focus:border-yellow-500" required>
        
        <input type="password" name="password" placeholder="Password" 
               class="w-full p-4 mb-4 bg-zinc-800 rounded-xl focus:outline-none focus:border-yellow-500" required>
        
        <input type="text" name="valorant_id" placeholder="Valorant ID (Name#Tag)" 
               class="w-full p-4 mb-4 bg-zinc-800 rounded-xl focus:outline-none focus:border-yellow-500" required>
        
        <input type="text" name="discord_id" placeholder="Discord ID (Optional)" 
               class="w-full p-4 mb-6 bg-zinc-800 rounded-xl focus:outline-none focus:border-yellow-500">
        
        <button type="submit" name="register" 
                class="w-full bg-yellow-500 hover:bg-yellow-400 text-black py-4 text-xl font-bold rounded-xl">
            REGISTER NOW
        </button>
    </form>
    
    <p class="text-center mt-6">
        Already have account? <a href="login.php" class="text-yellow-400 hover:underline">Login Here</a>
    </p>
</div>

<?php include 'includes/footer.php'; ?>