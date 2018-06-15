<?php

declare(strict_types=1);

namespace App\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\Environment\InitializedContextEnvironment;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Doctrine\Bundle\DoctrineBundle\Registry;
use PHPUnit\Framework\Assert;

class DoctrineContext implements Context
{
    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * @var ApiContext
     */
    private $apiContext;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @BeforeScenario
     */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();

        if ($environment instanceof InitializedContextEnvironment) {
            $this->apiContext = $environment->getContext(ApiContext::class);
        }
    }

    /**
     * @When /^I load Doctrine data from "(?P<tableName>.*)"$/
     * @When /^I load Doctrine data from "(?P<tableName>.*)" using "(?P<connectionName>.*)"$/
     */
    public function iLoadDoctrineData($tableName, $connectionName = null)
    {
        $this->apiContext->expressionLanguageData[$tableName] = $this
            ->doctrine
            ->getConnection($connectionName)
            ->fetchAll('SELECT * FROM ' . $tableName);
    }

    /**
     * @Then /^The table "(?P<tableName>.*)" is not empty$/
     */
    public function TheTableIsNotEmpty($tableName)
    {
        $row = $this
            ->doctrine
            ->getConnection()
            ->fetchArray('SELECT COUNT(*) FROM ' . $tableName);

        Assert::assertGreaterThan(0, $row[0]);
    }
}
