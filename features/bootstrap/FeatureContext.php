<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

require_once __DIR__ . '/../../vendor/phpunit/phpunit/src/Framework/Assert/Functions.php';

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    private $user;
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    /**
     * @Given /^I\'m user "([^"]*)"$/
     */
    public function iMUser($username)
    {
        var_dump($username);
    }

    /**
     * @Given /^I have an empty wall$/
     */
    public function iHaveAnEmptyWall()
    {
    }

    /**
     * @When /^I run "([^"]*)"$/
     */
    public function iRun($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should have "([^"]*)" on my wall$/
     */
    public function iShouldHaveOnMyWall($arg1)
    {
        throw new PendingException();
    }
}
