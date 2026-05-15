<?php 
include_once '../config.php';
if(!has_role(ROLE_ORGANIZER)) { header("Location: login.php"); exit(); }

if(isset($_POST['schedule_match'])){
    $t_id = clean($_POST['t_id']);
    $t1 = clean($_POST['team_a']); $t2 = clean($_POST['team_b']);
    $time = clean($_POST['match_time']);
    $stmt = $conn->prepare("INSERT INTO matches (tournament_id, team_a, team_b, match_time, status) VALUES (?, ?, ?, ?, 'Upcoming')");
    $stmt->bind_param("isss", $t_id, $t1, $t2, $time);
    if($stmt->execute()) header("Location: manage-matches.php?msg=scheduled");
}
$tournaments = mysqli_query($conn, "SELECT id, title FROM tournaments WHERE status != 'Closed'");
$teams = mysqli_query($conn, "SELECT team_name FROM teams");
?>
<?php include '../includes/header.php'; ?>
<div class="min-h-screen bg-[#0b0f12] py-20 px-6">
    <div class="max-w-3xl mx-auto">
        <h2 class="text-4xl font-black oswald text-white mb-10 italic underline decoration-valRed">SCHEDULE FIXTURE</h2>
        <form method="POST" class="bg-[#0f1923] border border-white/5 p-8 space-y-6">
            <select name="t_id" class="w-full bg-black/40 border border-white/10 p-4 text-white">
                <?php while($t = mysqli_fetch_assoc($tournaments)) echo "<option value='{$t['id']}'>{$t['title']}</option>"; ?>
            </select>
            <div class="grid grid-cols-2 gap-4">
                <select name="team_a" class="bg-black/40 border border-white/10 p-4 text-valRed">
                    <?php mysqli_data_seek($teams, 0); while($tm = mysqli_fetch_assoc($teams)) echo "<option>{$tm['team_name']}</option>"; ?>
                </select>
                <select name="team_b" class="bg-black/40 border border-white/10 p-4 text-blue-500">
                    <?php mysqli_data_seek($teams, 0); while($tm = mysqli_fetch_assoc($teams)) echo "<option>{$tm['team_name']}</option>"; ?>
                </select>
            </div>
            <input type="datetime-local" name="match_time" required class="w-full bg-black/40 border border-white/10 p-4 text-white">
            <button type="submit" name="schedule_match" class="btn-valorant w-full py-4">CONFIRM MATCH</button>
        </form>
    </div>
</div>
<?php include '../includes/footer.php'; ?>