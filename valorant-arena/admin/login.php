<?php 
include_once '../config.php';

// Check if already logged in as Admin or Organizer
if(is_logged_in() && has_role(ROLE_ORGANIZER)){
    header("Location: dashboard.php");
    exit();
}

$error = "";

if(isset($_POST['admin_login'])){
    $email = clean($_POST['email']);
    $pass  = $_POST['password'];

    // Hum level 2 (Organizer) ya level 3 (Admin) ko allow kar rahe hain
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND (role >= 2)");
    $admin = mysqli_fetch_assoc($query);

    if($admin && password_verify($pass, $admin['password'])){
        $_SESSION['user_id'] = $admin['id'];
        $_SESSION['username'] = $admin['username'];
        $_SESSION['role'] = $admin['role'];
        
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "CRITICAL: UNAUTHORIZED ACCESS DETECTED.";
    }
}
?>

<?php include '../includes/header.php'; ?>

<div class="min-h-screen flex items-center justify-center bg-[#0b0f12] px-4 relative overflow-hidden">
    <div class="absolute inset-0 opacity-[0.02] pointer-events-none select-none">
        <h1 class="text-[20vw] font-black oswald leading-none rotate-12">SECURE GATEWAY</h1>
    </div>

    <div class="max-w-md w-full relative">
        <div class="absolute -inset-2 bg-[#ff4655] opacity-10 blur-2xl rounded-full"></div>
        
        <div class="relative bg-[#0f1923] p-10 border-t-4 border-[#ff4655] shadow-[0_40px_80px_rgba(0,0,0,0.8)]">
            
            <div class="flex justify-center mb-10">
                <div class="relative group">
                    <div class="absolute -inset-4 bg-[#ff4655] opacity-20 group-hover:opacity-40 rounded-full blur transition-all"></div>
                    <div class="w-20 h-20 bg-[#ff4655] flex items-center justify-center rotate-45 border-4 border-[#0f1923] relative z-10">
                        <i class="fas fa-fingerprint text-3xl text-white -rotate-45"></i>
                    </div>
                </div>
            </div>

            <div class="text-center mb-12">
                <h2 class="text-4xl font-black oswald tracking-tighter text-white uppercase italic leading-none">
                    TERMINAL <span class="text-[#ff4655]">ACCESS</span>
                </h2>
                <div class="h-1 w-16 bg-[#d4af37] mx-auto mt-4"></div>
                <p class="text-gray-500 text-[10px] tracking-[0.5em] font-bold mt-6 uppercase italic">Protocol: Season 2 Administrative Control</p>
            </div>

            <?php if($error): ?>
                <div class="bg-red-600/10 border-l-4 border-[#ff4655] p-4 mb-8 text-[#ff4655] text-[10px] font-black uppercase oswald tracking-[0.2em] animate-pulse">
                    <i class="fas fa-exclamation-triangle mr-2"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-8">
                <div class="relative">
                    <label class="block text-[10px] font-bold text-[#d4af37] uppercase mb-3 tracking-[0.3em] italic">Administrator Email</label>
                    <div class="relative">
                        <i class="fas fa-id-badge absolute left-4 top-1/2 -translate-y-1/2 text-gray-600"></i>
                        <input type="email" name="email" 
                            class="w-full bg-[#1a252e] border border-white/5 p-5 pl-12 focus:border-[#ff4655] outline-none transition-all text-white font-bold oswald uppercase tracking-widest text-sm" 
                            placeholder="ADMIN@TEC-TRADER.COM" required>
                    </div>
                </div>

                <div class="relative">
                    <label class="block text-[10px] font-bold text-[#d4af37] uppercase mb-3 tracking-[0.3em] italic">Encrypted Key</label>
                    <div class="relative">
                        <i class="fas fa-key absolute left-4 top-1/2 -translate-y-1/2 text-gray-600"></i>
                        <input type="password" name="password" 
                            class="w-full bg-[#1a252e] border border-white/5 p-5 pl-12 focus:border-[#ff4655] outline-none transition-all text-white font-bold oswald tracking-widest text-sm" 
                            placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" name="admin_login" class="relative group w-full overflow-hidden bg-white py-5 transition-all">
                    <span class="relative z-10 text-black font-black oswald text-xl tracking-[0.3em] uppercase italic">AUTHORIZE LOGIN</span>
                    <div class="absolute inset-0 bg-[#ff4655] translate-x-[-101%] group-hover:translate-x-0 transition-transform duration-500"></div>
                </button>
            </form>

            <div class="mt-12 text-center border-t border-white/5 pt-8">
                <a href="../index.php" class="text-gray-600 hover:text-[#ff4655] text-[9px] font-black uppercase tracking-[0.4em] transition-all flex items-center justify-center italic">
                    <i class="fas fa-chevron-left mr-3"></i> ABORT & RETURN TO GRID
                </a>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>