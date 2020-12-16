<?php


namespace App\Clients;


use Illuminate\Support\Facades\Storage;
use zcrmsdk\crm\crud\ZCRMInventoryLineItem;
use zcrmsdk\crm\crud\ZCRMRecord;
use zcrmsdk\crm\crud\ZCRMTax;
use zcrmsdk\crm\setup\restclient\ZCRMRestClient;
use zcrmsdk\oauth\ZohoOAuth;

class ZOHOClient
{
    public function init()
    {
        if (!Storage::disk('local')->exists('zcrm_oauthtokens.txt')) {
            Storage::put('zcrm_oauthtokens.txt', '');
        }
        $ref_t_url = Storage::url('zcrm_oauthtokens.txt');
        $configuration = [
            "client_id" => env('ZOHO_CLIENT_ID'),
            "client_secret" => env('ZOHO_CLIENT_SECRET'),
            "redirect_uri" => env('ZOHO_REDIRECT_URI'),
            "currentUserEmail" => env('ZOHO_CURRENT_USER_EMAIL'),
            "token_persistence_path" => Storage::disk('local')->path('/')
        ];
        ZCRMRestClient::initialize($configuration);
        $oAuthClient = ZohoOAuth::getClientInstance();
        $refreshToken = env('ZOHO_REFRESH_TOKEN');
        $userIdentifier = env('ZOHO_CURRENT_USER_EMAIL');
        $oAuthClient->generateAccessTokenFromRefreshToken($refreshToken, $userIdentifier);
    }

    public function createDeals($dealName = 'Not provided')
    {
        //Create the deal
        $moduleIns = ZCRMRestClient::getInstance()->getModuleInstance("deals"); //to get the instance of the module
        $records = [];
        $record = ZCRMRecord::getInstance("deals", null);  //To get ZCRMRecord instance
        $record->setFieldValue("Deal_Name", $dealName); //This function use to set FieldApiName and value similar to all other FieldApis and Custom field
        $record->setFieldValue("Stage", "Qualification");

        array_push($records, $record); // pushing the record to the array.
        $trigger = array();//triggers to include
        //$lar_id={"lead_assignment_rule_id"};//lead assignment rule id
        $responseIn = $moduleIns->createRecords($records, $trigger); // updating the records.$trigger,$lar_id are optional
        $dealCreateResStatus = $responseIn->getHttpStatusCode();
        $dealID = $responseIn->getEntityResponses()[0]->getDetails()['id'];


        return ['status' => $dealCreateResStatus,
            'dealID' => $dealID];

        //Print out the response data
        /*foreach ($responseIn->getEntityResponses() as $responseIns) {
            echo "HTTP Status Code:" . $responseIn->getHttpStatusCode(); // To get http response code
            echo "Status:" . $responseIns->getStatus(); // To get response status
            echo "Message:" . $responseIns->getMessage(); // To get response message
            echo "Code:" . $responseIns->getCode(); // To get status code
            echo "Details:" . json_encode($responseIns->getDetails());
        }*/
    }

    public function createTasks($taskSubject = 'Not provided', $dealID)
    {
        //Create the task
        $moduleIns = ZCRMRestClient::getInstance()->getModuleInstance("tasks"); //to get the instance of the module
        $records = [];
        $record = ZCRMRecord::getInstance("tasks", null);  //To get ZCRMRecord instance
        $record->setFieldValue("Subject", $taskSubject); //This function use to set FieldApiName and value similar to all other FieldApis and Custom field
        $record->setFieldValue("\$se_module", "Deals");
        $record->setFieldValue("What_Id", $dealID);

        array_push($records, $record); // pushing the record to the array.
        $trigger = array();//triggers to include
        //$lar_id={"lead_assignment_rule_id"};//lead assignment rule id
        $responseIn = $moduleIns->createRecords($records, $trigger); // updating the records.$trigger,$lar_id are optional
        $taskID = $responseIn->getEntityResponses()[0]->getDetails()['id'];

        return ['status' => $responseIn->getHttpStatusCode(),
            'taskID' => $taskID];
    }
}
