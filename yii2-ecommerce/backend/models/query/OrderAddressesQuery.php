<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OrderAddresses]].
 *
 * @see OrderAddresses
 */
class OrderAddressesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OrderAddresses[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OrderAddresses|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
