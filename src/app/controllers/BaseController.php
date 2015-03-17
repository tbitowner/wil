<?php

use PHPassLib\Hash\BCrypt;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Cookie;
//use TBIT\FormBundle\Entity\Creator;
use TBIT\FormRepository\VisualFormBuilder;
use TBIT\FormRepository\Creator;
use TBIT\FormRepository\Contact;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class BaseController 
{
    
    
    public function showWelcome(Application $app, Request $request) 
    {
        // Darol@darollucas.com
        
        $pages = Post::pages()->get();
        $title = Option::title()->first();
        
       
        $formCreator = new Creator;
        $form = $formCreator->create(new VisualFormBuilder, $app);
        
        $contact = new Contact($this, $app, $request);
        $contact->post($form);
        
       

        return $app['twig']->render('welcome.twig.html', [
            "pages" => $pages,
            "title" => $title->option_value,
            'form' => $form->createView()
        ]);    
    }
    
    public function contactAction(Application $app, Request $request)
    {
        return $app->redirect($app['url_generator']->generate('index'));
    }
    
    public function showPageContent(Application $app, Request $request, $page)
    {
        $thePage = Post::search($page)->first();
        $title = Option::title()->first();

        if( null == $thePage)
        {
            return new Response( $app['twig']->render('404.twig.html', array( 'data' => '' )), 404 );
        }

        $pages = Post::pages()->get();
        
        return $app['twig']->render('page.twig.html', [
            "title"   => $title->option_value . ' | ' . $thePage->post_title,
            "content" => $thePage->post_content,
            "childassets" => $thePage->childassets,
            "pages" => $pages,
            "pageheader" => $thePage->post_title
        ]);
    }

    public function showPostContent(Application $app, Request $request, $postname)
    {
        
    }

    public function showAssetContent(Application $app, Request $request)
    {
        $name = $request->get('slug');
        $year = $request->get('year');
        $month = $request->get('month');

        $asset = PostMeta::search($year . '/' . $month . '/' . $name);

        //dd($app['app.static_root_assets'] . $asset->first()->meta_value);
        $response = new BinaryFileResponse($app['app.static_root_assets'] . $asset->first()->meta_value);

        return $response->send();
    }

}
