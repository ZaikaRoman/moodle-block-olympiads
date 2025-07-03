<?php

namespace block_olympiads\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

class olympiads_form extends \moodleform {

    public function definition() {
        $mform = $this->_form;

        $mform->addElement('text', 'name', 'Название олимпиады');
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', 'Обязательное поле', 'required', null, 'client');

        $mform->addElement('textarea', 'description', 'Описание олимпиады',
                           'wrap="virtual" rows="8" cols="60"');
        $mform->setType('description', PARAM_TEXT);

        $mform->addElement('date_selector', 'startdate', 'Дата начала');
        $mform->addRule('startdate', 'Обязательное поле', 'required', null, 'client');

        $mform->addElement('date_selector', 'enddate', 'Дата окончания');
        $mform->addRule('enddate', 'Обязательное поле', 'required', null, 'client');

        $this->add_action_buttons(true, 'Сохранить олимпиаду');
    }
}
