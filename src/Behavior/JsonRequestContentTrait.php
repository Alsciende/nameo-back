<?php

declare(strict_types=1);

namespace App\Behavior;

use Symfony\Component\HttpFoundation\Request;

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
        if(!is_array($content)) {
            $content = [];
        }

        return $content;
    }
}
