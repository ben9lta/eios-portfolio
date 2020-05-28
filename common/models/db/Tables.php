<?php


namespace common\models\db;


use Yii;

class Tables
{

    public CONST TABLE_NAMES = [
        'achievements'  => 'Достижения',
        'activity_type' => 'Тип деятельности',
        'courseworks'   => 'Курсовые работы',
        'department'    => 'Подразделение',
        'direction'     => 'Направление',
        'doc_maintypes' => 'Главные типы документов',
        'doc_types'     => 'Типы документов',
        'documents'     => 'Документы',
        'edu_form'      => 'Форма образования',
        'edu_level'     => 'Уровень образования',
        'event_status'  => 'Статус мероприятия',
        'event_type'    => 'Тип мероприятия',
        'events'        => 'Мероприятия',
        'group'         => 'Группы',
        'institute'     => 'Институты',
        'practics'      => 'Практики',
        'publ_indexing' => 'Индексация публикаций',
        'publications'  => 'Публикации',
        'shedule'       => 'Расписание',
        'students'      => 'Студенты',
        'univer'        => 'Универ',
        'user'          => 'Пользователи',
        'vkr'           => 'ВКР',
    ];

    public CONST LINKS = [
        'achievements'  => 'achievements',
        'activity_type' => 'activity-type',
        'courseworks'   => 'courseworks',
        'department'    => 'department',
        'direction'     => 'direction',
        'doc_maintypes' => 'doc-maintypes',
        'doc_types'     => 'doc-types',
        'documents'     => 'documents',
        'edu_form'      => 'edu-form',
        'edu_level'     => 'edu-level',
        'event_status'  => 'event-status',
        'event_type'    => 'event-type',
        'events'        => 'events',
        'group'         => 'group',
        'institute'     => 'institute',
        'practics'      => 'practics',
        'publ_indexing' => 'publ-indexing',
        'publications'  => 'publications',
        'shedule'       => 'shedule',
        'students'      => 'students',
        'univer'        => 'univer',
        'user'          => 'users',
        'vkr'           => 'vkr',
    ];

    /**
     * @return array
     */
    public function getAllTables()
    {
        preg_match("/dbname=([^;]*)/", Yii::$app->db->dsn, $matches);
        $tables = (new \yii\db\Query())
            ->select('table_name as table, table_rows as count')
            ->from('information_schema.tables')
            ->where('table_schema = ' . Yii::$app->db->quoteValue($matches[1]))
            ->andWhere('table_name not in ("migration", "auth_assignment", "auth_item", "auth_item_child", "auth_rule", "menu")')->all();

        return array_values($tables);
    }
}
