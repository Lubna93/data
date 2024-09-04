<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{

// // HAL
    #[Route('/login', name: 'login')]
    public function login(Request $request) {
        $target = urlencode($this->getParameter('cas_login_target').'/force');
        $url = 'https://'.$this->getParameter('cas_host') . ((($this->getParameter('cas_port')!=80) || ($this->getParameter('cas_port')!=443)) ? ":".$this->getParameter('cas_port') : "") . $this->getParameter('cas_path') . '/login?service=';
        return $this->redirect($url . $target);
    }
    

//    PV
    #[Route('/login2', name: 'login2')]
    public function login2(Request $request) {
        $target2 = urlencode($this->getParameter('cas_login_target2').'/force2');
        $url2 = 'https://'.$this->getParameter('cas_host2') . ((($this->getParameter('cas_port2')!=80) || ($this->getParameter('cas_port2')!=443)) ? ":".$this->getParameter('cas_port2') : "") . $this->getParameter('cas_path2') . '/login?service=';
        return $this->redirect($url2 . $target2);
    }
    // #[Route('/casc/login2', name: 'login2')]
    // public function login2(Request $request) {
    //     $target2 = urlencode($this->getParameter('cas_login_target2').'/casc/force2');
    //     $url2 = 'https://'.$this->getParameter('cas_host2') . ((($this->getParameter('cas_port2')!=80) || ($this->getParameter('cas_port2')!=443)) ? ":".$this->getParameter('cas_port2') : "") . $this->getParameter('cas_path2') . '/login?service=';
    //     return $this->redirect($url2 . $target2);
    // }


    
    #[Route('/logout', name: 'logout')]
    public function logout(Request $request) {
        if (($this->getParameter('cas_logout_target') !== null) && (!empty($this->getParameter('cas_logout_target')))) {
            \phpCAS::logoutWithRedirectService($this->getParameter('cas_logout_target'));
        } else {
            \phpCAS::logout();
        }
    }

    #[Route('/logout2', name: 'logout2')]
    public function logout2(Request $request) {
        if (($this->getParameter('cas_logout_target2') !== null) && (!empty($this->getParameter('cas_logout_target2')))) {
            \phpCAS::logoutWithRedirectService($this->getParameter('cas_logout_target2'));
        } else {
            \phpCAS::logout();
        }
    }


    #[Route('/force', name: 'force')]
    public function force(Request $request) {

            if ($this->getParameter("cas_gateway")) {
                if (!isset($_SESSION)) {
                        session_start();
                }

                session_destroy();
            }

            return $this->redirect($this->generateUrl('index'));
    }



    #[Route('/force2', name: 'force2')]
    public function force2(Request $request) {

            if ($this->getParameter("cas_gateway2")) {
                if (!isset($_SESSION)) {
                        session_start();
                }

                session_destroy();
            }

            return $this->redirect($this->generateUrl('index'));
    }
    // #[Route('/casc/force2', name: 'force2')]
    // public function force2(Request $request) {

    //         if ($this->getParameter("cas_gateway2")) {
    //             if (!isset($_SESSION)) {
    //                     session_start();
    //             }

    //             session_destroy();
    //         }

    //         return $this->redirect($this->generateUrl('app_apropos'));
    // }



}
