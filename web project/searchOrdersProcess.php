<?php
require "connection.php";
session_start();

$orderId = $_POST["orderId"];
$dFrom = $_POST["dFrom"];
$dTo = $_POST["dTo"];

$query = "SELECT * FROM `invoice` INNER JOIN `books` ON `books`.`book_id`=`invoice`.`bk_id` 
INNER JOIN `authors` ON `authors`.`id` = `books`.`authors_id` INNER JOIN `publisher` ON 
`publisher`.`id` = `books`.`publisher_id` INNER JOIN `copy` ON `copy`.`copy_id` = `books`.`copy_copy_id` WHERE ";

if(empty($orderId) && empty($dFrom) && empty($dTo)){
    echo("Search something!");
}else{
    if (!empty($orderId) && empty($dFrom) && empty($dTo)) {
        $query .= "`order_id`='" . $orderId . "'";
        // echo(1);
    } else if (empty($orderId) && !empty($dFrom) && empty($dTo)) {
        $query .= "`seller_email`='" . $_SESSION["seller"]["email"] . "' AND `date` >= '" . $dFrom . "'";
        // echo(2);
    } else if (empty($orderId) && empty($dFrom) && !empty($dTo)) {
        $query .= "`seller_email`='" . $_SESSION["seller"]["email"] . "' AND `date` <= '" . $dTo . "'";
        // echo(3);
    } else if (!empty($orderId) && !empty($dFrom) && empty($dTo)) {
        $query .= "`seller_email`='" . $_SESSION["seller"]["email"] . "' AND `order_id`='" . $orderId . "' AND `date` >= '" . $dFrom . "'";
        // echo(4);
    } else if (!empty($orderId) && empty($dFrom) && !empty($dTo)) {
        $query .= "`seller_email`='" . $_SESSION["seller"]["email"] . "' AND `order_id`='" . $orderId . "' AND `date` <= '" . $dTo . "'";
        // echo(5);
    } else if (empty($orderId) && !empty($dFrom) && !empty($dTo)) {
        $query .= "`seller_email`='" . $_SESSION["seller"]["email"] . "' AND `date` BETWEEN '" . $dFrom . "' AND '" . $dTo . "'";
        // echo(6);
    } else if (!empty($orderId) && !empty($dFrom) && !empty($dTo)) {
        $query .= "`order_id`='" . $orderId . "' AND `date` BETWEEN '" . $dFrom . "' AND '" . $dTo . "'";
        // echo(7);
    }

    $response = Database::search($query);

$response_num = $response->num_rows;
// echo($orderId);echo($dFrom);echo($dTo);

if ($response_num > 0) {

    for ($y = 0; $y < $response_num; $y++) {
        $response_data = $response->fetch_assoc();
?>
        <tr>
            <td scope="row"><?php echo $response_data["order_id"] ?></td>
            <td><?php echo $response_data["date"] ?></td>
            <td><?php echo $response_data["user_email"] ?></td>
            <td><?php echo $response_data["total"] ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td><button class="btn btn-link" onclick="showDetails(<?php echo $y?>);">View details</button></td>
        </tr>
        <thead class=" table-dark">
            <tr class="visually-hidden" id="viewDetailsRow<?php echo $y?>c">
                <th scope="col" class=" text-danger">Unit price(Rs.)</th>
                <th scope="col"  class=" text-danger">Author</th>
                <th scope="col"  class=" text-danger">Publisher</th>
                <th scope="col"  class=" text-danger">Copy</th>
                <th scope="col"  class=" text-danger">Shipping(Rs.)</th>
                <th scope="col"  class=" text-danger">Discount</th>
                <th scope="col"  class=" text-danger">Delivery fee Colombo(Rs.)</th>
                <th scope="col"  class=" text-danger">Delivery fee Other(Rs.)</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <tr class="visually-hidden" id="viewDetailsRow<?php echo $y?>d">
                <th scope="row"><?php echo $response_data["price"] ?></th>
                <td><?php echo $response_data["fname"] ?>&nbsp;<?php echo $response_data["lname"] ?></td>
                <td><?php echo $response_data["publisher"] ?></td>
                <td><?php echo $response_data["type"] ?></td>
                <td><?php echo $response_data["shipping"] ?></td>
                <td><?php echo $response_data["discount"] ?>%</td>
                <td><?php echo $response_data["delivery_fee_colombo"] ?></td>
                <td><?php echo $response_data["delivery_fee_other"] ?></td>
                <td><button class="btn btn-link" onclick="closeDetails(<?php echo $y?>);">Close</button></td>
            </tr>
        </tbody>

    <?php
    }
    ?>

<?php
} else {
?>
    <tr>
        <th scope="row">No orders yet</th>
        <td>No orders yet</td>
        <td>No orders yet</td>
        <td>No orders yet</td>
        <td><button class="btn btn-link">View details</button></td>
    </tr>
<?php
}
}

?>




