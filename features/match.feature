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
          "start_at": "2017-07-14T02:40:00+00:00"
      }
      """
    When I request "/matches/" using HTTP POST
    Then the response code is 200
