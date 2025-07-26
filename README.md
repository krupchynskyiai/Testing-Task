Установка

Установка проекту є простою за використання плагіну Duplicator. Проте для імпорту необхідна Pro версія. Необхідно розпакувати завантажений архів (так, я склав архів в архів задля уникнення потенційних проблем з перейменуванням) та імпортувати розпакований архів у плагін (або у папку wp-content/backup-dup/imports/) та відресторити. Або можна вже на встановлений wordpress закинути файли з репозиторія, імпортувати дамп бд (додав до репозиторію) та виконати SQL команди 

UPDATE wp_posts SET post_content = REPLACE(post_content, 'http://localhost:10365', 'http://your-domain.com');

UPDATE wp_posts SET post_title = REPLACE(post_title, 'http://localhost:10365', 'http://your-domain.com');

UPDATE wp_posts SET post_excerpt = REPLACE(post_excerpt, 'http://localhost:10365', 'http://your-domain.com');

UPDATE wp_posts SET guid = REPLACE(guid, 'http://localhost:10365', 'http://your-domain.com');

UPDATE wp_options SET option_value = REPLACE(option_value, 'http://localhost:10365', 'http://your-domain.com') WHERE option_name = 'home' OR option_name = 'siteurl' OR option_value LIKE '%http://localhost:10365%';

UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, 'http://localhost:10365', 'http://your-domain.com') WHERE meta_value LIKE '%http://localhost:10365%';

UPDATE wp_comments SET comment_content = REPLACE(comment_content, 'http://localhost:10365', 'http://your-domain.com');

UPDATE wp_comments SET comment_author_url = REPLACE(comment_author_url, 'http://localhost:10365', 'http://your-domain.com');

UPDATE wp_links SET link_url = REPLACE(link_url, 'http://localhost:10365', 'http://your-domain.com');

UPDATE wp_links SET link_image = REPLACE(link_image, 'http://localhost:10365', 'http://your-domain.com');

Запуск проекту + редагування


Наразі проект вже весь зібраний і готовий до використання, проте, за потреби можна в терміналі можна виконати команду npm run dev і вносити зміни в файли. За цього скрипта будуть відлавлюватися зміни, які стосуються TailwindCSS, звичайного JS та React і будуть автоматично перезбиратися. 

Проте попередньо треба буде ініціалізувати через npm install для того, щоб підвантажилися всі необхідні пакети. 

!ВАЖЛИВО!
Для коректної роботи необхідно перевірити чи є API TOKEN у wp-config.php
define('API_TOKEN', 'GRJ^j^a7bdFBI9ZUu1I*lxvjAYAjpJdb');
Якщо його немає, необхідно додати (інакше блок каталогу працювати не буде)

Проект

Задля демонстрації знань та навичок, проект побудований таким чином:
сторінка General Settings (знаходиться Settings -> General Settings) - зроблена через ручну реєстрацію додаткової сторінки меню та ручну реєстрацію необхідних полів
блоки Hero, Filters, List - кастомні ACF блоки
блок Каталог - реєструється як кастонимй блок, проте побудований на React
сторінка single приймає будь яка блоки
сторінка single-cars - використовує дані з кастомних полів цього посттайпу
також посттайп cars використовує 2 таксономії - brands та categories

Каталог

Блок каталогу побудований на React і використовує ендпоінт testing-task/v1/cars. Фільтрація, сортування, пошук та пагінація реалізовані на стороні сервера. В залежності від заданих параметрів ендпоінт віддає відповідні результати. 
Цей ендпоінт можна використати і з інших пристроїв, проте необхідно використати API TOKEN для авторизації. 
Також сторінка /catalog/ підтримує SEO-Friendly урли, тобто такий урл http://localhost:10365/catalog/brand/skoda,honda/sort/newest/search/adui/ автоматично активує усі вказані фільтри, сортування тощо.
