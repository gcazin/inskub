<?php

use Laravel\Cashier\Coupon\CouponOrderItemPreprocessor as ProcessCoupons;
use Laravel\Cashier\Order\PersistOrderItemsPreprocessor as PersistOrderItems;

return [

    /**
     * Plan defaults. Can be overridden per Plan.
     */
    'defaults' => [

        /**
         * A first payment requires a customer to go through the Mollie checkout screen in order to create a Mandate for
         * future recurring payments.
         * @link https://docs.mollie.com/payments/recurring#payments-recurring-first-payment
         */
        'first_payment' => config('cashier.first_payment'),

        /**
         * The default chain of subscription OrderItem preprocessors. These are called right before the Subscription's
         * OrderItem is processed into an OrderItem. You can use this for calculating variable costs a.k.a. metered billing.
         * Can be overridden per subscription plan. Make sure the preprocessors implement the PreprocessesOrderItems
         * interface.
         */
         'order_item_preprocessors' => [
             ProcessCoupons::class,
             PersistOrderItems::class,
         ],
    ],

    /**
     * The subscription plans.
     */
    'plans' => [

        /**
         * The plan reference.
         */
        'main' => [
            'amount' => [
                'value' => '10.00',
                'currency' => 'EUR',
            ],

            'interval' => '1 month',

            'description' => 'Monthly payment',

            //'order_item_preprocessors' => [
            //    ProcessCoupons::class,
                PersistOrderItems::class,
            //],
        ],
    ],
];
