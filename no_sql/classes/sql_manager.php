<?php

    namespace No_SQL\Classes;

    class SQL_Manager
    {
        private array $collections = [];

        public function __construct(string $database_file_name)
        {
            $this->file = $database_file_name;
            $this->file_manager = new \No_SQL\Classes\File_Manager($database_file_name);
            foreach(json_decode($this->file_manager->get(), true)['collections'] as $title => $data)
            {
                $this->collections[$title] = new \No_SQL\Types\Collection($title, $data);
            }
        }

        public function __call($method, $param)
        {
            if($method == "collections" and isset($this->collections[$param[0]]))
            {
                return $this->collections[$param[0]];
            } else {
                die("Collection not exists");
            }
        }

        public function create_collection(string $title) : \No_SQL\Types\Collection
        {
            if(!isset($this->collections[$title]))
            {
                $this->collections[$title] = \No_SQL\Types\Collection::create($title);
                return $this->collections[$title];
            } else {
                return $this->collections[$title];
            }
        }

        public function delete_collection(string $title) : void
        {
            unset($collections[$title]);
        }

        public function save()
        {
            $collections = [];
            foreach($this->collections as $title => $collection)
            {
                $collections[$title] = [
                    "last_id" => $collection->to_array()['last_id'],
                    "documents" => $collection->to_array()['documents']
                ];
            }
            $this->file_manager->set(json_encode(["collections" => $collections]));
        }
    }