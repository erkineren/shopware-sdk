<?php

namespace LeadCommerce\Shopware\SDK\Query;

use LeadCommerce\Shopware\SDK\Util\Constants;

/**
 * Class OrdersQuery
 *
 * @author Alexander Mahrt <amahrt@leadcommerce.de>
 * @copyright 2016 LeadCommerce <amahrt@leadcommerce.de>
 */
class OrdersQuery extends Base
{
    /**
     * @var array
     */
    protected $methodsAllowed = [
        Constants::METHOD_GET,
        Constants::METHOD_GET_BATCH,
        Constants::METHOD_UPDATE,
    ];

    /**
     * @return mixed
     */
    protected function getClass()
    {
        return 'LeadCommerce\\Shopware\\SDK\\Entity\\Order';
    }

    /**
     * Gets the query path to look for entities.
     * E.G: 'variants' or 'articles'
     *
     * @return string
     */
    protected function getQueryPath()
    {
        return 'orders';
    }

    /**
     * @param $ordernumber
     * @return Base
     * @throws \LeadCommerce\Shopware\SDK\Exception\MethodNotAllowedException
     * @throws \LeadCommerce\Shopware\SDK\Exception\NotValidApiResponseException
     */
    public function findOneByNumber($ordernumber)
    {
        $result = $this->findAll([
            'filter' => [
                [
                    'property' => 'number',
                    'value' => $ordernumber
                ]
            ]
        ]);

        if ($result->getEntity()) {
            return $this->findOne($ordernumber, true);
        }

        return null;
    }

}
