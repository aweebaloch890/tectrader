<?php include '../config.php'; 
if(!isset($_SESSION['admin_id'])) header("Location: login.php");
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="max-w-7xl mx-auto px-6 py-12">
    <h2 class="text-4xl font-bold neon-yellow mb-8">Manage Tournaments</h2>
    <div class="bg-zinc-900 p-8 rounded-3xl">
        <p class="text-xl">Tournament management coming soon...</p>
    </div>
</div>

<?php include '../includes/footer.php'; ?>