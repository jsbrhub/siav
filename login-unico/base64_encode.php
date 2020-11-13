<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 17/09/2020
 * Time: 17:22
 */

echo base64_encode($_POST["client_id"].":".$_POST["secret"]);