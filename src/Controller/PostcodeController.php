<?php

namespace App\Controller;

use App\Entity\Postcode;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PostcodeController extends Controller
{

    /**
     * Matches /postcode/search/*
     *
     * @Route("/postcode/search/{queryString}", name="postcode_partial_search")
     * @param string $queryString
     * @return bool|float|int|string
     */
    public function getPostcodesByPartialStringMatch(string $queryString)
    {
        $postcodeRepository = $this->getDoctrine()->getRepository(Postcode::class);
        $results = $postcodeRepository->findByPartialPostcode($queryString);

        $serializer = new Serializer(new ObjectNormalizer(), new JsonEncoder());
        return $serializer->serialize($results, 'json');
    }

    public function updatePostcodes(array $postcodes):void
    {
        foreach ($postcodes as $postcode) {
            $this->updatePostcode($postcode);
        }
    }

    private function updatePostcode(Postcode $postcode):void
    {
        $entityManager = $this->getDoctrine()->getManager();
        $postcodeRepository = $this->getDoctrine()->getRepository(Postcode::class);
        $existingPostcodes = $postcodeRepository->findByPartialPostcode($postcode->getPostcode());
        foreach ($existingPostcodes as $existingPostcode) {
            $entityManager->remove($existingPostcode);
        }
        $entityManager->persist($postcode);
        $entityManager->flush();
    }
}
