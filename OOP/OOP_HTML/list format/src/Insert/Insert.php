<?php 

namespace player\Insert;
class Insert
{
    public function insertData($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}

?>