<?php
function nofication()
{
    require_once '../dbconnect.php';
    $conn = connect_db();

    $query = "SELECT * FROM progression ORDER BY progressID DESC";
    $result_list = mysqli_query($conn, $query);

    if (mysqli_num_rows($result_list) > 0) {
        while ($row_progress = mysqli_fetch_assoc($result_list)) {
            $progressID = $row_progress['progressID'];
            $customerName = $row_progress['customerName'];

            $sell_date = date_create($row_progress['sellDate']);
            $sell_time_format = date_format($sell_date, "H:i");
            $sell_date_format = date_format($sell_date, "d/m/Y");
?>
            <a href="../dashboard/detail/progressDetail.php?id=<?php echo $progressID ?>" class="popuptable">
                <div class="info">
                    <p class="infoname">Người dùng: <?php echo $customerName ?></p>
                    <p class="infotime">thời gian nhận số: <?php echo $sell_time_format . " ngày " . $sell_date_format ?></p>
                </div>
            </a>
<?php }
    }
}
?>

<?php
function nofication_sub()
{
    require_once '../../dbconnect.php';
    $conn = connect_db();

    $query = "SELECT * FROM progression ORDER BY progressID DESC";
    $result_list = mysqli_query($conn, $query);

    if (mysqli_num_rows($result_list) > 0) {
        while ($row_progress = mysqli_fetch_assoc($result_list)) {
            $progressID = $row_progress['progressID'];
            $customerName = $row_progress['customerName'];

            $sell_date = date_create($row_progress['sellDate']);
            $sell_time_format = date_format($sell_date, "H:i");
            $sell_date_format = date_format($sell_date, "d/m/Y");
?>
            <a href="../../dashboard/detail/progressDetail.php?id=<?php echo $progressID ?>" class="popuptable">
                <div class="info">
                    <p class="infoname">Người dùng: <?php echo $customerName ?></p>
                    <p class="infotime">thời gian nhận số: <?php echo $sell_time_format . " ngày " . $sell_date_format ?></p>
                </div>
            </a>
<?php }
    }
}
?>