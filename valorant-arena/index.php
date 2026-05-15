<?php 
include_once 'config.php'; 
include 'includes/header.php'; 
include 'includes/navbar.php'; 
?>

<div class="relative min-h-screen flex items-center justify-center overflow-hidden bg-[#0b0f12]">
    <div class="absolute top-0 left-0 w-full h-full opacity-[0.03] pointer-events-none flex items-center justify-center">
        <h1 class="text-[30vw] font-black italic text-white leading-none uppercase">SEASON 2</h1>
    </div>

    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-20 left-20 w-32 h-[2px] bg-[#ff4655] rotate-45 animate-pulse"></div>
        <div class="absolute bottom-40 right-20 w-40 h-[1px] bg-[#d4af37] -rotate-12"></div>
    </div>

    <div class="max-w-7xl mx-auto text-center px-6 relative z-10">
        <div class="inline-block mb-6">
            <span class="text-sm md:text-base font-bold text-[#ff4655] tracking-[0.6em] uppercase oswald bg-[#ff4655]/10 px-4 py-2 border-x-2 border-[#ff4655]">
                // PREPARE FOR GLORY
            </span>
        </div>
        
        <h1 class="text-6xl md:text-[120px] font-black mb-6 oswald leading-[0.85] uppercase italic text-white">
            TEC TRADER <br> <span class="text-[#d4af37]">VALORANT</span>
        </h1>
        
        <p class="text-gray-400 text-base md:text-lg max-w-2xl mx-auto mb-12 uppercase tracking-[0.2em] font-medium leading-relaxed italic">
            Pakistan's Premier Esports Infrastructure featuring <span class="text-white">Real-Time Veto</span> & Professional <span class="text-white">Match Analytics</span>.
        </p>

        <div class="flex flex-col md:flex-row gap-6 justify-center items-center">
            <?php if(is_logged_in()): ?>
                <a href="dashboard.php" class="relative group overflow-hidden bg-[#ff4655] text-white px-16 py-6 text-2xl font-black oswald tracking-widest uppercase transition-all">
                    <span class="relative z-10">ENTER HEADQUARTERS</span>
                    <div class="absolute inset-0 bg-[#d4af37] translate-x-[-105%] group-hover:translate-x-0 transition-transform duration-300"></div>
                </a>
            <?php else: ?>
                <a href="register.php" class="relative group overflow-hidden bg-[#ff4655] text-white px-16 py-6 text-2xl font-black oswald tracking-widest uppercase transition-all">
                    <span class="relative z-10">JOIN THE HUNT</span>
                    <div class="absolute inset-0 bg-[#d4af37] translate-x-[-105%] group-hover:translate-x-0 transition-transform duration-300"></div>
                </a>
            <?php endif; ?>

            <a href="tournaments.php" class="group border-2 border-white/10 hover:border-[#d4af37] px-12 py-6 text-2xl font-black oswald tracking-widest uppercase text-white transition-all">
                VIEW <span class="group-hover:text-[#d4af37] transition-colors">BRACKETS</span>
            </a>
        </div>
    </div>
</div>

<div class="bg-[#0f1419] py-24 border-y border-white/5 relative">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12">
        
        <div class="p-10 border-t-2 border-[#d4af37] bg-[#1a252e]/50 backdrop-blur-sm hover:translate-y-[-10px] transition-all duration-300 group">
            <div class="w-16 h-16 bg-[#ff4655]/10 flex items-center justify-center mb-8 group-hover:bg-[#ff4655] transition-colors">
                <i class="fas fa-map-marked-alt text-3xl text-[#d4af37] group-hover:text-white"></i>
            </div>
            <h3 class="text-2xl font-black oswald mb-4 uppercase tracking-wider group-hover:text-[#ff4655]">VCT STYLE VETO</h3>
            <p class="text-gray-400 font-medium leading-relaxed uppercase text-xs tracking-widest">
                Professional Pick/Ban system for BO1/BO3 with live synchronization and map history.
            </p>
        </div>

        <div class="p-10 border-t-2 border-[#ff4655] bg-[#1a252e]/50 backdrop-blur-sm hover:translate-y-[-10px] transition-all duration-300 group">
            <div class="w-16 h-16 bg-[#ff4655]/10 flex items-center justify-center mb-8 group-hover:bg-[#ff4655] transition-colors">
                <i class="fas fa-trophy text-3xl text-[#d4af37] group-hover:text-white"></i>
            </div>
            <h3 class="text-2xl font-black oswald mb-4 uppercase tracking-wider group-hover:text-[#ff4655]">ELITE BRACKETS</h3>
            <p class="text-gray-400 font-medium leading-relaxed uppercase text-xs tracking-widest">
                Automated double-elimination brackets with real-time score verification.
            </p>
        </div>

        <div class="p-10 border-t-2 border-[#d4af37] bg-[#1a252e]/50 backdrop-blur-sm hover:translate-y-[-10px] transition-all duration-300 group">
            <div class="w-16 h-16 bg-[#ff4655]/10 flex items-center justify-center mb-8 group-hover:bg-[#ff4655] transition-colors">
                <i class="fas fa-chart-line text-3xl text-[#d4af37] group-hover:text-white"></i>
            </div>
            <h3 class="text-2xl font-black oswald mb-4 uppercase tracking-wider group-hover:text-[#ff4655]">ADVANCED STATS</h3>
            <p class="text-gray-400 font-medium leading-relaxed uppercase text-xs tracking-widest">
                Track map win-rates, agent picks, and team rankings across multiple seasons.
            </p>
        </div>

    </div>
</div>

<?php include 'includes/footer.php'; ?>