<?php

    namespace No_SQL\Types;

    class Document 
    {
        
        public function __construct(array $data)
        {
            foreach($data as $key => $value)
            {
                $this->$key = $value;
            }
        }

        public function __set($key, $value) : void
        {
            $this->$key = $value;
        }

        public function __get($key) : mixed
        {
            return $this->$key;
        }

        public function delete($key) : void
        {
            unset($this->$key);
        }

        public static function create(array $data)
        {
            return new \No_SQL\Types\Document($data);
        }
    }