<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
    echo "<script>window.location = 'inbox.php';</script>";
} else {
    $id = $_GET['msgid'];
}
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Massage</h2>
<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $to = $fm->validation($_POST['toEmail']);
    $from = $fm->validation($_POST['fromEmail']);
    $subject = $fm->validation($_POST['subject']);
    $massage = $fm->validation($_POST['massage']);


    $sendmail = mail($to, $subject, $massage, $from);
    if ($sendmail) {
        echo "<span class='success'>Massage Sent Successfully.</span>";
    } else{
        echo "<span class='error'>Something Went wrong!</span>";
    }

}
?>
                <div class="block">               
                 <form action="addpage.php" method="post">
                 <?php 
						$query = "SELECT * from tbl_contact where id='$id'";
						$msg = $db->select($query);
						if($msg) {
                        while ($result = $msg->fetch_assoc()){
                 ?>
                    <table class="form">
                        <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" readonly name="toEmail" value="<?php echo $result['email'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name="fromEmail" placeholder="Please Enter Your Email Address" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="subject" placeholder="Please Enter Your Subject" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Massage</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name = "massage"></textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
                            </td>
                        </tr>
                    </table>
                    <?php } } ?>
                    </form>
                </div>
            </div>
        </div>
        <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
<?php include 'inc/footer.php';?>