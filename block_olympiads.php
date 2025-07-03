<?php
defined('MOODLE_INTERNAL') || die();

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

        global $OUTPUT;

        $this->content = new stdClass();

        // Ссылки для администратора
        $url_add  = new moodle_url('/blocks/olympiads/add.php');
        $url_list = new moodle_url('/blocks/olympiads/list.php');
        // Ссылка для абитуриентов — вывод карточек (п.19)
        $url_view = new moodle_url('/blocks/olympiads/view.php');

        $this->content->text  = html_writer::link($url_add,  'Добавить олимпиаду')
                             . html_writer::empty_tag('br');
        $this->content->text .= html_writer::link($url_list, 'Список олимпиад')
                             . html_writer::empty_tag('br');
        $this->content->text .= html_writer::link($url_view, 'Олимпиады для абитуриентов');

        $this->content->footer = '';

        return $this->content;
    }
}
