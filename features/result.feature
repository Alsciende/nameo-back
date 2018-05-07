Feature: Result
  I need to be able to post some results for a match

  Scenario: I can post a result
    When I load Doctrine data from "matches"
    And I load Doctrine data from "cards"
    Given the request body is:
      """
      {
          "attempts": [
              {
                "step": 1,
                "card": "{{ data["cards"][0]["id"] }}",
                "presented_at": "2017-07-14T02:40:00+00:00",
                "presented_for": 10,
                "outcome": 1
              }
          ]
      }
      """
    When I request "/matches/{{ data['matches'][0]['id'] }}/results/" using HTTP POST
    Then the response code is 200
    When I load the response as JSON
    Then the JSON should be valid
    And the JSON node "success" should be equal to "true"
