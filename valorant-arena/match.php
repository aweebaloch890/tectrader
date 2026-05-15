<?php include 'config.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="max-w-7xl mx-auto px-6 py-12">
    <h2 class="text-4xl font-bold text-center neon-yellow">TEAM A <span class="text-red-500">VS</span> TEAM B</h2>

    <!-- Live Stream Embed -->
    <div class="mt-10 bg-black border-4 border-yellow-500 rounded-3xl overflow-hidden">
        <iframe width="100%" height="620" 
            src="https://www.youtube.com/embed/dQw4w9wgxcq" 
            frameborder="0" allowfullscreen></iframe>
    </div>

    <div class="mt-10 text-center">
        <button onclick="alert('Result Submitted! Team Rating Updated')" 
                class="bg-green-600 hover:bg-green-500 text-white px-12 py-5 text-2xl font-bold rounded-2xl">
            Submit Result (Winner)
        </button>
    </div>
</div>

<?php include 'includes/footer.php'; ?>