<?php

namespace Jplarar\SNSBundle\Services;

use Aws\Sns\SnsClient;
use Aws\Sns\Exception\SnsException;

/**
 * Reference: http://docs.aws.amazon.com/sns/latest/DeveloperGuide/send-using-sdk-php.html
 * Class AmazonSNSClient
 * @package Jplarar\SNSBundle\Services
 */
class AmazonSNSClient
{

    protected $service;

    /**
     * AmazonSNSClient constructor.
     * @param $amazon_sns_key
     * @param $amazon_sns_secret
     * @param $amazon_sns_region
     */
    public function __construct($amazon_sns_key, $amazon_sns_secret, $amazon_sns_region)
    {
        $this->service = SnsClient::factory(array(
            'credentials' => [
                'key'    => $amazon_sns_key,
                'secret' => $amazon_sns_secret
            ],
            'version'=> 'latest',
            'region' => $amazon_sns_region
        ));
    }

    /**
     * @param $message
     * @param $phoneNumber
     * @param $senderId
     * @param string $smsType
     * @return \Aws\Result|\Guzzle\Service\Resource\Model
     * @throws \Exception
     */
    public function sendSMS($message, $phoneNumber, $senderId, $smsType = "Transactional")
    {
        // TODO validate phone number
        // SMS parameters
        $args = array(
            "MessageAttributes" => [
                'AWS.SNS.SMS.SenderID' => [
                    'DataType' => 'String',
                    'StringValue' => $senderId
                ],
                'AWS.SNS.SMS.SMSType' => [
                    'DataType' => 'String',
                    'StringValue' => $smsType
                ]
            ],
            "Message" => $message,
            "PhoneNumber" => "$phoneNumber"
        );

        try {
            // Send the sms
            $result = $this->service->publish($args);
            return $result;
        } catch (SnsException $error) {
            throw new \Exception("The sms was not sent. Error message: ".$error->getAwsErrorMessage()."\n");
        }
    }
}