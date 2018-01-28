# nrd

Реализовать сайт – менеджер TODO задач. 

; --------------------------------------------

Необходимые поля в каждой TODO: 
1.  Название и флаг «выполнено». 
2.  Предусмотреть возможность добавления и удаления, а так же возможность отметить галочкой выполненные задачи.
3.  Предусмотреть общую для всех задач галку «Показывать выполненные задачи».

БД – mysql, mongo, на свой вкус. 
Серверную часть - нужно сделать на PHP. 
Клиентскую часть - по желанию(например SPA с Vue или Angular или на чистом JS).

; --------------------------------------------
![Image alt](https://github.com/stweet/nrd/edit/master/public/imgs/preview.png)

Для работы с проектом:
1.  Создать базу данных(MySql) для приложения.
2.  В файле конфигурации драйвера(/server/database/pdo/drivers/DBOConfig.php) 
    настроить подключение к вновь созданной БД(необходимо для работы проекта).
3.  Выполнить комманду: "php index.php" или "php index.php help" для вывода справки.
4.  Выполнить комманду: "php index.php install" или "./install.sh" для установки базы банных.
    Так же "php index.php uninstall" или "./uninstall.sh" для удаления базы банных.
5.  Выполнить комманду "php -S localhost:8000 index.php" или "./server.sh" для запуска приложения.
    В браузе перейти по адресу: http://localhost:8000

; --------------------------------------------

PS: Для использования bash скриптов сначала выполнить:
1.  chmod +x install.sh 
2.  chmod +x uninstall.sh 
3.  chmod +x server.sh

; --------------------------------------------

Отчёт:

На реализацию серверной части ушло около 8(в общем) рабочих часов(в порывах вспомнить былые времена).
На реализацию клиентской части ушло около 4(в общем) рабочих часов.
[лирик]Львиную долю работы убил на размышления о жизни(тз размыто)[/лирик]

В проеткте не использовал сторонних решений так как они не отображают мышление программиста 
а только навок/знание стороннего решения.
Так же опустил интерфейсы и некоторые возможности стандарта, не нашёл причин.

Важно! 
Данный проект всего лишь демонстрация и ни как не является примером для подражания.
