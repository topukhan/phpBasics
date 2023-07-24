<?php 
namespace class19\Update;
class Update
{
    public function updateData($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}


?>