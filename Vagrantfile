Vagrant.configure("2") do |config|
  config.vm.box = 'debian-6-amd64'
  config.vm.box_url = 'http://s3.cargomedia.ch/vagrant-boxes/debian-6-amd64.box'

  config.vm.synced_folder Dir.getwd, '/var/www/denkmal.org'
  config.vm.network 'forwarded_port', guest: 80, host: 8080
  config.ssh.forward_agent = true

  config.vm.provision :shell, :inline => 'gem install puppet_local --no-ri --no-rdoc;' \
    'apt-get install git -y;' \
    'puppet-local install /var/www/denkmal.org/hiera.json'
end
