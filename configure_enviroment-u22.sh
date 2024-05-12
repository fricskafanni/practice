#!/bin/bash


#Definición de variables

DOMAIN_DEV="devhogarth.com"
DIR_APACHE_CONF="/etc/apache2/apache2.conf"
DIR_APACHE_SITES="/etc/apache2/sites-enabled"
DIR_FILE_00_DEFAUTL="/etc/apache2/sites-enabled/000-default.conf"
MYSQL_CONF_FILE="/etc/mysql/mysql.conf.d/mysqld.cnf"
APACHE_LOG_DIR="/var/log/apache2/"


get_subdomain()
{
    read -p "$MSG_GET_SUBDOMAIN" SUBDOMAIN
    _message "$MSG_SUBDOMAIN_CONFIRM" 
    _msg_question "$MSG_CONFIRM" "$SUBDOMAIN" "$DOMAIN_DEV"
    if ! _confirm; then
            exit $EXIT_CODE_ABORTED; 
    fi
}


checks_root(){
    if  [ $EUID -ne 0 ]
        then _msg_error "$MSG_IS_ROOT"
        exit
    fi
}

certs_install()
{
    _message "$MSG_INSTALL_CERTS"
    docker pull certbot/dns-route53 > /dev/null
    docker run -it --rm -v /home/ubuntu/var-log-letsencrypt:/var/log/letsencrypt -v ~/.aws/credentials:/root/.aws/credentials -v /home/ubuntu/certs:/etc/letsencrypt certbot/dns-route53 certonly -v -n --agree-tos --dns-route53 --email me@mydomain.com -d $SUBDOMAIN.$DOMAIN_DEV --force-renewal
}

libs_install()
{
    _message "$MSG_INSTALL_LIBS"
    sudo a2enmod ssl > /dev/null
    sudo a2enmod rewrite > /dev/null
    sudo a2enmod headers > /dev/null
    sudo a2enmod userdir > /dev/null
    sudo usermod -a -G ubuntu www-data > /dev/null
    sudo chgrp www-data /home/ubuntu > /dev/null
    #sudo apt -qq install mariadb-server -y > /dev/null
    #sudo apt -qq install ruby-sass -y > /dev/null
}



create_apache_site(){
    DIR_FILE_SITE="$DIR_APACHE_SITES/$SUBDOMAIN.$DOMAIN_DEV.conf"
    DOMAIN="$SUBDOMAIN.$DOMAIN_DEV"
    _message "$MSG_CREATE_APACHE_SITE" "$DIR_FILE_SITE"
    sudo cat > $DIR_FILE_SITE <<EOL
<Directory /home/ubuntu/environment/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
</Directory>    

<VirtualHost *:80>
        ServerAdmin webmaster@localhost
        ServerName $DOMAIN
        DocumentRoot /home/ubuntu/environment/dev
        Redirect permanent / https://$DOMAIN/
        ErrorLog ${APACHE_LOG_DIR}${DOMAIN}_error.log
        CustomLog ${APACHE_LOG_DIR}${DOMAIN}_access.log combined
</VirtualHost>

<IfModule mod_ssl.c>
        <VirtualHost *:443>
                ServerAdmin webmaster@localhost
                ServerName $DOMAIN
                DocumentRoot /home/ubuntu/environment/dev
                ErrorLog ${APACHE_LOG_DIR}${DOMAIN}_error.log
                CustomLog ${APACHE_LOG_DIR}${DOMAIN}_access.log combined              
                SSLEngine on
                SSLCertificateFile      /home/ubuntu/certs/live/$DOMAIN/cert.pem
                SSLCertificateKeyFile /home/ubuntu/certs/live/$DOMAIN/privkey.pem
                SSLCertificateChainFile /home/ubuntu/certs/live/$DOMAIN/fullchain.pem
                <FilesMatch "\.(cgi|shtml|phtml|php)$">
                                SSLOptions +StdEnvVars
                </FilesMatch>
                <Directory /usr/lib/cgi-bin>
                                SSLOptions +StdEnvVars
                </Directory>
        </VirtualHost>
</IfModule>
EOL
}


unlink_site_default(){
    _message "$MSG_UNLINK_00_SITE" "$DIR_FILE_00_DEFAUTL"
    if [ -f "$DIR_FILE_00_DEFAUTL" ]
    then
            sudo unlink $DIR_FILE_00_DEFAUTL
    fi
    
}


restart_apache(){
    _message "$MSG_RESTART_APACHE"
    sudo service apache2 restart
}

mysql_config(){
    _message "$MSG_MYSQL_BINADD"
    sudo sed -i 's/^bind-address/#bind-address/g' $MYSQL_CONF_FILE
# DUDA, comentar tambien mysqlx-bind-address 
#sudo sed -i 's/^mysqlx-bind-address/#mysqlx-bind-address/g' $MYSQL_CONF_FILE
}

add_mysql_users(){
    _message "$MSG_MYSQL_USERS"
    read -p "$MSG_MYSQL_USER" MYSQLUSER
    read -p "$MSG_MYSQL_PASS" MYSQLPASS
    _message "$MSG_MYSQL_CREATE_USER" "$MYSQLUSER" "$MYSQLPASS"
    
    sudo mysql -u root <<MYSQL_INPUT


CREATE USER '$MYSQLUSER'@'%' IDENTIFIED BY '$MYSQLPASS';     
GRANT ALL PRIVILEGES ON *.* TO '$MYSQLUSER'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;
MYSQL_INPUT
# DUDA: Si el usuario existe dara error la creacion del mismo
    
}

