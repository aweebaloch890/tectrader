<?php 
include_once 'config.php'; 

// Auth Check - Sirf logged in users hi team bana saktay hain
if(!is_logged_in()) {
    header("Location: login.php");
    exit();
}

$error = "";
$success = "";

if(isset($_POST['create_team'])){
    $team_name  = clean($_POST['team_name']);
    $team_tag   = strtoupper(clean($_POST['team_tag']));
    $captain_id = $_SESSION['user_id'];
    
    // Check if user already owns a team
    $check_captain = mysqli_query($conn, "SELECT id FROM teams WHERE captain_id = '$captain_id'");
    
    if(mysqli_num_rows($check_captain) > 0) {
        $error = "You already own a team! One captain per team policy.";
    } else {
        // --- LOGO UPLOAD LOGIC ---
        $target_dir = "assets/uploads/teams/";
        // Create directory if not exists
        if (!file_exists($target_dir)) { mkdir($target_dir, 0777, true); }

        $file_name = time() . "_" . basename($_FILES["team_logo"]["name"]);
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Basic Image Validation
        if(getimagesize($_FILES["team_logo"]["tmp_name"]) === false) {
            $error = "File is not an image.";
        } elseif ($_FILES["team_logo"]["size"] > 2000000) { // 2MB Limit
            $error = "Logo size too large (Max 2MB).";
        } elseif(!in_array($imageFileType, ['jpg', 'png', 'jpeg'])) {
            $error = "Only JPG, JPEG & PNG files are allowed.";
        } else {
            if (move_uploaded_file($_FILES["team_logo"]["tmp_name"], $target_file)) {
                // Insert into Database
                $sql = "INSERT INTO teams (team_name, team_tag, team_logo, captain_id, rating) 
                        VALUES ('$team_name', '$team_tag', '$target_file', '$captain_id', 0)";
                
                if(mysqli_query($conn, $sql)){
                    $team_id = mysqli_insert_id($conn);
                    
                    // Update user role to Captain (Level 1)
                    mysqli_query($conn, "UPDATE users SET role = 1 WHERE id = '$captain_id'");
                    $_SESSION['user_role'] = 1;

                    // Add Captain to team_members
                    mysqli_query($conn, "INSERT INTO team_members (team_id, user_id, role) VALUES ('$team_id', '$captain_id', 'Captain')");
                    
                    echo "<script>alert('Organization Established! Welcome to Tec Trader Season 2.'); window.location='teams.php';</script>";
                } else {
                    $error = "Team Name or Tag already taken.";
                }
            } else {
                $error = "Error uploading logo.";
            }
        }
    }
}
?>

<?php include 'includes/header.php'; ?>
<div class="min-h-screen flex items-center justify-center px-6 py-20 bg-[#0b0f12]">
    <div class="max-w-xl w-full bg-[#0f1923] border-t-4 border-[#ff4655] p-10 shadow-[0_0_50px_rgba(255,70,85,0.1)] relative overflow-hidden">
        
        <div class="absolute -right-10 -top-10 opacity-10 pointer-events-none">
            <h1 class="text-[150px] font-black italic text-white uppercase">VLT</h1>
        </div>

        <div class="text-center mb-10 relative">
            <h2 class="text-5xl font-black oswald italic tracking-tighter uppercase text-white">
                START YOUR <span class="text-[#d4af37]">LEGACY</span>
            </h2>
            <p class="text-gray-500 text-[10px] tracking-[0.5em] font-bold mt-2 uppercase">Tec Trader Valorant Season 2</p>
        </div>

        <?php if($error): ?>
            <div class="bg-red-600/10 border-l-4 border-[#ff4655] p-4 mb-6 text-[#ff4655] text-xs font-bold uppercase tracking-widest oswald">
                <i class="fas fa-exclamation-triangle mr-2"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="space-y-6 relative z-10">
            <div>
                <label class="block text-[10px] font-bold text-[#d4af37] uppercase mb-2 tracking-[0.2em]">Full Team Name</label>
                <input type="text" name="team_name" placeholder="E.G. TEC TRADERS ESPORTS" 
                       class="w-full bg-[#1a252e] border border-white/10 p-4 focus:border-[#ff4655] outline-none text-white font-bold oswald text-xl uppercase tracking-wider transition-all" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-bold text-[#d4af37] uppercase mb-2 tracking-[0.2em]">Team Tag</label>
                    <input type="text" name="team_tag" placeholder="TT" maxlength="5"
                           class="w-full bg-[#1a252e] border border-white/10 p-4 focus:border-[#ff4655] outline-none text-white font-black oswald text-3xl uppercase tracking-widest transition-all" required>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-[#d4af37] uppercase mb-2 tracking-[0.2em]">Team Logo (1:1)</label>
                    <input type="file" name="team_logo" accept="image/*"
                           class="w-full bg-[#1a252e] border border-white/10 p-3 text-xs text-gray-400 file:bg-[#ff4655] file:border-none file:text-white file:font-bold file:px-3 file:py-1 file:mr-4 file:cursor-pointer hover:file:bg-[#d4af37]" required>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" name="create_team" 
                        class="relative group w-full overflow-hidden bg-[#ff4655] py-5 text-white font-black oswald text-xl tracking-[0.3em] uppercase transition-all">
                    <span class="relative z-10">REGISTER ORGANIZATION</span>
                    <div class="absolute inset-0 bg-[#d4af37] translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-300"></div>
                </button>
            </div>
        </form>

        <div class="mt-8 text-center">
            <a href="teams.php" class="text-gray-500 hover:text-[#ff4655] text-[10px] font-bold uppercase tracking-widest transition-all italic">
                <i class="fas fa-long-arrow-alt-left mr-2"></i> Return to Headquarters
            </a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>