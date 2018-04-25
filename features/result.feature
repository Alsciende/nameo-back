Feature: Result
  I need to be able to post some results for a match

  Scenario: I can post a result
    When I load Doctrine data from "matches"
    And I load Doctrine data from "cards"
    Given the request body is:
      """
      {
          "match": "{{ data["matches"][0]["id"] }}",
          "attempts": [
              "{{ data["cards"][0]["id"] }}",
              "{{ data["cards"][1]["id"] }}",
              "{{ data["cards"][2]["id"] }}",
              "{{ data["cards"][3]["id"] }}",
              "{{ data["cards"][4]["id"] }}",
              "{{ data["cards"][5]["id"] }}",
              "{{ data["cards"][6]["id"] }}",
              "{{ data["cards"][7]["id"] }}",
              "{{ data["cards"][8]["id"] }}",
              "{{ data["cards"][9]["id"] }}"
          ]
      }
      """
    When I request "/results/" using HTTP POST
    Then the response code is 200
    When I load the response as JSON
    Then the JSON should be valid
    And the JSON should be valid according to the schema "match.json"
