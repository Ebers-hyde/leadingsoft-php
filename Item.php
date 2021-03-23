<?php

require_once('vendor/connect.php');

/**
* Класс для работы с предметом из базы данных 
* 
* Выполняет инициализацию экземпляра,
* чтение и запись его свойств, сохранение изменённых свойств в базу данных
* 
* @author Anton Rybchenko <tharuthlessman@gmail.com>
* @version 0.1
*/

class Item {

    /** 
     * @var integer идентификатор предмета
    */
    private int $id;

    /**
     * @var string название предмета
     */
    private string $name;

    /**
     * @var integer статус предмета
     */
    private int $status;

    /**
     * @var boolean изменён ли статус
     */
    private bool $changed;

    /**
     * Конструктор класса
     * 
     * @param integer $id - идентификатор предмета
     */
    public function __construct (int $id) {
        $this->id = $id;
        $this->_init();
    }

    /**
     * Получение свойств предмета из таблицы и запись их в экземпляр класса
     * 
     * @global object $connect - Объект установки соединения с базой данных
     */
    private function _init() {
        global $connect;
        $stmt = $connect->prepare('SELECT `name`, `status` FROM `objects` WHERE `id` = :id');
        $stmt->execute([
            ':id' => $this->id
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->$name = $result['name'];
        $this->$status = $result['status'];
    }

    /**
     * Чтение какого-либо свойства предмета
     * 
     * @param string $property - свойство предмета, к которому обращаются из кода
     * @return значение свойства 
     */

    public function __get($property) {
        return $this->$property;
    }

    /**
     * Изменение значений свойств экземпляра кроме идентификатора
     * 
     * @param string $property - свойство предмета, к которому обращаются из кода.
     * @param string $value - новое значение, которое хотят присвоить свойству
     */

    public function __set($property, $value) {
        if ($value && $property != 'id' && gettype($value) === gettype($this->$property)) {
            $this->$property = $value;
        }
    }

    /**
     * Cохранение измений значений имени и статуса предмета в базу данных. Получается так, что если метод вызван,
     * то он в любом случае делает апдейт. даже если данные не были изменены. Если проверять, были ли изменены
     * данные, то нужно либо ещё раз получать их из базы, либо при первом получении в init сохранять в отдельные
     * свойства, а тут перед апдейтом сравнивать то что сейчас в свойствах и то что пришло изначально. Ни то ни другое
     * делать не стал, потому что ни то ни другое решение не нравится.
     * 
     * @global object $connect - Объект установки соединения с базой данных
     */

    public function save() {
        global $connect;
        $stmt = $connect->prepare("UPDATE `objects` 
        SET `name` = :name, `status` = :status");
        $stmt->execute([
        ':name' => $this->name,
        ':status' => $this->status,
        ]);
    }
}

?>