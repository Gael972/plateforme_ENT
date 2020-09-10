<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class ShareController extends AbstractController
{
    /**
     * @Route("/drag", name="drag")
     */
    public function index()
    {
        return $this->render('share/share.html.twig', [
            'controller_name' => 'DragController',
        ]);
    }
	/**
     * @Route("/test", name="test")
     */
    public function test()
    {
        return $this->render('share/share.html.twig', [
            'controller_name' => 'DragController',
        ]);
    }
	/**
     * @Route("/fileuploadhandler", name="fileuploadhandler")
     * @param Request $request
     * @return JsonResponse
     */
    public function fileUploadHandler(Request $request): JsonResponse
    {
        $output = array('uploaded' => false);
        // get the file from the request object
        $file = $request->files->get('file');
        // generate a new filename (safer, better approach), but to use original filename instead, use $fileName = $file->getClientOriginalName();
        $fileName = md5(uniqid('', true)).'.'.$file->guessExtension();
//        $fileName = uniqid('', true) . '_' . trim($file->getClientOriginalName());

        // set your uploads directory
        $uploadDir = __DIR__ . '/../../public/uploads/share_file/';
        if (!file_exists($uploadDir) && !is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0775, true) && !is_dir($uploadDir)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $uploadDir));
            }
        }
        if ($file->move($uploadDir, $fileName)) {
            // get entity manager
            //$em = $this->getDoctrine()->getManager();

            // create and set this document
            //$document = new Document();
            //$document->setName($file->getClientOriginalName());
//            $document->setFile($file);
            //$document->setPath('/uploads/documents/'.$fileName);

            // save the uploaded filename to database
            //$em->persist($document);
            //$em->flush();
            $output['uploaded'] = true;
            $output['fileName'] = $fileName;
            $output['documentId'] = $document->getId();
            $output['originalFileName'] = $file->getClientOriginalName();
        }
        return new JsonResponse($output);
    }
	/**
     * @Route("/deletefileresource", name="deleteFileResource")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return JsonResponse
     */
    public function deleteResource(Request $request, EntityManagerInterface $manager): JsonResponse
    {
        $output = array('deleted' => false, 'error' => false);
        $documentId = $request->get('id');
        $fileName = $request->get('fileName');
        $document = $manager->find('App:Document', $documentId);
        if ($fileName && $document && $document instanceof Document) {
            $uploadDir = __DIR__ . '/../../../public/uploads/documents/';
            $output['deleted'] = unlink($uploadDir.$fileName);
            if ($output['deleted']) {
                // delete linked document
                $manager->remove($document);
                $manager->flush();
            }
        } else {
            $output['error'] = 'Missing/Incorrect Media ID and/or FileName';
        }
        return new JsonResponse($output);
    }
}
