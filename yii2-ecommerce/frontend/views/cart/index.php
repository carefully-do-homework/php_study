<?php
/** @var array $allCartItem*/
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Product</th>
            <th>Image</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($allCartItem as $cartItem)?>
    <tr>
        <td><?php echo $cartItem->id?></td>
        <td>@twitter</td>
        <td>@twitter</td>
        <td>@twitter</td>
        <td>@twitter</td>
        <td>@twitter</td>
    </tr>
    <?php ?>
    </tbody>
</table>
