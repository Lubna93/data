<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{

// UPVM
    #[Route('/login', name: 'login')]
    public function login(Request $request) {
        $target = urlencode($this->getParameter('cas_login_target').'/force');
        $url = 'https://'.$this->getParameter('cas_host') . ((($this->getParameter('cas_port')!=80) || ($this->getParameter('cas_port')!=443)) ? ":".$this->getParameter('cas_port') : "") . $this->getParameter('cas_path') . '/login?service=';
        return $this->redirect($url . $target);
    }
    

//  HAL
    // #[Route('/login2', name: 'login2')]
    // public function login2(Request $request) {
    //     $target2 = urlencode($this->getParameter('cas_login_target2').'/force2');
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

    // #[Route('/force2', name: 'force2')]
    // public function force2(Request $request) {

    //         if ($this->getParameter("cas_gateway2")) {
    //             if (!isset($_SESSION)) {
    //                     session_start();
    //             }

    //             session_destroy();
    //         }

    //         return $this->redirect($this->generateUrl('index'));
    // }


    // Controller for the second CAS login (login2)
    #[Route('/login2', name: 'login2')]
    public function login2(Request $request) {
        // URL for redirecting to HAL's login with proper return URL after CAS authentication
        $target2 = urlencode('https://hal.science/user/login?url=https%3A%2F%2Fhal.science%2F');
        
        // Construct CAS login URL with proper encoding and CAS server parameters
        $url2 = 'https://'.$this->getParameter('cas_host2') 
              . ((($this->getParameter('cas_port2') != 80 && $this->getParameter('cas_port2') != 443)) 
                ? ":".$this->getParameter('cas_port2') 
                : "") 
              . $this->getParameter('cas_path2') 
              . '/login?service=' . $target2;
        
        return $this->redirect($url2);
    }
    


    
    // Controller for handling the CAS validation (force2)
    #[Route('/force2', name: 'force2')]
    public function force2(Request $request) {
        // Clear session if gateway is set
        if ($this->getParameter("cas_gateway2")) {
            if (!isset($_SESSION)) {
                session_start();
            }
            session_destroy();
        }
    
        // After successful authentication, redirect the user to HAL
        return $this->redirect('https://hal.science');
    }

}
