node default {

  class {'cm::application':
    development => true,
  }

  class {'cm::services':
    ssl_key => file('/home/vagrant/denkmal/puppet/templates/ssl/denkmal-dev.key'),
    ssl_cert => file('/home/vagrant/denkmal/puppet/templates/ssl/denkmal-dev.pem'),
  }

  cm::vhost {'www.denkmal.dev':
    path => '/home/vagrant/denkmal',
    debug => true,
    ssl_key => file("/home/vagrant/denkmal/puppet/templates/ssl/denkmal-dev.key"),
    ssl_cert => file("/home/vagrant/denkmal/puppet/templates/ssl/denkmal-dev.pem"),
    aliases => ['denkmal.dev', 'admin.denkmal.dev'],
    cdn_origin => 'origin-www.denkmal.dev',
  }

  environment::variable {'PHP_IDE_CONFIG':
    value => 'serverName=www.denkmal.dev',
  }

}
