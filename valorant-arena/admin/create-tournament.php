<?php 
include_once '../config.php';
if(!has_role(ROLE_ORGANIZER)) { header("Location: login.php"); exit(); }

if(isset($_POST['deploy_event'])){
    $title = clean($_POST['title']);
    $prize = clean($_POST['prize']);
    $type = clean($_POST['type']);
    $s_date = clean($_POST['start_date']);
    
    $stmt = $conn->prepare("INSERT INTO tournaments (title, prize_pool, type, start_date, status) VALUES (?, ?, ?, ?, 'Open')");
    $stmt->bind_param("ssss", $title, $prize, $type, $s_date);
    
    if($stmt->execute()){
        header("Location: manage-tournaments.php?msg=deployed");
    }
}
?>
<?php include '../includes/header.php'; ?>
<div class="min-h-screen bg-[#0b0f12] py-20 px-6">
    <div class="max-w-3xl mx-auto">
        <div class="border-l-4 border-[#ff4655] pl-6 mb-10 italic">
            <h2 class="text-4xl font-black oswald uppercase text-white leading-none">DEPLOY <span class="text-[#ff4655]">OPERATION</span></h2>
        </div>
        <form method="POST" class="bg-[#0f1923] border border-white/5 p-8 space-y-6">
            <input type="text" name="title" placeholder="TOURNAMENT NAME" required class="w-full bg-black/40 border border-white/10 p-4 text-white oswald focus:border-valRed outline-none">
            <input type="text" name="prize" placeholder="PRIZE POOL (e.g. 50K)" required class="w-full bg-black/40 border border-white/10 p-4 text-[#ffd700] oswald focus:border-valRed outline-none">
            <select name="type" class="w-full bg-black/40 border border-white/10 p-4 text-white oswald">
                <option>5v5 Single Elimination</option>
                <option>5v5 Double Elimination</option>
            </select>
            <input type="date" name="start_date" required class="w-full bg-black/40 border border-white/10 p-4 text-white oswald">
            <button type="submit" name="deploy_event" class="btn-valorant w-full py-4">INITIALIZE EVENT</button>
        </form>
    </div>
</div>
<?php include '../includes/footer.php'; ?>