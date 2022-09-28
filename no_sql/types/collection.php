<?php

    namespace No_SQL\Types;

    class Collection
    {
        public $title;
        public $documents = [];

        public function __construct(string $title, array $data)
        {
            $this->title = $title;
            $this->info = [
                "last_id" => $data['last_id']
            ];
            foreach($data['documents'] as $id => $doc)
            {
                $this->documents[] = new \No_SQL\Types\Document($doc);
            }
        }

        public function to_array() : array
        {
            $documents = [];
            foreach($this->documents as $doc)
            {
                $documents[] = get_object_vars($doc);
            }
            return [
                "last_id" => $this->info['last_id'],
                "documents" => $documents
            ];
        }

        public function create_document(array $data)
        {
            $data['_id'] = $this->info['last_id'];
            $this->documents[] = \No_SQL\Types\Document::create($data);
            $this->info['last_id'] += 1;
        }

        public function getAll(array $query = []) : array
        {
            if(empty($query))
            {
                if(empty($this->documents)) return [];
                return $this->documents;
            } else {
                if(empty($this->documents)) return [];
                return $this->select($query, "all");
            }
        }

        public function getOne(array $query = []) : mixed
        {
            if(empty($query))
            {
                if(empty($this->documents)) return [];
                return $this->documents[$this->info['last_id']-1];
            } else {
                if(empty($this->documents)) return [];
                return $this->select($query, "one");
            }
        }

        private function select(array $query, string $mode) : mixed
        {
            $result = [];
            foreach($this->documents as $doc)
            {
                $condition_count = 0;
                foreach($query as $condition)
                {
                    if($condition[1] == "==" and $doc->$condition[0] == $condition[2]) $condition_count += 1;
                    if($condition[1] == "<" and $doc->$condition[0] < $condition[2]) $condition_count += 1;
                    if($condition[1] == "<=" and $doc->$condition[0] <= $condition[2]) $condition_count += 1;
                    if($condition[1] == ">" and $doc->$condition[0] > $condition[2]) $condition_count += 1;
                    if($condition[1] == ">=" and $doc->$condition[0] >= $condition[2]) $condition_count += 1;
                }
                if($condition_count == count($query) and $mode == "one") return $doc;
                if($condition_count == count($query)) $result[] = $doc;
            }
            return $result;
        }

        public static function create(string $title)
        {
            return new \No_SQL\Types\Collection($title, ["last_id" => 1, "documents" => []]);
        }

    }