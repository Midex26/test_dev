<?php

namespace App\Controller;

use App\Entity\Fabricants;
use App\Entity\Materiels;
use App\Entity\Metiers;
use App\Entity\Types;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $materielsRepository = $entityManager->getRepository(Materiels::class);
        $typesRepository = $entityManager->getRepository(Types::class);

        $materiels = $materielsRepository->getAllMaterials();
        $brands = $materielsRepository->getBrand();

        $famillies= $typesRepository->getFamilly();

        return $this->render('home/index.html.twig', [
            'materiels' => $materiels,
            'marques' => $brands,
            'familles' => $famillies
        ]);
    }

    /**
     * @Route("/update/{page}", name="update")
     */
    public function updateBd(HttpClientInterface $client, ManagerRegistry $doctrine, String $page = null) {

        //C'est degueu a voir comment je peux le modifier
        ini_set('max_execution_time', 0);
        //

        $token = $this->getParameter('API_KEY');

        if($page === null){
            $response = $client->request(
                'GET',
                'https://preprod.starif.cristalcrm.fr/api/materiels?token='.$token
            );
        }else{
            $response = $client->request(
                'GET',
                $page
            );
        }


        $entityManager = $doctrine->getManager();

        $content = $response->toArray();

        foreach ($content['data'] as $element){
            if($entityManager->getRepository(Materiels::class)->find($element['materiel_id']) === null){
                $materiel = new Materiels();

                $materiel->setId($element['materiel_id']);
                $materiel->setReferenceFabricant($element['reference_fabricant']);
                $materiel->setDebutCommmercialisation(new \DateTime($element['debut_commercialisation']));

                if($element['fin_commercialisation'] !== null) {
                    $materiel->setFinCommercialisation(new \DateTime($element['fin_commercialisation']));
                }

                if($element['prix_public'] !== null){
                    $materiel->setPrixPublic($element['prix_public']);
                }

                $materiel->setNomCourt($element['nom_court']);

                if($element['nom'] !== null){
                    $materiel->setNom($element['nom']);
                }

                if($element['commentaire'] !== null){
                    $materiel->setCommentaire($element['commentaire']);
                }

                $materiel->setMarque($element['marque']);

                $type = $entityManager->getRepository(Types::class)->find($element['type']['type_id']);
                if($type === null){
                    $type = new Types();

                    $type->setId($element['type']['type_id']);
                    $type->setFamille($element['type']['famille']);
                    $type->setSerialisable($element['type']['serialisable']);
                    $type->setSerialisable($element['type']['serialisable']);
                    $type->setOptionType($element['type']['option']);
                    $type->setNom($element['type']['nom']);

                    $metier = $entityManager->getRepository(Metiers::class)->find($element['type']['metier']['metier_id']);

                    if($metier === null){
                        $metier = new Metiers();

                        $metier->setId($element['type']['metier']['metier_id']);
                        $metier->setNom($element['type']['metier']['nom']);
                        $metier->setCode($element['type']['metier']['code']);
                    }


                    $type->setMetierId($metier);
                }

                $materiel->setTypeId($type);

                $fabricant = $entityManager->getRepository(Fabricants::class)->find($element['fabricant']['fabricant_id']);

                if($fabricant === null){
                    $fabricant = new Fabricants();

                    $fabricant->setId($element['fabricant']['fabricant_id']);
                    $fabricant->setNom($element['fabricant']['nom']);
                    $fabricant->setCode($element['fabricant']['code']);
                }

                $materiel->setFabricantId($fabricant);

                // tell Doctrine you want to (eventually) save the Product (no queries yet)
                $entityManager->persist($materiel);

                // actually executes the queries (i.e. the INSERT query)
                $entityManager->flush();
            }

        }

        if($content['next_page_url'] !== null){
            $this->updateBd($client, $doctrine, $content['next_page_url']);
        }

        return new JsonResponse($content['data']);
    }
    /**
     * @Route("/filter/", name="update")
     */
    public function filter(ManagerRegistry $doctrine){
        $request = Request::createFromGlobals();

        $famille = $request->query->get('famille');
        $marque = $request->query->get('marque');

        $entityManager = $doctrine->getManager();

        $materielsRepository = $entityManager->getRepository(Materiels::class);



        $materiels = $materielsRepository
            ->createQueryBuilder('m')
            ->join('m.type_id ', 't');


        if($famille !== null){
            $materiels = $materiels->where('t.famille = :famille')
                ->setParameter('famille', $famille);
        }

        if($marque !== null){
            $materiels = $materiels->andWhere('m.marque = :marque')
                ->setParameter('marque', $marque);
        }

        $materiels = $materiels->getQuery()->getResult(AbstractQuery::HYDRATE_ARRAY);


        return new JsonResponse($materiels);


    }
}
