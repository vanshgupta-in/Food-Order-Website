<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Reservations</h1>

                <br /><br /><br />

                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Reservation Date</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //Get all the orders from database
                        $sql = "SELECT * FROM reservations ORDER BY id DESC"; // DIsplay the Latest Order at First
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count the Rows
                        $count = mysqli_num_rows($res);

                        $sn = 1; //Create a Serial Number and set its initail value as 1

                        if($count>0)
                        {
                            //Order Available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Get all the order details
                                $id = $row['id'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $$reservation_date = $row['$reservation_date'];
                                
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $order_date; ?></td>

                                        <td>
                                            <?php 
                                                // Reserve Successfully, Not Available

                                                if($status=="Reserve Successfully")
                                                {
                                                    echo "<label style='color: green;'>$status</label>";
                                                }
                                                elseif($status=="Not Available")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                            ?>
                                        </td>

                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $reservation_date; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-reservation.php?id=<?php echo $id; ?>" class="btn-secondary">Update Status</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //Order not Available
                            echo "<tr><td colspan='12' class='error'>Reservation not Available</td></tr>";
                        }
                    ?>

 
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>