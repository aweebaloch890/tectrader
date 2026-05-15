<?php 
include '../config.php';
if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-5xl font-bold neon-yellow text-center mb-12">ADMIN DASHBOARD</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-zinc-900 border border-yellow-500 p-8 rounded-3xl text-center">
            <h3 class="text-6xl font-bold text-yellow-400">12</h3>
            <p class="text-xl mt-4">Total Teams</p>
        </div>
        <div class="bg-zinc-900 border border-yellow-500 p-8 rounded-3xl text-center">
            <h3 class="text-6xl font-bold text-yellow-400">3</h3>
            <p class="text-xl mt-4">Active Tournaments</p>
        </div>
        <div class="bg-zinc-900 border border-yellow-500 p-8 rounded-3xl text-center">
            <h3 class="text-6xl font-bold text-yellow-400">8</h3>
            <p class="text-xl mt-4">Pending Matches</p>
        </div>
        <div class="bg-zinc-900 border border-yellow-500 p-8 rounded-3xl text-center">
            <h3 class="text-6xl font-bold text-yellow-400">45</h3>
            <p class="text-xl mt-4">Registered Players</p>
        </div>
    </div>

    <div class="mt-12 text-center">
        <a href="manage-teams.php" class="inline-block bg-yellow-500 text-black px-10 py-5 rounded-2xl font-bold text-xl mr-4">Manage Teams</a>
        <a href="manage-tournaments.php" class="inline-block bg-yellow-500 text-black px-10 py-5 rounded-2xl font-bold text-xl mr-4">Manage Tournaments</a>
        <a href="manage-matches.php" class="inline-block bg-yellow-500 text-black px-10 py-5 rounded-2xl font-bold text-xl">Manage Matches</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>