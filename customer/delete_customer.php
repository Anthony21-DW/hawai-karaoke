<?php
include_once '../config/dadatabase.php';

// Cek metode permintaan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil ID dari permintaan POST
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    // var_dump($id);

    if ($id > 0) {
        // Siapkan pernyataan SQL untuk menghapus data
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $db_connection->prepare($sql);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Customer Berhasil Dihapus'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to delete user: ' . $stmt->error
            ]);
        }

        $stmt->close();
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid user ID'
        ]);
    }

    $db_connection->close();
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}
?>