create_mysql_ddbb(){
    read -p "$MSG_MYSQL_GET_DDBB" MYSQLDB
    _message "$MSG_MYSQL_DDBB" "$MYSQLDB"
    sudo mysql -u root <<MYSQL_INPUT
CREATE DATABASE $MYSQLDB
MYSQL_INPUT
}


mysql_restart(){
    sudo /etc/init.d/mysql restart
}





init()
{
    # echo "Biendenido a la configuración del c9.io para Apache y Mysql. Con el dominio: $DOMAIN_DEV \nDesea Continuar? [y/N]\n"
    checks_root
    _message "$MSG_WELCOME"
    _msg_question "$MSG_INIT_INSTALL" "$DOMAIN_DEV" "$DOMAIN_DEV"
    ! _confirm && exit $EXIT_CODE_ABORTED;
    get_subdomain
    libs_install
    certs_install
    create_apache_site
    unlink_site_default
    restart_apache
    _msg_question "$MSG_MYSQL_CONFIRM"
    ! _confirm && exit $EXIT_CODE_ABORTED;
    mysql_config
    add_mysql_users
    _msg_question "$MSG_MYSQL_DDBB_CONFIRM"
    ! _confirm && exit $EXIT_CODE_ABORTED;
    create_mysql_ddbb
    mysql_restart
    _message "$MSG_FINISH"
    _check_ok
    _msg_error "$MSG_REMEMBER"
    
    
}





### Messages

readonly MSG_IS_ROOT="\nPor favor Ejecute el script como ROOT.\nsudo ./install_c9_enviroment.sh\n\n"
readonly MSG_WELCOME="\nBienvenido a la configuración del c9.io para Apache y Mysql."
readonly MSG_INIT_INSTALL=" \n¿Desea continuar? [y/N]\n"
readonly MSG_GET_SUBDOMAIN="¿Qué subdominio desea configurar?:  "
readonly MSG_SUBDOMAIN_CONFIRM="¿Los datos introducidos son correctos?:\n"
readonly MSG_CONFIRM="%s.%s [y/N]\n"
readonly MSG_INSTALL_CERTS="Generando el certificado de seguridad.\n"
readonly MSG_INSTALL_LIBS="Instalando módulos y librerías.\n"
readonly MSG_ADD_APACHE_CONFIG="Configurando Apache en el fichero: %s\n"
readonly MSG_CREATE_APACHE_SITE="Creando el fichero: %s\n"
readonly MSG_UNLINK_00_SITE="Eliminando link para el fichero: %s\n"
readonly MSG_RESTART_APACHE="Reiniciando Apache2.\n"
readonly MSG_MYSQL_CONFIRM="¿Desea configurar MySQL?  [y/N]\n"
readonly MSG_MYSQL_BINADD="Eliminando Bind-address=127.0.0.1 en la configuración de MySQL.\n"
readonly MSG_MYSQL_USERS="Configurando Usuarios para MySQL. Ingrese los siguientes datos:\n"
readonly MSG_MYSQL_USER="Usuario: "
readonly MSG_MYSQL_PASS="Contraseña: "
readonly MSG_MYSQL_CREATE_USER="Creando usuario con las siguientes credenciales %s : %s \n"
readonly MSG_MYSQL_DDBB_CONFIRM="¿Desea crear una BBDD? [y/N]\n"
readonly MSG_MYSQL_GET_DDBB="Por favor, especifique el nombre de la BBDD: "
readonly MSG_MYSQL_DDBB="Creando la BBDD: %s \n"
readonly MSG_FINISH="Se ha finalizado la instalación "
readonly MSG_REMEMBER="Recuerda configurar el puerto de MySQL 3306 en AWS.\n\n"





readonly COLOR_RED='\e[31m'
readonly COLOR_GREEN='\e[32m'
readonly COLOR_YELLOW='\e[33m'
readonly COLOR_BLUE='\e[34m'
readonly COLOR_DEFAULT='\e[39m'


### helpers

_check() {
    local MESSAGE
    MESSAGE=$(_msg_action "$@")
    printf "%-70s" "$MESSAGE" | tee -a $LOG_FILE
}

_check_ok() {
    _msg_action "✔\n" | tee -a $LOG_FILE
}

_check_fail() {
    _msg_action "❌\n"  | tee -a $LOG_FILE
}

_message() {
    local FORMAT=$1
    shift
    
    printf "${COLOR_GREEN}${FORMAT}${COLOR_DEFAULT}" "$@" | tee -a $LOG_FILE
}

_msg_question() {
    local FORMAT=$1
    shift
    
    printf "${COLOR_YELLOW}${FORMAT}${COLOR_DEFAULT}" "$@" | tee -a $LOG_FILE
}

_msg_action() {
    local FORMAT=$1
    shift
    
    printf "${COLOR_BLUE}${FORMAT}${COLOR_DEFAULT}" "$@" | tee -a $LOG_FILE
}

_msg_error() {
    local FORMAT=$1
    shift
    
    printf "${COLOR_RED}${FORMAT}${COLOR_DEFAULT}" "$@" | tee -a $LOG_FILE 1>&2
}

_confirm() {
    local RESPONSE
    read -r -p "> " RESPONSE
    RESPONSE=${RESPONSE,,} # tolower
    [[ $RESPONSE =~ (yes|y)$ ]]
}




init
