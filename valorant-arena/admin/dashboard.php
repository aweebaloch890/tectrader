<?php 
include_once '../config.php';

// Role Check: Using the Numeric Level System (Level 2 or 3 required)
if(!has_role(ROLE_ORGANIZER)) {
    header("Location: ../login.php");
    exit();
}

// Stats auto-fetch with safety checks
$total_teams = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM teams"))['count'] ?? 0;
$active_tourneys = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM tournaments WHERE status IN ('Open', 'Ongoing')"))['count'] ?? 0;
// Note: Adjusted user query to check role numeric value if needed
$total_players = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM users WHERE role = 0"))['count'] ?? 0;
$pending_matches = 8; // Link this to your matches table later
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="min-h-screen bg-[#0b0f12] py-16">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="flex flex-col md:flex-row items-center justify-between mb-16 space-y-6 md:space-y-0">
            <div class="flex items-center space-x-6">
                <div class="h-20 w-2 bg-[#ff4655] shadow-[0_0_15px_rgba(255,70,85,0.5)]"></div>
                <div>
                    <h1 class="text-6xl font-black oswald tracking-tighter uppercase italic text-white leading-none">
                        COMMAND <span class="text-[#d4af37]">CENTER</span>
                    </h1>
                    <p class="text-gray-500 text-[10px] tracking-[0.5em] font-bold uppercase mt-2 italic">
                        Authorized Access Only // <span class="text-[#ff4655]">Level: <?php echo $_SESSION['role']; ?></span>
                    </p>
                </div>
            </div>
            
            <div class="bg-[#1a252e] border border-white/5 px-6 py-3 flex items-center space-x-4">
                <div class="text-right">
                    <p class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">System Status</p>
                    <p class="text-green-500 font-black oswald text-sm italic uppercase tracking-tighter">Operational</p>
                </div>
                <div class="w-10 h-10 rounded-full border-2 border-green-500 flex items-center justify-center animate-pulse">
                    <i class="fas fa-satellite-dish text-green-500 text-xs"></i>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
            <div class="relative bg-[#0f1923] border-t-2 border-[#d4af37] p-8 group overflow-hidden shadow-2xl">
                <div class="absolute -right-4 -top-4 opacity-5 group-hover:opacity-10 transition-all">
                    <i class="fas fa-users text-8xl text-white"></i>
                </div>
                <i class="fas fa-users text-[#d4af37] text-xs mb-6 block tracking-widest font-bold uppercase italic">SQUADRON COUNT</i>
                <h3 class="text-7xl font-black oswald text-white group-hover:translate-x-2 transition-transform duration-500 leading-none"><?php echo str_pad($total_teams, 2, "0", STR_PAD_LEFT); ?></h3>
                <p class="text-gray-500 oswald uppercase tracking-[0.3em] text-[10px] mt-4 font-bold italic">Verified Units</p>
            </div>

            <div class="relative bg-[#0f1923] border-t-2 border-[#ff4655] p-8 group overflow-hidden shadow-2xl">
                <div class="absolute -right-4 -top-4 opacity-5 group-hover:opacity-10 transition-all">
                    <i class="fas fa-trophy text-8xl text-white"></i>
                </div>
                <i class="fas fa-trophy text-[#ff4655] text-xs mb-6 block tracking-widest font-bold uppercase italic">DEPLOYED EVENTS</i>
                <h3 class="text-7xl font-black oswald text-white group-hover:translate-x-2 transition-transform duration-500 leading-none"><?php echo str_pad($active_tourneys, 2, "0", STR_PAD_LEFT); ?></h3>
                <p class="text-gray-500 oswald uppercase tracking-[0.3em] text-[10px] mt-4 font-bold italic">Live Grid</p>
            </div>

            <div class="relative bg-[#0f1923] border-t-2 border-blue-500 p-8 group overflow-hidden shadow-2xl">
                <div class="absolute -right-4 -top-4 opacity-5 group-hover:opacity-10 transition-all">
                    <i class="fas fa-crosshairs text-8xl text-white"></i>
                </div>
                <i class="fas fa-crosshairs text-blue-500 text-xs mb-6 block tracking-widest font-bold uppercase italic">PENDING OPS</i>
                <h3 class="text-7xl font-black oswald text-white group-hover:translate-x-2 transition-transform duration-500 leading-none"><?php echo str_pad($pending_matches, 2, "0", STR_PAD_LEFT); ?></h3>
                <p class="text-gray-500 oswald uppercase tracking-[0.3em] text-[10px] mt-4 font-bold italic">Upcoming Fights</p>
            </div>

            <div class="relative bg-[#0f1923] border-t-2 border-green-500 p-8 group overflow-hidden shadow-2xl">
                <div class="absolute -right-4 -top-4 opacity-5 group-hover:opacity-10 transition-all">
                    <i class="fas fa-user-shield text-8xl text-white"></i>
                </div>
                <i class="fas fa-user-shield text-green-500 text-xs mb-6 block tracking-widest font-bold uppercase italic">ACTIVE AGENTS</i>
                <h3 class="text-7xl font-black oswald text-white group-hover:translate-x-2 transition-transform duration-500 leading-none"><?php echo str_pad($total_players, 2, "0", STR_PAD_LEFT); ?></h3>
                <p class="text-gray-500 oswald uppercase tracking-[0.3em] text-[10px] mt-4 font-bold italic">Registered Personnel</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2 space-y-6">
                <h2 class="text-2xl font-black oswald mb-8 italic uppercase tracking-[0.4em] text-white border-l-4 border-white pl-6">
                    SYSTEM <span class="text-[#ff4655]">OPERATIONS</span>
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="manage-teams.php" class="group bg-[#0f1923] border border-white/5 p-8 flex items-center justify-between hover:bg-[#16212b] transition-all hover:border-[#d4af37]">
                        <div class="flex items-center space-x-6">
                            <div class="w-14 h-14 bg-[#d4af37] text-black flex items-center justify-center text-2xl skew-x-[-12deg]">
                                <i class="fas fa-shield-alt skew-x-[12deg]"></i>
                            </div>
                            <div>
                                <span class="oswald font-black text-xl uppercase tracking-wider text-white">Manage Teams</span>
                                <p class="text-[9px] text-gray-500 uppercase font-bold tracking-widest">Verify / Ban Squads</p>
                            </div>
                        </div>
                        <i class="fas fa-arrow-right text-gray-700 group-hover:text-[#d4af37] transform group-hover:translate-x-2 transition-all"></i>
                    </a>

                    <a href="manage-tournaments.php" class="group bg-[#0f1923] border border-white/5 p-8 flex items-center justify-between hover:bg-[#16212b] transition-all hover:border-[#ff4655]">
                        <div class="flex items-center space-x-6">
                            <div class="w-14 h-14 bg-[#ff4655] text-white flex items-center justify-center text-2xl skew-x-[-12deg]">
                                <i class="fas fa-calendar-check skew-x-[12deg]"></i>
                            </div>
                            <div>
                                <span class="oswald font-black text-xl uppercase tracking-wider text-white">Events Grid</span>
                                <p class="text-[9px] text-gray-500 uppercase font-bold tracking-widest">Deploy / Edit Tournaments</p>
                            </div>
                        </div>
                        <i class="fas fa-arrow-right text-gray-700 group-hover:text-[#ff4655] transform group-hover:translate-x-2 transition-all"></i>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-[#0f1923] border border-white/5 h-full flex flex-col shadow-2xl">
                    <div class="p-6 border-b border-white/5 bg-white/5">
                        <h3 class="oswald text-xs font-black text-white uppercase tracking-[0.4em] italic flex items-center">
                            <i class="fas fa-stream text-[#ff4655] mr-3"></i> Intelligence Feed
                        </h3>
                    </div>
                    <div class="p-6 space-y-6 overflow-y-auto max-h-[400px] custom-scrollbar">
                        <div class="border-l-2 border-[#d4af37] pl-4 py-2">
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">02 MINS AGO</p>
                            <p class="text-xs text-gray-300 font-bold oswald uppercase italic mt-1">
                                <span class="text-[#d4af37]">NEW RECRUIT:</span> Team "Phoenix" registered for S2.
                            </p>
                        </div>
                        <div class="border-l-2 border-[#ff4655] pl-4 py-2">
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">1 HOUR AGO</p>
                            <p class="text-xs text-gray-300 font-bold oswald uppercase italic mt-1">
                                <span class="text-[#ff4655]">MATCH UPDATE:</span> Match #402 results secured.
                            </p>
                        </div>
                    </div>
                    <div class="p-4 bg-black/20 mt-auto text-center border-t border-white/5">
                        <span class="text-[8px] text-gray-600 font-black tracking-[0.5em] uppercase italic animate-pulse italic">Real-time sync active</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 3px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255, 70, 85, 0.3); }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #ff4655; }
</style>

<?php include '../includes/footer.php'; ?>