Vagrant.configure('2') do |config|
  config.ssh.forward_agent = true
  config.vm.box = 'debian-7-amd64-cm'
  config.vm.box_url = 'http://vagrant-boxes.cargomedia.ch/virtualbox/debian-7-amd64-cm.box'

  config.vm.hostname = 'www.denkmal.dev'
  if Vagrant.has_plugin? 'vagrant-dns'
    config.dns.tld = 'dev'
    config.dns.patterns = [/^.*denkmal.dev$/]
  end

  if Vagrant.has_plugin? 'vagrant-phpstorm-tunnel'
    config.phpstorm_tunnel.project_home = '/home/vagrant/denkmal'
  end

  config.vm.network :private_network, ip: '10.10.10.12'
  config.vm.synced_folder '.', '/home/vagrant/denkmal', :type => 'nfs'

  config.librarian_puppet.puppetfile_dir = 'puppet'
  config.librarian_puppet.placeholder_filename = '.gitkeep'
  config.librarian_puppet.resolve_options = {:force => true}
  config.vm.provision :puppet do |puppet|
    puppet.module_path = 'puppet/modules'
    puppet.manifests_path = 'puppet/manifests'
  end

  config.vm.provision 'shell', inline: [
    'cd /home/vagrant/denkmal',
    'composer --no-interaction install --dev',
    'cp resources/config/local.dev.php resources/config/local.php',
    'bin/cm app set-deploy-version',
    'bin/cm app setup',
    'bin/cm db run-updates',
  ].join(' && ')
end
