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
                    <td class="quantity_operate" data-key="<?php echo $cartItem->id?>">
                        <a type="button" class="btn btn-outline-secondary btn-sm subtract" >-</a>
                        <span style="margin: 0 5px"><?php echo $quantity ?></span>
                        <a type="button" class="btn btn-outline-secondary btn-sm append">+</a>
                    </td>
                    <td class="total_price" data-key="<?php echo $cartItem->id?>">
                        ¥<?php echo $quantity *  $cartItem->price ?>
                    </td>
                    <td>
                        <?php echo \yii\helpers\Html::a('delete', ['/cart/delete', 'id' => $cartItem->id], [
                            'class' => 'btn btn-outline-danger',
                            'data-confirm' => 'do you want to delete that?',
                            'data-method' => 'post'
                        ]) ?>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <a type="button" class="btn btn-primary" style="float: right" href="/cart/checkout">checkout</a>
    </div>
<?php endif ?>