<?php
   include '../lib/session.php';
   Session:: checkSession();
?>
<?php include '../config/config.php';?>
<?php include '../lib/Database.php';?>
<?php include '../helpers/format.php';?>

<?php
 $db = new Database();
 ?>
 <?php
if (!isset($_GET['sliderid']) || $_GET['sliderid'] == NULL) {
    echo "<script>window.location = 'sliderlist.php';</script>";
} else {
    $sliderid = $_GET['sliderid'];

    $query = "select * from tbl_slider where id='$sliderid'";
    $getdata = $db->select($query);
    if ($getdata) {
        while ($delimg = $getdata->fetch_assoc()) {
            $dellink = $delimg['image'];
            unlink($dellink);
        }
    }

    $delquery = "delete from tbl_slider where id = '$sliderid'";
    $deldata = $db->delete($delquery);
    if ($deldata) {
        echo "<script>alert('Slider Deleted Successfully');</script>";
        echo "<script>window.location = 'sliderlist.php';</script>";
    } else{
        echo "<script>alert('Slider not Deleted');</script>";
        echo "<script>window.location = 'sliderlist.php';</script>";
    }
}
?>