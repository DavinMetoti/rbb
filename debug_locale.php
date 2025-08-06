<?php
// Simple PHP debug file to test locale functionality
session_start();

echo "<h1>Locale Debug Information</h1>";
echo "<p><strong>PHP Session Storage:</strong></p>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<p><strong>Current Language from Session:</strong> " . ($_SESSION['applocale'] ?? 'not set') . "</p>";

echo "<p><strong>Test Links:</strong></p>";
echo '<a href="?lang=en">Set English</a> | ';
echo '<a href="?lang=zh">Set Chinese</a><br><br>';

if (isset($_GET['lang'])) {
    if (in_array($_GET['lang'], ['en', 'zh'])) {
        $_SESSION['applocale'] = $_GET['lang'];
        echo "<p style='color: green;'>Language set to: " . $_GET['lang'] . "</p>";
        echo '<script>window.location.href = window.location.pathname;</script>';
    }
}

echo "<p><strong>Sample Translation Test:</strong></p>";
$translations = [
    'en' => [
        'participants' => 'Participants',
        'add_participant' => 'Add Participant',
        'logout' => 'Logout'
    ],
    'zh' => [
        'participants' => '参与者',
        'add_participant' => '添加参与者', 
        'logout' => '退出登录'
    ]
];

$current_lang = $_SESSION['applocale'] ?? 'en';
echo "<p>Current Language: <strong>$current_lang</strong></p>";
echo "<ul>";
foreach ($translations[$current_lang] as $key => $value) {
    echo "<li>$key: $value</li>";
}
echo "</ul>";
?>
