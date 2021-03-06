<?php

use yii\db\Migration;

/**
 * Class m200614_222527_insert_to_doc_types_table
 */
class m200614_222527_insert_to_doc_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

      $this->batchInsert('doc_types', ['doc_maintypes_id', 'title'], [
          [1, "Учебный план"],
          [1, "Программы преподавания"]
      ]);

      $this->batchInsert('doc_types', ['doc_maintypes_id', 'title'], [
          [2, "Учебный план"],
          [2, "Программы преподавания"],
          [2, "Практикум"],
          [2, "Сборник упражнений"],
          [2, "Сборник задач (задачник)"],
          [2, "Сборник иностранных текстов"],
          [2, "Сборник описания лабораторных работ"],
          [2, "Сбоник планов семинарских занятий"],
          [2, "Сборник контрольных заданий"],
          [2, "Хрестоматия"],
          [2, "Тесты"]
      ]);

      $this->batchInsert('doc_types', ['doc_maintypes_id', 'title'], [
          [3, "Дистанционный курс"],
          [3, "Электронная обучающая система (ЭОС)"],
          [3, "Электронные представления бумажных изданий и информационных материалов (ЭИМ)"],
          [3, "Электронное учебное пособие (ЭУП)"],
          [3, "Электронный тренажер (ЭТ)"],
          [3, "Средства практической подготовки (СПП)"],
          [3, "Тестирующий комплекс (ТК)"],
          [3, "Электронный учебник (ЭУ)"],
          [3, "Электронный задачник (ЭЗ)"],
          [3, "Презентация (демонcтрация), слайд-конспект (ПР)"],
          [3, "Видеолекция (ВЛ)"],
          [3, "Экспертная система (ЭС)"],
          [3, "Электронный словарь (ЭСЛ)"],
          [3, "Электронный справочник (ЭСП)"],
          [3, "Электронная энциклопедия (ЭЭ)"],
          [3, "Информационно-поисковая система (ИПС)"],
          [3, "Электронный лабораторный практикум (ЭЛП) или виртуальная лаборатория (ВЛ)"],
          [3, "Аппаратно-программные комплексы, обеспечивающие доступ к физическим стендам и приборам (АПК)"],
          [3, "Учебная компьютерная игра"],
          [3, "Развивающая компьютерная игра"],
          [3, "Мультимедийное электронное издание"],
          [3, "Учебное электронное издание"],
          [3, "Локальное электронное издание"],
          [3, "Сетевое электронное издание"],
          [3, "Электронное издание комбинированного распространения"]
      ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('doc_types');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200614_222527_insert_to_doc_types_table cannot be reverted.\n";

        return false;
    }
    */
}
