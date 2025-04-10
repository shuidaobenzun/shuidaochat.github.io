<?php
header('Content-Type: application/json');
$postData = file_get_contents("php://input");
$request = json_decode($postData);

$username = $request->username;
$password = $request->password;

$usersJson = file_get_contents('users.json');
$users = json_decode($usersJson, true);

foreach ($users as &$user) {
  if ($user['username'] === $username && $user['password'] === $password) {
    $user['online'] = true;
    file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
    echo json_encode(['success' => true,'message' => '登录成功']);
    return;
  }
}

echo json_encode(['success' => false,'message' => '用户名或密码错误']);
?>
