<?php
/** @var common\models\User $userModel */
/** @var common\models\UserAddresses $userAddress */
/** @var yii\bootstrap5\ActiveForm $AddressForm */
/** @var yii\bootstrap5\ActiveForm $UserForm */
/** @var \yii\web\View $this */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$isShowRefineAddressNotice = $this->params['isShowRefineAddressNotice'] ?? false;
?>

<?php if (isset($isShowRefineAddressNotice) && $isShowRefineAddressNotice == true): ?>
    <div class="alert alert-danger" role="alert">
        you should refine address information first, and then checkout.
    </div>
<?php endif ?>

<div style="display: flex">
    <div class="card  m-3" style="flex: 1">
        <div class="card-header">
            Address information
        </div>
        <div class="card-body">
            <?php \yii\widgets\Pjax::begin([
                'enablePushState' => false
            ])?>
                <?php echo $this->render('_address_update', [
                    'userAddress' => $userAddress
                ])?>
            <?php \yii\widgets\Pjax::end()?>
        </div>
    </div>
    <div class="card  m-3" style="flex: 1">
        <div class="card-header">
            Account information
        </div>
        <div class="card-body">
            <?php \yii\widgets\Pjax::begin([
                'enablePushState' => false
            ])?>
                <?php echo $this->render('_account_update', [
                    'userModel' => $userModel
                ])?>
            <?php \yii\widgets\Pjax::end()?>
        </div>
    </div>
</div>



