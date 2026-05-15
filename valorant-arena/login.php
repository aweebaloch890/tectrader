<?php 
include_once 'config.php';

// Agar user pehle se login hai toh index par bhej do
if(is_logged_in()){
    header("Location: index.php");
    exit();
}

$error = "";

if(isset($_POST['login'])){
    $email = clean($_POST['email']); 
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($query);

    if($user && password_verify($password, $user['password'])){
        // Setting up Sessions based on new Role System
        $_SESSION['user_id']    = $user['id'];
        $_SESSION['username']   = $user['username'];
        $_SESSION['user_role']  = (int)$user['role']; // Role: 0, 1, 2, or 3
        $_SESSION['valorant_id'] = $user['valorant_id'];
        
        // Redirect logic based on role
        if($_SESSION['user_role'] >= ROLE_ORGANIZER) {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $error = "ACCESS DENIED: INVALID CREDENTIALS";
    }
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="min-h-screen flex items-center justify-center px-4 bg-[#0b0f12]">
    <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-[0.02] flex items-center justify-center">
        <h1 class="text-[40vw] font-black italic text-white uppercase select-none">LOGIN</h1>
    </div>

    <div class="max-w-md w-full bg-[#0f1923] p-10 relative border-t-4 border-[#d4af37] shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
        
        <div class="absolute top-0 right-0 w-12 h-12 bg-[#ff4655]" style="clip-path: polygon(100% 0, 0 0, 100% 100%);"></div>
        
        <div class="text-center mb-10 relative">
            <h2 class="text-5xl font-black oswald tracking-tighter text-white uppercase italic">
                USER <span class="text-[#ff4655]">LOGIN</span>
            </h2>
            <div class="h-1 w-20 bg-[#d4af37] mx-auto mt-2"></div>
            <p class="text-gray-500 text-[10px] mt-4 uppercase tracking-[0.4em] font-bold">Authentication Required</p>
        </div>

        <?php if($error): ?>
            <div class="bg-red-600/10 border-l-4 border-[#ff4655] text-[#ff4655] p-4 mb-6 text-xs font-bold uppercase tracking-widest oswald animate-shake">
                <i class="fas fa-shield-virus mr-2"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-6 relative z-10">
            <div>
                <label class="block text-[10px] font-bold text-[#d4af37] uppercase mb-2 tracking-[0.2em]">Deployment Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-600">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" name="email" 
                        class="w-full bg-[#1a252e] border border-white/5 p-4 pl-12 focus:border-[#ff4655] outline-none transition-all text-white font-bold oswald uppercase tracking-wider" 
                        placeholder="NAME@TEC-TRADER.COM" required>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-bold text-[#d4af37] uppercase mb-2 tracking-[0.2em]">Security Key</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-600">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password" 
                        class="w-full bg-[#1a252e] border border-white/5 p-4 pl-12 focus:border-[#ff4655] outline-none transition-all text-white font-bold oswald uppercase tracking-wider" 
                        placeholder="••••••••" required>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center text-[10px] font-bold text-gray-500 uppercase tracking-widest cursor-pointer group">
                    <input type="checkbox" class="mr-2 accent-[#ff4655] bg-transparent border-white/10"> 
                    <span class="group-hover:text-white transition-colors">Keep Session Active</span>
                </label>
                <a href="forgot-password.php" class="text-[10px] font-bold text-[#ff4655] hover:text-[#d4af37] uppercase tracking-widest transition-all italic">Recover Key?</a>
            </div>

            <div class="pt-4">
                <button type="submit" name="login" class="relative group w-full overflow-hidden bg-[#ff4655] py-5 text-white font-black oswald text-xl tracking-[0.3em] uppercase transition-all">
                    <span class="relative z-10">AUTHORIZE ACCESS</span>
                    <div class="absolute inset-0 bg-[#d4af37] translate-x-[-105%] group-hover:translate-x-0 transition-transform duration-300"></div>
                </button>
            </div>
        </form>

        <div class="mt-8 text-center border-t border-white/5 pt-6">
            <p class="text-gray-500 text-[10px] font-bold tracking-widest uppercase">
                NOT REGISTERED? 
                <a href="register.php" class="text-[#ff4655] hover:text-[#d4af37] ml-2 underline decoration-2 underline-offset-4 transition-all">CREATE IDENTITY</a>
            </p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>