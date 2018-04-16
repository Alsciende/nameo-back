<?php

declare(strict_types=1);

namespace App\Behavior;

use Assert\Assertion;
use Symfony\Component\HttpFoundation\Request;
use Assert\AssertionFailedException;

trait JsonRequestContentTrait
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function getJsonRequestContent(Request $request): array
    {
        $content = json_decode($request->getContent(), true);
        try {
            Assertion::isArray($content);
        } catch (AssertionFailedException $exception) {
            $content = [];
        }

        return $content;
    }
}
