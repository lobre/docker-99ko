# 99ko container

After having created the main user, you can delete the `install.php` using that command.

    docker exec -ti 99ko rm /var/www/html/install.php

To change permissions of mounted `theme` and `plugin` folders.

    docker exec -ti 99ko chgrp -R www-data /var/www/html/plugin /var/www/html/theme
