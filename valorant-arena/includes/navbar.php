<nav class="bg-zinc-950 border-b-4 border-yellow-500 py-5">
    <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
        <h1 class="text-4xl font-bold neon-yellow">VALORANT ARENA</h1>
        <div class="flex gap-8 text-lg">
            <a href="../index.php" class="hover:text-yellow-400">Home</a>
            <a href="../teams.php" class="hover:text-yellow-400">Teams</a>
            <a href="../tournaments.php" class="hover:text-yellow-400">Tournaments</a>
            <a href="../veto.php" class="hover:text-yellow-400">Veto</a>
        </div>
        <div>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="../create-team.php" class="bg-yellow-500 text-black px-5 py-2 rounded font-bold">+ Team</a>
                <a href="../logout.php" class="ml-4 text-red-500">Logout</a>
            <?php else: ?>
                <a href="../login.php" class="bg-yellow-500 text-black px-5 py-2 rounded font-bold">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>