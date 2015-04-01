node default {

  $domain = 'denkmal.dev'

  class {'cm::application':
    development => true,
  }

  cm::vhost {"www.${domain}":
    path => '/home/vagrant/denkmal',
    debug => true,
    aliases => [$domain, "admin.${domain}"],
    ssl_key => file("/home/vagrant/denkmal/puppet/templates/ssl/*.denkmal.dev.key"),
    ssl_cert => file("/home/vagrant/denkmal/puppet/templates/ssl/*.denkmal.dev.pem"),
    cdn_origin => 'origin-www.denkmal.dev',
  }

  include 'redis'
  include 'mysql::server'
  include 'memcached'
  include 'elasticsearch'
  include 'gearman::server'
  include 'cm::services::webserver'
  include 'mongodb::role::standalone'

  class { 'cm::services::stream':
    ssl_key => file("/home/vagrant/denkmal/puppet/templates/ssl/*.denkmal.dev.key"),
    ssl_cert => file("/home/vagrant/denkmal/puppet/templates/ssl/*.denkmal.dev.pem"),
  }

  environment::variable {'PHP_IDE_CONFIG':
    value => 'serverName=www.denkmal.dev',
  }

}
