<?php

class block_olympiads extends block_base {

    public function init() {
        $this->title = get_string('pluginname', 'block_olympiads');
    }

    public function has_config() {
        return false;
    }

    public function applicable_formats() {
        return [
            'all' => true
        ];
    }

    public function instance_allow_multiple() {
        return true;
    }

    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();

        $url = new moodle_url('/blocks/olympiads/add.php');
        $list = new moodle_url('/blocks/olympiads/list.php');

        $this->content->text  = html_writer::link($url, 'Добавить олимпиаду') . html_writer::empty_tag('br');
        $this->content->text .= html_writer::link($list, 'Список олимпиад');
        $this->content->footer = '';

        return $this->content;
    }
}
