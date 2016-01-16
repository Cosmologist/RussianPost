<?php

namespace Cosmologist;

use GuzzleHttp\Client;
use RuntimeException;

/**
 * Class for the russian post delivery calculation
 */
class RussianPost
{
    /**
     * Guzzle client
     *
     * @var Client
     */
    private $client;

    /**
     * Russian post api url
     *
     * @var string
     */
    private $apiUrl;

    /**
     * Constructor
     *
     * @param Client $client Guzzle HTTP-client
     * @param string $apiUrl Russian post API URL
     */
    public function __construct(Client $client, $apiUrl='https://www.pochta.ru/portal-portlet/delegate/calculator/v1/api/delivery.time.cost.get')
    {
        $this->client = $client;
        $this->apiUrl = $apiUrl;
    }

    /**
     * Calculate russian post delivery cost
     *
     * @param int $fromIndex From post index
     * @param int $toIndex To post index
     * @param int $weight Parcel weight (grams)
     * @param int $cashOnDeliverySum Cash on delivery sum (Сумма наложенного платежа)
     *                               Pass 0 if it is not necessary
     * @param int $insuranceSum Insurance sum
     *                          Pass 0 if it is not necessary
     *
     * @return int
     */
    public function calculateCost($fromIndex, $toIndex, $weight, $cashOnDeliverySum = 0, $insuranceSum = 0)
    {
        $data = [
            'calculationEntity' => [
                'sendingType' => 'PACKAGE'
            ],
            'costCalculationEntity' => [
                'carefullyMark' => true,
                'declaredValue' => $cashOnDeliverySum,
                'parcelKind' => 'STANDARD',
                'postalCodesFrom' => [$fromIndex],
                'postalCodesTo' => [$toIndex],
                'postingCategory' => ($cashOnDeliverySum > 0 ? 'WITH_DECLARED_VALUE' : 'ORDINARY'),
                'postingKind' => 'PARCEL',
                'postingType' => 'VPO',
                'wayForward' => 'EARTH',
                'weight' => $weight,
                'zipCodeFrom' => $fromIndex,
                'zipCodeTo' => $toIndex,
            ],
            'minimumCostEntity' => [
                'ems' => [
                    'declaredValue' => $cashOnDeliverySum,
                    'postalCodesFrom' => [$fromIndex],
                    'postalCodesTo' => [$toIndex],
                    'postingCategory' => 'ORDINARY',
                    'postingKind' => 'EMS',
                    'postingType' => 'VPO',
                    'wayForward' => 'AVIA',
                    'weight' => $weight,
                    'zipCodeFrom' => $fromIndex,
                    'zipCodeTo' => '614016',
                ],
                'firstClass' => [
                    'declaredValue' => $cashOnDeliverySum,
                    'parcelKind' => 'STANDARD',
                    'postalCodesFrom' => [$fromIndex],
                    'postalCodesTo' => [$toIndex],
                    'postingCategory' => 'ORDINARY',
                    'postingKind' => 'PARCEL',
                    'postingType' => 'VPO',
                    'wayForward' => 'AVIA',
                    'weight' => $weight,
                    'zipCodeFrom' => $fromIndex,
                    'zipCodeTo' => $toIndex,
                ],
                'standard' => [
                    'declaredValue' => $cashOnDeliverySum,
                    'parcelKind' => 'STANDARD',
                    'postalCodesFrom' => [$fromIndex],
                    'postalCodesTo' => [$toIndex],
                    'postingCategory' => 'ORDINARY',
                    'postingKind' => 'PARCEL',
                    'postingType' => 'VPO',
                    'wayForward' => 'EARTH',
                    'weight' => $weight,
                    'zipCodeFrom' => $fromIndex,
                    'zipCodeTo' => $toIndex,
                ],
            ],
            'productPageState' => [
                'careful' => true,
                'cashOnDelivery' => ($cashOnDeliverySum > 0),
                'cashOnDeliverySum' => $cashOnDeliverySum,
                'destinationHasCourier' => true,
                'emsTerm' => '',
                'emsWeightLimit' => 30,
                'firstClassTerm' => '',
                'insurance' => ($insuranceSum > 0),
                'insuranceSum' => $insuranceSum,
                'isAviaAvailable' => true,
                'isCarefulAvailable' => true,
                'isCashOnDeliveryAvailable' => true,
                'isDeliveryNotificationAvailable' => true,
                'isGroundAvailable' => true,
                'isInsuranceAvailable' => true,
                'mainType' => 'standardParcel',
                'printSummary' => true,
                'productType' => 'PARCEL',
                'showAsKg' => true,
                'sizeType' => 'items',
                'sourceHasCourier' => true,
                'standard' => true,
                'standardTerm' => '',
                'stickySummary' => true,
                'valuable' => true,
                'weight' => $weight
            ]
        ];

        $response = $this->client->request(
            'POST',
            $this->apiUrl,
            [
                'json' => $data
            ]
        );
        $responseContent = $response->getBody()->getContents();
        $parsedResponse = json_decode($responseContent, true);

        if (!is_array($parsedResponse) ||
            !array_key_exists('data', $parsedResponse) ||
            !array_key_exists('costEntity', $parsedResponse['data']) ||
            !array_key_exists('cost', $parsedResponse['data']['costEntity'])) {

            $message = sprintf(
                "Unexpected response:\n%s\n\n for the input values:\n-%s\n-%s\n-%s\n-%s\n-%s",
                $responseContent,
                $fromIndex,
                $toIndex,
                $weight,
                $cashOnDeliverySum,
                $insuranceSum
            );

            throw new RuntimeException($message);
        }

        return $parsedResponse['data']['costEntity']['cost'];
    }
} 