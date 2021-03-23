Задание 1 в компанию ЛидингСофт. В файле Item.php описан класс экземпляра объекта. в файле connect.php
определён объект подключения к базе данных.

1.	Создан класс Item, который не наследуется. В конструктор класса передается ID объекта.
2.	Описаны свойства (int) id, (string) name, (int) status, (bool) changed. Свойства доступны только внутри класса.
3.	Создан метод init(). Предусмотрен одноразовый вызов метода в конструкторе.
4.	Метод доступен только внутри класса.
5.	Метод получает из таблицы objects данные name и status и заполняет их в свойства экземпляра.
6.	Возможно получение свойств объекта, используя magic methods.
7.	Возможно задание свойств объекта, используя magic methods с проверкой вводимого значения на заполненность и тип значения. Свойство ID не поддается записи.
8.	Создан публичный метод save(). Метод сохраняет установленные значения name и status в случае, если свойства объекта были изменены извне.
9.	Класс задокументирован в стиле PHPDocumentor.
