<form action="order/edit.php" method="post" id="edit_order_form_<?php echo $order["id"] ?>">
    <input type="hidden" name="order_id" id="order_id" value="<?php echo $order['id'] ?>"/>
    <span style="cursor: pointer" class="fa fa-pencil-square-o" onclick="submitForm('edit_order_form_<?php echo $order["id"] ?>')">Edit</span>
</form>
<form action="controller/order.php" method="post" id="delete_order_form_<?php echo $order["id"] ?>">
    <input type="hidden" name="order_id" id="order_id" value="<?php echo my_encrypt($order['id']) ?>" />
    <input type="hidden" name="delete" value="delete"/>
    <span style="cursor: pointer" class="fa fa-trash-o" onclick="submitForm('delete_order_form_<?php echo $order["id"] ?>')">Delete</span>
</form>