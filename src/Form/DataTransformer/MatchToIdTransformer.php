<?php

declare(strict_types=1);

namespace App\Form\DataTransformer;

use App\Entity\Match;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class MatchToIdTransformer implements DataTransformerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Match|null $match
     *
     * @return string
     */
    public function transform($match)
    {
        if ($match instanceof Match) {
            return $match->getId();
        }

        return '';
    }

    /**
     * @param string $id
     *
     * @return Match|null
     *
     * @throws TransformationFailedException
     */
    public function reverseTransform($id)
    {
        if (!$id) {
            return null;
        }

        $match = $this->entityManager->find(Match::class, $id);

        if ($match instanceof Match) {
            return $match;
        }

        throw new TransformationFailedException('No match found with id ' . $id);
    }
}
