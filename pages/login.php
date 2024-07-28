<?php

include '../includes/header.php';
include '../config/config.php';


$dbInstance = Database::getInstance();
$mysqli = $dbInstance->getConnection();

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header('Location: admin.php');
            } else {
                header('Location: user.php');
            }
            exit;
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with that username!";
    }
}
?>

<main class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-4">Login</h1>
    <form action="login.php" method="POST" class="space-y-4">
        <div>
            <label for="username" class="block">Username</label>
            <input type="text" id="username" name="username" class="w-full p-2 border border-gray-300" required>
        </div>
        <div>
            <label for="password" class="block">Password</label>
            <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Login</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>