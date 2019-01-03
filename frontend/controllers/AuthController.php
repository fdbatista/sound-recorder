<?php

namespace frontend\controllers;

use yii\web\Controller;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

class AuthController extends Controller {

    public function actionTest() {
        $token = (new Builder())->setIssuer('http://example.com') // Configures the issuer (iss claim)
                ->setAudience('http://example.org') // Configures the audience (aud claim)
                ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
                ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
                ->setNotBefore(time() + 0) // Configures the time that the token can be used (nbf claim)
                ->setExpiration(time() + 3600) // Configures the expiration time of the token (nbf claim)
                ->set('uid', 1) // Configures a new claim, called "uid"
                ->getToken(); // Retrieves the generated token
        $token->getHeaders(); // Retrieves the token headers
        $token->getClaims(); // Retrieves the token claims
        //echo $token;

        /*$token = (new Parser())->parse((string) $token); // Parses from a string
        $token->getHeaders(); // Retrieves the token header
        $token->getClaims(); // Retrieves the token claims
        echo $token->getHeader('jti'); // will print "4f1g23a12aa"
        echo $token->getClaim('iss'); // will print "http://example.com"
        echo $token->getClaim('uid');*/

        $data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)
        $data->setIssuer('http://example.com');
        $data->setAudience('http://example.org');
        $data->setId('4f1g23a12aa');
        $data->setCurrentTime(time() + 3601); // changing the validation time to future
        var_dump($token->validate($data)); // false, because token is expired since current time is greater than exp
    }

}
