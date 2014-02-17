Vagrant.configure('2') do |config|
  config.vm.box = 'debian-7-amd64'
  config.ssh.forward_agent = true

  config.vm.hostname = 'www.denkmal.org'

  config.librarian_puppet.puppetfile_dir = 'puppet'
  config.librarian_puppet.placeholder_filename = '.gitkeep'
  config.vm.provision :puppet do |puppet|
    puppet.module_path = 'puppet/modules'
    puppet.manifests_path = 'puppet/manifests'
  end

  config.vm.provider :virtualbox do |virtualbox, override|
    override.vm.box_url = 'http://vagrant-boxes.cargomedia.ch/virtualbox/debian-7-amd64-default.box'
    override.vm.hostname = 'www.denkmal.dev'
    #override.dns.tld = 'dev'
    #override.dns.patterns = [/^.*denkmal.dev$/]
    override.vm.network :private_network, ip: '10.10.10.10'
    override.vm.synced_folder '.', '/vagrant', nfs: true
  end

  config.vm.provider :aws do |aws, override|
    override.vm.box_url = 'http://vagrant-boxes.cargomedia.ch/aws/debian-7-amd64-default.box'
    override.ssh.username = 'admin'
    override.ssh.private_key_path = '~/.ssh/denkmal.org.pem'
    override.vm.synced_folder '.', '/vagrant', disabled: true

    aws.access_key_id = ENV['AWS_ACCESS_KEY']
    aws.secret_access_key = ENV['AWS_SECRET_KEY']
    aws.keypair_name = 'denkmal.org'

    aws.region = 'eu-west-1'
    aws.instance_type = 'm3.medium'
    aws.security_groups = 'denkmal.org'
  end
end
