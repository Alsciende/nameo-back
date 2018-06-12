Feature: Match
  I need to be able to create a match and get its cards

  Scenario: I can post a match
    Given the request body is:
      """
      {
          "nb_cards": 30,
          "difficulty": 2,
          "nb_players": 6,
          "nb_teams": 3,
          "started_at": "2017-07-14T08:40:00.000+06:00"
      }
      """
    When I request "/matches/" using HTTP POST
    Then the response code is 200
    When I load the response as JSON
    Then the JSON should be valid
    And the JSON should be valid according to the schema "match.json"
    And the JSON array node "cards" should have 30 elements

  Scenario: I can post a match
    Given the request body is:
      """
      {
          "nb_cards": 3,
          "difficulty": 4,
          "nb_players": 4,
          "nb_teams": 2,
          "started_at": "2017-07-14T08:40:00.000+06:00"
      }
      """
    When I request "/matches/" using HTTP POST
    Then the response code is 200
    When I load the response as JSON
    Then the JSON should be valid
    And the JSON should be valid according to the schema "match.json"
    And the JSON array node "cards" should have 3 elements
