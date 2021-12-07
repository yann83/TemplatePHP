# TemplatePHP
I would like to thanks [niltonpaes](https://github.com/niltonpaes/php_template_crud_api/) and [purotu](https://github.com/datamonnit/simple-crud-example/) for sharing linked code, it was a great inspiration for me.

## Content
Actually this template was built with Boostrap 5, Firebase, some ajax/javascript and I've added an API fonctionnality with JWT token.
There are two roles : Admin and User.
You can CRUD the Users or Products page on a single page.
There is an API doc (this isn't a full doc)
A user can change his email or password, and generate a token for 24hours.

  ## How to use
You can import php_template.sql sample.
Default credentials are : user:user and admin:admin

The App :
You must change constants in 
- SQL config : \config\pdo-connection.php. 
- Constantes file : \layout\constantes.php.

The API :
You must change constants in 
- Core file : \api\config\core.php
- Database file : \api\config\database.php

Feel free to update, change or share this template.