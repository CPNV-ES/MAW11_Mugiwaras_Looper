<?php
function dbConnect()
{
    echo("toto");
    return new PDO(getenv('PDO_DSN', true), getenv('PDO_USERNAME', true), getenv('PDO_PASSWORD', true));

}