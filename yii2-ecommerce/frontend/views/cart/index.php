<?php
/** @var array $allCartItem*/
/** @var array $CartItem_quantity*/

?>

<?php if(count($allCartItem) == 0):?>
    <div class="p-5"
         style="
            border:1px solid #eee;
            border-radius: 10px;
            text-align: center;
         "
    >
        <h4>there is nothing here</h4>
    </div>
<?php else: ?>
    <div>
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
            <?php foreach ($allCartItem as $cartItem) { ?>
                <?php $quantity = $CartItem_quantity[$cartItem->id]?>
                <tr>
                    <td><?php echo $cartItem->name ?></td>
                    <td>
                        <?php echo \yii\helpers\Html::img($cartItem->imgUrl, ['style' => 'width: 100px']);?>
                    </td>
                    <td>¥<?php echo $cartItem->price ?></td>
                    <td><?php echo $quantity ?></td>
                    <td>¥<?php echo $quantity *  $cartItem->price ?></td>
                    <td>
                        <?php echo \yii\helpers\Html::a('delete', ['/cart/delete', 'id' => $cartItem->id], [
                            'class' => 'btn btn-outline-danger',
                            'data-confirm' => 'do you want to delete that?'
                        ]) ?>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary" style="float: right">checkout</button>
    </div>
<?php endif ?>