<?php

function validationType($type)
{
    switch ($type) {
        case 'login_request':
            return validateRequest();
            break;
    }
}

function validateRequest() {

}
