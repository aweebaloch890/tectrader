<?php include 'config.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="max-w-6xl mx-auto px-6 py-12">
    <h1 class="text-5xl font-bold neon-yellow text-center mb-10">VETO ROOM - BO3</h1>
    
    <div class="bg-zinc-900 border-2 border-yellow-500 rounded-3xl p-10">
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6 text-center" id="map-pool">
            <!-- JS se maps load honge -->
        </div>
    </div>
</div>

<script>
const maps = ["Ascent", "Bind", "Breeze", "Fracture", "Haven", "Icebox", "Lotus", "Pearl", "Split", "Sunset"];

maps.forEach(map => {
    document.getElementById('map-pool').innerHTML += `
        <div onclick="this.classList.toggle('bg-red-600'); this.classList.toggle('line-through')" 
             class="map bg-zinc-800 hover:bg-yellow-500 hover:text-black p-8 rounded-2xl font-bold text-xl cursor-pointer transition">
            ${map}
        </div>`;
});
</script>

<?php include 'includes/footer.php'; ?>