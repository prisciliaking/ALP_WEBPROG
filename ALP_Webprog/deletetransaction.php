<?php
// Include the controller.php file, which contains the function to delete a transaction
include_once('controller.php');

// Check if the request method is POST and required parameters are set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteTransaction']) && isset($_POST['transaction_id']) && isset($_POST['user_id'])) {
    // Retrieve transaction_id and user_id from POST data and convert them to integers for security
    $transaction_id = intval($_POST['transaction_id']);
    $user_id = intval($_POST['user_id']);

    // Debugging output to check values (this will be logged)
    error_log("Attempting to delete transaction ID: $transaction_id for user ID: $user_id");

    // Call the deleteTransaction function to delete the transaction with the provided IDs
    $deleteSuccess = deleteTransaction($transaction_id, $user_id);

    // Check if the transaction was deleted successfully
    if ($deleteSuccess) {
        // Log success message
        error_log("Transaction ID: $transaction_id for user ID: $user_id deleted successfully.");

        // Redirect to the same page with a success message
        header("Location: usertransaksi.php?user_id=" . urlencode($user_id) . "&message=Transaction deleted successfully");
        exit(); // Exit the script after redirecting
    } else {
        // Log failure message
        error_log("Failed to delete transaction ID: $transaction_id for user ID: $user_id.");

        // Redirect to the same page with an error message
        header("Location: usertransaksi.php?user_id=" . urlencode($user_id) . "&message=Failed to delete transaction");
        exit(); // Exit the script after redirecting
    }
}

// Handle displaying the transactions or other logic here (if not handling deletion)
?>
