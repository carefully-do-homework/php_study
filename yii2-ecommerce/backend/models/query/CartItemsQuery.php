<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CartItems]].
 *
 * @see CartItems
 */
class CartItemsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CartItems[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CartItems|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
