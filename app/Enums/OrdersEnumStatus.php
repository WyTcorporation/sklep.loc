<?php
/**
 * Created by WyTcorp.
 * NickName: WyTcorp
 * User: Vladyslav Gladyr
 * Date: 29.05.23
 * Email: wild.savedo@gmail.com
 */

namespace App\Enums;

enum OrdersEnumStatus:string {
    case NotPayed = '0';
    case Payed = '1';
    case Send = '2';
}
