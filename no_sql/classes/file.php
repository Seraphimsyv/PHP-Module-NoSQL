<?php

    namespace No_SQL\Classes;

    class File_Manager
    {
        public string $file;
        public int $file_size;
        public mixed $file_stat;
        public mixed $file_last_update;
        public bool $file_block;

        public function __construct(string $file_name)
        {
            if(!$this->_exists($file_name))
            {
                $this->_create($file_name);
            }
            $this->_info($file_name);
        }

        public function __toString()
        {
            return file_get_contents($this->file_name);
        }

        public function get()
        {
            return file_get_contents($this->file_name);
        }

        public function set(string $text)
        {
            file_put_contents($this->file_name, $text);
        }

        private function _info($file_name) : void
        {
            $this->file_name = $file_name;
            $this->file = $file_name;
            $this->file_size = filesize($file_name);
            $this->file_stat = stat($file_name);
            $this->file_last_update = filectime($file_name);
            $this->file_block = false;
        }

        private function _create($file_name) : void
        {
            file_put_contents($file_name, '{"collections": {}}');
        }
        
        private function _exists($file_name) : bool
        {
            if(file_exists($file_name)) return true;
            return false;
        }
    }