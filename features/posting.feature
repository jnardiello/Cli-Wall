# features/posting.feature
Feature: posting
    In order to add content to my cli-wall
    As a User
    I need to be able to write a message

Background:
    Given I'm user "Jacopo"

Scenario: Post a message on the wall
    Given I have an empty wall
    When I run "Jacopo -> this is a tweet"
    Then I should have "this is a tweet" on my wall
