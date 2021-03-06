Feature: Sample Tests
In order to test the API
I need to be able to test the API

Scenario: Get Questions
Given I have the payload:
"""
"""
When I request "GET /api/question"
Then the response is JSON
Then the response contains 50 records

Scenario: Add Question
Given I have the payload:
"""
{
  "title": "Behat",
  "question": "Is it awesome?",
  "poll_id": 2 
}
"""
When I request "POST /api/question"
Then the response is JSON
Then the question contains a title of "Behat"

Scenario: Delete Question
Given I have the payload:
"""
"""
When I request "DELETE /api/question/40"
Then the response is JSON
Then the response contains 49 records