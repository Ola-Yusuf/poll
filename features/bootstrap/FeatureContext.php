<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->bearerToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiZmE3YWNmMmE1NmIwZDVhZDdjZGQwN2E0ZTdlMGFhMDM2MzE2OGQzZmNkN2I0NDIyODMyMTQzZWU5NWZmMzIyNmU5NzY4MTg0MzBjZjlhYWQiLCJpYXQiOjE2MTcyNzc4MjIsIm5iZiI6MTYxNzI3NzgyMiwiZXhwIjoxNjQ4ODEzODIyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.LlYINT3KxdeIn4I5Ywmrdk6btNPOvx71uDheNkg0pgwkrvGgX2gC_RYQEoVn1b3hdyr9oGshJuIQGlSE_F5pJQ2kbb0qJ4pgbiNHK0qCl0H1AxrDy5n3E2igfMWD-uKRxQkM4HMBmD9Yanc_zKlycoIBH-lJ3nrR3yuMOpeFzOpkZ94vzOYLZWRDUY-RnhHPSURMY0qM9ytmRlJDxNhlGdGKeO4uIrMMi5pBliZ5irhoV2C1f_3xZxIJttA5ehb2XKz8cOk_Lzmz1gDx1MBftkSaL6NidP9J4F3mmlbpMZCulvsBCgnNSmo2_gWHeJJblaxW3A0qRu1SMsW7BmiyXRRIGk1PA9u6MXQqI1Ef8toWNkHx9Iw9qJhTVY8K9UfeIY3QUGj1gDyj6Ul1OFBnDHS6LOY4J_eUquSXNpy0Iqu-5bvVEi-BQELAaJtsU_Y3YsUB83FVUthut-y3AoNWJGEAL5J1flbfbeSrzBcJQOUEVBSgtoIhwiAO8MVs_IVtXKeYcvDTN-XlZHoaDuOUGk3dBKDfZ6l2NK1N2NF8pKKkTFMXVB3xfIC4Mou7zRyz3QmxieeoUpJCfjlhxsyhZZKgRQCgGHcVRXnJ9clHwPyN2lquvjySkTkWp5O1HL0iJvFzbGTIp6eyse2fELiStHj7nlae20baykUZLtwU-kA";
    }

    /**
     * @Given I have the payload:
     */
    public function iHaveThePayload(PyStringNode $string)
    {
        $this->payload = $string;
    }

    /**
     * @When /^I request "(GET|PUT|POST|DELETE|PATCH) ([^"]*)"$/
     */
    public function iRequest($httpMethod, $argument1)
    {
        $client = new GuzzleHttp\Client();
        $this->response = $client->request(
            $httpMethod,
            'http://127.0.0.1:8000' . $argument1,
            [
                'body' => $this->payload,
                'headers' => [
                    "Authorization" => "Bearer {$this->bearerToken}",
                    "Content-Type" => "application/json",
                ],
            ]
        );
        $this->responseBody = $this->response->getBody(true);
    }

    /**
     * @Then /^I get a response$/
     */
    public function iGetAResponse()
    {
        if (empty($this->responseBody)) {
            throw new Exception('Did not get a response from the API');
        }
    }

    /**
     * @Given /^the response is JSON$/
     */
    public function theResponseIsJson()
    {
        $data = json_decode($this->responseBody);

        if (empty($data)) {
            throw new Exception("Response was not JSON\n" . $this->responseBody);
        }
    }

    /**
     * @Then the response contains :arg1 records
     */
    public function theResponseContainsRecords($arg1)
    {
        $data = json_decode($this->responseBody);
        $count = count($data);
        return ($count == $arg1);   
    }

    /**
     * @Then the question contains a title of :arg1
     */
    public function theQuestionContainsATitleOf($arg1)      
    {
        $data = json_decode($this->responseBody);
        if($data->title == $arg1){}
        else{
            throw new Exception("The title does not match.");
        } 
    }

}