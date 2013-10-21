Список виджетов, которые должны присутствовать в пакете
=======================================================

Common
------
* [Number](src/Number.php) - для работы с числами необходимой точности
  * [NumberColor](src/NumberColor.php) - обвязка для цветового кодирования положительных и отрициательных чисел
* DateTime - для отображения времени
* URL - генерация URL

Layout
------
* Document - для работы с документами
  * HTML fragment
    * HTML document
  * JSON document
* FileExport - отправка файла пользователю
  
Head
----
* [OpenGraph](src/OpenGraph.php) - для работы с openGraph markup
* META - для описания title, keywords, description
* Header - для отправки необходимого header-а

Forms
-----
* Input - поле ввода, с необходимым типом
* CheckBox - чекбокс
* RadioButton - радио
* ListSelect - список с возможностью множественного выбора
* ListCheckBox - список множественного выбора, реализованный при помощи чекбоксов
* ListRadioButton - список одиночного выбора, реализованный при помощи радио
* ListSingleSelect - список одиночного выбора, в зависимости от количества элементов используется или радио или select
* ListMultipleSelect - список множественного выбора, в зависимости от количества элементов используется или checkbox или select
* 


Video
-----
* [Coub](src/Video/Coub.php) - для вставки видео с Coub
* Youtube - для вставки видео с Youtube
* Vimeo - для вставки видео с Vimeo
 

