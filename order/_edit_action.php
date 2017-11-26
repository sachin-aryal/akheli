<form action="order/edit.php" method="post" id="edit_order_form_<?php echo $order["id"] ?>">
    <input type="hidden" name="order_id" id="order_id" value="<?php echo $order['id'] ?>"/>
    <span class="fa fa-pencil-square-o" onclick="submitForm('edit_order_form_<?php echo $order["id"] ?>')"></span>
</form>
<form action="controller/order.php" method="post" id="delete_order_form_<?php echo $order["id"] ?>">
    <input type="hidden" name="order_id" id="order_id" value="<?php echo $order['id'] ?>" />
    <input type="hidden" name="delete" value="delete"/>
    <span class="fa fa-user-times" onclick="submitForm('delete_order_form_<?php echo $order["id"] ?>')"></span>
</form>