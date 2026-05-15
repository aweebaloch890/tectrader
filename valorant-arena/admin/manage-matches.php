<?php 
include_once '../config.php';

// Auth Check: Level 2 (Organizer) or 3 (Admin) required
if(!has_role(ROLE_ORGANIZER)) {
    header("Location: login.php");
    exit();
}

// Result handle karne ke liye (Delete logic)
if(isset($_GET['delete'])){
    $id = clean($_GET['delete']);
    // Security: Only allow delete if ID is valid
    $stmt = $conn->prepare("DELETE FROM matches WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: manage-matches.php?msg=deleted");
    exit();
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="min-h-screen bg-[#0b0f12] py-16">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="border-l-4 border-[#ff4655] pl-6">
                <h2 class="text-5xl font-black oswald tracking-tighter uppercase italic text-white leading-none">
                    MATCH <span class="text-[#ff4655]">OPERATIONS</span>
                </h2>
                <p class="text-gray-500 text-[10px] tracking-[0.4em] font-bold uppercase mt-3 italic">
                    Grid Protocol // Tactical Fixture Management
                </p>
            </div>
            
            <a href="create-match.php" class="relative group px-8 py-4 bg-[#ff4655] overflow-hidden transition-all">
                <span class="relative z-10 text-white font-black oswald tracking-widest uppercase italic flex items-center">
                    <i class="fas fa-plus-circle mr-3"></i> CREATE NEW FIXTURE
                </span>
                <div class="absolute inset-0 bg-white translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                <style>.group:hover span { color: black; }</style>
            </a>
        </div>

        <div class="bg-[#0f1923] border border-white/5 shadow-2xl overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-black/40 border-b border-white/5 text-[9px] font-black uppercase tracking-[0.3em] text-gray-500">
                        <th class="p-6">Intel ID</th>
                        <th class="p-6">Combatant Matchup</th>
                        <th class="p-6">Operation / Tournament</th>
                        <th class="p-6">Status</th>
                        <th class="p-6 text-right">Control</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.02]">
                    <?php
                    // JOIN query taake tournament ka title aur teams ki details mil saken
                    $sql = "SELECT m.*, t.title as tournament_name 
                            FROM matches m 
                            LEFT JOIN tournaments t ON m.tournament_id = t.id 
                            ORDER BY m.id DESC";
                    $res = mysqli_query($conn, $sql);
                    
                    if($res && mysqli_num_rows($res) > 0) {
                        while($row = mysqli_fetch_assoc($res)){
                            // Dynamic Status Styling
                            $status = strtoupper($row['status']);
                            $status_color = "text-gray-500 border-gray-800";
                            $dot_color = "bg-gray-700";

                            if($status == 'LIVE') {
                                $status_color = "text-green-500 border-green-500/20 bg-green-500/5";
                                $dot_color = "bg-green-500 animate-pulse shadow-[0_0_8px_#22c55e]";
                            } elseif($status == 'UPCOMING') {
                                $status_color = "text-[#d4af37] border-[#d4af37]/20 bg-[#d4af37]/5";
                                $dot_color = "bg-[#d4af37]";
                            } elseif($status == 'COMPLETED') {
                                $status_color = "text-blue-500 border-blue-500/20";
                                $dot_color = "bg-blue-500";
                            }
                    ?>
                    <tr class="hover:bg-white/[0.02] transition-all group">
                        <td class="p-6 font-mono text-[10px] text-gray-600">
                            #<?php echo str_pad($row['id'], 3, "0", STR_PAD_LEFT); ?>
                        </td>

                        <td class="p-6">
                            <div class="flex items-center space-x-4">
                                <span class="oswald font-black text-xl uppercase italic tracking-tighter text-white group-hover:text-[#d4af37] transition-colors">
                                    <?php echo $row['team_a']; ?>
                                </span>
                                <div class="px-2 py-0.5 bg-[#ff4655]/10 border border-[#ff4655]/20 text-[#ff4655] text-[8px] font-black italic">VS</div>
                                <span class="oswald font-black text-xl uppercase italic tracking-tighter text-white group-hover:text-[#d4af37] transition-colors">
                                    <?php echo $row['team_b']; ?>
                                </span>
                            </div>
                        </td>

                        <td class="p-6">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest italic">
                                <i class="fas fa-trophy mr-2 text-gray-700"></i>
                                <?php echo $row['tournament_name'] ?? 'Unassigned Event'; ?>
                            </p>
                        </td>

                        <td class="p-6">
                            <div class="inline-flex items-center space-x-2 px-3 py-1 border <?php echo $status_color; ?>">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo $dot_color; ?>"></span>
                                <span class="text-[9px] font-black uppercase tracking-widest">
                                    <?php echo $status; ?>
                                </span>
                            </div>
                        </td>

                        <td class="p-6 text-right">
                            <div class="flex justify-end space-x-4">
                                <a href="edit-match.php?id=<?php echo $row['id']; ?>" class="w-10 h-10 bg-white/5 border border-white/5 flex items-center justify-center text-gray-400 hover:bg-[#d4af37] hover:text-black transition-all">
                                    <i class="fas fa-pen-nib text-xs"></i>
                                </a>
                                <a href="manage-matches.php?delete=<?php echo $row['id']; ?>" 
                                   onclick="return confirm('CRITICAL: Permanently purge this match data?')"
                                   class="w-10 h-10 bg-white/5 border border-white/5 flex items-center justify-center text-gray-400 hover:bg-[#ff4655] hover:text-white transition-all">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='5' class='p-32 text-center'>
                                <i class='fas fa-ghost text-4xl text-gray-800 mb-4 block'></i>
                                <p class='oswald text-xl text-gray-600 tracking-[0.4em] uppercase italic'>No active combat data detected</p>
                              </td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>