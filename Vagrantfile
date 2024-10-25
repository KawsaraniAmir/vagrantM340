# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  BOX_IMAGE = "ubuntu/jammy64"
  BASE_INT_NETWORK = "10.10.20"
  BASE_HOST_ONLY_NETWORK = "192.168.56"
  
  VMBASENAME = "m340"
  
  config.vm.define "web.#{VMBASENAME}" do |web|
    web.vm.hostname = "web.#{VMBASENAME}"
    web.vm.box = BOX_IMAGE
    web.vm.network "private_network", ip: "#{BASE_HOST_ONLY_NETWORK}.10", name: "VirtualBox Host-Only Ethernet Adapter"
    web.vm.network "private_network", ip: "#{BASE_INT_NETWORK}.10", virtualbox__intnet: true
	web.vm.synced_folder "./web_content", "/var/www/html"

    web.vm.provision "shell", inline: <<-SCRIPT
	  sudo apt-get update -y
	  sudo apt-get upgrade -y
    sudo apt-get install -y apache2 php libapache2-mod-php mysql-client php-mysql php-mysql php-mysqli php-pdo
    sudo a2enmod rewrite

    sudo bash -c 'echo "<Directory /var/www/html>\n    AllowOverride All\n</Directory>" >> /etc/apache2/sites-available/000-default.conf'

    sudo chown -R www-data:www-data /var/www/html

	  systemctl enable apache2
	  systemctl start apache2
	SCRIPT
  end

  config.vm.define "db.#{VMBASENAME}" do |db|
    db.vm.hostname = "db.#{VMBASENAME}"
    db.vm.box = BOX_IMAGE
    db.vm.network "private_network", ip: "#{BASE_INT_NETWORK}.11", virtualbox__intnet: true

	db.vm.provision "shell", inline: <<-SCRIPT
      set -e
      sudo apt-get update
      sudo apt-get install -y mariadb-server
      # Permette a mariadb di prendere richieste dall'esterno.
      sudo sed -i 's/^bind-address\s*=.*/bind-address = 0.0.0.0/' /etc/mysql/mariadb.conf.d/50-server.cnf

      sudo systemctl enable mariadb

      # Applica la modifica.
      sudo systemctl restart mariadb

	    # Creazione di un utente non root per il collegamento dal web server
	    sudo mysql -e "CREATE USER 'vagrant'@'%' IDENTIFIED BY 'password';"
	    sudo mysql -e "GRANT ALL PRIVILEGES ON *.* TO 'vagrant'@'%';"
	    sudo mysql -e "FLUSH PRIVILEGES;"

	    # Esecuzione del file SQL
	    sudo mysql -u vagrant -ppassword < /vagrant/db/database.sql
	SCRIPT

  end
end
