# vagrant plugin install vagrant-librarian-puppet

Vagrant.configure('2') do |config|
  config.vm.box = 'debian-6-amd64'
  config.vm.box_url = 'http://s3.cargomedia.ch/vagrant-boxes/debian-6-amd64.box'

  config.vm.network :private_network, ip: '10.10.20.5'
  config.vm.network :forwarded_port, guest: 80, host: 8080
  config.vm.synced_folder '.', '/app/denkmal.org', nfs: true

  config.librarian_puppet.puppetfile_dir = 'puppet'
  config.vm.provision :puppet do |puppet|
    puppet.module_path = 'puppet/modules'
    puppet.manifests_path = 'puppet/manifests'
  end
end
