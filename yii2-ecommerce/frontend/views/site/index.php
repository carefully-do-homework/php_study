<?php

/** @var yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Yii2-Ecommerce';
?>
<div class="bg-dark py-5" style="margin-bottom: 20px">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</div>

<!--<!--轮播图 begin-->-->
<!--<div id="carouselExampleCaptions" class="carousel slide mb-5" data-bs-ride="false">-->
<!--    <div class="carousel-indicators">-->
<!--        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>-->
<!--        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>-->
<!--        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>-->
<!--    </div>-->
<!--    <div class="carousel-inner">-->
<!--        <div class="carousel-item active">-->
<!--            <img src="--><?php //echo '/storage/products/-oT4fw4ALz4d3q0-5bJu1lL52nr3DwNaeceb0fd46a6817b6c3003c7a08d6bdb.png'?><!--" class="d-block w-100 " alt="...">-->
<!--            <div class="carousel-caption d-none d-md-block">-->
<!--                <h5>First slide label</h5>-->
<!--                <p>Some representative placeholder content for the first slide.</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="carousel-item">-->
<!--            <img src="..." class="d-block w-100" alt="...">-->
<!--            <div class="carousel-caption d-none d-md-block">-->
<!--                <h5>Second slide label</h5>-->
<!--                <p>Some representative placeholder content for the second slide.</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="carousel-item">-->
<!--            <img src="..." class="d-block w-100" alt="...">-->
<!--            <div class="carousel-caption d-none d-md-block">-->
<!--                <h5>Third slide label</h5>-->
<!--                <p>Some representative placeholder content for the third slide.</p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">-->
<!--        <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
<!--        <span class="visually-hidden">Previous</span>-->
<!--    </button>-->
<!--    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">-->
<!--        <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
<!--        <span class="visually-hidden">Next</span>-->
<!--    </button>-->
<!--</div>-->
<!--<!--轮播图 end-->-->

<div class="site-index">
    <?php echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_products_item',
        'layout' => '{summary}<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">{items}</div>{pager}',
        'summaryOptions' => [
            'style' => 'display: none'
        ],
        'pager' => [
            'class' => \yii\bootstrap5\LinkPager::class
        ]
    ]) ?>

</div>
