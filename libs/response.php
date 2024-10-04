<?php
    class Response {
        public $user = null;

        public function __construct()
        {
            $this->user = new stdClass();
            $this->user->rol = 'none';
        }
    }