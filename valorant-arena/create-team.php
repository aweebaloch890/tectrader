<?php include 'config.php'; 
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if(isset($_POST['create_team'])){
    $team_name = mysqli_real_escape_string($conn, $_POST['team_name']);
    $team_tag  = mysqli_real_escape_string($conn, $_POST['team_tag']);
    $captain_id = $_SESSION['user_id'];

    $sql = "INSERT INTO teams (team_name, team_tag, captain_id) VALUES ('$team_name', '$team_tag', '$captain_id')";
    
    if(mysqli_query($conn, $sql)){
        $team_id = mysqli_insert_id($conn);
        mysqli_query($conn, "INSERT INTO team_members (team_id, user_id, role) VALUES ($team_id, $captain_id, 'captain')");
        echo "<script>alert('Team Created Successfully!'); window.location='teams.php';</script>";
    } else {
        echo "<script>alert('Team name or tag already exists!');</script>";
    }
}
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="max-w-lg mx-auto mt-12 bg-zinc-900 p-10 rounded-3xl border border-yellow-500">
    <h2 class="text-4xl font-bold neon-yellow text-center mb-8">CREATE NEW TEAM</h2>
    <form method="POST">
        <input type="text" name="team_name" placeholder="Team Full Name" class="w-full p-4 mb-4 bg-zinc-800 rounded-xl" required>
        <input type="text" name="team_tag" placeholder="Team Tag (e.g. VLT, NRG, FNC)" maxlength="5" class="w-full p-4 mb-6 bg-zinc-800 rounded-xl" required>
        <button type="submit" name="create_team" class="w-full bg-yellow-500 text-black py-4 text-xl font-bold rounded-xl">CREATE TEAM</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>