<?php
/**
 * Created by PhpStorm.
 * User: lamle
 * Date: 11/28/17
 * Time: 10:14 PM
 */

namespace App;


final class Status extends Enum
{
    const CREATE = 0;
    const  REOPEN = 1;
    const  REPORT = 2;
    const DONE = 3;
}

final class UserType extends Enum
{
    const MANAGER = 0;
    const USER = 1;
    const ADMIN = 2;
}

final class TypeLog extends Enum
{
    const EDIT = 0;
    const ISREAD = 1;
    const REPORT = 2;
    const REJECT = 3;
    const CHANGE_DEADLINE = 4;

}