
![landing](https://user-images.githubusercontent.com/46515069/52531877-a3166980-2d1c-11e9-9023-cefa30813315.jpg)
# NGSHOP 


__projet éducatif  réalisé au campus numérique in the Alps__

https://digital-grenoble.com/campus-numerique-in-the-alps/


## Getting Started
***

git clone the project with the command :


git clone git@github.com:jpb4git/session.git




### Prerequisites


[Nginx ou Apache ] : vous devez avoir un serveur web installé sur votre machine  

[mysql] :  doit être installé également

## Install Nginx


install Nginx
term : sudo apt-get install nginx

## Configure  Nginx

éditez votre  /etc/Nginx/sites-available/default   file 
```
vous pouvez changer le root du server par la ligne 

root /var/www/[VOtreDossierRoot]
```
//après location ajoutez ces lignes pour la gestion  de PHP par Nginx
```
location ~ \.PHP$ {
   include snippets/fastcgi-php.conf;
  fastcgi_pass unix:/run/PHP/php7.2-fpm.sock;
}
```

### install and Configure  php



### install and configure  mysql

### install and Configure  phpmyAdmin

***

## Running step 3 (terminal mode)
![ngshop](https://user-images.githubusercontent.com/46515069/52532863-91888e00-2d2b-11e9-97ad-d8bd940227c5.jpg)

### une application en mode terminal est accecible à la racine du site: 
 tapez  :
 ```
 php ngshop 
```

*vous disposez d'une aide el ligne en passant par la commande* 
 
```
php ngshop --help
```



***
## Deployment
placez ce repo dans votre www.
Appelez-le via le browser par localhost/VotreRepo/



### Built With




## Contributing




## Versioning


We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 


## Authors


* **JEAN-PASCAL BOUDET** - *Initial work* - [jpb4git](https://github.com/jpb4git/)




## License


This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details


## Acknowledgments


* design inspiration (www.nginx.com)
