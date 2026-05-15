<?php
// Intelligent Base URL: Automatic detection taake localhost aur live server dono par chale
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$host = $_SERVER['HTTP_HOST'];
// Folder path fix: Agar aapka project root par hai toh "/" kar dein, varna folder name.
$folder = "/valorant_arena/"; 
$base_url = $protocol . "://" . $host . $folder;

// Helper for Active Link styling
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="bg-[#0b0f12]/95 backdrop-blur-md border-b-2 border-[#d4af37]/30 py-4 sticky top-0 z-[100] shadow-[0_10px_30px_rgba(0,0,0,0.5)]">
    <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
        
        <a href="<?php echo $base_url; ?>index.php" class="group flex items-center space-x-3">
            <div class="w-8 h-8 bg-valRed rotate-45 border-2 border-white/20 group-hover:scale-110 transition-all duration-300"></div>
            <h1 class="text-3xl font-black oswald tracking-tighter text-white uppercase italic">
                VALORANT <span class="text-valRed group-hover:neon-text-red transition-all">ARENA</span>
            </h1>
        </a>

        <div class="hidden md:flex items-center gap-10">
            <?php 
            $nav_links = [
                'index.php' => 'Home',
                'teams.php' => 'Teams',
                'tournaments.php' => 'Tournaments',
                'veto.php' => 'Veto Room'
            ];
            foreach($nav_links as $file => $label): 
                $is_active = ($current_page == $file) ? 'text-valGold border-b-2 border-valGold' : 'text-gray-500 hover:text-white';
            ?>
                <a href="<?php echo $base_url . $file; ?>" 
                   class="text-[11px] font-black oswald uppercase tracking-[0.3em] transition-all pb-1 <?php echo $is_active; ?>">
                    <?php echo $label; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="flex items-center space-x-6">
            <?php if(isset($_SESSION['user_id'])): ?>
                
                <?php if(has_role(ROLE_ORGANIZER)): ?>
                    <a href="<?php echo $base_url; ?>admin/dashboard.php" 
                       class="hidden sm:flex items-center space-x-2 bg-valRed/10 border border-valRed/30 px-4 py-2 group hover:bg-valRed transition-all">
                        <i class="fas fa-terminal text-valRed group-hover:text-white text-xs"></i>
                        <span class="text-[10px] font-black oswald text-white uppercase tracking-widest">Command Center</span>
                    </a>
                <?php endif; ?>

                <a href="<?php echo $base_url; ?>create-team.php" 
                   class="btn-valorant !py-2 !px-6 !text-[10px] shadow-lg shadow-valGold/10">
                    <i class="fas fa-shield-halved mr-2"></i> FORM SQUAD
                </a>
                
                <a href="<?php echo $base_url; ?>logout.php" 
                   class="w-10 h-10 flex items-center justify-center rounded-full bg-white/5 border border-white/10 text-gray-500 hover:text-valRed hover:border-valRed transition-all" 
                   title="Terminate Session">
                    <i class="fas fa-power-off text-sm"></i>
                </a>

            <?php else: ?>
                <a href="<?php echo $base_url; ?>login.php" 
                   class="relative group overflow-hidden px-8 py-2 bg-white/5 border border-white/10 hover:border-valGold transition-all">
                    <span class="relative z-10 text-[11px] font-black oswald text-white tracking-[0.2em] group-hover:text-black transition-colors">INITIATE LOGIN</span>
                    <div class="absolute inset-0 bg-valGold translate-x-[-101%] group-hover:translate-x-0 transition-transform duration-300"></div>
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>