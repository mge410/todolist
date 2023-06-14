# ToDoList

**Запуск проекта**

Клонируем себе репозиторий:  
```git clone https://github.com/mge410/todolist.git ```  
и переходим в папку с проектом   
```cd todolist ```

Для запуска через Docker потребуется запустить [Docker desktop](https://www.docker.com/products/docker-desktop/).

| **Запуск проекта с Docker**                                                                                     |
|-----------------------------------------------------------------------------------------------------------------|
| **1** Подгружаем зависимости composer: <br>```composer install --no-dev```                                      |
| **2** Подгружаем зависимости npm и запускаем build: <br>```npm install ```   <br>```npm run build  ```          |
| **3** Копируем env файл: <br>  ```cp -r .env.docker .env```                                                     |
| **4** Генерируем ключ для приложения: <br>  ```php artisan key:gen```                                           |
| **5** Поднимаем docker контейнер: <br>```docker-compose up -d ```                                               |
| **6** Заходим в контейнер и все следующие команды выполняем в нём: <br>```docker exec -it app_todolist bash ``` |
| **7** Создаём storage link : <br>```php artisan migrate  ```                                                    |
| **8** Подгружаем миграции : <br>```php artisan storage:link  ```                                                |

| **Запуск без Docker**                                                                                  |
|--------------------------------------------------------------------------------------------------------|
| **1** Подгружаем зависимости composer: <br>```composer install ```                                     |
| **2** Подгружаем зависимости npm и запускаем build: <br>```npm install ```   <br>```npm run build  ``` |
| **3** Копируем env файл: <br>  ```cp -r .env.example .env```                                           |
| **4** Генерируем ключ для нашего приложения :  <br> ```php artisan key:gen```                          |
| **5** Запускаем миграции    <br>```php artisan migrate```                                              |
| **6** Запускаем сервер : <br>  ```php artisan serve```                                                 |

После проект будет доступен тут ```http://127.0.0.1:8000/```
<br><br><br>
**Некоторые особенности проекта**

