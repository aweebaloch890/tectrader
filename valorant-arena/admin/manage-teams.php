<?php include '../config.php'; 
if(!isset($_SESSION['admin_id'])) header("Location: login.php");
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="max-w-7xl mx-auto px-6 py-12">
    <h2 class="text-4xl font-bold neon-yellow mb-8">Manage Teams</h2>
    
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-zinc-800">
                <th class="p-4 text-left">Team Name</th>
                <th class="p-4 text-left">Tag</th>
                <th class="p-4 text-left">Rating</th>
                <th class="p-4">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM teams");
            while($team = mysqli_fetch_assoc($result)){
            ?>
            <tr class="border-b border-zinc-700">
                <td class="p-4"><?php echo $team['team_name']; ?></td>
                <td class="p-4"><?php echo $team['team_tag']; ?></td>
                <td class="p-4"><?php echo $team['rating']; ?></td>
                <td class="p-4 text-center">
                    <button onclick="alert('Team Deleted')" class="bg-red-600 px-4 py-2 rounded">Delete</button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>