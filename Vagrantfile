# NOTE: use for Windows only when you already have Vagrant and cannot setup docker + docker-compose
# Steps the same as described in README.md, except Pre-setup steps for Vagrant:

# Pre-setup steps for Vagrant
# > vagrant up
# > vagrant ssh
# > cd magento2


ram = '2048'
hostname = 'localhost'
ip = '192.168.0.97'
Vagrant.configure(2) do |config|
  config.vm.box = "ubuntu/trusty64"

    config.vm.box_check_update = false
    config.vm.hostname = hostname
    config.vm.network :private_network, ip: ip
    config.vm.network :forwarded_port, host: 8085, guest: 8085
    config.vm.network :forwarded_port, host: 8088, guest: 8088
    config.vm.provider "virtualbox" do |v|
        v.customize ['modifyvm', :id, '--name', hostname, '--memory', ram]
    end

  # config.vm.network "public_network"

  # Install docker
  config.vm.provision :docker

  # Install docker-compose
  config.vm.provision "shell", inline: <<-EOC
    test -e /usr/local/bin/docker-compose || \\
    curl -sSL https://github.com/docker/compose/releases/download/1.17.0/docker-compose-`uname -s`-`uname -m` \\
      | sudo tee /usr/local/bin/docker-compose > /dev/null
    sudo chmod +x /usr/local/bin/docker-compose
    test -e /etc/bash_completion.d/docker-compose || \\
    curl -sSL https://raw.githubusercontent.com/docker/compose/$(docker-compose --version | awk 'NR==1{print $NF}')/contrib/completion/bash/docker-compose \\
      | sudo tee /etc/bash_completion.d/docker-compose > /dev/null
  EOC

# Script to run app
$appRunScript = <<SCRIPT
sudo apt-get install -y git
git clone https://github.com/mslabko/mageconf-workshop.git magento2
cd magento2
docker-compose up -d
SCRIPT

  config.vm.provision "shell", inline: $appRunScript
end