<?php 

include_once '../config/dadatabase.php';

// Request DataTable
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $draw = isset($_POST['draw']) ? intval($_POST['draw']) : 0;
    $row = isset($_POST['start']) ? intval($_POST['start']) : 0;
    $rowperpage = isset($_POST['length']) ? intval($_POST['length']) : 10;
    $columnIndex = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0;
    $columnName = isset($_POST['columns'][$columnIndex]['data']) ? $_POST['columns'][$columnIndex]['data'] : 'id';
    $columnSortOrder = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc';
    $searchValue = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

    $searchQuery = "";
    if ($searchValue != '') {
        $searchQuery = " AND (u.name LIKE '%".$searchValue."%' OR u.email LIKE '%".$searchValue."%')";
    }

    // Total records without filtering
    $totalRecordsQuery = "SELECT COUNT(*) AS total
                          FROM bookings AS b
                          JOIN users AS u ON b.customer_id = u.id
                          JOIN rooms AS r ON b.room_id = r.id";
    $totalRecordsResult = $db_connection->query($totalRecordsQuery);
    if ($totalRecordsResult) {
        $totalRecords = $totalRecordsResult->fetch_assoc()['total'];
    } else {
        die("Error in totalRecordsQuery: " . $db_connection->error);
    }

    // Total records with filtering
    $totalFilteredRecordsQuery = "SELECT COUNT(*) AS total 
                                  FROM bookings AS b
                                  JOIN users AS u ON b.customer_id = u.id
                                  JOIN rooms AS r ON b.room_id = r.id 
                                  WHERE 1 ".$searchQuery;
    $totalFilteredRecordsResult = $db_connection->query($totalFilteredRecordsQuery);
    if ($totalFilteredRecordsResult) {
        $totalFilteredRecords = $totalFilteredRecordsResult->fetch_assoc()['total'];
    } else {
        die("Error in totalFilteredRecordsQuery: " . $db_connection->error);
    }

    // Fetch records
    $dataQuery = "SELECT b.id, b.booking_code, 
                  u.id as user_id, u.name as user_name, 
                  r.room_code, r.room_name, 
                  b.start, b.end, b.status
                  FROM bookings AS b
                  JOIN users AS u ON b.customer_id = u.id
                  JOIN rooms AS r ON b.room_id = r.id
                  WHERE 1 ".$searchQuery."
                  ORDER BY ".$columnName." ".$columnSortOrder." 
                  LIMIT ".$row.",".$rowperpage;
    
    $dataResult = $db_connection->query($dataQuery);

    $data = array();
    if ($dataResult) {
        while ($row = $dataResult->fetch_assoc()) {
            $data[] = array(
                "id" => $row['id'],
                "bookingCode" => $row['booking_code'],
                "userId" => $row['user_id'],
                "userName" => $row['user_name'],
                "roomCode" => $row['room_code'],
                "roomName" => $row['room_name'],
                "start" => $row['start'],
                "end" => $row['end'],
                "status" => $row['status'],
            );
        }
    } else {
        die("Error in dataQuery: " . $db_connection->error);
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

$db_connection->close();

?>
