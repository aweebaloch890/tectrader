<?php 
include_once 'config.php'; 
include 'includes/header.php'; 
include 'includes/navbar.php'; 
?>

<div class="bg-[#0b0f12] py-20 border-b border-white/5 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-1/3 h-full bg-[#ff4655]/5 skew-x-[-20deg] translate-x-20"></div>
    
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-end gap-8">
            <div>
                <h2 class="text-6xl md:text-8xl font-black oswald tracking-tighter italic text-white leading-none">
                    ACTIVE <span class="text-[#ff4655]">EVENTS</span>
                </h2>
                <div class="h-1.5 w-32 bg-[#d4af37] mt-6"></div>
                <p class="text-gray-500 uppercase tracking-[0.5em] text-[10px] font-bold mt-6 italic">Secure your spot in the professional circuit</p>
            </div>
            
            <?php if(has_role(ROLE_ORGANIZER)): ?>
                <a href="admin/create_tournament.php" class="group relative px-8 py-4 bg-transparent border-2 border-[#d4af37] overflow-hidden transition-all">
                    <span class="relative z-10 text-[#d4af37] group-hover:text-black font-black oswald tracking-widest uppercase italic flex items-center">
                        <i class="fas fa-plus-square mr-3"></i> DEPLOY NEW EVENT
                    </span>
                    <div class="absolute inset-0 bg-[#d4af37] translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-6 py-20">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
        <?php
        // Database se tournaments fetch karna
        $result = mysqli_query($conn, "SELECT * FROM tournaments ORDER BY start_date DESC");
        
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){
                // Status Logic
                $isOpen = (strtolower($row['status']) == 'open');
                $status_color = $isOpen ? 'text-green-500 border-green-500/30' : 'text-[#ff4655] border-[#ff4655]/30';
                $status_dot = $isOpen ? 'bg-green-500 animate-pulse' : 'bg-[#ff4655]';
        ?>
        <div class="group bg-[#0f1923] border border-white/5 relative transition-all duration-500 hover:border-[#ff4655]/40 hover:-translate-y-3 shadow-2xl">
            <div class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-[#ff4655] to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center space-x-2 px-3 py-1 border <?php echo $status_color; ?> bg-black/20">
                        <span class="w-1.5 h-1.5 rounded-full <?php echo $status_dot; ?>"></span>
                        <span class="text-[9px] font-black uppercase tracking-[0.2em]">
                            <?php echo $row['status']; ?>
                        </span>
                    </div>
                    <span class="text-gray-500 oswald text-[10px] font-bold uppercase tracking-widest italic">
                        Starts: <?php echo date('d M, Y', strtotime($row['start_date'])); ?>
                    </span>
                </div>

                <h3 class="text-3xl font-black oswald mb-4 text-white group-hover:text-[#d4af37] transition-colors leading-none tracking-tighter uppercase italic">
                    <?php echo $row['title']; ?>
                </h3>
                
                <div class="bg-[#1a252e] p-4 border-l-4 border-[#ff4655] mb-8">
                    <p class="text-[9px] text-gray-500 font-bold uppercase tracking-[0.3em] mb-1 italic">Authorized Prize Pool</p>
                    <div class="flex items-center text-white">
                        <span class="text-2xl font-black oswald tracking-wider text-[#d4af37]">
                            <?php echo $row['prize_pool']; ?>
                        </span>
                        <i class="fas fa-trophy ml-3 text-[#ff4655] text-xs"></i>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-10">
                    <div class="border-r border-white/5">
                        <p class="text-[9px] text-gray-500 font-bold uppercase tracking-widest mb-1">Game Mode</p>
                        <p class="text-xs font-black text-white oswald italic uppercase"><?php echo $row['type']; ?></p>
                    </div>
                    <div class="pl-2">
                        <p class="text-[9px] text-gray-500 font-bold uppercase tracking-widest mb-1">Bracket</p>
                        <p class="text-xs font-black text-white oswald italic uppercase"><?php echo <?= $tournament['bracket_type'] ?? 'Single Elimination' ?>
                    </div>
                </div>

                <a href="tournament_details.php?id=<?php echo $row['id']; ?>" 
                   class="relative group/btn block w-full bg-white py-4 overflow-hidden text-center transition-all">
                    <span class="relative z-10 text-black font-black oswald text-xs tracking-[0.3em] uppercase italic">ENTER PROTOCOL</span>
                    <div class="absolute inset-0 bg-[#ff4655] translate-x-[-101%] group-hover/btn:translate-x-0 transition-transform duration-300"></div>
                </a>
            </div>
            
            <div class="absolute bottom-0 right-0 w-8 h-8 bg-[#0b0f12]" style="clip-path: polygon(100% 0, 0 100%, 100% 100%);"></div>
        </div>
        <?php 
            }
        } else {
            echo '
            <div class="col-span-full py-32 text-center bg-[#0f1923] border-2 border-dashed border-white/5">
                <i class="fas fa-satellite-dish text-6xl text-gray-800 mb-6 animate-pulse"></i>
                <p class="oswald text-2xl text-gray-600 tracking-[0.4em] uppercase italic font-bold">Scanning for active transmissions...</p>
                <p class="text-gray-700 text-xs mt-2 uppercase tracking-widest">No tournaments found in this sector.</p>
            </div>';
        }
        ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>