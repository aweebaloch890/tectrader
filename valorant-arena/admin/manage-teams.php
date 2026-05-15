<?php 
include_once '../config.php';

// Auth Check: Level 2 (Organizer) or 3 (Admin) required
if(!has_role(ROLE_ORGANIZER)) {
    header("Location: login.php");
    exit();
}

// Action: Delete Team (Security Optimized)
if(isset($_GET['delete'])){
    $id = clean($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM teams WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: manage-teams.php?msg=purged");
    exit();
}

// Action: Update Rating (Secure Update)
if(isset($_POST['update_rating'])){
    $id = clean($_POST['team_id']);
    $new_rating = clean($_POST['rating']);
    $stmt = $conn->prepare("UPDATE teams SET rating = ? WHERE id = ?");
    $stmt->bind_param("ii", $new_rating, $id);
    $stmt->execute();
    header("Location: manage-teams.php?msg=updated");
    exit();
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="min-h-screen bg-[#0b0f12] py-16">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="flex flex-col md:flex-row items-center justify-between mb-12 gap-6 border-b-2 border-white/5 pb-10">
            <div class="flex items-center space-x-6">
                <div class="w-2 h-16 bg-[#ffd700] shadow-[0_0_15px_rgba(255,215,0,0.3)]"></div>
                <div>
                    <h2 class="text-5xl font-black oswald tracking-tighter uppercase italic text-white leading-none">
                        TEAM <span class="text-[#ffd700]">ROSTER</span> CONTROL
                    </h2>
                    <p class="text-gray-500 text-[10px] tracking-[0.4em] font-bold mt-2 uppercase italic">
                        Authorized Personnel Only // Database Access Level 2
                    </p>
                </div>
            </div>
            
            <div class="bg-[#0f1923] px-8 py-4 border border-white/5 relative group overflow-hidden">
                <div class="relative z-10 flex flex-col items-center">
                    <span class="text-[9px] text-gray-500 font-bold uppercase tracking-widest mb-1">Total Verified Orgs</span>
                    <span class="text-[#ffd700] font-black oswald text-3xl italic">
                        <?php 
                        $count_res = mysqli_query($conn, "SELECT COUNT(id) as total FROM teams");
                        $count_data = mysqli_fetch_assoc($count_res);
                        echo str_pad($count_data['total'], 2, "0", STR_PAD_LEFT); 
                        ?>
                    </span>
                </div>
                <div class="absolute inset-0 bg-[#ffd700] opacity-0 group-hover:opacity-5 transition-opacity"></div>
            </div>
        </div>

        <div class="bg-[#0f1923] border border-white/5 shadow-2xl overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-black/40 text-[9px] font-black uppercase tracking-[0.3em] text-gray-500 border-b border-white/5">
                        <th class="p-6">Insignia</th>
                        <th class="p-6">Organization Details</th>
                        <th class="p-6 text-center">Skill Rating (ELO)</th>
                        <th class="p-6 text-right">Operational Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.02]">
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM teams ORDER BY rating DESC");
                    if(mysqli_num_rows($result) > 0) {
                        while($team = mysqli_fetch_assoc($result)){
                    ?>
                    <tr class="hover:bg-white/[0.02] transition-all group">
                        <td class="p-6 w-32">
                            <div class="relative w-16 h-16 bg-black/50 border border-white/10 flex items-center justify-center overflow-hidden">
                                <?php if(!empty($team['logo'])): ?>
                                    <img src="../uploads/logos/<?php echo $team['logo']; ?>" class="w-full h-full object-contain p-2">
                                <?php else: ?>
                                    <span class="oswald font-black text-2xl text-gray-700 group-hover:text-[#ff4655] transition-colors">
                                        <?php echo substr($team['team_name'], 0, 1); ?>
                                    </span>
                                <?php endif; ?>
                                <div class="absolute bottom-0 left-0 w-full h-0.5 bg-[#ff4655] scale-x-0 group-hover:scale-x-100 transition-transform"></div>
                            </div>
                        </td>

                        <td class="p-6">
                            <div class="oswald font-black text-2xl uppercase italic tracking-tighter text-white group-hover:text-[#ffd700] transition-colors leading-none">
                                <?php echo $team['team_name']; ?>
                            </div>
                            <div class="flex items-center mt-2 space-x-2">
                                <span class="bg-[#ff4655] text-white text-[8px] font-black px-2 py-0.5 italic uppercase tracking-widest">
                                    TAG: <?php echo $team['team_tag']; ?>
                                </span>
                                <span class="text-gray-600 text-[9px] font-bold uppercase tracking-widest">
                                    UUID: #<?php echo str_pad($team['id'], 3, "0", STR_PAD_LEFT); ?>
                                </span>
                            </div>
                        </td>

                        <td class="p-6">
                            <form method="POST" class="flex items-center justify-center group/form">
                                <input type="hidden" name="team_id" value="<?php echo $team['id']; ?>">
                                <div class="relative">
                                    <input type="number" name="rating" value="<?php echo $team['rating']; ?>" 
                                        class="w-24 bg-black/40 border border-white/5 p-3 text-center oswald font-black text-xl text-[#ffd700] focus:border-[#ff4655] outline-none transition-all">
                                    <button type="submit" name="update_rating" 
                                        class="absolute -right-10 top-1/2 -translate-y-1/2 opacity-0 group-hover/form:opacity-100 transition-all text-green-500 hover:text-white">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </div>
                            </form>
                        </td>

                        <td class="p-6 text-right">
                            <div class="flex justify-end items-center space-x-3">
                                <a href="../team_profile.php?id=<?php echo $team['id']; ?>" target="_blank"
                                    class="w-10 h-10 bg-white/5 border border-white/5 flex items-center justify-center text-gray-500 hover:bg-blue-500 hover:text-white transition-all shadow-xl" 
                                    title="Intelligence Report">
                                    <i class="fas fa-external-link-alt text-xs"></i>
                                </a>
                                
                                <a href="manage-teams.php?delete=<?php echo $team['id']; ?>" 
                                    onclick="return confirm('CRITICAL ALERT: Permanently purge this organization from the database?')"
                                    class="w-10 h-10 bg-white/5 border border-white/5 flex items-center justify-center text-gray-500 hover:bg-[#ff4655] hover:text-white transition-all shadow-xl" 
                                    title="Purge Team">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        } 
                    } else {
                        echo "<tr><td colspan='4' class='p-32 text-center text-gray-700 oswald uppercase tracking-[0.5em] italic'>No Orgs Registered In Grid</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex justify-end">
            <p class="text-[9px] text-gray-600 font-bold uppercase tracking-[0.3em]">
                System Sync: <?php echo date('H:i:s'); ?> // Protocol Secured
            </p>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>