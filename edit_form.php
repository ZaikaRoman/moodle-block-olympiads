<?php

require_once($CFG->libdir . '/formslib.php');

class olympiad_edit_form extends moodleform {
    public function definition() {
        $mform = $this->_form;

        $mform->addElement('text', 'name', 'Название олимпиады');
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', 'Обязательное поле', 'required', null, 'client');

        $mform->addElement('editor', 'description', 'Описание');
        $mform->setType('description', PARAM_RAW);

        $mform->addElement('date_selector', 'startdate', 'Дата начала');
        $mform->addElement('date_selector', 'enddate', 'Дата окончания');

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $this->add_action_buttons();
    }
}
