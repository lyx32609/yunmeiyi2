server {
    include       mime.types;
    default_type  application/octet-stream;
    server_name ly.xunmallapi.com;
    root  /var/www/html/ly;
    location ~ .*\.(gif|jpg|jpeg|png|css)$ {
            expires 24h;
            proxy_store on;
            proxy_store_access user:rw group:rw all:rw;
            proxy_redirect          off;
            proxy_set_header        Host 127.0.0.1;
            client_max_body_size    10m;
            client_body_buffer_size 1280k;
            proxy_connect_timeout   900;
            proxy_send_timeout      900;
            proxy_read_timeout      900;
            proxy_buffer_size       40k;
            proxy_buffers           40 320k;
            proxy_busy_buffers_size 640k;
            proxy_temp_file_write_size 640k;
            if ( -f $request_filename)
            {
                break;
            }
    }

    location / {
                index  index.html index.php;
                if (!-e $request_filename){
                        rewrite ^/(.*) /index.php last;
                }
        }

        location ~ \.php$ {
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        proxy_set_header Host  $host;
        proxy_set_header X-Forwarded-For  $remote_addr;
        real_ip_header     X-Forwarded-For;
        fastcgi_pass 127.0.0.1:9000;
        }
}

