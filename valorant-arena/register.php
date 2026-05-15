<?php 
include_once 'config.php';

// Agar user pehle se login hai toh seedha home par
if(is_logged_in()){
    header("Location: index.php");
    exit();
}

$error = "";

if(isset($_POST['register'])){
    $username = clean($_POST['username']);
    $email    = clean($_POST['email']);
    $pass     = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $valorant = clean($_POST['valorant_id']); // Format: Name#TAG
    $discord  = clean($_POST['discord']);
    $rank     = clean($_POST['rank']); 

    // Email duplication check
    $check_email = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
    if(mysqli_num_rows($check_email) > 0){
        $error = "CRITICAL ERROR: IDENTITY ALREADY EXISTS IN DATABASE!";
    } else {
        // Role 0 = Player (as per config.php)
        $sql = "INSERT INTO users (username, email, password, valorant_id, discord_id, rank, role) 
                VALUES ('$username', '$email', '$pass', '$valorant', '$discord', '$rank', 0)";
        
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('RECRUITMENT SUCCESSFUL: Your profile is now active.'); window.location='login.php';</script>";
        } else {
            $error = "SYSTEM FAILURE: DATA COULD NOT BE SECURED.";
        }
    }
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="min-h-screen py-24 flex items-center justify-center px-4 bg-[#0b0f12]">
    <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-[0.03] flex items-center justify-center">
        <h1 class="text-[35vw] font-black italic text-white uppercase select-none">JOIN</h1>
    </div>

    <div class="max-w-2xl w-full bg-[#0f1923] p-10 relative border-t-4 border-[#d4af37] shadow-[0_30px_60px_rgba(0,0,0,0.6)]">
        
        <div class="absolute top-0 left-0 w-2 h-16 bg-[#ff4655]"></div>
        <div class="absolute top-0 left-0 w-16 h-2 bg-[#ff4655]"></div>
        
        <div class="mb-12 relative text-center">
            <h2 class="text-6xl font-black oswald tracking-tighter text-white uppercase italic leading-none">
                AGENT <span class="text-[#ff4655]">ENROLLMENT</span>
            </h2>
            <p class="text-gray-500 text-[10px] mt-4 uppercase tracking-[0.5em] font-bold">Tec Trader Tactical Infrastructure</p>
            <div class="h-1 w-24 bg-[#d4af37] mx-auto mt-4"></div>
        </div>

        <?php if($error): ?>
            <div class="bg-red-600/10 border-l-4 border-[#ff4655] text-[#ff4655] p-4 mb-8 text-xs font-bold uppercase tracking-widest oswald animate-shake">
                <i class="fas fa-biohazard mr-2"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6 relative z-10">
            
            <div class="md:col-span-1">
                <label class="block text-[10px] font-bold text-[#d4af37] uppercase mb-2 tracking-[0.2em]">Agent Callsign</label>
                <input type="text" name="username" placeholder="E.G. TENZ" 
                    class="w-full bg-[#1a252e] border border-white/5 p-4 focus:border-[#ff4655] outline-none transition-all text-white font-bold oswald uppercase" required>
            </div>

            <div class="md:col-span-1">
                <label class="block text-[10px] font-bold text-[#d4af37] uppercase mb-2 tracking-[0.2em]">Secure Email</label>
                <input type="email" name="email" placeholder="AGENT@TEC-TRADER.COM" 
                    class="w-full bg-[#1a252e] border border-white/5 p-4 focus:border-[#ff4655] outline-none transition-all text-white font-bold oswald uppercase" required>
            </div>

            <div class="md:col-span-2">
                <label class="block text-[10px] font-bold text-[#d4af37] uppercase mb-2 tracking-[0.2em]">Security Key (Password)</label>
                <input type="password" name="password" placeholder="••••••••" 
                    class="w-full bg-[#1a252e] border border-white/5 p-4 focus:border-[#ff4655] outline-none transition-all text-white font-bold oswald uppercase" required>
            </div>

            <div class="md:col-span-1">
                <label class="block text-[10px] font-bold text-[#d4af37] uppercase mb-2 tracking-[0.2em]">Riot ID + Tag</label>
                <input type="text" name="valorant_id" placeholder="NAME#000" 
                    class="w-full bg-[#1a252e] border border-white/5 p-4 focus:border-[#ffd700] outline-none transition-all text-[#ff4655] font-black oswald uppercase tracking-widest" required>
            </div>

            <div class="md:col-span-1">
                <label class="block text-[10px] font-bold text-[#d4af37] uppercase mb-2 tracking-[0.2em]">Competitive Rank</label>
                <div class="relative">
                    <select name="rank" class="w-full bg-[#1a252e] border border-white/5 p-4 focus:border-[#ff4655] outline-none transition-all text-white font-bold oswald uppercase cursor-pointer appearance-none">
                        <option value="Iron">Iron</option>
                        <option value="Bronze">Bronze</option>
                        <option value="Silver">Silver</option>
                        <option value="Gold">Gold</option>
                        <option value="Platinum">Platinum</option>
                        <option value="Diamond">Diamond</option>
                        <option value="Ascendant">Ascendant</option>
                        <option value="Immortal">Immortal</option>
                        <option value="Radiant">Radiant</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                        <i class="fas fa-chevron-down text-[#ff4655] text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <label class="block text-[10px] font-bold text-[#d4af37] uppercase mb-2 tracking-[0.2em]">Discord Handle (For Comms)</label>
                <input type="text" name="discord" placeholder="USERNAME#0000" 
                    class="w-full bg-[#1a252e] border border-white/5 p-4 focus:border-[#ff4655] outline-none transition-all text-white font-bold oswald uppercase">
            </div>

            <div class="md:col-span-2 mt-8">
                <button type="submit" name="register" class="relative group w-full overflow-hidden bg-[#ff4655] py-6 text-white font-black oswald text-2xl tracking-[0.4em] uppercase transition-all shadow-[0_0_20px_rgba(255,70,85,0.3)]">
                    <span class="relative z-10">INITIALIZE IDENTITY</span>
                    <div class="absolute inset-0 bg-[#d4af37] translate-x-[-101%] group-hover:translate-x-0 transition-transform duration-500"></div>
                </button>
            </div>
        </form>

        <p class="mt-10 text-center text-[10px] text-gray-500 font-bold uppercase tracking-[0.3em]">
            IDENTIFIED BEFORE? <a href="login.php" class="text-[#ff4655] hover:text-[#d4af37] underline underline-offset-4 transition-all ml-2 italic">ACCESS ACCOUNT</a>
        </p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>