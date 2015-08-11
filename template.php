server {
        
        listen   80;

        root /var/www/<?php echo $domain; ?>/public_html;
        index index.php index.html index.htm;

        # Make site accessible from http://localhost/
        server_name <?php echo $domain; ?> www.<?php echo $domain; ?> dev.<?php echo $domain; ?>;
    
        location / {
                try_files $uri $uri/ /index.php?$args;
        }
        
        location ~ \.php$ {
                try_files $uri =404;
                fastcgi_split_path_info ^(.+\.php)(/.+)$;
                # NOTE: You should have "cgi.fix_pathinfo = 0;" in php.ini

                # With php5-cgi alone:
                #fastcgi_pass 127.0.0.1:9000;
                # With php5-fpm:
                fastcgi_pass unix:/var/run/php5-fpm.sock;
                fastcgi_index index.php;
                include fastcgi_params;

                client_max_body_size 32m;
        }
        
}