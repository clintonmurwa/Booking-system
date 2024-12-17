<!-- book_slot.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book a Slot</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
</head>
<body>
    <div class="container">
        <h2>Book a Slot</h2>
        <!-- Display flash messages for feedback -->
        <?php if($this->session->flashdata('message')): ?>
            <div class="alert alert-info">
                <?= $this->session->flashdata('message'); ?>
            </div>
        <?php endif; ?>

        <!-- Booking form -->
        <form action="<?= base_url('user/make_booking'); ?>" method="post">
            <div class="mb-3">
                <label for="slot_id" class="form-label">Select Slot</label>
                <select class="form-control" name="slot_id" id="slot_id" required>
                    <option value="">Select a slot</option>
                    <?php foreach($slots as $slot): ?>
                        <option value="<?= $slot['id']; ?>">
                            Slot <?= $slot['slot_number']; ?>: <?= $slot['start_time']; ?> - <?= $slot['end_time']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="service" class="form-label">Service</label>
                <input type="text" class="form-control" id="service" name="service" placeholder="Enter service required" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Book Slot</button>
        </form>

        <!-- Link to view user's own bookings -->
        <a href="<?= base_url('user/view_bookings'); ?>" class="btn btn-secondary mt-3">View My Bookings</a>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
