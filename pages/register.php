<?php
include '../includes/header.php';
include '../config/config.php';

// Initialize the database connection
$dbInstance = Database::getInstance();
$mysqli = $dbInstance->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user'; // Automatically set the role to 'user'

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

    if ($mysqli->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}
?>

<main class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-4">Register</h1>
    <form action="register.php" method="POST" class="space-y-4">
        <div>
            <label for="username" class="block">Username</label>
            <input type="text" id="username" name="username" class="w-full p-2 border border-gray-300" required>
        </div>
        <div>
            <label for="password" class="block">Password</label>
            <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Register</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>