Vagrant.configure('2') do |config|
  config.vm.box = 'debian-6-amd64'
  config.vm.box_url = 'http://s3.cargomedia.ch/vagrant-boxes/debian-6-amd64.box'
  config.ssh.forward_agent = true

  config.vm.hostname = 'www.denkmal.org'

  config.librarian_puppet.puppetfile_dir = 'puppet'
  config.librarian_puppet.placeholder_filename = '.gitkeep'
  config.vm.provision :puppet do |puppet|
    puppet.module_path = 'puppet/modules'
    puppet.manifests_path = 'puppet/manifests'
  end

  config.vm.provider :virtualbox do |virtualbox, override|
    override.vm.hostname = 'www.denkmal.dev'
    #override.dns.tld = 'dev'
    #override.dns.patterns = [/^.*denkmal.dev$/]
    override.vm.network :private_network, ip: '10.10.10.10'
    override.vm.synced_folder '.', '/vagrant', nfs: true
  end

  config.vm.provider :aws do |aws, override|
    override.vm.box = 'dummy'
    override.vm.box_url = 'https://github.com/mitchellh/vagrant-aws/raw/master/dummy.box'
    override.ssh.username = 'admin'
    override.ssh.private_key_path = '~/.ssh/denkmal.org.pem'
    override.vm.synced_folder '.', '/vagrant', disabled: true

    aws.access_key_id = 'AKIAJMEUUI54CZ3YN3DA'
    aws.secret_access_key = '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'
    aws.keypair_name = 'denkmal.org'

    aws.ami = 'ami-9ef001e9'
    aws.region = 'eu-west-1'
    aws.instance_type = 'm3.medium'
    aws.security_groups = 'denkmal.org'
    aws.tags = {
        :app => 'denkmal.org',
    }
  end
end
