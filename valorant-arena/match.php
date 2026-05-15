<?php 
include_once 'config.php'; 
include 'includes/header.php'; 
include 'includes/navbar.php'; 

// Database se match detail uthana (Mocking for now based on your logic)
$match_id = isset($_GET['id']) ? (int)clean($_GET['id']) : 0;
$team_a = "TEAM LIQUID"; 
$team_b = "SENTINELS";
$tournament_name = TOURNAMENT_TITLE; // Defined in config.php
?>

<div class="bg-[#0b0f12] pt-20 pb-10 border-b border-white/5">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <span class="text-[#ff4655] oswald tracking-[0.5em] text-xs font-bold uppercase animate-pulse">
                // <?php echo $tournament_name; ?>
            </span>
            
            <div class="flex flex-col md:flex-row items-center justify-center gap-6 md:gap-20 mt-6">
                <div class="text-center group">
                    <div class="w-32 h-32 bg-[#1a252e] border-2 border-[#d4af37] flex items-center justify-center mb-4 overflow-hidden transform group-hover:scale-105 transition-all">
                        <img src="assets/images/placeholder_team.png" class="w-20 opacity-80" alt="Team A">
                    </div>
                    <h2 class="text-3xl md:text-6xl font-black oswald tracking-tighter text-white uppercase italic"><?php echo $team_a; ?></h2>
                </div>

                <div class="flex flex-col items-center">
                    <span class="text-5xl md:text-7xl font-black text-[#ff4655] italic oswald tracking-tighter">VS</span>
                    <div class="mt-4 px-6 py-1 bg-[#d4af37]/10 border border-[#d4af37] text-[#d4af37] text-[10px] font-black tracking-[0.3em] uppercase">
                        LIVE BROADCAST
                    </div>
                </div>

                <div class="text-center group">
                    <div class="w-32 h-32 bg-[#1a252e] border-2 border-white/10 flex items-center justify-center mb-4 overflow-hidden transform group-hover:scale-105 transition-all">
                        <img src="assets/images/placeholder_team.png" class="w-20 opacity-80" alt="Team B">
                    </div>
                    <h2 class="text-3xl md:text-6xl font-black oswald tracking-tighter text-white uppercase italic"><?php echo $team_b; ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-6 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
        
        <div class="lg:col-span-1 space-y-8">
            <div class="bg-[#0f1923] p-6 border-t-2 border-[#d4af37] shadow-xl">
                <h3 class="oswald text-xl font-black text-white mb-6 uppercase italic tracking-wider flex items-center">
                    <i class="fas fa-info-circle text-[#ff4655] mr-3"></i> Match Protocol
                </h3>
                <ul class="space-y-4">
                    <li class="flex justify-between items-center border-b border-white/5 pb-2">
                        <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Format</span> 
                        <span class="text-sm font-bold text-white oswald">BEST OF 3</span>
                    </li>
                    <li class="flex justify-between items-center border-b border-white/5 pb-2">
                        <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Region</span> 
                        <span class="text-sm font-bold text-white oswald">PAKISTAN / ASIA</span>
                    </li>
                    <li class="flex justify-between items-center">
                        <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Time</span> 
                        <span class="text-sm font-bold text-[#ff4655] oswald">21:00 PKT</span>
                    </li>
                </ul>
            </div>

            <div class="bg-[#0f1923] p-6 border-t-2 border-[#ff4655] shadow-xl">
                <h3 class="oswald text-xl font-black text-white mb-6 uppercase italic tracking-wider">
                    <i class="fas fa-map-marked-alt text-[#d4af37] mr-3"></i> Map Veto
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center bg-black/40 p-3 border-l-2 border-red-600">
                        <span class="text-xs font-bold text-gray-400 uppercase">Bind</span> 
                        <span class="text-[10px] bg-red-600 px-2 py-0.5 text-white font-black">BANNED</span>
                    </div>
                    <div class="flex justify-between items-center bg-black/40 p-3 border-l-2 border-green-500">
                        <span class="text-xs font-bold text-white uppercase">Ascent</span> 
                        <span class="text-[10px] bg-green-500 px-2 py-0.5 text-white font-black">PICKED</span>
                    </div>
                    <div class="flex justify-between items-center bg-black/40 p-3 border-l-2 border-green-500">
                        <span class="text-xs font-bold text-white uppercase">Haven</span> 
                        <span class="text-[10px] bg-green-500 px-2 py-0.5 text-white font-black">PICKED</span>
                    </div>
                    <div class="flex justify-between items-center bg-black/40 p-3 border-l-2 border-[#d4af37]">
                        <span class="text-xs font-bold text-white uppercase">Icebox</span> 
                        <span class="text-[10px] bg-[#d4af37] px-2 py-0.5 text-black font-black">DECIDER</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3">
            <div class="relative group border-2 border-white/5 bg-[#0f1923]">
                <div class="absolute -top-1 -left-1 w-8 h-8 border-t-2 border-l-2 border-[#ff4655]"></div>
                <div class="absolute -bottom-1 -right-1 w-8 h-8 border-b-2 border-r-2 border-[#d4af37]"></div>
                
                <div class="p-2">
                    <div class="aspect-video bg-black">
                        <iframe width="100%" height="100%" 
                            src="https://www.youtube.com/embed/live_stream?channel=YOUR_CHANNEL_ID&autoplay=0" 
                            frameborder="0" allowfullscreen class="opacity-90 group-hover:opacity-100 transition-opacity">
                        </iframe>
                    </div>
                </div>
            </div>

            <?php if(has_role(ROLE_ORGANIZER)): ?>
            <div class="mt-10 p-8 bg-[#1a252e] border border-[#ff4655]/20">
                <div class="flex items-center mb-6">
                    <div class="h-px flex-1 bg-white/10"></div>
                    <span class="px-4 text-[10px] font-black text-[#ff4655] tracking-[0.4em] uppercase italic">Admin Authority Panel</span>
                    <div class="h-px flex-1 bg-white/10"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <button onclick="confirmSubmission('<?php echo $team_a; ?>')" 
                            class="group relative bg-transparent border-2 border-green-600 py-6 overflow-hidden transition-all">
                        <span class="relative z-10 text-white font-black oswald text-xl tracking-widest uppercase">DECLARE <?php echo $team_a; ?> WINNER</span>
                        <div class="absolute inset-0 bg-green-600 translate-y-[100%] group-hover:translate-y-0 transition-transform duration-300"></div>
                    </button>

                    <button onclick="confirmSubmission('<?php echo $team_b; ?>')" 
                            class="group relative bg-transparent border-2 border-red-600 py-6 overflow-hidden transition-all">
                        <span class="relative z-10 text-white font-black oswald text-xl tracking-widest uppercase">DECLARE <?php echo $team_b; ?> WINNER</span>
                        <div class="absolute inset-0 bg-red-600 translate-y-[100%] group-hover:translate-y-0 transition-transform duration-300"></div>
                    </button>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function confirmSubmission(winner) {
    if(confirm("CRITICAL: Are you sure you want to declare " + winner + " as the winner? This will update league points and close the match.")){
        // AJAX implementation goes here
        alert("COMMAND RECEIVED: " + winner + " wins. Updating Database...");
    }
}
</script>

<?php include 'includes/footer.php'; ?>