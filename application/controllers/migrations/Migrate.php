<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {
    public function index()
    {
        $sections = array(
                     'config'  => TRUE,
                     'queries' => TRUE
                     );
        $this->output->set_profiler_sections($sections);
        $this->output->enable_profiler(TRUE);

        $this->load->library('migration');
        if ($this->migration->current() === false) {
            show_error($this->migration->error_string());
        }
        else {
            echo 'Migrado';
        }
    }
}