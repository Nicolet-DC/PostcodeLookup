<?php

namespace App\Controller;

use App\Entity\Postcode;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostcodeController extends Controller
{
    /**
     * @Route("/postcode", name="postcode")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PostcodeController.php',
        ]);
    }

    public function getPostcodesByPartialStringMatch(string $queryString)
    {
        $postcodeRepository = $this->getDoctrine()->getRepository(Postcode::class);
        $results = $postcodeRepository->findByPartialPostcode($queryString);
        // TODO : Return as JSON
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
