<?php

namespace block_olympiads\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

class olympiad_form extends \moodleform {

    public function definition() {
        $mform = $this->_form;

        // Название олимпиады
        $mform->addElement('text', 'name', 'Название олимпиады');
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', 'Обязательное поле', 'required', null, 'client');

        // Описание
        $mform->addElement('editor', 'description', 'Описание олимпиады');
        $mform->setType('description', PARAM_RAW);

        // Дата начала
        $mform->addElement('date_selector', 'startdate', 'Дата начала');

        // Дата окончания
        $mform->addElement('date_selector', 'enddate', 'Дата окончания');

        // Кнопки
        $this->add_action_buttons(true, 'Сохранить олимпиаду');
    }
}
