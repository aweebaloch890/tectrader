<?php 
include_once 'config.php'; 
include 'includes/header.php'; 
include 'includes/navbar.php'; 
?>

<div class="bg-[#0b0f12] py-20 border-b border-white/5">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-6xl md:text-8xl font-black oswald tracking-tighter italic text-white uppercase leading-none">
            ELITE <span class="text-[#ff4655]">LEADERBOARD</span>
        </h2>
        <div class="h-1 w-32 bg-[#d4af37] mx-auto mt-6"></div>
        <p class="text-gray-500 mt-6 uppercase tracking-[0.5em] text-[10px] font-bold">Season 2: Tactical Rankings & Contenders</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-6 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
        
        <div class="lg:col-span-1">
            <div class="bg-[#0f1923] p-8 border-t-2 border-[#d4af37] sticky top-28 shadow-2xl">
                <h3 class="oswald text-xl font-black text-white mb-6 uppercase italic tracking-wider flex items-center">
                    <i class="fas fa-search text-[#ff4655] mr-3"></i> Locate Team
                </h3>
                
                <div class="space-y-6">
                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 block">Team Name</label>
                        <input type="text" placeholder="TAG OR NAME..." 
                               class="w-full bg-[#1a252e] border border-white/5 p-4 text-xs font-bold oswald text-white focus:border-[#ff4655] outline-none transition-all">
                    </div>
                    
                    <div>
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3 block">Regional Grid</label>
                        <div class="space-y-3">
                            <label class="flex items-center group cursor-pointer">
                                <input type="checkbox" class="hidden peer">
                                <div class="w-4 h-4 border border-white/10 peer-checked:bg-[#ff4655] peer-checked:border-[#ff4655] transition-all mr-3"></div>
                                <span class="text-xs font-bold text-gray-400 group-hover:text-white uppercase tracking-widest transition-all">Pakistan (PK)</span>
                            </label>
                            <label class="flex items-center group cursor-pointer">
                                <input type="checkbox" class="hidden peer">
                                <div class="w-4 h-4 border border-white/10 peer-checked:bg-[#ff4655] peer-checked:border-[#ff4655] transition-all mr-3"></div>
                                <span class="text-xs font-bold text-gray-400 group-hover:text-white uppercase tracking-widest transition-all">International</span>
                            </label>
                        </div>
                    </div>

                    <div class="pt-4">
                        <a href="create_team.php" class="relative group block w-full overflow-hidden bg-white py-4 text-center">
                            <span class="relative z-10 text-black font-black oswald text-sm tracking-widest uppercase italic">CREATE YOUR SQUAD</span>
                            <div class="absolute inset-0 bg-[#ff4655] translate-x-[-101%] group-hover:translate-x-0 transition-transform duration-300"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php
            // Database query with Fallback for rating
            $query = "SELECT * FROM teams ORDER BY rating DESC";
            $result = mysqli_query($conn, $query);
            
            if(mysqli_num_rows($result) > 0) {
                $rank = 1;
                while($team = mysqli_fetch_assoc($result)){
            ?>
            <div class="group relative bg-[#0f1923] border border-white/5 p-8 transition-all duration-500 hover:border-[#d4af37]/50 shadow-lg">
                
                <div class="absolute -right-2 -bottom-6 text-[120px] font-black italic text-white/[0.03] group-hover:text-[#ff4655]/10 group-hover:scale-110 transition-all duration-700 pointer-events-none">
                    #<?php echo str_pad($rank++, 2, "0", STR_PAD_LEFT); ?>
                </div>

                <div class="relative z-10">
                    <div class="flex items-center space-x-6">
                        <div class="relative w-24 h-24 bg-[#1a252e] flex items-center justify-center border-l-4 border-[#ff4655] p-2 group-hover:border-[#d4af37] transition-colors">
                            <img src="assets/img/teams/<?php echo $team['logo'] ?? 'default_team.png'; ?>" 
                                 alt="Logo" class="max-w-full h-auto opacity-90 group-hover:scale-110 transition-transform duration-500 grayscale group-hover:grayscale-0">
                        </div>

                        <div class="flex-1">
                            <h3 class="text-3xl font-black oswald italic text-white leading-none tracking-tighter group-hover:text-[#d4af37] transition-colors">
                                <?php echo strtoupper($team['team_name']); ?>
                            </h3>
                            <div class="flex items-center mt-2 space-x-2">
                                <span class="bg-[#ff4655] text-white text-[9px] font-black px-2 py-0.5 tracking-widest">
                                    <?php echo strtoupper($team['team_tag']); ?>
                                </span>
                                <span class="text-[9px] font-bold text-gray-500 tracking-[0.2em] uppercase">Verified Unit</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 flex justify-between items-end border-t border-white/5 pt-6">
                        <div>
                            <p class="text-[9px] text-gray-500 font-bold uppercase tracking-[0.3em] mb-1 italic">Tactical Rating</p>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-bolt text-[#d4af37] text-xs"></i>
                                <span class="text-4xl font-black oswald text-white tracking-tighter italic">
                                    <?php echo number_format($team['rating'] ?? 0); ?>
                                </span>
                            </div>
                        </div>

                        <a href="team_profile.php?id=<?php echo $team['id']; ?>" 
                           class="relative px-6 py-2 border border-white/10 text-[10px] font-black oswald text-white uppercase tracking-[0.2em] hover:bg-[#ff4655] hover:border-[#ff4655] transition-all italic">
                            INTEL / ROSTER
                        </a>
                    </div>
                </div>
            </div>
            <?php 
                } 
            } else {
                echo "
                <div class='col-span-full py-20 text-center bg-[#0f1923] border border-white/5'>
                    <i class='fas fa-ghost text-5xl text-gray-800 mb-4'></i>
                    <p class='text-gray-500 oswald tracking-[0.5em] uppercase text-sm'>No active teams detected in this grid.</p>
                </div>";
            }
            ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>