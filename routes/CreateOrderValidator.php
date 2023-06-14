<?php
declare(strict_types=1);

namespace App;

class CreateOrderValidator
{
    /**
    * @param string $json
    * @return Violation[]
    */
    public function validateRequestContent(string $json): array
    {
        $data = json_decode($json, true);

        $violations = [];

        // Check for missing userId
        if (!isset($data['userId'])) {
            $violations[] = Violation::NO_USER_ID_FIELD();
        } elseif (!is_int($data['userId']) && !ctype_digit($data['userId'])) {
            // Check for invalid userId type
            $violations[] = Violation::INVALID_USER_ID_TYPE();
        } elseif ($data['userId'] <= 0) {
            // Check for invalid userId value
            $violations[] = Violation::INVALID_USER_ID_VALUE();
        }

        // Check for missing cart
        if (!isset($data['cart'])) {
            $violations[] = Violation::NO_CART_FIELD();
        }

        // Check for invalid cart field format
        if (isset($data['cart']) && !is_array($data['cart'])) {
            $violations[] = Violation::INVALID_CART_TYPE();
        }

        // Check for invalid dateCreated field format
        if (isset($data['dateCreated'])  && !self::isValidDateTime($data['dateCreated'])) {
            $violations[] = Violation::INVALID_DATE_CREATED();
        }


        // Check cart items

        if (isset($data['cart']) && is_array($data['cart'])) {
            foreach ($data['cart'] as $item) {
                // Check for missing productId
                if (!isset($item['productId'])) {
                    $violations[] = Violation::NO_PRODUCT_ID_FIELD();
                } elseif (!is_string($item['productId'])) {
                    // Check for invalid productId type
                    $violations[] = Violation::INVALID_PRODUCT_ID_TYPE();
                } elseif (strlen($item['productId']) > 255 || strlen($item['productId']) < 9) {
                    // Check for productId too long
                    $violations[] = Violation::INVALID_PRODUCT_ID_VALUE();
                } elseif (!preg_match('/^[0-9]+$/', $item['productId'])) {
                    // Check for special characters in productId
                    $violations[] = Violation::INVALID_PRODUCT_ID_VALUE();
                }
                if (!isset($item['quantity'])) {
                    $violations[] = Violation::NO_QUANTITY_FIELD()();
                } elseif (!is_int($item['quantity'])) {
                    // Check for invalid quantity type
                    $violations[] = Violation::INVALID_QUANTITY_TYPE();
                } elseif ($item['quantity'] < 1) {
                    // Check for invalid quantity type
                    $violations[] = Violation::INVALID_QUANTITY_VALUE();
                }
            }
        }

        return $violations;
    }

    /**
    * Check if the given string is a valid DateTime format
    * @param string $dateTime
    * @return bool
    */
    private static function isValidDateTime(string $dateTime): bool
    {
        $date = date_create_from_format('Y-m-d\TH:i:sP', $dateTime);
        return $date && $date->format('Y-m-d\TH:i:sP') === $dateTime;
    }
}
