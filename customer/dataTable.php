<?php 

include_once '../config/dadatabase.php';

// Request DataTable
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  // Check if POST parameters exist
    $draw = isset($_POST['draw']) ? intval($_POST['draw']) : 0;
    $row = isset($_POST['start']) ? intval($_POST['start']) : 0;
    $rowperpage = isset($_POST['length']) ? intval($_POST['length']) : 10; // Rows per page, default is 10
    $columnIndex = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0; // Column index
    $columnName = isset($_POST['columns'][$columnIndex]['data']) ? $_POST['columns'][$columnIndex]['data'] : 'id'; // Column name, default to 'id'
    $columnSortOrder = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc'; // asc or desc
    $searchValue = isset($_POST['search']['value']) ? $_POST['search']['value'] : ''; // Search value

    // Search query
    $searchQuery = "";
    if($searchValue != ''){
        $searchQuery = " AND (name LIKE '%".$searchValue."%' OR email LIKE '%".$searchValue."%') ";
    }

    // Total records without filtering
    $totalRecordsQuery = "SELECT COUNT(*) AS total FROM users";
    $totalRecordsResult = $db_connection->query($totalRecordsQuery);
    $totalRecords = $totalRecordsResult->fetch_assoc()['total'];

    // Total records with filtering
    $totalFilteredRecordsQuery = "SELECT COUNT(*) AS total FROM users WHERE 1 ".$searchQuery;
    $totalFilteredRecordsResult = $db_connection->query($totalFilteredRecordsQuery);
    $totalFilteredRecords = $totalFilteredRecordsResult->fetch_assoc()['total'];

    // Fetch records
    $dataQuery = "SELECT * FROM users WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT ".$row.",".$rowperpage;
    $dataResult = $db_connection->query($dataQuery);

    $data = array();

    while($row = $dataResult->fetch_assoc()) {
        $data[] = array(
            "id" => $row['id'],
            "name" => $row['name'],
            "username" => $row['username'],
            "email" => $row['email'],
            "role_id" => $row['role_id'],
            "created_at" => $row['created_at']
        );
    }

    // Response to DataTable
    $response = array(
        "draw" => $draw,
        "recordsTotal" => intval($totalRecords),
        "recordsFiltered" => intval($totalFilteredRecords),
        "data" => $data
    );

    echo json_encode($response);


  }

  // Fungsi untuk menyimpan data ke database
function saveUser($name, $username, $email, $password, $role) {
    global $pdo;

    // Cek apakah username sudah ada
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        return "Username sudah digunakan.";
    }

    // Hash password sebelum disimpan
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Simpan data ke database
    $stmt = $pdo->prepare("INSERT INTO user (name, username, email, password, role) VALUES (:name, :username, :email, :password, :role)");
    $result = $stmt->execute([
        'name' => $name,
        'username' => $username,
        'email' => $email,
        'password' => $hashedPassword,
        'role' => $role
    ]);

    return $result ? "Data berhasil disimpan." : "Gagal menyimpan data.";
}


$db_connection->close();

?>