<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header('Location: login.php');
    exit;
}
include '../includes/header.php';
?>

<main class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-4">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <a href="logout.php" class="bg-red-500 text-white px-4 py-2">Logout</a>
</main>

<?php include '../includes/footer.php'; ?>
