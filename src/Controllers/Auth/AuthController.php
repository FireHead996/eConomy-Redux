<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Sign user out and redirect to home
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getSignOut($request, $response)
    {
        $this->auth->logout();
        
        return $response->withRedirect($this->router->pathFor('home'));
    }

    /**
     * Render sign up form
     *
     * @param Request $request
     * @param Response $response
     * @return View
     */
    public function getSignUp($request, $response)
    {
        return $this->view->render($response, 'auth/signup.twig');
    }

    /**
     * Render sign in form
     *
     * @param Request $request
     * @param Response $response
     * @return View
     */
    public function getSignIn($request, $response)
    {
        return $this->view->render($response, 'auth/signin.twig');
    }

    /**
     * Sign user up, sign in and redirect to home
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function postSignUp($request, $response)
    {
        if ($this->validator->validateRegisterForm($request)->getErrorsCount() > 0) {
            $_SESSION['errors'] = $this->validator->getErrors();
            return $response->withRedirect($this->router->pathFor('auth.signup'));
        }
        
        $user = User::create([
            'email' => $request->getParam('email'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
            'nickname' => $request->getParam('name'),
        ]);

        $this->flash->addMessage('success', 'Zostałeś zarejestrowany oraz zalogowany');

        $this->auth->attempt($user->email, $request->getParam('password'));

        return $response->withRedirect($this->router->pathFor('home'));
    }

    /**
     * Try to sign user in
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function postSignIn($request, $response)
    {
        if ($this->validator->validateLoginForm($request)->getErrorsCount() > 0) {
            $_SESSION['errors'] = $this->validator->getErrors();
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }
        
        $auth = $this->auth->attempt(
            $request->getParam('email'),
            $request->getParam('password')
        );

        if (!$auth) {
            $this->flash->addMessage('danger', 'Podano błędne dane');
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }

        return $response->withRedirect($this->router->pathFor('home'));
    }
}
