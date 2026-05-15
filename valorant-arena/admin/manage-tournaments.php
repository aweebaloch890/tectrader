<?php 
include_once '../config.php';

// Auth Check: Level 2 (Organizer) or 3 (Admin) required
if(!has_role(ROLE_ORGANIZER)) {
    header("Location: login.php");
    exit();
}

// Action: Delete Tournament (Prepared Statement)
if(isset($_GET['delete'])){
    $id = clean($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM tournaments WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: manage-tournaments.php?msg=deleted");
    exit();
}

// Action: Tactical Status Change
if(isset($_GET['status']) && isset($_GET['id'])){
    $id = clean($_GET['id']);
    $status = clean($_GET['status']);
    $stmt = $conn->prepare("UPDATE tournaments SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
    header("Location: manage-tournaments.php?msg=status_updated");
    exit();
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="min-h-screen bg-[#0b0f12] py-16">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="border-l-4 border-[#ffd700] pl-6">
                <h2 class="text-5xl font-black oswald tracking-tighter uppercase italic text-white leading-none">
                    TOURNAMENT <span class="text-[#ff4655]">MASTER</span>
                </h2>
                <p class="text-gray-500 text-[10px] tracking-[0.4em] font-bold mt-3 uppercase italic">
                    Event Lifecycle Management // Prize Pool Authority
                </p>
            </div>
            
            <a href="create-tournament.php" class="relative group px-8 py-5 bg-[#ffd700] overflow-hidden transition-all skew-x-[-10deg]">
                <span class="relative z-10 text-black font-black oswald tracking-widest uppercase italic flex items-center skew-x-[10deg]">
                    <i class="fas fa-plus-square mr-3"></i> DEPLOY NEW EVENT
                </span>
                <div class="absolute inset-0 bg-white translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
            </a>
        </div>

        <div class="bg-[#0f1923] border border-white/5 shadow-2xl overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-black/40 text-[9px] font-black uppercase tracking-[0.3em] text-gray-500 border-b border-white/5">
                        <th class="p-6">Operation Intel</th>
                        <th class="p-6">Reward Assets</th>
                        <th class="p-6">Tactical Type</th>
                        <th class="p-6 text-center">Status Command</th>
                        <th class="p-6 text-right">System Control</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.02]">
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM tournaments ORDER BY id DESC");
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                            // Logic for Status Glow
                            $status = $row['status'];
                            $glow = "border-gray-800 text-gray-500";
                            if($status == 'Open') $glow = "border-green-500/30 text-green-500 bg-green-500/5 shadow-[0_0_10px_rgba(34,197,94,0.1)]";
                            if($status == 'Ongoing') $glow = "border-blue-500/30 text-blue-500 bg-blue-500/5 shadow-[0_0_10px_rgba(59,130,246,0.1)]";
                            if($status == 'Closed') $glow = "border-red-500/30 text-red-500 bg-red-500/5";
                    ?>
                    <tr class="hover:bg-white/[0.01] transition-all group">
                        <td class="p-6">
                            <div class="oswald font-black text-2xl uppercase italic tracking-tighter text-white group-hover:text-[#ffd700] transition-colors leading-none">
                                <?php echo $row['title']; ?>
                            </div>
                            <div class="flex items-center mt-3 text-[9px] font-bold text-gray-600 uppercase tracking-widest">
                                <i class="far fa-calendar-alt mr-2 text-[#ff4655]"></i>
                                Deployment: <?php echo date('d M, Y', strtotime($row['start_date'])); ?>
                            </div>
                        </td>

                        <td class="p-6">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-coins text-[#ffd700] text-xs"></i>
                                <span class="text-[#ffd700] font-black oswald text-xl italic tracking-widest">
                                    <?php echo $row['prize_pool']; ?>
                                </span>
                            </div>
                        </td>

                        <td class="p-6">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] px-3 py-1 bg-white/5 border border-white/5">
                                <?php echo $row['type']; ?>
                            </span>
                        </td>

                        <td class="p-6">
                            <div class="flex flex-col items-center space-y-3">
                                <span class="px-4 py-1 border <?php echo $glow; ?> text-[10px] font-black uppercase tracking-widest italic">
                                    ● <?php echo $status; ?>
                                </span>
                                
                                <div class="flex bg-black/60 p-1 rounded-sm border border-white/5">
                                    <a href="manage-tournaments.php?id=<?php echo $row['id']; ?>&status=Open" 
                                       class="text-[8px] font-bold px-2 py-1 hover:bg-green-600 hover:text-white transition-all <?php echo ($status=='Open'?'bg-green-600/20 text-green-500':'text-gray-600'); ?>">OPEN</a>
                                    <a href="manage-tournaments.php?id=<?php echo $row['id']; ?>&status=Ongoing" 
                                       class="text-[8px] font-bold px-2 py-1 hover:bg-blue-600 hover:text-white transition-all <?php echo ($status=='Ongoing'?'bg-blue-600/20 text-blue-500':'text-gray-600'); ?>">LIVE</a>
                                    <a href="manage-tournaments.php?id=<?php echo $row['id']; ?>&status=Closed" 
                                       class="text-[8px] font-bold px-2 py-1 hover:bg-red-600 hover:text-white transition-all <?php echo ($status=='Closed'?'bg-red-600/20 text-red-500':'text-gray-600'); ?>">END</a>
                                </div>
                            </div>
                        </td>

                        <td class="p-6 text-right">
                            <div class="flex justify-end space-x-3">
                                <a href="edit-tournament.php?id=<?php echo $row['id']; ?>" 
                                   class="w-10 h-10 bg-white/5 border border-white/5 flex items-center justify-center text-gray-500 hover:bg-[#ffd700] hover:text-black transition-all">
                                    <i class="fas fa-cog text-xs"></i>
                                </a>
                                <a href="manage-tournaments.php?delete=<?php echo $row['id']; ?>" 
                                   onclick="return confirm('WARNING: Purging this event will terminate all associated brackets. Confirm termination?')"
                                   class="w-10 h-10 bg-white/5 border border-white/5 flex items-center justify-center text-gray-500 hover:bg-[#ff4655] hover:text-white transition-all">
                                    <i class="fas fa-bolt text-xs"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='5' class='p-32 text-center'>
                                <p class='oswald text-2xl text-gray-800 tracking-[0.5em] uppercase italic'>No active operations in grid</p>
                              </td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>