Vagrant.configure('2') do |config|
  config.ssh.forward_agent = true
  config.vm.box = 'cargomedia/debian-8-amd64-cm'

  config.vm.hostname = 'denkmal.dev.cargomedia.ch'
  if Vagrant.has_plugin? 'landrush'
    config.landrush.enable
    config.landrush.tld = 'dev.cargomedia.ch'
    config.landrush.host 'denkmal.dev.cargomedia.ch'
    config.landrush.host 'admin-denkmal.dev.cargomedia.ch'
    config.landrush.host 'origin-denkmal.dev.cargomedia.ch'
  end

  config.vm.network :private_network, ip: '10.10.10.12'
  config.vm.network :public_network, bridge: 'en0: Wi-Fi (AirPort)'
  config.vm.synced_folder '.', '/home/vagrant/denkmal', :type => 'nfs'
  config.vm.synced_folder '../cm', '/home/vagrant/cm', :type => 'nfs' if Dir.exists? '../cm'

  config.librarian_puppet.puppetfile_dir = 'puppet'
  config.librarian_puppet.placeholder_filename = '.gitkeep'
  config.librarian_puppet.resolve_options = { :force => true }
  config.vm.provision :puppet do |puppet|
    puppet.environment_path = 'puppet/environments'
    puppet.environment = 'development'
    puppet.module_path = ['puppet/modules', 'puppet/environments/development/modules']
  end

  config.vm.provision 'shell', run: 'always', inline: [
    'cd /home/vagrant/denkmal',
    '(test ! -L vendor/cargomedia/cm || rm vendor/cargomedia/cm)',
    'composer --no-interaction install',
  ].join(' && ')

  if ENV['LINK']
    config.vm.provision 'shell', run: 'always', inline: [
      'cd /home/vagrant/denkmal',
      'rm -rf vendor/cargomedia/cm',
      'ln -s ../../../cm vendor/cargomedia/cm',
    ].join(' && ')
  end

  config.vm.provision 'shell', run: 'always', inline: [
    'cd /home/vagrant/denkmal',
    'cp resources/config/_local.dev.php resources/config/local.php',
    "bin/cm app set-config deploy '#{{ :deployVersion => Time.now.to_i }.to_json}'",
    'bin/cm app setup',
    'bin/cm migration run',
    'sudo foreman-systemd reload -w cm-applications.target denkmal .',
  ].join(' && ')
end
