<?php
include 'session-check.php';
include 'connect.php';

if (isset($_GET['id'])) {
    $reservation_id = $_GET['id'];
    $sid = $_SESSION["user_id"];

    // Verify the reservation belongs to the logged-in student and is active
    $check_sql = "SELECT * FROM reservations WHERE reservation_id = '$reservation_id' AND student_id = '$sid' AND status = 'active'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) === 1) {
        // Update the reservation status to "cancelled"
        $update_sql = "UPDATE reservations SET status = 'cancelled' WHERE reservation_id = '$reservation_id'";
        if (mysqli_query($conn, $update_sql)) {
            header("Location: booking.php?success=Reservation canceled successfully.");
        } else {
            header("Location: booking.php?error=Failed to cancel reservation. Please try again.");
        }
    } else {
        header("Location: booking.php?error=Invalid reservation or you cannot cancel this reservation.");
    }
} else {
    header("Location: booking.php?error=Reservation ID not provided.");
}
?>
