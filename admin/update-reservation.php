<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Reservation</h1>
        <br><br>


        <?php 
        
            //CHeck whether id is set or not
            if(isset($_GET['id']))
            {
                //GEt the Order Details
                $id=$_GET['id'];

                //Get all other details based on this id
                //SQL Query to get the order details
                $sql = "SELECT * FROM reservations WHERE id=$id";
                //Execute Query
                $res = mysqli_query($conn, $sql);
                //Count Rows
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Detail Availble
                    $row=mysqli_fetch_assoc($res);

                
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $reservation_date= $row['reservation_date'];
                }
                else
                {
                    //DEtail not Available/
                    //Redirect to Manage Order
                    header('location:'.SITEURL.'admin/manage-reservation.php');
                }
            }
            else
            {
                //REdirect to Manage ORder PAge
                header('location:'.SITEURL.'admin/manage-reservation.php');
            }
        
        ?>

        <form action="" method="POST">
        
            <table class="tbl-30">

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Reserve Successfully"){echo "selected";} ?> value="Reserve Successfully">Reserve Successfully</option>
                            <option <?php if($status=="Not Available"){echo "selected";} ?> value="Not Available">Not Available</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Reservation Date: </td>
                    <td>
                        <textarea name="reservation_date" cols="30" rows="5"><?php echo $reservation_date; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td clospan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        
        </form>


        <?php 
            //CHeck whether Update Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //Get All the Values from Form
                $id = $_POST['id'];

                $status = $_POST['status'];

                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $reservation_date = $_POST['customer_address'];

                //Update the Values
                $sql2 = "UPDATE tbl_order SET 
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    reservation_date = '$reservation_date'
                    WHERE id=$id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether update or not
                //And REdirect to Manage Order with Message
                if($res2==true)
                {
                    //Updated
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-reservation.php');
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    header('location:'.SITEURL.'admin/manage-reservation.php');
                }
            }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>
