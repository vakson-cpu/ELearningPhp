<?php
class Response
    {
        public $user;
        public $tip;
        function set_user($user)
        {
            $this->user = $user;
        }
        function set_tip($tip)
        {
            return $this->tip = $tip;
        }
    }
?>