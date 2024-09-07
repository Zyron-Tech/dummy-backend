try {
    // Minimal test code
    $stmt = $pdo->prepare("SELECT 1");
    $stmt->execute();
    echo json_encode(['status' => 'success', 'message' => 'Database connection works.']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
}
