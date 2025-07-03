<?php
/**
 * Upgrade steps for block_olympiads
 */
function xmldb_block_olympiads_upgrade($oldversion): bool {
    global $DB;
    $dbman = $DB->get_manager();

    // Шаг 1: создаём основную таблицу block_olympiads
    if ($oldversion < 2025070700) {

        $table = new xmldb_table('block_olympiads');
        $table->add_field('id',          XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('name',        XMLDB_TYPE_CHAR,    '255', null,           XMLDB_NOTNULL,     null, null);
        $table->add_field('description', XMLDB_TYPE_TEXT,    null,  null,           null,              null, null);
        $table->add_field('startdate',   XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL,     null, null);
        $table->add_field('enddate',     XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL,     null, null);
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        upgrade_block_savepoint(true, 2025070700, 'olympiads');
    }

    // Шаг 2: создаём таблицу registrations для записи абитуриентов
    if ($oldversion < 2025070701) {

        $table = new xmldb_table('block_olympiads_registration');
        $table->add_field('id',          XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('olympiadid',  XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL,     null, null);
        $table->add_field('userid',      XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL,     null, null);
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        upgrade_block_savepoint(true, 2025070701, 'olympiads');
    }

    return true;
}
