<?php include 'config.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="max-w-7xl mx-auto px-6 py-12">
    <h2 class="text-5xl font-bold neon-yellow text-center mb-12">TEAMS LEADERBOARD</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM teams ORDER BY rating DESC");
        while($team = mysqli_fetch_assoc($result)){
        ?>
        <div class="bg-zinc-900 border border-yellow-500 rounded-2xl p-6 hover:border-red-500 transition-all">
            <h3 class="text-2xl font-bold"><?php echo $team['team_name']; ?> 
                <span class="text-yellow-400">[<?php echo $team['team_tag']; ?>]</span>
            </h3>
            <p class="text-4xl mt-4 mb-6">Rating: <span class="neon-yellow"><?php echo $team['rating']; ?></span></p>
            <a href="#" class="block text-center bg-yellow-500 text-black py-3 rounded-xl font-bold">View Roster</a>
        </div>
        <?php } ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>