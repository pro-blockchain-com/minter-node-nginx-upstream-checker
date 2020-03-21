# minter-node-nginx-upstream-checker
Checking the nodes for the correct block height and turning on the upstream

```bash
cp 00_upstream_main.conf /etc/nginx/sites-enabled/00_upstream_main.conf
cp 10_default.conf  /etc/nginx/sites-enabled/10_default.conf
cp 11_node_8840.conf /etc/nginx/sites-enabled/11_node_8840.conf

./nginx_node_upstream_checker.php
```

```bash
ln -s 00_upstream_main.conf /etc/nginx/sites-enabled/00_upstream_main.conf
ln -s 10_default.conf  /etc/nginx/sites-enabled/10_default.conf
ln -s 11_node_8840.conf /etc/nginx/sites-enabled/11_node_8840.conf

./nginx_node_upstream_checker.php
```
