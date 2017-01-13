# PHP-MVC
iNightclub - PHP MVC OOP script. Copyright goes on https://github.com/andrzuk/FineCMS </br>
Script was found on github, tried to contact the owner for permission to use it on Facebook, no response. </br>
# Currently working on adding a posts/pages comment system, FRONTEND pagination for category post pages. </br>

Comment system should be built on 3 new files: </br>
application/controller/comments.php </br>
application/model/comments.php </br>
application/view/comments.php </br>

MySQL table "comments" already created</br>
Website of the CMS is here: www.inight.club , example of pages where I need comments is for example here on this single post page: http://inight.club/index.php?route=page&id=7  (it should be inserted in extended.php in templates folder (css with bootstrap) in an "article" class, it must be OOP - MVC approach, using OOP and MVC, we should create 3 comments.php files and we should put them in "root/application" directory, 1 comments.php  file into Root/Application/Controller folder, 1 into View, 1 into Model folder, to see how it works take a look in other controllers - models - views files. You will see that they are very similar, comments.php should be simple, all of model php are already connected to database.php which is using config.php data. I want only logged in users to comment, so we can ignore creating any comment form, I don't need it, I need only registered users to be able to comment, so only very simple "textarea" field. In "inight" database I have already created "comments" table, but because I am not MySQL expert we should control attributes, null, not null, unsigned ecc, and necessary to create foreign key for author_id. 

